<?php

namespace Modules\Produto\Controllers;

use App\Http\Controllers\Controller;

use Modules\Produto\Request\ProdutoRequest;
use Modules\Produto\Services\Interfaces\ProdutoServiceInterface;
use Exception;
use Modules\Assunto\Services\Interfaces\AssuntoServiceInterface;
use Modules\Autor\Services\Interfaces\AutorServiceInterface;

class ProdutoController extends Controller
{
    protected $service;
    protected $serviceAutor;
    protected $serviceAssunto;

    public function __construct(ProdutoServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $produtos = $this->service->list();
            return view('produto.listar', compact('produto'));
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

            // Monta retorno de campos para a tela.
            $dados = array(
                'title_page'        => 'Cadastrar Produto',
                'produto'             => null,
                'MANTER'            => 'Cadastrar'
            );

            // Retorna para a página de edição.
            return view('produto/manter', $dados);

        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Edição dos dados para WEB
     */
    public function edit($CodAl = null)
    {
        try {

            // Verifica se código foi informado.
            if (empty($CodAl)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexProduto')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Código do Produto não foi informado.');
            }

            $produto = $this->service->find($CodAl);

            // Verifica se objeto foi encontrado.
            if (empty($produto)) {
                // Redireciona usuário para tela de consulta.
                return redirect()->route('indexProduto')
                    ->with('class', 'alert-warning')
                    ->with('message', 'Produto não encontrado.');
            } else {
                
                $dados = array(
                    'title_page'        => 'Atualizar Livro',
                    'produto'             => $produto,
                    'MANTER'            => 'Atualizar'
                );

                // Retorna para a página de edição.
                return view('livro/manter', $dados);
            }
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/produto/list",
     *     tags={"Produto"},
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
     ** path="/api/produto/create",
     *   tags={"Produto"},
     *   summary="Criar Registro",
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="decimal")
     *   ),
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=201,description="Created"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function create(ProdutoRequest $request)
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
     ** path="/api/produto/update",
     *   tags={"Produto"},
     *   summary="Atualizar Registro",
     *   @OA\Parameter(
     *      name="id",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="integer")
     *   ),
     *   @OA\Parameter(
     *      name="name",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *      name="price",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="decimal")
     *   ),
     *   @OA\Parameter(
     *      name="description",
     *      in="query",
     *      required=true,
     *      @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response=200,description="Updated"),
     *   @OA\Response(response=404,description="Not found"),
     *   @OA\Response(response=500,description="Internal Server Error"),
     *   @OA\MediaType(mediaType="application/json")
     *)
     **/
    public function update(ProdutoRequest $request)
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
     ** path="/api/produto/delete",
     *   tags={"Produto"},
     *   summary="Excluir Registro",
     *   @OA\Parameter(
     *      name="id",
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
    public function delete(ProdutoRequest $request)
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
