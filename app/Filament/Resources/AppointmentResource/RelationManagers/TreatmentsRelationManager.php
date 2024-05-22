<?php

namespace App\Filament\Resources\AppointmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TreatmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'treatments';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('appointments')
                    ->relationship('appointments', 'name')
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required(),
                //->maxLength(255),
                Forms\Components\TextInput::make('quantity')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('discount')
                    ->numeric()
                    ->required(),
                // Forms\Components\TextInput::make('amount')
                //     ->numeric()
                //     ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('description')->limit(20),
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('price'),
                Tables\Columns\TextColumn::make('discount'),
                Tables\Columns\TextColumn::make('amount'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
