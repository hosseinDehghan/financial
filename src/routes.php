<?php
Route::group(['middleware' => ['web']], function () {
    Route::get("financial","Hosein\Financial\Controllers\FinancialController@index");
    Route::get("financial/stock/getWithYear/{year}","Hosein\Financial\Controllers\FinancialController@getWithYear");
    Route::get("financial/editStock/{id}","Hosein\Financial\Controllers\FinancialController@editStock");
    Route::get("financial/deleteStock/{id}","Hosein\Financial\Controllers\FinancialController@deleteStock");

    Route::post("financial/createStock","Hosein\Financial\Controllers\FinancialController@createStock");
    Route::post("financial/updateStock/{id}","Hosein\Financial\Controllers\FinancialController@updateStock");
    Route::post("financial/createCash","Hosein\Financial\Controllers\FinancialController@createCash");
    Route::get("financial/editCash/{id}","Hosein\Financial\Controllers\FinancialController@editCash");
    Route::get("financial/deleteCash/{id}","Hosein\Financial\Controllers\FinancialController@deleteCash");

});
