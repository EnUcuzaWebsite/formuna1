<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static ?string $title = 'Kullanıcı Oluştur';

    protected function handleRecordCreation(array $data): Model
    {
        $record = static::getModel()::createQuietly($data);

        $record->log([
            'type' => 'created',
            'message' => '
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                '.auth()->user()->name.'
                            </a>

                        </strong>
                        <small> oluşturdu </small>
                        <strong>
                            <a href="'.route('filament.admin.resources.users.view', ['record' => $record]).'">
                                '.$data['name'].'
                            </a>
                        </strong>',
        ]);

        return $record;
    }

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
