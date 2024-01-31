<?php

namespace Tests\Feature;

use Modules\Produto\Entities\Produto;
use Tests\TestCase;

class ProdutoTest extends TestCase
{
    protected $service = Produto::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listProduto'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateProduto()
    {

        $autor = factory($this->service)->make();

        $response = $this->postJson(route('createProduto'),$autor->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

    }
}
