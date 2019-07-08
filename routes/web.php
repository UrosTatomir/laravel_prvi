<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ovde možete da registrujete veb rute za vašu aplikaciju. Ove
| rute su učitane od strane RouteServiceProvider unutar grupe koja
| sadrži "veb" middlevare grupu. Sada kreirajte nešto veliko!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/welcome', function () {
    return view('welcome'); //iz route idemo na stranicu welcome u resources folderu  
});



// Route::get('/insert',function(){
//     return view('insert');
// });
Route::get('/insert','MyController@showInsertDriver')->name('insert');
Route::get('/insert_new_driver','MyController@insertDriver');
Route::get('/show_allvehicle','MyController@showAllVehicle');
Route::get('/show_insert_car','MyController@showInsertCar');
Route::get('/insert_car','MyController@insertCar');
Route::get('/show_edit_vehicle/id_vehicle/{id_vehicle}','MyController@showEditVehicle');
Route::get('/edit_vehicle','MyController@editVehicle');
Route::get('/delete_vehicle/id_vehicle/{id_vehicle}','MyController@deleteVehicle');
Route::get('/show_alldrivers','MyController@showAllDrivers');
Route::get('/show_edit_driver/id_driver/{id_driver}','MyController@showEditDriver');
Route::get('/edit_driver','MyController@editDriver');
Route::get('/delete_driver/id_driver/{id_driver}','MyController@deleteDriver');
Route::get('/show_assign','MyController@showAssign');
Route::get('/get_assign','MyController@getAssign');

Route::get('/choose_driverbyvehicle','MyController@showDriverByVehicle');
Route::get('/choose_drivers','MyController@chooseDrivers');
Route::get('/choose_vehiclebydriver','MyController@showVehicleByDriver');
Route::get('/choose_vehicles','MyController@chooseVehicles');
//ovo je routa koja vraca na index stranu ugradjenom metodom redirect sa MyControllera 

Route::get('/alldrivers',function(){
    return view('alldrivers')->withSuccess('Records insert successfully');
});

Route::get('/allvehicle',function(){
    return view('allvehicle')->withSuccess( 'Records insert successfully');
});

Route::get('/assign', function () {
    return view('assign')->withSuccess('Records insert successfully');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
