<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\UserSuspension;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Fieldset;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Database\Eloquent\Model;

class ViewUser extends ViewRecord
{
    protected static string $resource = UserResource::class;

    public function getTitle(): string|\Illuminate\Contracts\Support\Htmlable
    {
        return $this->record->name;
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('suspend')
                ->label($this->record->isActive() ? 'Engelle' : 'Engeli Kaldır' )
                ->icon($this->record->isActive() ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-check-circle')
                ->color($this->record->isActive() ? 'danger' : 'success')
                ->form([
                    Select::make('status')
                        ->label('Status')
                        ->options([
                            'suspended' => 'Suspended',
                            'banned' => 'Banned',
                        ])
                        ->default('suspended')
                        ->required(),
                    Textarea::make('reason')
                        ->label('Reason')
                        ->required(),
                    DatePicker::make('starts_at')
                        ->label('Starts At')
                        ->default(now())
                        ->required(),
                    TextInput::make('expires_days')
                        ->label('Expires Days')
                        ->numeric()
                        ->integer()
                        ->required(),
                ])
                ->action(function (Model $record, array $data) {
                    if ($record->isActive()) {
                        $data['expires_at'] = now()->addDays(intval($data['expires_days']));
                        $suspension = UserSuspension::createQuietly([
                            'user_id' => $record->id,
                            'status' => $data['status'],
                            'reason' => $data['reason'],
                            'starts_at' => $data['starts_at'],
                            'expires_at' => $data['expires_at'],
                        ]);

                        $suspension->log([
                            'type' => $data['status'],
                            'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> '. $data['reason'] . ' nedeniyle Engelledi</small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.users.view', ['record' => $record]).'">
                                            '.$record->name.'
                                        </a>
                                      </strong>
                                       ',
                        ]);

                    }
                    else {

                        $suspensions = $record->suspensions->where('expires_at', '>', now());

                        $suspensions->each->deleteQuietly();

                        foreach ($suspensions as $suspension) {
                            $suspension->log([
                                'type' => $data['status'],
                                'message' => '<strong>
                                    <a href="' . route('filament.admin.resources.users.view', ['record' => auth()->user()]) . '">
                                        ' . auth()->user()->name . '
                                    </a>
                                  </strong>
                                  <small>' . $data['reason'] . ' nedeniyle Engelledi</small>
                                  <strong>
                                    <a href="' . route('filament.admin.resources.users.view', ['record' => $record]) . '">
                                        ' . $record->name . '
                                    </a>
                                  </strong>',
                            ]);

                            $suspension->deleteQuietly();
                        }
                    }
                }),


        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->columns(5)
            ->schema([
                SpatieMediaLibraryImageEntry::make('avatar')
                    ->hiddenLabel()
                    ->extraAttributes(['class' => 'h-full flex items-center justify-center'])
                    ->circular()
                    ->columnSpan(2)
                    ->defaultImageUrl($this->record->getFilamentAvatarUrl())
                    ->size(200),

                Fieldset::make('Overview')
                    ->columnSpan(3)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('roles.name')
                            ->label('Roles')
                            ->bulleted()
                            ->listWithLineBreaks(),
                        IconEntry::make('status')
                            ->icon(fn (string $state): string => match ($state) {
                                'active' => 'heroicon-o-check-circle',
                                'inactive' => 'heroicon-o-x-circle',
                            })
                            ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                                default => 'gray',
                            }),
                    ]),

                Fieldset::make('Biography')
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('bio')
                            ->hiddenLabel()
                            ->columnSpan(3),
                    ]),

                RepeatableEntry::make('user_logs')
                    ->label('Loglar')
                    ->columnSpan(3)
                    ->hidden(fn () => $this->record->user_logs->isEmpty())
                    ->extraAttributes([
                        'class' => 'user-activiy',
                    ])
                    ->schema([
                        TextEntry::make('loggable_type')
                            ->label('İşlem'),
                        TextEntry::make('created_at')
                            ->label('Tarih')
                            ->datetime(),
                        TextEntry::make('log.message')
                            ->html()
                            ->hiddenLabel()
                            ->columnSpan(2),

                        RepeatableEntry::make('changes')
                            ->label('Değişiklikler')
                            ->hiddenLabel()
                            ->columnSpan(3)
                            ->columns(3)
                            ->schema([
                                TextEntry::make('field')
                                    ->suffix(':')
                                    ->weight('bold')
                                    ->hiddenLabel(),
                                TextEntry::make('old')
                                    ->label('Eski'),
                                TextEntry::make('new')
                                    ->label('Yeni'),
                            ]),

                    ])
                    ->columns(2),

            ]);
    }
}
