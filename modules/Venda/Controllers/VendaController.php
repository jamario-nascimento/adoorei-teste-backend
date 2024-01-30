<?php

namespace Modules\Venda\Controllers;

use App\Http\Controllers\Controller;

use Modules\Venda\Request\VendaRequest;
use Modules\Venda\Services\Interfaces\VendaServiceInterface;
use Exception;
use Modules\Produto\Services\Interfaces\ProdutoServiceInterface;


class VendaController extends Controller
{
    protected $service;
    protected $serviceProduto;

    public function __construct(VendaServiceInterface $service,
                                ProdutoServiceInterface $serviceProduto)
    {
        $this->service = $service;
        $this->serviceProduto = $serviceProduto;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $vendas = $this->service->list();
            return view('venda.listar', compact('vendas'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Cadastro dos dados para WEB
     */
    public function register()
    {
        try {
            $produtos = $this->serviceProduto->list();

            // Monta retorno de campos para a tela.
            $dados = array(
                'title_page'        => 'Cadastrar Venda',
                'amount'             => null,
                'products'           => $produtos,
                'listProdutos'       => [],
                'MANTER'            => 'Cadastrar'
            );

            // Retorna para a página de edição.
            return view('livro/manter', $dados);

        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($id = null)
    {
        try {

            // Verifica se código foi informado.
            if (empty($id)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexVenda')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código da Venda não foi informado.');
            }

            $venda = $this->service->find($id,['with' => 'produtos']);

            // Verifica se objeto foi encontrado.
            if (empty($venda)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexVenda')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Venda não encontrada.');
            } else {
                // Monta retorno de campos para a tela.
                $listProdutos = [];
                foreach($venda->products as $produto){
                    $listAutores[] = $produto->id;
                }

                

                $produtos = $this->serviceProduto->list();


                $dados = array(
                    'title_page'        => 'Atualizar Venda',
                    'venda'             => $venda,
                    'products'           => $produtos,
                    'listProdutos'      => $listProdutos,
                    'MANTER'            => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('venda/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/venda/list",
     *     tags={"Venda"},
     *     summary="Listar os Registros",
     *     @OA\Response(response="200", description="Success"),
     *     @OA\Response(response="404", description="Not Found"),
     *     @OA\Response(response=500,description="Validate Error"),
     *     @OA\MediaType(mediaType="application/json")
     * )
     */
    public function list()
    {
        try {
            return $this->service->list();
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem'], 500);
        }
    }

    /**
     * @OA\Post(
     ** path="/api/venda/create",
     *   tags={"Venda"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="amount",
     *      in="query",
     *      required=true,
     *     @OA\Schema(type="number",format="decimal")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function create(VendaRequest $request)
    {
        try {
            return $this->service->create($request->validated());
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar o cadastro'], 500);
        }
    }

    /**
     * @OA\Put(
     ** path="/api/venda/update",
     *   tags={"Venda"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="sales_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="amount",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="products",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="number",format="integer")
     *   ),
     *   @OA\Response(response=200,description="Updated"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function update(VendaRequest $request)
    {
        try {
            if($this->service->update($request->validated())) {
                return response()->json(['message' => 'Atualizado com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a edição'], 500);
        }
    }

    /**
     * @OA\Delete(
     ** path="/api/venda/delete",
     *   tags={"Venda"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="sales_id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Response(response=200,description="Deleted"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function delete(VendaRequest $request)
    {
        try {
            if($this->service->delete($request->validated())) {
                return response()->json(['message' => 'Excluído com sucesso'], 200);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a exclusão'], 500);
        }
    }
}
