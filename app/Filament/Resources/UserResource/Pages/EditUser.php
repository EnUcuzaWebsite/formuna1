<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);
        return $record;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->visible(fn() => auth()->user()?->hasRole('super_admin'))
                    ->required(),
                RichEditor::make('bio')
                    ->label('Biografi'),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'suspended' => 'Suspended',
                        'banned' => 'Banned',
                    ])
                    ->required(),
                Select::make('roles')
                    ->relationship('roles', 'name')
                    ->label('Roles')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->options(
                        fn() => Role::query()
                            ->when(
                                !auth()->user()?->hasRole('super_admin'),
                                fn($query) => $query->whereNotIn('name', ['super_admin', 'Panel Admin'])
                            )
                            ->pluck('name', 'id')
                    )
                    ->disabled(fn() => !auth()->user()?->hasRole('super_admin') && $this->record->hasRole('super_admin') || $this->record->hasRole('Panel Admin')),
            ]);
    }
}
