<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Model;
use Filament\Actions;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Get;
use Spatie\Permission\Models\Role;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        unset($data['change_password']);
        $record->update($data);
        return $record;
    }


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Avatar')
                    ->acceptedFileTypes(['image/*'])
                    ->extraAttributes([
                        'class' => 'h-',
                    ]),
                Fieldset::make('Overview')
                    ->columnSpan(1)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        TextInput::make('name')
                            ->label('Name')
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Fieldset::make('Password')
                    ->columnSpan(1)
                    ->visible(fn() => auth()->user()?->hasRole('super_admin'))
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
                        Toggle::make('change_password')
                            ->label('Change Password')
                            ->live()
                            ->default(false),
                        TextInput::make('password')
                            ->label('Password')
                            ->password()
                            ->revealable()
                            // ->disabled(fn(Get $get) => !$get('change_password'))
                            ->visible(fn(Get $get) => auth()->user()?->hasRole('super_admin') && $get('change_password'))
                            ->columnSpanFull()
                            ->required(),
                    ]),

                Fieldset::make('Roles & Status')
                    ->columnSpan(1)
                    ->extraAttributes([
                        'class' => 'h-full',
                    ])
                    ->schema([
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
                            ->disabled(fn() => (!auth()->user()?->hasRole('super_admin') && $this->record->hasRole('super_admin')) || ($this->record->hasRole('Panel Admin') && auth()->user()?->hasRole('Panel Admin'))),
                    ]),


                RichEditor::make('bio')
                    ->label('Biografi')
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
