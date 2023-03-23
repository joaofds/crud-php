<?php

namespace App\Models;

use App\Database\ActiveRecord;
use App\Database\Transaction;

class VendaItem extends ActiveRecord
{
    public const TABLENAME = 'vendas_itens';
}
