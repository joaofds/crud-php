<?php

namespace App\Controllers;

use App\Database\Transaction;
use App\Models\Produto as ProdutoModel;

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
        echo $this->blade()->run('produto.create');
    }

    public function store()
    {
        $produto = json_decode(json_encode($_REQUEST), false);
        echo json_encode($produto);
    }

    public function show()
    {
        // mostra por id
    }

    public function delete()
    {
        // deleta por id
    }
}
