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

Route::get('', 'HomeController@index');
Route::get('home', 'HomeController@index')->name('home');
Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('profile', ProfileController::
class)
;

Route::group([
    'prefix' => 'result',
    'as' => 'result.',
    'namespace' => 'Result',
    'middleware' => 'auth'
], function()
{
    Route::resource('summary', ResultController::
    class)
    ;
    Route::resource('detail', ResultDetailController::
    class, ['only' => ['store', 'edit', 'update', 'destroy']]);
    Route::get('getPrint/{id}', 'ResultController@getPrint')->name('getPrint');
    Route::get('getValidate/{id}', 'ResultController@getValidate')->name('getValidate');
    Route::get('getUnvalidate/{id}', 'ResultController@getUnvalidate')->name('getUnvalidate');
    Route::get('getValidateResult/{id}', 'ResultDetailController@getValidateResult')->name('getValidateResult');
    Route::get('getUnvalidateResult/{id}', 'ResultDetailController@getUnvalidateResult')->name('getUnvalidateResult');
});

Route::group([
    'prefix' => 'report',
    'as' => 'report.',
    'namespace' => 'Report',
    'middleware' => 'auth'
], function()
{
    Route::resource('summary', SummaryController::
    class, ['only' => ['index', 'show']]);
    Route::resource('visitByRoom', VisitByRoomController::class, ['only' => ['index']]);
});

Route::group([
    'prefix' => 'api',
    'as' => 'api.',
    'namespace' => 'Api',
    'middleware' => 'auth'
], function()
{
    Route::get('postStatus/{id}', 'NotificationController@postStatus')->name('postStatus');

});


Route::group([
    'prefix' => 'settings',
    'as' => 'settings.',
    'namespace' => 'Admin'
], function()
{
    Route::group(['middleware' => 'auth.admin'], function ()
    {
        Route::resource('customer', CustomerController::class,['except' => ['getDataDetail']]);
        Route::resource('dashboard', DashboardController::class);
        Route::resource('barang', BarangController::class);
        Route::resource('ruang', RuangController::class);
        Route::resource('kelas', KelasController::class);
        Route::resource('status', StatusController::class);
        Route::resource('doctor', DoctorController::class);
        Route::resource('officer', OfficerController::class);

        Route::resource('kdlab', KdlabController::class);
        Route::resource('nrujukan', NrujukanController::class, ['only' => ['store', 'edit', 'update', 'destroy']]);

        Route::resource('hospital', 'HospitalController', ['except' => ['destroy']]);
    });

    Route::resource('user', UserController::class)->middleware('auth.superadmin');
    Route::resource('slider', SliderController::class)->middleware('auth.superadmin');
});

Route::get('getDataDetail/{no_rm}', 'ApiController@getDataDetail');
Route::get('getNilaiRujukan/{id_lab}/{id_master}', 'ApiController@getNilaiRujukan');
Route::get('getLabDetail/{id_lab}', 'ApiController@getLabDetail');

Auth::routes();