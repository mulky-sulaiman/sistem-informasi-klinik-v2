<?php

namespace App\Filament\Resources;

use App\Enums\BloodTypeEnum;
use App\Enums\GenderEnum;
use App\Enums\MaritalStatusEnum;
use App\Filament\Resources\PatientResource\Pages;
use App\Filament\Resources\PatientResource\RelationManagers;
use App\Models\District;
use App\Models\Patient;
use App\Models\Regency;
use App\Models\Village;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;


class PatientResource extends Resource
{
    protected static ?string $model = Patient::class;

    protected static ?string $navigationIcon = 'tabler-user-heart';

    protected static ?string $modelLabel = 'patient';
    protected static ?string $pluralModelLabel = 'patients';
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationGroup = 'User Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(100),
                Forms\Components\DatePicker::make('birth_date'),
                Forms\Components\Select::make('gender')
                    ->options([
                        GenderEnum::MALE->value => GenderEnum::MALE->label(),
                        GenderEnum::FEMALE->value => GenderEnum::FEMALE->label(),
                    ])
                    ->preload()
                    ->live(),
                Forms\Components\TextInput::make('age')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('marital_status')
                    ->options([
                        MaritalStatusEnum::SINGLE->value => MaritalStatusEnum::SINGLE->label(),
                        MaritalStatusEnum::MARRIED->value => MaritalStatusEnum::MARRIED->label(),
                        MaritalStatusEnum::DIVORCED->value => MaritalStatusEnum::DIVORCED->label(),
                    ])
                    ->preload()
                    ->live(),
                Forms\Components\Select::make('blood_type')
                    ->options([
                        BloodTypeEnum::APLUS->value => BloodTypeEnum::APLUS->label(),
                        BloodTypeEnum::AMIN->value => BloodTypeEnum::AMIN->label(),
                        BloodTypeEnum::BPLUS->value => BloodTypeEnum::BPLUS->label(),
                        BloodTypeEnum::BMIN->value => BloodTypeEnum::BMIN->label(),
                        BloodTypeEnum::OPLUS->value => BloodTypeEnum::OPLUS->label(),
                        BloodTypeEnum::OMIN->value => BloodTypeEnum::OMIN->label(),
                        BloodTypeEnum::ABPLUS->value => BloodTypeEnum::ABPLUS->label(),
                        BloodTypeEnum::ABMIN->value => BloodTypeEnum::ABMIN->label(),
                    ])
                    ->preload()
                    ->live(),
                Forms\Components\Textarea::make('bio')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\Select::make('province_id')
                    ->label(__('Province'))
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('birth_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('marital_status'),
                Tables\Columns\TextColumn::make('blood_type')
                    ->searchable()
                    ->sortable(),
                // Tables\Columns\TextColumn::make('province_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('regency_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('district_id')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('village_id')
                //     ->searchable(),
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
                    //Tables\Actions\DeleteBulkAction::make(),
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
