<?php

use Ti\Helpdesk\App\http\controllers\AdministratorController;
use Ti\Helpdesk\App\http\controllers\CategoryController;
use Ti\Helpdesk\App\http\controllers\ClientController;
use Ti\Helpdesk\App\http\controllers\DashboardController;
use Ti\Helpdesk\App\http\controllers\PermissionController;
use Ti\Helpdesk\App\http\controllers\RoleController;
use Ti\Helpdesk\App\http\controllers\CompanyController;
use Ti\Helpdesk\App\http\controllers\TicketController;
use Ti\Helpdesk\App\http\controllers\TaskController;
use Ti\Helpdesk\App\http\controllers\InvoiceController;
use Ti\Helpdesk\App\http\controllers\CompdashController;
use Ti\Helpdesk\App\http\controllers\TechnicianController;
use Ti\Helpdesk\App\http\controllers\PaymentController;
use Ti\Helpdesk\App\http\controllers\ReceiptController;
use Ti\Helpdesk\App\http\controllers\ReportController;
use Ti\Helpdesk\App\http\controllers\ErrorController;
use Ti\Helpdesk\App\System\Routers;
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
$router = new Routers();


$router->get('/admin/login', AdministratorController::class, 'index','');
$router->post('/login/me', AdministratorController::class, 'loginUser','');
$router->get('/dashboard', DashboardController::class, 'index','');
$router->get('/profile', DashboardController::class, 'getAdminProfile','');
$router->get('/changepassword/userid/{id}', DashboardController::class, 'changepassword','');
$router->post('/changepassword/c/{id}', DashboardController::class, 'changepasswordpost','');


/*
|--------------------------------------------------------------------------
|                        ALL roles          
|--------------------------------------------------------------------------
|
|
*/
$router->get('/roles', RoleController::class, 'index','');
$router->post('/create', RoleController::class, 'store','');
$router->get('/role/rid/{id}', RoleController::class, 'show','');
$router->post('/role/update/{id}', RoleController::class, 'edit','');
$router->get('/role/delete/{id}', RoleController::class, 'destroy','');
$router->post('/permission/assign', RoleController::class, 'assign','');
$router->post('/permission/unassign', RoleController::class, 'unassign','');
/*
|--------------------------------------------------------------------------
|                        ALL CATEGORIES          
|--------------------------------------------------------------------------
|
|
*/
$router->get('/categories', CategoryController::class, 'index','');
$router->post('/cat/register', CategoryController::class, 'store','');
$router->get('/cat/update/{id}', CategoryController::class, 'show','');
$router->post('/cat/u/{id}', CategoryController::class, 'edit','');
$router->post('/cat/delete/{id}', CategoryController::class, 'destroy','');


/*
|--------------------------------------------------------------------------
|                        ALL PERMISSIONS
|--------------------------------------------------------------------------
|
|
*/
$router->get('/permissions', PermissionController::class, 'index','');
$router->post('/perm/register', PermissionController::class, 'store','');
$router->get('/perm/update/{id}', PermissionController::class, 'show','');
$router->post('/perm/p/{id}', PermissionController::class, 'edit','');
$router->post('/perm/delete/{id}', PermissionController::class, 'destroy','');
$router->get('/permissions/role/{role}', PermissionController::class, 'getAssignedByRole','');




/*
|--------------------------------------------------------------------------
|                        ALL COMPANY EMPLOYEES
|--------------------------------------------------------------------------
|
|
*/
$router->get('/employees', DashboardController::class, 'users','');
$router->post('/employee/register', DashboardController::class, 'store','');
$router->get('/employee/v/{id}', DashboardController::class, 'show','');
$router->post('/employee/u/{id}', DashboardController::class, 'edit','');
$router->get('/employee/d/{id}', DashboardController::class, 'destroy','');
$router->get('/employee/r/{id}', DashboardController::class, 'deactivate','');
$router->get('/employee/a/{id}', DashboardController::class, 'activate','');


/*
|--------------------------------------------------------------------------
|                        ALL ADMINISTRATOR/COMPANIES
|--------------------------------------------------------------------------
|
|
*/
$router->get('/companies', CompanyController::class, 'index','');
$router->post('/company/register', CompanyController::class, 'store','');
$router->get('/company/v/{id}', CompanyController::class, 'show','');
$router->post('/company/u/{id}', CompanyController::class, 'edit','');
$router->get('/company/d/{id}', CompanyController::class, 'destroy','');

/*
|--------------------------------------------------------------------------
|                        ALL SUPPORTS            
|--------------------------------------------------------------------------
|
|
*/

$router->get('/tickets', TicketController::class, 'index','');
$router->post('/ticket/register', TicketController::class, 'store','');
$router->get('/ticket/v/{id}', TicketController::class, 'show','');
$router->get('/ticket/e/{id}', TicketController::class, 'edit','');
$router->post('/ticket/u/{id}', TicketController::class, 'updatedata','');
$router->get('/ticket/d/{id}', TicketController::class, 'destroy','');
$router->get('/ticket/a/{id}', TicketController::class, 'accept','');
$router->get('/ticket/r/{id}', TicketController::class, 'reject','');


/*
|--------------------------------------------------------------------------
|                        ALL TASKS            
|--------------------------------------------------------------------------
|
|
*/

