<?php

namespace App\Controllers;

class Produto extends Controller
{
    public function index()
    {
        echo $this->blade()->run('produto.index');
    }

    public function store($data)
    {
        // salvar
    }

    public function show($id)
    {
        // mostra por id
    }

    public function delete($id)
    {
        // deleta por id
    }
}
