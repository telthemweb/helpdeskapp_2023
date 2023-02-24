<?php
/*
|--------------------------------------------------------------------------
|            This file is part of the Telthemweb package.
|               
|--------------------------------------------------------------------------
|
|     For the full copyright and license information, please view the LICENSE
|       file that was distributed with this source code.
|
*/

namespace Ti\Helpdesk\App\http\controllers;
// use Ti\Helpdesk\App\System\Request;
use Illuminate\Http\Request;
interface Resourcesa{
    public function index();
    public function create();
    public function store();
    public function show($id);
    public function edit($id);
    public function update();
    public function destroy($id);
}