<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customers_reports;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Invoices_reports;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;



Auth::routes();
Route::resources([
    'roles'     => RoleController::class,
    'users'     => UserController::class,
    'sections'  => SectionController::class,
    'categories'=> CategoryController::class,
    'invoices'=> InvoiceController::class,
    'InvoiceAttachments'=> InvoiceAttachmentsController::class,
]);


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::Put('/updateProfile/{id}',[UserController::class,'updateProfile'])->name('updateProfile');

// Invoices
Route::get('/section/{id}',[InvoiceController::class,'getoption']);
Route::get('invoices.status/{id}',[InvoiceController::class,'status'])->name('status');
Route::put('invoices.status.update',[InvoiceController::class,'updateStatus'])->name('updateStatus');
Route::get('invoices.trached',[InvoiceController::class,'trached'])->name('trached');
Route::put('invoices.retrached',[InvoiceController::class,'retrached'])->name('retrached');
Route::delete('invoices.delete',[InvoiceController::class,'delete'])->name('delete');
Route::get('invoices.paid',[InvoiceController::class,'paid'])->name('paid');
Route::get('invoices.unpaid',[InvoiceController::class,'unpaid'])->name('unpaid');
Route::get('invoices.somepaid',[InvoiceController::class,'somepaid'])->name('somepaid');
Route::get('invoices.print/{id}',[InvoiceController::class,'print'])->name('print');
Route::get('exportInvoices', [InvoiceController::class, 'export'])->name('exportInvoices');
Route::get('markAsRead', [InvoiceController::class, 'markAsRead'])->name('markAsRead');

// invoice_details
Route::get('/invoice_details/{id}',[InvoicesDetailsController::class,'getdetails'])->name('details');

// InvoiceAttachments
Route::get('/InvoiceAttachments/{invoice_num}/{filename}',[InvoiceAttachmentsController::class,'getPic'])->name('getPic');
Route::get('/InvoiceAttachments/viewfile/{invoice_num}/{filename}',[InvoiceAttachmentsController::class,'downloadPic'])->name('downloadPic');
Route::get('/InvoiceAttachments/delete_file',[InvoiceAttachmentsController::class,'delete_file'])->name('delete_file');



// Reports
Route::get('/Invoices_reports',[Invoices_reports::class,'index'])->name('Invoices_reports');
Route::Post('/Invoices_reports/sarech',[Invoices_reports::class,'sarech'])->name('sarech_reports');

Route::get('/customers_report',[customers_reports::class,'index'])->name('customers_report');
Route::Post('/customers_report/sarech',[customers_reports::class,'sarech'])->name('sarech_customers_report');


// AdminController
Route::get('/{page}',[AdminController::class,'index']);
