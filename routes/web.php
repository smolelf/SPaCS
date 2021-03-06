<?php

use App\Http\Controllers\CheckpointController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjMemberController;
use App\Http\Controllers\User as ControllersUser;
use App\Models\Client;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', [Controller::class, 'index']);

//Route::get('/landing', [Controller::class, 'landing']);

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//Project Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/addproject', [ProjectController::class, 'list'])->name('project');

Route::middleware(['auth:sanctum', 'verified'])->post('/projadd', [ProjectController::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/editproj/{id}', [ProjectController::class, 'view'])->name('project');

Route::middleware(['auth:sanctum', 'verified'])->post('/updateproj', [ProjectController::class, 'update']);

//History Controller
// Route::middleware(['auth:sanctum', 'verified'])->get('/addproject', [ProjectController::class, 'list'])->name('project');

// Route::middleware(['auth:sanctum', 'verified'])->post('/projadd', [ProjectController::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/edithist/{id}', [ProjectController::class, 'view'])->name('history');

Route::middleware(['auth:sanctum', 'verified'])->post('/updatehist', [ProjectController::class, 'update']);

//ProjMember Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/editmember/{id}', [ProjMemberController::class, 'view'])->name('project');

Route::middleware(['auth:sanctum', 'verified'])->post('/updatememb', [ProjMemberController::class, 'update']);

//User Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/adduser', [ControllersUser::class, 'list'])->name('user');

Route::middleware(['auth:sanctum', 'verified'])->post('/useradd', [ControllersUser::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/edituser/{id}', [ControllersUser::class, 'view'])->name('user');

Route::middleware(['auth:sanctum', 'verified'])->post('/updateuser', [ControllersUser::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])->get('/deluser/{id}', [ControllersUser::class, 'deluser']); //soft delete implemented

Route::middleware(['auth:sanctum', 'verified'])->post('/resetpw', [ControllersUser::class, 'resetpw']);

Route::middleware(['auth:sanctum', 'verified'])->get('/restuser', [ControllersUser::class, 'restuserlist'])->name('usrestore');

Route::middleware(['auth:sanctum', 'verified'])->get('/restus/{id}', [ControllersUser::class, 'restuser']);

//User Controller (User Profile)

Route::middleware(['auth:sanctum', 'verified'])->get('/editself', [ControllersUser::class, 'self'])->name('profile');

Route::middleware(['auth:sanctum', 'verified'])->post('/updateself', [ControllersUser::class, 'updateself']);

Route::middleware(['auth:sanctum', 'verified'])->post('/updateselfpw', [ControllersUser::class, 'updateselfpw']);

//Client Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/addclient', [ClientController::class, 'list'])->name('client');

Route::middleware(['auth:sanctum', 'verified'])->post('/clientadd', [ClientController::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/editclient/{id}', [ClientController::class, 'view'])->name('client');

Route::middleware(['auth:sanctum', 'verified'])->post('/updateclient', [ClientController::class, 'update']);

//Checkpoints Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/addcheckpoint', [CheckpointController::class, 'list'])->name('checkpoint');

Route::middleware(['auth:sanctum', 'verified'])->post('/checkpointadd', [CheckpointController::class, 'add']);

Route::middleware(['auth:sanctum', 'verified'])->get('/editcheckpoint/{id}', [CheckpointController::class, 'view'])->name('checkpoint');

Route::middleware(['auth:sanctum', 'verified'])->post('/updatecheckpoint', [CheckpointController::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])->get('/delcp/{id}', [CheckpointController::class, 'delcp']);

Route::middleware(['auth:sanctum', 'verified'])->post('/genqr', [CheckpointController::class, 'genqr']);

Route::middleware(['auth:sanctum', 'verified'])->get('/printqr/{id}', [CheckpointController::class, 'printQR']);

Route::middleware(['auth:sanctum', 'verified'])->get('/restcp', [CheckpointController::class, 'restcplist'])->name('cprestore');

Route::middleware(['auth:sanctum', 'verified'])->get('/restcp/{id}', [CheckpointController::class, 'restcp']);

//Navbar Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/home', [Controller::class, 'home'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/project', [Controller::class, 'project'])->name('project');

Route::middleware(['auth:sanctum', 'verified'])->get('/history', [Controller::class, 'history'])->name('history');

Route::middleware(['auth:sanctum', 'verified'])->get('/user', [Controller::class, 'user'])->name('user');

Route::middleware(['auth:sanctum', 'verified'])->get('/client', [Controller::class, 'client'])->name('client');

Route::middleware(['auth:sanctum', 'verified'])->get('/checkpoint', [Controller::class, 'checkpoint'])->name('checkpoint');

Route::middleware(['auth:sanctum', 'verified'])->get('/landing', [Controller::class, 'landing'])->name('landing');

//Report Controller
Route::middleware(['auth:sanctum', 'verified'])->get('/report/new', [HistoryController::class, 'newreport'])->name('report');

Route::middleware(['auth:sanctum', 'verified'])->post('/report/xport', [HistoryController::class, 'genreport']);

//Search Function
Route::middleware(['auth:sanctum', 'verified'])->get('/history/search', [Controller::class, 'htsearch'])->name('htsearch');

Route::middleware(['auth:sanctum', 'verified'])->get('/user/search', [Controller::class, 'ussearch'])->name('ussearch');

Route::middleware(['auth:sanctum', 'verified'])->get('/checkpoint/search', [Controller::class, 'cpsearch'])->name('cpsearch');

//Mobile View
Route::middleware(['auth:sanctum', 'verified'])->get('/mobile/scan', [Controller::class, 'scanqr'])->name('scanqr');

Route::middleware(['auth:sanctum', 'verified'])->any('/mobile/scanned', [HistoryController::class, 'regscan']);

Route::middleware(['auth:sanctum', 'verified'])->get('/mobile/history', [Controller::class, 'mobilehistory'])->name('mobilehistory');

Route::get('/test', function () {
    return view('public.qrprint');
});

// Route::get('qr-code-g', function () {
//     \QrCode::size(500)
//             ->format('png')
//             ->generate('www.google.com', public_path('images/qrcode.png'));
// return view('qrCode');
// });