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
        $request = json_decode(json_encode($_REQUEST), false);

        try {
            Transaction::open();

            $categoria = new CategoriaModel();
            $categoria->nome = strtolower($request->categoria);
            $categoria->percentual = (float) $request->percentual;
            $categoria->data_cadastro = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $saved = $categoria->save();

            header('Content-Type: application/json');
            if ($saved) {
                echo json_encode(
                    [
                        'msg' => 'Categoria salva com sucesso.',
                        'code' => 200
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'msg' => 'Oops... erro ao salvar categoria.',
                    ]
                );
            }

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }
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
