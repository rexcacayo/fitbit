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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('notifies', 'notifyController');

Route::resource('entities', 'entityController');

Route::resource('atributes', 'atributeController');

Route::resource('$iotServices', '$iotServiceController');

Route::resource('iotServices', 'iotServiceController');

Route::resource('iotDevices', 'iot_deviceController');

Route::resource('iotDeviceAttributes', 'iot_device_attributeController');

Route::resource('iotDeviceAttributes', 'iot_device_attributeController');

Route::get('fitbits/sync', 'fitbitController@syncup')->name('fitbits.sync');

Route::get('fitbits/sync/sleep', 'fitbitController@syncupSleep')->name('fitbits.syncupSleep');

Route::resource('fitbits', 'fitbitController');

Route::get('temperatura/form', 'fiwareController@form')->name('temperatura.form');

Route::get('temperatura/sensores/{nombre}', 'fiwareController@getSensores');

Route::post('temperatura/consulta', 'fiwareController@consulta')->name('temperatura.consulta');

Route::get('presion/form', 'fiwareController@formPresion')->name('presion.formPresion');

Route::get('presion/sensores/{nombre}', 'fiwareController@getSensoresPresion');

Route::post('presion/consulta', 'fiwareController@consultaPresion')->name('presion.consultaPresion');

Route::get('humedad/form', 'fiwareController@formHumedad')->name('humedad.formHumedad');

Route::get('humedad/sensores/{nombre}', 'fiwareController@getSensoresHumedad');

Route::post('humedad/consulta', 'fiwareController@consultaHumedad')->name('humedad.consultaHumedad');

Route::resource('temperatura', 'fiwareController');

//Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::resource('heartRates', 'heartRateController');

Route::resource('heartInterDays', 'heartInterDayController');

Route::resource('sleeps', 'sleepController');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
