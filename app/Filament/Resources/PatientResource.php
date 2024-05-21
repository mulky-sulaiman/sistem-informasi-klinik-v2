<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\Patient;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'User Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nik')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('birth_date'),
                Forms\Components\TextInput::make('gender'),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('marital_status'),
                Forms\Components\TextInput::make('blood_type'),
                Forms\Components\Textarea::make('bio')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('province_id')
                    ->maxLength(2),
                Forms\Components\TextInput::make('regency_id')
                    ->maxLength(4),
                Forms\Components\TextInput::make('district_id')
                    ->maxLength(7),
                Forms\Components\TextInput::make('village_id')
                    ->maxLength(10),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender'),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marital_status'),
                Tables\Columns\TextColumn::make('blood_type'),
                Tables\Columns\TextColumn::make('province_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('regency_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('village_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPatients::route('/'),
            'create' => Pages\CreatePatient::route('/create'),
            'view' => Pages\ViewPatient::route('/{record}'),
            'edit' => Pages\EditPatient::route('/{record}/edit'),
        ];
    }
}
