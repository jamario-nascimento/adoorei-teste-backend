<?php

namespace Modules\Venda\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Produto\Entities\Produto;
use Database\Factories\VendaFactory;

class Venda extends Model
{
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [];

    protected $table        = 'Vendas';
    protected $primaryKey   = 'id';
    public $fillable = [
        'sales_id',
        'amount',
    ];


    public function Produtos()
    {
        return $this->belongsTo(Produto::class,'venda_produto');
    }

}
