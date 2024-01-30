<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'Produtos';
    protected $primaryKey   = 'id';
    public $fillable = [
        'name',
        'price',
        'description',
    ];

}
