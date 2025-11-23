<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceproviderController;

Route::get('/', [CustomerController::class, 'HOME'])
    ->name('Userhome');
Route::get('/loginsignup', [CustomerController::class, 'LOGINSIGNUP'])
    ->name('loginsignup');
Route::post('/usersignup', [CustomerController::class, 'USERSIGNUP'])
    ->name('UserSignup');
Route::post('/userlogin', [CustomerController::class, 'USERLOGIN'])
    ->name('UserLogin');
Route::middleware(['customer'])->group(function () {
Route::post('/userlogout', [CustomerController::class, 'USERLOGOUT'])
    ->name('UserLogout');
Route::get('/Userhome', [CustomerController::class, 'HOME']);
Route::get('/userprofile', [CustomerController::class, 'USERPROFILE'])
    ->name('userprofile');
Route::get('/services', [CustomerController::class, 'SERVICES'])
    ->name('services');
Route::post('/requestservice/{id}', [CustomerController::class, 'REQUESTSERVICE'])
    ->name('requestservice');
Route::get('/myrequests', [CustomerController::class, 'MYREQUESTS'])
    ->name('myrequests');
Route::get('/updateinfo', [CustomerController::class, 'UPDATEINFOPAGE'])
    ->name('updateinfo');
Route::post('/updateprofile', [CustomerController::class, 'UPDATEPROFILE'])
    ->name('updateprofile');
Route::get('/updatepasswordc', [CustomerController::class, 'UPDATEPASSWORDC'])
    ->name('updatepasswordc');
Route::post('/passchangecc', [CustomerController::class, 'CHANGEPASS'])
    ->name('passchangecc');
Route::get('/pendingservices', [CustomerController::class, 'PENDINGSERVICES'])
    ->name('pendingservices');
Route::get('/takenservices', [CustomerController::class, 'TAKENSERVICES'])
    ->name('takenservices');
Route::post('/cancelpendingservice/{id}', [CustomerController::class, 'CANCLELPENDINGSERVICE'])
    ->name('cancelpendingservice');
});


Route::get('/adminlogin', [AdminController::class, 'ADMINLOGINPAGE'])
    ->name('adminloginpage');
Route::get('/adminsignup', [AdminController::class, 'ADMINSIGNUPPAGE'])
    ->name('adminsignuppage');
Route::post('/adminsignup', [AdminController::class, 'ADMINSIGNUPS'])
    ->name('AdminSignup');
Route::post('/adminlogin', [AdminController::class, 'ADMINLOGINS'])
    ->name('AdminLogin');
