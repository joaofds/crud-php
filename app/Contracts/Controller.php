<?php

namespace App\Contracts;

interface Controller
{
    public function index();

    public function store($data);

    public function show($id);

    public function delete($id);
}
