<?php

use Illuminate\Database\Seeder;
use Modules\Produto\Entities\Produto;
use Illuminate\Support\Facades\DB;
class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('produtos')->insert([
           'name'  => 'Celular 1',
           'price'  => 1.800,
           'description'    => 'Lorem ipsum',
            ]);

            DB::table('produtos')->insert([
                'name'  => 'Celular 2',
                'price'  => 3.200,
                'description'    => 'Lorem ipsum dolor',
                 ]);

                 DB::table('produtos')->insert([
                    'name'  => 'Celular 3',
                    'price'  => 9.800,
                    'description'    => 'Lorem ipsum dolor sit amet',
                     ]);


    }
}
