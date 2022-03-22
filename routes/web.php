<?php

use App\Models\Message;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $data = [];
    $data = Message::get()->map(function ($c) {
        $user = User::where('id', $c->user_id)->first();
        return [
            'id'        => $c->id,
            'user_name' => $user->username,
            'message'   => ($c->message),
            'time'      => $c->created_at,
            // base64_decode
        ];
    });
    return view('index')->with('data', $data);
});

Route::get('/register', function () {
    return view('register');
});
