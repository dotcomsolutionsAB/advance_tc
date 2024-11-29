<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MPEModel extends Model
{
    //
    protected $table = 't_mpe';

    protected $fillable = [
        'mtc_id', 'testing_equipment', 'magnetic_particle', 'wet_dry', 'color', 'magnetizing_process'
    ];
}
