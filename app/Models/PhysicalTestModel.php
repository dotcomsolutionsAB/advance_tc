<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalTestModel extends Model
{
    //
    protected $table = 't_physical_test';

    protected $fillable = [
        'material_id', 'elongation_start', 'elongation_end', 'tensile_start', 'tensile_end', 'yield_start', 'yield_end'
    ];
}
