<?php

namespace Tests\Unit;

use Modules\Produto\Entities\Produto;
use PHPUnit\Framework\TestCase;

class ProdutoUnitTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckColumnsTest()
    {
        $autor = new Produto();

        $expected = [
            'name',
            'price',
            'description'
        ];

        $arrayCompared = array_diff($expected, $autor->getFillable());

        $this->assertEquals(0, count($arrayCompared));
    }
}
