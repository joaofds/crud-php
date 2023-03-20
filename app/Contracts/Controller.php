<?php

namespace App\Contracts;

interface Controller
{
    public function index();

    public function create();

    public function store();

    public function show();

    public function delete();
}
