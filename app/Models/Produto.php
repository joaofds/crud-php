<?php

namespace App\Models;

use App\Database\ActiveRecord;
use App\Database\Transaction;

class Produto extends ActiveRecord
{
    public const TABLENAME = 'produtos';

    /**
     * Busca todos os produtos
     *
     * @return object
     */
    public static function getProductos()
    {
        $conn = Transaction::get();

        $sql = 'select A.nome, A.valor, A.qtde, B.nome as categoria
                from produtos A
                join categorias B on A.categoria_id = B.id
        ';

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $produtos = $prepare->fetchAll();

        return $produtos;
    }
}
