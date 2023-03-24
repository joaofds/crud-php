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

        $sql = 'select a.id, a.nome, a.valor, a.qtde, a.data_cadastro, b.nome as categoria
                from produtos a
                join categorias b
                on a.categoria_id = b.id
                where a.deleted = false and b.deleted = false';

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

        $sql = "select a.id, a.nome, a.valor, a.qtde, b.nome as categoria, b.percentual
                from produtos a
                join categorias b on a.categoria_id = b.id
                where a.nome like '%$term%'
                order by A.nome
        ";

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $produtos = $prepare->fetchAll();

        return $produtos;
    }
}
