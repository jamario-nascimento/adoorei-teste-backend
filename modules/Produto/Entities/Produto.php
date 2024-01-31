<?php

namespace Modules\Produto\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Venda\Entities\Venda;

class Produto extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'produtos';
    protected $primaryKey   = 'id';
    public $fillable = [
        'id',
        'name',
        'price',
        'description',
    ];

}
