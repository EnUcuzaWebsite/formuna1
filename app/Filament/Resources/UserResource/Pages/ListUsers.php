<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\UserSuspension;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ListUsers extends ListRecords
{
    use ExposesTableToWidgets;

    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Kullanıcılar';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Kullanıcı Olşutur')
                ->icon('heroicon-o-plus-circle'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return UserResource::getWidgets();
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('roles.name')
                    ->label('Roles')
                    ->searchable()
                    ->sortable()
                    ->listWithLineBreaks(),
                IconColumn::make('status')
                    ->label('Status')
                    ->default('active')
                    ->sortable()
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-check-circle',
                        'active' => 'heroicon-o-check-circle',
                        'inactive' => 'heroicon-o-x-circle',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        default => 'success',
                        'inactive' => 'danger',
                    }),
                IconColumn::make('suspensions.status')
                    ->label('Suspension')
                    ->default('active')
                    ->sortable()
                    ->icon(fn (string $state): string => match ($state) {
                        default => 'heroicon-o-check-circle',
                        'active' => 'heroicon-o-check-circle',
                        'suspended' => 'heroicon-o-clock',
                        'banned' => 'heroicon-o-no-symbol',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        default => 'success',
                        'suspended' => 'warning',
                        'banned' => 'danger',
                    }),

            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    ViewAction::make()
                        ->color('primary'),
                    EditAction::make()
                        ->color('info'),
                    Action::make('activate')
                        ->label('Activate')
                        ->color('success')
                        ->icon('heroicon-o-check-circle')
                        ->requiresConfirmation()
                        ->visible(fn (Model $record) => $record->suspensions->where('expires_at', '>', now())->isNotEmpty())
                        ->action(function (Model $record) {
                            $record->suspensions->where('expires_at', '>', now())->each->delete();
                        }),
                    Action::make('suspend')
                        ->label('Suspend')
                        ->color('warning')
                        ->icon('heroicon-o-clock')
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
                        ->hidden(fn (Model $record) => $record->suspensions->where('expires_at', '>', now())->isNotEmpty())
                        ->action(function (Model $record, array $data) {
                            $data['expires_at'] = now()->addDays(intval($data['expires_days']));
                            UserSuspension::create([
                                'user_id' => $record->id,
                                'status' => $data['status'],
                                'reason' => $data['reason'],
                                'starts_at' => $data['starts_at'],
                                'expires_at' => $data['expires_at'],
                            ]);
                        }),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('activate')
                        ->label('Activate')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $record) {
                            $record->each(function (Model $record) {
                                $record->suspensions->where('expires_at', '>', now())->each->delete();
                            });
                            Notification::make()
                                ->title('Users Suspensions Removed')
                                ->icon('heroicon-o-check-circle')
                                ->success()
                                ->send();
                        }),

                    BulkAction::make('suspend')
                        ->label('Suspend')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-clock')
                        ->color('warning')
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
                        ->action(function (Collection $record, array $data) {
                            $record->each(function (Model $record) use ($data) {
                                $data['expires_at'] = now()->addDays(intval($data['expires_days']));
                                UserSuspension::create([
                                    'user_id' => $record->id,
                                    'status' => $data['status'],
                                    'reason' => $data['reason'],
                                    'starts_at' => $data['starts_at'],
                                    'expires_at' => $data['expires_at'],
                                ]);
                            });
                            Notification::make()
                                ->title('Users Suspended')
                                ->icon('heroicon-o-clock')
                                ->warning()
                                ->send();
                        }),

                ]),
            ]);
    }
}
