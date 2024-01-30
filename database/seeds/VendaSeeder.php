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
            'sales_id'  => 'Celular 1',
            'amount'  => 1.800,
            'products'    => [1,2],
        ]);
    }
}
