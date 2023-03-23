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

    /**
     * Busca produtos de acordo com termo passado no parametro.
     *
     * @param string $term
     * @return object
     */
    public static function findByTerm($term)
    {
        $conn = Transaction::get();

        $sql = "select A.id, A.nome, A.valor, A.qtde, B.nome as categoria, B.percentual
                from produtos A
                join categorias B on A.categoria_id = B.id
                where A.nome like '%$term%'
                order by A.nome
        ";

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $produtos = $prepare->fetchAll();

        return $produtos;
    }
}
