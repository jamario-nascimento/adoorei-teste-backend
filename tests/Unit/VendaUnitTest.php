<?php

namespace Tests\Unit;

use Modules\Venda\Entities\Venda;
use PHPUnit\Framework\TestCase;

class VendaUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $livro = new Venda();

        $expected = [
            'amount',
            'sales_id',
        ];

        $arrayCompared = array_diff($expected, $livro->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
