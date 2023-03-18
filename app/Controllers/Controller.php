<?php

namespace App\Controllers;

use App\Contracts\Controller as ContractsController;
use eftec\bladeone\BladeOne;

abstract class Controller implements ContractsController
{
    /**
     * Instancia do Blade Template
     *
     * @var mix
     */
    public $blade;

    public function __construct()
    {
        $views = __DIR__ . '/../Views';
        $cache = __DIR__ . '/../../temp/blade';
        $this->blade = new BladeOne($views, $cache, BladeOne::MODE_DEBUG);
    }

    /**
     *  Retorna Blade Template Engine
     *
     * */
    public function blade()
    {
        return $this->blade;
    }
}
