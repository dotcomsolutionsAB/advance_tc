<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    //
    protected $table = 't_product';

    protected $fillable = [
        'material_id', 'alpha', 'name', 'print_name', 'md_1', 'md_2', 'raw', 'specifications', 'template', 'temperature'
    ];
}
