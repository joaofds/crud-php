<?php

namespace App\Controllers;

use App\Database\Transaction;
use App\Models\Produto as ProdutoModel;
use App\Models\Categoria;

class Produto extends Controller
{
    public function index()
    {
        try {
            Transaction::open();

            $produtos = ProdutoModel::getProductos();

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }

        echo $this->blade()->run('produto.index', ['produtos' => $produtos]);
    }

    public function create()
    {
        try {
            Transaction::open();

            $categorias = Categoria::getCategorias();

            Transaction::close();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            Transaction::rollback();
        }
        echo $this->blade()->run('produto.create', ['categorias' => $categorias]);
    }

    public function store()
    {
        $request = json_decode(json_encode($_REQUEST), false);

        try {
            Transaction::open();

            $produto = new ProdutoModel();
            $produto->nome = $request->produto;
            $produto->valor = $request->preco;
            $produto->qtde = $request->qtde;
            $produto->categoria_id = $request->categoria;
            $produto->data_cadastro = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $saved = $produto->save();

            if (!$saved) {
                echo json_encode(
                    [
                        'msg' => 'Produto salvo com sucesso.',
                        'code' => 200
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'msg' => 'Oops... erro ao salvar produto.',
                    ]
                );
            }

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }
    }

    public function show()
    {
        //
    }

    public function delete()
    {
        //
    }
}
