<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalRecordModel extends Model
{
    //
    protected $table = 't_physical_record';

    protected $fillable = [
        'tc_id', 'mtc_id', 'heat_no', 'label', 'value'
    ];
}