Route::middleware(['admin'])->group(function () {
Route::get('/adminprofile', [AdminController::class, 'ADMINPROFILE'])
    ->name('adminprofile');
Route::get('/allserviceprovider', [AdminController::class, 'ALLSERVICEPROVIDER'])
    ->name('allserviceprovider');
Route::get('/allcustomer', [AdminController::class, 'ALLCUSTOMER'])
    ->name('allcustomer');
Route::post('/adminlogout', [AdminController::class, 'ADMINLOGOUT'])
    ->name('AdminLogout');
Route::get('/approveservice', [AdminController::class, 'APPROVESERVICE'])
    ->name('approveservice');
Route::get('/addservice', [AdminController::class, 'ADDSERVICEPAGE'])
    ->name('addservicepage');
Route::post('/addservice', [AdminController::class, 'ADDSERVICE'])
    ->name('AddService');
Route::get('/servicerequests', [AdminController::class, 'SERVICEREQUESTS'])
    ->name('servicerequests');
Route::post('/approveservicerequest/{id}', [AdminController::class, 'APPROVESERVICEREQUEST'])
    ->name('approveservicerequest');
Route::post('/rejectservicerequest/{id}', [AdminController::class, 'REJECTSERVICEREQUEST'])
    ->name('rejectservicerequest');
Route::get('/allusers', [AdminController::class, 'ALLUSERS'])
    ->name('allusers');
Route::get('/allserviceproviders', [AdminController::class, 'ALLSERVICEPROVIDERS'])
    ->name('allserviceproviders');
Route::get('/serviceproviderrequests', [AdminController::class, 'SERVICEPROVIDERREQUESTS'])
    ->name('serviceproviderrequests');
Route::post('/approveserviceproviderrequest/{sp_id}', [AdminController::class, 'APPROVESERVICEPROVIDERREQUEST'])
    ->name('approveserviceproviderrequest');
Route::post('/rejectserviceproviderrequest/{sp_id}', [AdminController::class, 'REJECTSERVICEPROVIDERREQUEST'])
    ->name('rejectserviceproviderrequest');
Route::get('/approvedservices', [AdminController::class, 'APPROVEDSERVICES'])
    ->name('approvedservices');
Route::post('/completeservices/{id}', [AdminController::class, 'COMPLETESERVICES'])
    ->name('completeservices');
Route::get('/doneservices', [AdminController::class, 'DONESERVICES'])
    ->name('doneservices');
Route::get('/completedservices', [AdminController::class, 'COMPLETEDSERVICES'])
    ->name('completedservices');
Route::get('/payments', [AdminController::class, 'PAYMENTS'])
    ->name('payments');
Route::post('/markaspaid/{id}', [AdminController::class, 'MARKASPAID'])
    ->name('markaspaid');
Route::get('/eachuser/{id}', [AdminController::class, 'EACHUSER'])
    ->name('eachuser');
Route::get('/eachserviceprovider/{sp_id}', [AdminController::class, 'EACHSERVICEPROVIDER'])
    ->name('eachserviceprovider');
Route::get('/activesp', [AdminController::class, 'ACTIVESP'])
    ->name('activesp');
Route::get('/adminhome', [AdminController::class, 'MONTHLYSALES'])
    ->name('adminhome');
Route::post('/removeserviceprovider/{sp_id}', [AdminController::class, 'REMOVESERVICEPROVIDER'])
    ->name('removeserviceprovider');
});



Route::get('/serviceproviderlogin', [ServiceproviderController::class, 'SERVICEPROVIDERLOGINPAGE'])
    ->name('serviceproviderlogin');
Route::get('/serviceprovidersignup', [ServiceproviderController::class, 'SERVICEPROVIDERSIGNUPPAGE'])
    ->name('serviceprovidersignup');
Route::post('/serviceprovidersignup', [ServiceproviderController::class, 'SERVICEPROVIDERSIGNUP'])
    ->name('ServiceproviderSignup');
Route::post('/serviceproviderlogin', [ServiceproviderController::class, 'SERVICEPROVIDERLOGIN'])
    ->name('ServiceproviderLogin');
Route::middleware(['serviceprovider'])->group(function () {
Route::post('/serviceproviderlogout', [ServiceproviderController::class, 'SERVICEPROVIDERLOGOUT'])
    ->name('ServiceproviderLogout');
Route::get('/serviceproviderhome', [ServiceproviderController::class, 'SERVICEPROVIDERHOME'])
    ->name('serviceproviderhome');
Route::get('/serviceproviderprofile', [ServiceproviderController::class, 'SERVICEPROVIDERPROFILE'])
    ->name('serviceproviderprofile');
Route::get('/tasks', [ServiceproviderController::class, 'TASKS'])
    ->name('tasks');
Route::get('/servicetaskdetails/{id}', [ServiceproviderController::class, 'SERVICETASKDETAILS'])
    ->name('servicetaskdetails');
Route::post('/workdone/{id}', [ServiceproviderController::class, 'WORKDONE'])
    ->name('workdone');
Route::post('/workstarted/{id}', [ServiceproviderController::class, 'WORKSTARTED'])
    ->name('workstarted');
Route::get('/completedtasks', [ServiceproviderController::class, 'COMPLETEDTASKS'])
    ->name('completedtasks');
Route::get('/updatepassword', [ServiceproviderController::class, 'UPDATEPASSWORD'])
    ->name('updatepassword');
Route::post('/passchangec', [ServiceproviderController::class, 'CHANGEPASS'])
    ->name('Passchangec');
Route::post('/statusactive', [ServiceproviderController::class, 'STATUSACTIVE'])
    ->name('statusactive');
Route::post('/statusinactive', [ServiceproviderController::class, 'STATUSINACTIVE'])
    ->name('statusinactive');
});

