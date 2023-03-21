<?php

namespace App\Controllers;

use App\Models\Produto as ProdutoModel;

class Produto extends Controller
{
    public function index()
    {
        echo $this->blade()->run('produto.index');
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
