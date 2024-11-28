<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MTCModel extends Model
{
    //
    protected $table = 't_mtc';

    protected $fillable = [
        'customer', 'order_no', 'order_date', 'inspection_authority', 'qap_no', 'place_of_inspection', 'qap_clause', 'certificate_no', 'certificate_date', 'edition',
    ];
}
