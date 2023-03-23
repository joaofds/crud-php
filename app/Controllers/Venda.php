<?php

namespace App\Controllers;

use App\Models\Produto;
use App\Models\Venda as VendaModel;
use App\Database\Transaction;
use App\Models\VendaItem;

class Venda extends Controller
{
    /**
     * Mostra view de vendas
     *
     * @return void
     */
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

    /**
     * Mostra view de pdv
     *
     * @return void
     */
    public function create()
    {
        echo $this->blade()->run('venda.create');
    }

    /**
     * Salva venda
     *
     * @return void
     */
    public function store()
    {
        $request = json_decode(json_encode($_REQUEST), false);

        try {
            Transaction::open();

            // salva a venda
            $venda = new VendaModel();
            $venda->cliente_id = isset($request->cliente_id) ? $request->cliente_id : 1;
            $venda->total_venda = $request->total_venda;
            $venda->total_imposto = $request->total_imposto;
            $venda->data_cadastro = (new \DateTime('now'))->format('Y-m-d H:i:s');
            $venda->save();

            // id da venda inserida
            $venda_id = Transaction::get()->lastInsertId();

            // itera nos produtos e salva na tabela vendas_itens
            foreach ($request->produtos as $produto) {
                $item = new VendaItem();
                $item->venda_id = $venda_id;
                $item->produto_id = $produto->id;
                $item->qtde = $produto->qtde;
                $item->preco_unt = $produto->preco;
                $item->total = $produto->total_itens;
                $item->total_imposto = $produto->icms_total;
                $saved = $item->save();
            }

            header('Content-Type: application/json');
            if ($saved) {
                echo json_encode(
                    [
                        'msg' => 'Venda finalizada com sucesso.',
                        'code' => 200
                    ]
                );
            } else {
                echo json_encode(
                    [
                        'msg' => 'Oops... erro ao finalizar venda.'
                    ]
                );
            }
            Transaction::close();
        } catch (\Throwable $th) {
            var_dump($th->getMessage());
            Transaction::rollback();
        }
    }

    /**
     * Mostra venda pelo id
     *
     * @return void
     */
    public function show()
    {
        //
    }

    /**
     * Deleta venda pelo id
     *
     * @return void
     */
    public function delete()
    {
        //
    }

    /**
     * Metodo que busca itens da venda pelo id.
     *
     * @return void
     */
    public function getItensByVenda()
    {
        $request = json_decode(json_encode($_REQUEST), false);

        try {
            Transaction::open();

            // busca itens da venda pelo id
            $itens = VendaItem::getItensByIdVenda($request->id);

            header('Content-Type: application/json');
            echo json_encode(
                [
                    'code' => 200,
                    'data' => $itens
                ]
            );

            Transaction::close();
        } catch (\Throwable $th) {
            Transaction::rollback();
        }
    }
}
