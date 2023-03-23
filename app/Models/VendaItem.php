<?php

namespace App\Models;

use App\Database\ActiveRecord;
use App\Database\Transaction;

class VendaItem extends ActiveRecord
{
    public const TABLENAME = 'vendas_itens';

    // busca itens da venda pelo id
    public static function getItensByIdVenda(int $id)
    {
        $conn = Transaction::get();

        $sql = "select  b.id,
                        b.nome,
                        a.qtde,
                        a.preco_unt,
                        a.total,
                        a.total_imposto
        
        from vendas_itens a
        join produtos b
        on a.produto_id = b.id
        join vendas c
        on c.id = a.venda_id
        where a.venda_id = $id";

        $prepare = $conn->prepare($sql);
        $prepare->execute();
        $itens = $prepare->fetchAll();

        return $itens;
    }
}
