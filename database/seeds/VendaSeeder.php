<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendas')->insert([
            'sales_id'  => 456754,
            'amount'  => 1.800,
        ]);

        DB::table('venda_produto')->insert([
            'venda_id'  => 1,
            'produto_id'  => 1,
        ]);
    }
}
