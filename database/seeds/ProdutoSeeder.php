<?php

use Illuminate\Database\Seeder;
use Modules\Produto\Entities\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Produto::class,5)->create();
    }
}
