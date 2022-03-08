<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//LOGIN
Route::post('/Register', 'userController@register');
Route::post('/Login', 'userController@login');

Route::group(['middleware' => ['jwt.verify']], function(){

    Route::group(['middleware' => ['api.superadmin']], function(){
        Route::delete('/Students/{id}', 'StudentsController@delete');
        Route::delete('/Grade/{id}', 'GradeController@delete');
        Route::delete('/Book/{id}', 'BookController@delete');
        Route::delete('/BookBorrow/{id}', 'BookBorrowController@delete');
        Route::delete('/BookReturn/{id}', 'BookReturnController@delete');
        Route::delete('/BookBorrowDetails/{id}', 'BookBorrowDetailsController@delete');

  
    });

    Route::group(['middleware' => ['api.admin']], function(){
        Route::post('/Students', 'StudentsController@store');
        Route::put('/Students/{id}', 'StudentsController@update');

        Route::post('/Grade', 'GradeController@store');
        Route::put('/Grade/{id}', 'GradeController@update');

        Route::post('/Book', 'BookController@store');
        Route::put('/Book/{id}', 'BookController@update');

        Route::post('/BookBorrow', 'BookBorrowController@store');
        Route::put('/BookBorrow/{id}', 'BookBorrowController@update');
    
        Route::post('/BookReturn', 'BookReturnController@store');
        Route::put('/BookReturn/{id}', 'BookReturnController@update');

        Route::post('/BookBorrowDetails', 'BookBorrowDetailsController@store');
        Route::put('/BookBorrowDetails/{id}', 'BookBorrowDetailsController@update');

        Route::post('addItem/{id}', 'BookBorrowController@addItem');

    });
    

    //get start
    Route::get('/Students', 'StudentsController@show');
    Route::get('/Students/{id}', 'StudentsController@detail');

    Route::get('/Grade', 'GradeController@show');
    Route::get('/Grade/{id}', 'GradeController@detail');

    Route::get('/Book', 'BookController@show');
    Route::get('/Book/{id}', 'BookController@detail');

    Route::get('/BookBorrow', 'BookBorrowController@show');
    Route::get('/BookBorrow/{id}', 'BookBorrowController@detail');

    Route::get('/BookReturn', 'BookReturnController@show');
    Route::get('/BookReturn/{id}', 'BookReturnController@detail');

    Route::get('/BookBorrowDetails', 'BookBorrowDetailsController@show');
    Route::get('/BookBorrowDetails/{id}', 'BookBorrowDetailsController@detail');

});
