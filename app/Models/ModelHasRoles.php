<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelHasRoles extends Model
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(config('permission.models.role'));
    }
}
