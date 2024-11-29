<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateModel extends Model
{
    //
    protected $table = 't_certificate';

    protected $fillable = [
        'c_no', 'product_id', 'size', 'heat_no', 'serial', 'quantity', 'drawing_no', 'customer', 'auth_signatory', 'inspect_signatory', 'manufacture_process', 'tcd', 'reduction', 'size_2', 'notes', 'hardness', 'maker_name', 'edited'
    ];
}
