<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Enums\RoleEnum;
use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array

    {
        return [
            'all' => Tab::make(),
            RoleEnum::SUPER_ADMIN->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', RoleEnum::SUPER_ADMIN->value)),
            RoleEnum::ADMIN->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', RoleEnum::ADMIN->value)),
            RoleEnum::OPERATOR->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', RoleEnum::OPERATOR->value)),
            RoleEnum::PHARMACIST->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', RoleEnum::PHARMACIST->value)),
            RoleEnum::DOCTOR->value => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->with('roles')->whereRelation('roles', 'name', '=', RoleEnum::DOCTOR->value)),
        ];
    }
}
