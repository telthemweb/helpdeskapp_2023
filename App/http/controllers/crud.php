<?php

namespace Ti\Helpdesk\App\http\controllers;

use Ti\Helpdesk\App\System\Request;

interface crud
{
    public function index();
    public function create();
    public function store(Request $request);
    public function show($id);
    public function update(Request $request,$id);
    public function destroy($id);
}