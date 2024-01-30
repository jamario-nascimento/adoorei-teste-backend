<?php

namespace Modules\Venda\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Produto\Entities\Produto;

class Venda extends Model
{
    public $incrementing = true;
    public $timestamps = false;

    protected $table        = 'Vendas';
    protected $primaryKey   = 'sales_id';
    public $fillable = [
        'amount',
        'products'
    ];

    public function produtos() {
        return $this->belongsToMany(Produto::class,'Venda_Produto');
    }


}
