<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Models\Debt;
use App\Models\UploadFiles;
use \PDF;
use Illuminate\Http\Request;

/* Загрузка всех записей из БД */
Route::get('/', function () {
    $debts = Debt::orderBy('created_at', 'asc')->get();

    return view('debts', ['debts' => $debts]);
});

/* Удаление записи из БД */
Route::delete('/debt/{debt}', function (Debt $debt) {
    $debt->delete();

    return redirect('/')->with('success', 'Должник удален');
});

/* Создание новой записи в БД */
Route::get('/create','App\Http\Controllers\DebtController@create');
Route::post('/publicate','App\Http\Controllers\DebtController@store');

/* Редактирование существующей записи в БД */
Route::get('/edit/{debt}','App\Http\Controllers\DebtController@edit');
Route::post('/update/{debt}','App\Http\Controllers\DebtController@update');

/* Экспорт файлов в PDF и Excel */
Route::get('/export/excel', 'App\Http\Controllers\DebtController@excel_export');
Route::get('/export/pdf/{debt}', 'App\Http\Controllers\DebtController@pdf_export');

/* Предпросмотр PDF */
Route::get('/view/pdf/{debt}', 'App\Http\Controllers\DebtController@pdf_preview');

Route::get('/upload/pdf/{debt}', 'App\Http\Controllers\DebtController@pdf_upload_db');
Route::get('/download/pdf/{debt}', 'App\Http\Controllers\DebtController@pdf_download_db');
