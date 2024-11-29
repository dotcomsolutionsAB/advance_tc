<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DimensionalModel extends Model
{
    //
    protected $table = 't_dimensional';

    protected $fillable = [
        'mtc_id', 'mtc_items_id', 'qty_checked', 'type', 'od_target_end', 'od_small_end', 'thickness', 'end_to_end_length', 'od', 'thk', 'center_to_end', 'outside_diameter', 'run', 'outlet',
    ];
}
