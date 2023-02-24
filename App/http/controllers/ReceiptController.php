<?php

namespace Ti\Helpdesk\App\http\controllers;

use Ti\Helpdesk\App\Model\Receipt;
use Ti\Helpdesk\App\System\Middles\AdministratorMiddleware;
use Ti\Helpdesk\App\System\Request;
use Ti\Helpdesk\App\Traits\GetRecordTrait;

class ReceiptController extends Controller implements crud
{

    use GetRecordTrait;
	public function __construct(){
		(new AdministratorMiddleware())->redirectIfNotAuthenticated();
	}
	/**
	 * @return mixed
	 */
	public function index() {
		$receipts = Receipt::orderByDesc('created_at')->get();
        $this->view("administrator/accounts/receipts/index", "dash", 'adminfooter', ['receipts'=>$receipts]);
	}

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function store(Request $request)
    {
        // TODO: Implement store() method.
    }

    public function show($id)
    {
        // TODO: Implement show() method.
    }

    public function update(Request $request, $id)
    {
        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }
}