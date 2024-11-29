<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PipeDataModel extends Model
{
    //
    protected $table = 't_pipe_data';

    protected $fillable = [
        'name', 'type', 'size', 'od_target_end', 'od_small_end', 'thickness', 'end_to_end_length', 'od', 'thk', 'center_to_end', 'outside_diameter', 'run', 'outlet',
    ];
}
