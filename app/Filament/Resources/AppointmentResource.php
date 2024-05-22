<?php

namespace App\Filament\Resources;

use App\Enums\AppointmentStatusEnum;
use App\Filament\Resources\AppointmentResource\Pages;
use App\Filament\Resources\AppointmentResource\RelationManagers;
use App\Filament\Resources\AppointmentResource\RelationManagers\TreatmentsRelationManager;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'tabler-calendar-due';

    protected static ?string $modelLabel = 'appointment';
    protected static ?string $pluralModelLabel = 'appointments';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Clinic Management';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('clinic_id')
                    ->relationship('clinic', 'name')
                    ->required(),
                Forms\Components\Select::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Forms\Components\Select::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required(),
                Forms\Components\DatePicker::make('schedule_date')
                    ->required(),
                Forms\Components\TextInput::make('height')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('blood_pressure')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('symptoms')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('diagnostic')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('doctor_fee')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\TextInput::make('status')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('clinic.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('patient.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('doctor.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('schedule_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('symptoms')
                    ->limit(20),
                // Tables\Columns\TextColumn::make('height')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('weight')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('blood_pressure')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('doctor_fee')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('discount')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('amount')
                //     ->numeric()
                //     ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    // ->color(fn (string $state): string => match ($state) {
                    //     AppointmentStatusEnum::SCHEDULED->value => 'gray',
                    //     AppointmentStatusEnum::DIAGNOSED->value => 'warning',
                    //     AppointmentStatusEnum::PREPARED->value => 'info',
                    //     AppointmentStatusEnum::CONFIRMED->value => 'success',
                    // })
                    ->searchable(),
                // ->color(fn (string $state): string => match ($state) {
                //     RoleEnum::SUPER_ADMIN->value => 'danger',
                //     RoleEnum::ADMIN->value => 'gray',
                //     RoleEnum::OPERATOR->value => 'info',
                //     RoleEnum::PHARMACIST->value => 'warning',
                //     RoleEnum::DOCTOR->value => 'success',
                // }),
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
            TreatmentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'view' => Pages\ViewAppointment::route('/{record}'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
