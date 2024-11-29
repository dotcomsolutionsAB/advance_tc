<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalModel extends Model
{
    //
    protected $table = 't_physical';

    protected $fillable = [
        'material_id', 'temperature', 'pressure_start', 'pressure_start'
    ];
}
