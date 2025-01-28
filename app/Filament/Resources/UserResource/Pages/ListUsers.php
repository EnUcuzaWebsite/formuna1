<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;


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
                ->icon('heroicon-o-plus-circle')
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
                    ->sortable()
                    ->icon(fn(string $state): string => match ($state) {
                        'active' => 'heroicon-o-check-circle',
                        'suspended' => 'heroicon-o-clock',
                        'banned' => 'heroicon-o-no-symbol',
                    })
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'suspended' => 'warning',
                        'banned' => 'danger',
                        default => 'gray',
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
                        ->hidden(fn(Model $record) => $record->isActive())
                        ->action(fn(Model $record) => $record->activate()),
                    Action::make('suspend')
                        ->label('Suspend')
                        ->color('warning')
                        ->icon('heroicon-o-clock')
                        ->requiresConfirmation()
                        ->hidden(fn(Model $record) => $record->isSuspended())
                        ->action(fn(Model $record) => $record->suspend()),
                    Action::make('ban')
                        ->label('Ban')
                        ->color('danger')
                        ->icon('heroicon-o-no-symbol')
                        ->requiresConfirmation()
                        ->hidden(fn(Model $record) => $record->isBanned())
                        ->action(fn(Model $record) => $record->ban()),

                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('ban')
                        ->label('Ban')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->action(function (Collection $record) {
                            $record->each->ban();
                            Notification::make()
                                ->title('Users Activated')
                                ->icon('heroicon-o-no-symbol')
                                ->success()
                                ->send();
                        }),

                    BulkAction::make('activate')
                        ->label('Activate')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Collection $record) {
                            $record->each->activate();
                            Notification::make()
                                ->title('Users Activated')
                                ->icon('heroicon-o-check-circle')
                                ->success()
                                ->send();
                        }),

                    BulkAction::make('suspend')
                        ->label('Suspend')
                        ->requiresConfirmation()
                        ->icon('heroicon-o-clock')
                        ->color('warning')
                        ->action(function (Collection $record) {
                            $record->each->suspend();
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
