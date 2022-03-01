<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageCheckID_Controller;
use App\Http\Controllers\PageMilestore_Controller;
use App\Http\Controllers\PageCustomer_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('CheckID');
});


Route::get('/Milestone', function () {
    return view('Milestone');
});


Route::get('/FAQ', function () {
    return view('FAQ');
});

Route::get('/Customer', function () {
    return view('CustomerInformation');
});

Route::post('/Check_IDCard', [PageCheckID_Controller::class, 'Check_IDCard']);

Route::post('/LOG_Login', [PageCheckID_Controller::class, 'LOG_Login']);



Route::post('/Check_State_Milestone', [PageMilestore_Controller::class, 'Check_state']);

Route::post('/List_Customer_Information', [PageCustomer_Controller::class, 'Customer_Information']);

Route::post('/PDF_INVOICE', [PageCustomer_Controller::class, 'PDF_INVOICE']);

Route::post('/PDF_REPAY', [PageCustomer_Controller::class, 'PDF_REPAY']);

Route::post('/PDF_TAX_INVOICE', [PageCustomer_Controller::class, 'PDF_TAX_INVOICE']);

Route::post('/PDF_CONTRACT', [PageCustomer_Controller::class, 'PDF_CONTRACT']);

Route::post('/PDF_TBDOWN', [PageCustomer_Controller::class, 'PDF_TBDOWN']);

Route::post('/PDF_APP', [PageMilestore_Controller::class, 'PDF_APP']);

Route::post('/PDF_RPDOWN', [PageCustomer_Controller::class, 'PDF_RPDOWN']);

Route::post('/PDF_TPDOWN', [PageCustomer_Controller::class, 'PDF_TPDOWN']);

Route::post('/PDF_INSURANCE', [PageCustomer_Controller::class, 'PDF_INSURANCE']);

Route::post('/QR_Code', [PageCustomer_Controller::class, 'QR_Code']);


Route::post('/TEST_API', [PageCustomer_Controller::class, 'TEST_API']);



// Google Domain Verification
Route::get('/google18d482a4643299fb.html', function () {
    return view('google18d482a4643299fb');
});


