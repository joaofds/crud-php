<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Database\Transaction;

class Venda extends Controller
{
    public function index()
    {
        echo $this->blade()->run('venda.index');
    }

    public function create()
    {
        try {
            Transaction::open();

            $produtos = Produto::getProductos();

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }

        echo $this->blade()->run('venda.create', ['produtos' => $produtos]);
    }

    public function store()
    {
        //
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
