<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LpiModel extends Model
{
    //
    protected $table = 't_lpi';

    protected $fillable = [
        'mtc_id', 'title', 'type', 'batch_no', 'mfg_date', 'expiry_date'
    ];
}
