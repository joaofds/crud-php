<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Models\Venda as VendaModel;
use App\Database\Transaction;

class Venda extends Controller
{
    public function index()
    {
        try {
            Transaction::open();

            $vendas = VendaModel::getVendas();

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }

        echo $this->blade()->run('venda.index', ['vendas' => $vendas]);
    }

    public function create()
    {
        echo $this->blade()->run('venda.create');
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
