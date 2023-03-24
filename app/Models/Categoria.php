<?php

namespace App\Models;

use App\Database\ActiveRecord;
use App\Database\Transaction;

class Categoria extends ActiveRecord
{
    public const TABLENAME = 'categorias';

    /**
     * Busca todas as categorias
     *
     * @return object
     */
    public static function getCategorias()
    {
        $conn = Transaction::get();

        $sql = 'select * from categorias a where a.deleted = false';

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $produtos = $prepare->fetchAll();

        return $produtos;
    }
}
