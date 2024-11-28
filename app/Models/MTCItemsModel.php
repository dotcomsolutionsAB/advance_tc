<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MTCItemsModel extends Model
{
    //
    protected $table = 't_mtc_items';

    protected $fillable = [
        'mtc_id', 'product', 'material_code', 'quantity', 'heat_no',
    ];
}
