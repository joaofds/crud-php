<?php

namespace App\Controllers;

class Home extends Controller
{
    public function index()
    {
        echo $this->blade()->run('home.index');
    }

    public function create()
    {
        //
    }

    public function store()
    {
        //
    }

    public function show()
    {
        //
    }

    public function delete()
    {
        //
    }
}
