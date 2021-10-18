<?php

use Illuminate\Support\Facades\Auth;
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

// Start Routes Before Login
Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {

    Route::get('/', 'SiteController@index')->name('front.home');
    Route::get('contact', 'SiteController@contact')->name('contact')->middleware('auth');
});
//End Routes Before Login
//Start My Info
Route::get('myInfo/{id}', 'Auth\MyInfoController@edit')->name('info.edit');
Route::post('myInfo/{id}', 'Auth\MyInfoController@update')->name('info.update');
//End My info

//start Routes After Login
Route::group(['namespace' => 'Dashboard', 'prefix' => 'dashboard', 'middleware' => 'auth'], function () {
//    Start Home
    Route::get('/', 'HomeController@index')->name('teacher.home');
//     End Home

// Start Print
    Route::get('class/{id}/print', 'CategoriesController@printView')->name('class.print');

    //End print

    //start Contact us
    Route::get('contact', 'ContactUsController@contactView')->name('contact.view');
    Route::post('/contactPost', 'ContactUsController@contactsPost')->name('contact.post');
// End Contact us

    // Start Message View
    Route::group(['prefix' => 'messages'], function () {
        Route::get('/', 'ContactUsController@messagesView')->name('messages.view');
        Route::get('show/{id}', 'ContactUsController@messageShow')->name('messages.show');
        Route::get('delete/{id}', 'ContactUsController@messageDestroy')->name('messages.delete');
    });
    // end Message View


//    Start Categories
    Route::get('/classes', 'CategoriesController@index')->name('dashboard.categories');

    //                 Store Class
    Route::post('/classes/storeClass', 'CategoriesController@storeClass')->name('dashboard.categories.store');

    //                 Edit Class
    Route::get('/classes/edit/{id}', 'CategoriesController@editClass')->name('dashboard.categories.edit');

//    Update Class
    Route::post('/classes/update/{id}', 'CategoriesController@updateClass')->name('dashboard.categories.update');

//    Delete Class
    Route::get('/classes/delete/{id}', 'CategoriesController@destroyClass')->name('dashboard.categories.delete');

//    Delete Class
    Route::get('/classes/repeat/{id}', 'CategoriesController@repeatClass')->name('dashboard.categories.repeat');

//    here /classes/show/{id}               Show Class
    Route::get('/classes/show/{id}', 'CategoriesController@show')->name('dashboard.categories.show');

    // here classes/{id}/addStudents        Add Students
    Route::get('/classes/{id}/addStudents', 'CategoriesController@addStudents')->name('dashboard.categories.addStudents');

    //                 Store Students
    Route::post('/classes/{id}/storeStudents', 'CategoriesController@storeStudents')->name('dashboard.categories.storeStudents');

    // here classes/{id}/manageColumns         Manage Columns
    Route::get('/classes/{id}/manageColumns', 'CategoriesController@manageColumns')->name('dashboard.categories.manageColumns');

    // here classes/{id}/add-columns
    Route::get('/classes/{id}/addColumn', 'CategoriesController@addColumn')->name('dashboard.categories.addColumn');

    //                 Store Columns
    Route::post('/classes/{id}/storeColumns', 'CategoriesController@storeColumns')->name('dashboard.categories.storeColumns');

    // here /classes/{class-id}/edit-column/{column-id}         edit Column
    Route::get('/classes/{classId}/editColumn/{columnId}', 'CategoriesController@editColumn')->name('dashboard.categories.editColumn');

    // Update Column
    Route::post('/classes/{classId}/updateColumn/{columnId}', 'CategoriesController@updateColumn')->name('dashboard.categories.updateColumn');


//    Delete Column
    Route::get('/classes/{classId}/destroyColumn/{columnId}', 'CategoriesController@destroyColumn')->name('dashboard.categories.destroyColumn');


    // Update student Details
    Route::post('/classes/show/{classId}', 'CategoriesController@updateStudentDetails')->name('dashboard.categories.updateStudentDetails');

    // Delete Student with relation
    Route::get('/classes/{classId}/destroyStudent/{studentId}', 'CategoriesController@destroyStudent')->name('dashboard.categories.destroyStudent');


//    End Categories


});
//End Route After Login

//Route::get('/testing', 'TestingController@index');
Auth::routes();

