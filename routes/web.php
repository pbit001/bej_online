<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\IrdosarLogController;
use App\Http\Controllers\DosareDeschiseController;
use App\Http\Controllers\InterogareController;
use App\Http\Controllers\ANAFAngajatoriController;
use App\Http\Controllers\ANAFBanciController;
use App\Http\Controllers\FacturiConrtoller;
use App\Http\Controllers\ITMController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

// Auth

Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
    ->name('login.store')
    ->middleware('guest');

Route::delete('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

// Dashboard

Route::get('/', [DashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');

// Users

Route::get('users', [UsersController::class, 'index'])
    ->name('users')
    ->middleware('auth');

Route::get('users/create', [UsersController::class, 'create'])
    ->name('users.create')
    ->middleware('auth');

Route::post('users', [UsersController::class, 'store'])
    ->name('users.store')
    ->middleware('auth');

Route::get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit')
    ->middleware('auth');

Route::put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update')
    ->middleware('auth');

Route::delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy')
    ->middleware('auth');

Route::put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore')
    ->middleware('auth');

// Organizations

Route::get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations')
    ->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('irdosarlogs', IrdosarLogController::class);
    Route::resource('DosareDeschise', DosareDeschiseController::class);

});

Route::post('DosareDeschiseIstoric/{Nr_Dosare}', [DosareDeschiseController::class, 'DosareDeschiseIstoric'])
    ->name('DosareDeschiseIstoric')
    ->middleware('auth');

Route::get('Notificari/{id}/edit', [DosareDeschiseController::class, 'NotificariEdit'])
    ->name('Notificari.edit')
    ->middleware('auth'); 

Route::post('Notificari/{id}', [DosareDeschiseController::class, 'NotificariUpdate'])
    ->name('Notificari.update')
    ->middleware('auth');

Route::delete('Notificari/{id}', [DosareDeschiseController::class, 'destroyNotificari'])
    ->name('Notificari.destroy')
    ->middleware('auth');
            
Route::post('DosareDeschiseNotificare', [DosareDeschiseController::class, 'DosareDeschiseNotificareStore'])
    ->name('DosareDeschiseNotificare')
    ->middleware('auth');

Route::get('ITM', [ITMController::class, 'index'])
    ->name('ITM')
    ->middleware('auth');

Route::get('interogare', [InterogareController::class, 'index'])
    ->name('interogare')
    ->middleware('auth');

Route::get('ANAFAngajatori', [ANAFAngajatoriController::class, 'index'])
    ->name('ANAFAngajatori')
    ->middleware('auth');

Route::post('ANAFAngajatori', [ANAFAngajatoriController::class, 'store'])
    ->name('ANAFAngajatori.store')
    ->middleware('auth');
    
Route::get('ANAFBanci', [ANAFBanciController::class, 'index'])
    ->name('ANAFBanci')
    ->middleware('auth');
Route::get('Facturi', [FacturiConrtoller::class, 'index'])
    ->name('Facturi')
    ->middleware('auth');    

Route::get('Upload', [UploadController::class, 'index'])
    ->name('Upload')
    ->middleware('auth');
   
Route::post('Upload', [UploadController::class, 'store'])
    ->name('Upload.store')
    ->middleware('auth');
    
Route::any('Clienti', [FacturiConrtoller::class, 'store'])
    ->name('Clienti')
    ->middleware('auth');        

Route::any('Createbill', [FacturiConrtoller::class, 'senttobill'])
    ->name('Createbill')
    ->middleware('auth');    
    
Route::post('Savebill', [FacturiConrtoller::class, 'Savebill'])
    ->name('Savebill')
    ->middleware('auth');        
    

Route::post('ANAFBanci', [ANAFBanciController::class, 'store'])
    ->name('ANAFBanci.store')
    ->middleware('auth');


Route::post('interogare_data', [InterogareController::class, 'interogare_data'])
    ->name('interogare_data')
    ->middleware('auth');    

Route::get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create')
    ->middleware('auth');

Route::post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store')
    ->middleware('auth');

Route::get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit')
    ->middleware('auth');

Route::put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update')
    ->middleware('auth');

Route::delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy')
    ->middleware('auth');

Route::put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore')
    ->middleware('auth');


// Template
Route::get('template', [TemplateController::class, 'index'])
    ->name('template')
    ->middleware('auth');

Route::get('template/create', [TemplateController::class, 'create'])
    ->name('template.create')
    ->middleware('auth');

Route::post('template', [TemplateController::class, 'store'])
    ->name('template.store')
    ->middleware('auth');

Route::get('template/{organization}/edit', [TemplateController::class, 'edit'])
    ->name('template.edit')
    ->middleware('auth');

Route::put('template/{organization}', [TemplateController::class, 'update'])
    ->name('template.update')
    ->middleware('auth');

Route::delete('template/{template}', [TemplateController::class, 'destroy'])
    ->name('template.destroy')
    ->middleware('auth');

Route::post('download_template', [TemplateController::class, 'download_template'])
    ->name('download_templaten')
    ->middleware('auth');
    
// Contacts

Route::get('contacts', [ContactsController::class, 'index'])
    ->name('contacts')
    ->middleware('auth');

Route::get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create')
    ->middleware('auth');

Route::post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store')
    ->middleware('auth');

Route::get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit')
    ->middleware('auth');

Route::put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update')
    ->middleware('auth');

Route::delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy')
    ->middleware('auth');

Route::put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore')
    ->middleware('auth');

// Reports

Route::get('reports', [ReportsController::class, 'index'])
    ->name('reports')
    ->middleware('auth');

// Images

Route::get('/img/{path}', [ImagesController::class, 'show'])
    ->where('path', '.*')
    ->name('image');
