<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClinicResource\Pages;
use App\Filament\Resources\ClinicResource\RelationManagers;
use App\Filament\Resources\ClinicResource\RelationManagers\MembersRelationManager;
use App\Filament\Resources\ClinicResource\RelationManagers\UsersRelationManager;
use App\Models\Clinic;
use App\Models\District;
use App\Models\Regency;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ClinicResource extends Resource
{
    protected static ?string $model = Clinic::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Clinic Management';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Info')
                    ->description('Contains basic information for the clinic such as Name, Description, Address, Regions etc.')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('description')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('address')
                            ->columnSpanFull(),
                    ]),
                Section::make('Regions')
                    ->description('Contains region related info for the clinic, such as Address, Province, Regency, District, and Village.')
                    ->schema([
                        Forms\Components\Select::make('province_id')
                            ->relationship('province', 'name')
                            ->searchable()
                            ->live()
                            ->preload()
                            ->afterStateUpdated(function (Set $set) {
                                $set('regency_id', null);
                                $set('district_id', null);
                                $set('village_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('regency_id')
                            ->label(__('Regency'))
                            ->options(fn (Get $get): Collection => Regency::query()
                                ->where('province_id', $get('province_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('district_id', null);
                                $set('village_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('district_id')
                            ->label(__('District'))
                            ->options(fn (Get $get): Collection => District::query()
                                ->where('regency_id', $get('regency_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->afterStateUpdated(function (Set $set) {
                                $set('village_id', null);
                            })
                            ->required(),
                        Forms\Components\Select::make('village_id')
                            ->label(__('Village'))
                            ->options(fn (Get $get): Collection => Village::query()
                                ->where('district_id', $get('district_id'))
                                ->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->live()
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('province.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('regency.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('district.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('village.name')
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
            MembersRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClinics::route('/'),
            'create' => Pages\CreateClinic::route('/create'),
            'view' => Pages\ViewClinic::route('/{record}'),
            'edit' => Pages\EditClinic::route('/{record}/edit'),
        ];
    }
}
