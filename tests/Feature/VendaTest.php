<?php

namespace Tests\Feature;

use Modules\Venda\Entities\Venda;
use Tests\TestCase;

class VendaTest extends TestCase
{
    protected $service = Venda::class;

    /**
     * @test
     */
    public function testStatusCodeShouldBe200()
    {
        $this->get(route('listVenda'),)->assertStatus(200);
    }

    /**
     * @test
     */
    public function testShouldCreateVenda()
    {
        $livro = factory($this->service)->make();

        $response = $this->postJson(route('createVenda'),$livro->toArray());

        $response->assertCreated();
        $response->assertStatus(201);

        $this->assertTrue(true);
    }
}
