<?php

namespace App\Models;

use App\Database\ActiveRecord;
use App\Database\Transaction;

class Venda extends ActiveRecord
{
    public const TABLENAME = 'categorias';

    /**
     * Busca todas as categorias
     *
     * @return object
     */
    public static function getVendas()
    {
        $conn = Transaction::get();

        $sql = 'select a.id, a.total_venda, a.total_imposto, b.nome as cliente, b.cpf, a.data_cadastro
                from vendas a
                join clientes b 
                on a.cliente_id = b.id';

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $vendas = $prepare->fetchAll();

        return $vendas;
    }
}
