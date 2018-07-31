<?php

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
    $numBalls = 200;
    $numSlots = 27;

    $galtonBoard = new \App\Classes\GaltonBoard();
    $galtonBoard->setNumBalls($numBalls);
    $galtonBoard->setNumSlots($numSlots);
    $galtonBoard->init();
    $galtonBoard->start();

    $slots = $galtonBoard->getSlots();

    return view('welcome', array('slots' => $slots, 'numBalls' => $numBalls, 'numSlots' => $numSlots));
});
