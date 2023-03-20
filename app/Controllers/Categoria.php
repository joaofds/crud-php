<?php

namespace App\Controllers;

class Categoria extends Controller
{
    public function index()
    {
        echo $this->blade()->run('categoria.index');
    }

    public function create()
    {
        echo $this->blade()->run('categoria.create');
    }

    public function store()
    {
        $categoria = json_decode(json_encode($_REQUEST), false);
        echo json_encode($categoria);
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
