<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Kullanıcı Oluştur';

    public function form(Form $form): Form
    {
        return $form
            ->columns(5)
            ->schema([
                Fieldset::make('Avatar')
                    ->extraAttributes([
                        'class' => 'h-full w-full',
                    ])
                    ->columnSpan(2)
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('avatar')
                            ->columnSpanFull()
                            ->avatar()
                            ->extraAttributes([
                                'class' => 'h-40 w-40  justify-center items-center',
                            ])
                            ->hiddenLabel()
                            ->acceptedFileTypes(['image/*']),

                    ]),

                Fieldset::make('User Information')
                    ->columnSpan(3)
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
                            ->revealable()
                            ->required(),
                    ]),

                Fieldset::make('Roles')
                    ->columnSpan(3)
                    ->schema([
                        Select::make('status')
                            ->label('Status')
                            ->default('active')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                            ])
                            ->required(),

                        Select::make('roles')
                            ->relationship('roles', 'name')
                            ->label('Roles')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->options(
                                fn () => Role::query()
                                    ->when(
                                        ! auth()->user()?->hasRole('super_admin'),
                                        fn ($query) => $query->whereNotIn('name', ['super_admin', 'Panel Admin'])
                                    )
                                    ->pluck('name', 'id')
                            ),
                    ]),
            ]);
    }
}
