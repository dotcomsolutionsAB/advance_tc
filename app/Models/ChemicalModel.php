<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemicalModel extends Model
{
    //
    protected $table = 't_chemical';

    protected $fillable = [
        'material_id', 'chemical', 'start', 'end'
    ];
}
