<?php

namespace App\Controllers;

use App\Database\Transaction;
use App\Models\Categoria as CategoriaModel;

class Categoria extends Controller
{
    /**
     * Busca categorias e mostra view de categorias
     *
     * @return void
     */
    public function index()
    {
        try {
            Transaction::open();

            $categorias = CategoriaModel::getCategorias();

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }

        echo $this->blade()->run('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Mostra view de criação de categorias
     *
     * @return void
     */
    public function create()
    {
        echo $this->blade()->run('categoria.create');
    }

    /**
     * Salva categoria
     *
     * @return void
     */
    public function store()
    {
        $categoria = json_decode(json_encode($_REQUEST), false);
        echo json_encode($categoria);
    }

    /**
     * Mostra apenas uma categoria
     *
     * @return void
     */
    public function show()
    {
        //
    }

    /**
     * Deleção de categorias
     *
     * @return void
     */
    public function delete()
    {
        //
    }
}