$router->get('/tasks', TaskController::class, 'index','');
$router->post('/task/register', TaskController::class, 'store','');
$router->get('/task/a/{id}', TaskController::class, 'show','');
$router->get('/task/v/{id}', TaskController::class, 'employeetasks','');
$router->post('/task/assign', TaskController::class, 'assignEmployee','');
$router->get('/task/r/{id}/{emp}', TaskController::class, 'destroyme','');
$router->get('/request/inv/{id}/c/{company}', TaskController::class, 'requestInvoice','');


/*
|--------------------------------------------------------------------------
|                        ALL INVOICE 
|--------------------------------------------------------------------------
|
|
*/

$router->get('/invoices', InvoiceController::class, 'index','');
$router->post('/invoice/register', InvoiceController::class, 'store','');
$router->get('/invoice/v/{id}', InvoiceController::class, 'show','');
$router->get('/invoice/edit/{id}', InvoiceController::class, 'findby','');
$router->post('/invoice/u/{id}', InvoiceController::class, 'edit','');
$router->get('/invoice/d/{id}', InvoiceController::class, 'destroyme','');
/*
|--------------------------------------------------------------------------
|                        ALL PENALTIES 
|--------------------------------------------------------------------------
|
|
*/

$router->get('/penalty/v/{id}', DashboardController::class, 'acceptPenaltiesinvoice','');
$router->get('/penalty/accept/{id}', DashboardController::class, 'acceptPenaltiesinvoicestore','');

/*
|--------------------------------------------------------------------------
|                        ALL Payment 
|--------------------------------------------------------------------------
|
|
*/

$router->get('/payments', PaymentController::class, 'index','');
$router->post('/payment/register', PaymentController::class, 'store','');
$router->get('/payment/v/{id}', PaymentController::class, 'show','');

/*
|--------------------------------------------------------------------------
|                        ALL Receipts 
|--------------------------------------------------------------------------
|
|
*/

$router->get('/receipts', ReceiptController::class, 'index','');
$router->post('/receipt/register', ReceiptController::class, 'store','');
$router->get('/receipts/v/{id}', ReceiptController::class, 'show','');


/*
|--------------------------------------------------------------------------
|                        TECHNICIAN PORTAL
|--------------------------------------------------------------------------
|
|
*/
$router->get('/technician/mytasks', TechnicianController::class, 'index','');
$router->get('/technician/v/{id}', TechnicianController::class, 'show','');
$router->get('/technician/t/{id}', TechnicianController::class, 'completeTask','');






/*
|--------------------------------------------------------------------------
|                        CLIENT PORTAL
|--------------------------------------------------------------------------
|
|
*/
$router->get('/', ClientController::class, 'index','');

$router->get('/login', ClientController::class, 'create','');
$router->get('/register', ClientController::class, 'register','');
$router->post('/company/auth', ClientController::class, 'createauth','');
$router->post('/company/login', ClientController::class, 'authenticate','');
$router->get('/company', CompdashController::class, 'index','');
$router->get('/company/profile', CompdashController::class, 'create','');
$router->get('/company/support', CompdashController::class, 'createticket','');
$router->get('/company/support/v/{id}', CompdashController::class, 'viewticket','');
$router->post('/company/ticket', CompdashController::class, 'store','');
$router->get('/company/ticket/e/{id}', CompdashController::class, 'showticketbyid','');
$router->get('/company/ticket/d/{id}', CompdashController::class, 'destroy','');
$router->post('/company/ticket/u/{id}', CompdashController::class, 'updateticket','');
$router->get('/company/invoice/{id}', CompdashController::class, 'invoice','');
$router->get('/company/makepayment/{id}/{mode}', CompdashController::class, 'payment','');
$router->post('/company/changepassword/{id}', CompdashController::class, 'changepassword','');
$router->get('/company/completeticket/{id}', CompdashController::class, 'completeticket','');
$router->get('/company/penalty/{id}', CompdashController::class, 'createpenalty','');

/*
|--------------------------------------------------------------------------
|                        ALL REPORTS            
|--------------------------------------------------------------------------
|
|
*/
$router->get('/reports/payements', ReportController::class, 'allpayments','');
$router->get('/reports/invoices', ReportController::class, 'allinvoices','');
$router->get('/reports/notpaidinvoices', ReportController::class, 'allnotpaidinvoices','');
$router->get('/reports/penalties', ReportController::class, 'allpenalties','');


/*
|--------------------------------------------------------------------------
|                        PENALTIES
|--------------------------------------------------------------------------
|
|
*/
$router->get('/penalties', DashboardController::class, 'penalty','');

/*
|--------------------------------------------------------------------------
|                        AUDIT TRAY
|--------------------------------------------------------------------------
|
|
*/
$router->get('/audits', DashboardController::class, 'audittray','');
$router->get('/logs', DashboardController::class, 'systemlogs','');





/*
|--------------------------------------------------------------------------
|                        ALL LOGOUTS            
|--------------------------------------------------------------------------
|
|
*/
$router->get('/admin/logout', AdministratorController::class, 'logout','');
$router->get('/logout', ClientController::class, 'logout','');
$router->get('/admin/error', ErrorController::class, 'getErrorPage','');


























$router->run();