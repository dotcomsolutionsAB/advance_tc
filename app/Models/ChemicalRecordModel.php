<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChemicalRecordModel extends Model
{
    //
    protected $table = 't_chemical_record';

    protected $fillable = [
        'tc_id', 'mtc_id', 'heat_no', 'label', 'value'
    ];
}
