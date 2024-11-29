<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialModel extends Model
{
    //
    protected $table = 't_material';

    protected $fillable = [
        'name', 'template', 'temperature'
    ];
}
