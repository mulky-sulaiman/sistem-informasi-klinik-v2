<?php

namespace App\Filament\Resources\ClinicResource\RelationManagers;

use App\Enums\GenderEnum;
use App\Enums\RoleEnum;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $title = 'Members';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\DateTimePicker::make('email_verified_at'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required()
                    ->maxLength(255)
                    ->visibleOn('create'),
                Forms\Components\Select::make('gender')
                    ->options([
                        GenderEnum::MALE->value => GenderEnum::MALE->label(),
                        GenderEnum::FEMALE->value => GenderEnum::FEMALE->label()
                    ]),
                Forms\Components\Select::make('roles')
                    ->relationship('roles', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->live()
                    ->hidden(fn (Get $get): bool => !in_array(auth()->user()->getRoleNames()->first(), [RoleEnum::SUPER_ADMIN->value, RoleEnum::ADMIN->value])),
                Forms\Components\TextInput::make('fee')
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('email'),
                Tables\Columns\TextColumn::make('roles.name')->label('Role'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
