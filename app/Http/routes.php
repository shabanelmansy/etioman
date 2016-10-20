<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});*/


Route::get('/',['as'=>'courses.index','uses'=>'CoursesController@index' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);

Route::get('about' , 'PageController@about');
Route::get('articles','ArticlesController@index');
Route::get('articles/create',['as'=>'articles.create','uses'=>'ArticlesController@create' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin']]);
Route::get('articles/{id}','ArticlesController@show');
Route::post('articles','ArticlesController@store');
Route::get('articles/{id}/edit','ArticlesController@edit');
Route::patch('articles/{id}','ArticlesController@update');

///////////////////////////////// cousers //////////////////////////////////////////////////////////
Route::get('courses/',['as'=>'courses.index','uses'=>'CoursesController@index' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('courses/create',['as'=>'courses.create','uses'=>'CoursesController@create' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::post('courses/store',['as'=>'courses.store','uses'=>'CoursesController@store' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('courses/{id}/details',['as'=>'courses.details','uses'=>'CoursesController@details' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('courses/{id}/edit',['as'=>'courses.edit','uses'=>'CoursesController@edit' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::post('courses/{id}/update',['as'=>'courses.update','uses'=>'CoursesController@update' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('courses/{id}/delete',['as'=>'courses.delete','uses'=>'CoursesController@delete' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);



/////////////////////////////   students //////////////////////////////////////////////////////////
Route::get('students/{course_id}',['as'=>'students.index','uses'=>'StudentsController@index' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('students/{course_id}/create',['as'=>'students.create','uses'=>'StudentsController@create' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::post('students/store',['as'=>'students.store','uses'=>'StudentsController@store' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('students/{course_id}/{id}/details',['as'=>'students.details','uses'=>'StudentsController@details' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('students/{course_id}/{id}/edit',['as'=>'students.edit','uses'=>'StudentsController@edit' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::post('students/{id}/update',['as'=>'students.update','uses'=>'StudentsController@update' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('students/{course_id}/{id}/delete',['as'=>'students.delete','uses'=>'StudentsController@delete' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);

////////////////////////  reports ////////////////////////////////////////////////////////////////////

Route::get('reports/',['as'=>'reports.index','uses'=>'ReportsController@index' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('reports/{course_id}/absants',['as'=>'reports.absants','uses'=>'ReportsController@absants' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('reports/{course_id}/invoice',['as'=>'reports.invoice','uses'=>'ReportsController@invoice' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('reports/{course_id}/list',['as'=>'reports.list','uses'=>'ReportsController@reportlist' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('reports/{course_id}/certificate',['as'=>'reports.certificate','uses'=>'ReportsController@certificate' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);
Route::get('reports/{course_id}/allinfo',['as'=>'reports.allinfo','uses'=>'ReportsController@allinfo' ,'middleware'=>['auth','roles'] , 'roles'=>['User','Admin','Manager']]);

 


Route::get('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@showLoginForm']);
Route::post('login', ['as' => 'auth.login', 'uses' => 'Auth\AuthController@login']);
Route::get('logout', ['as' => 'auth.logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes...
Route::get('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@showRegistrationForm']);
Route::post('register', ['as' => 'auth.register', 'uses' => 'Auth\AuthController@register']);

// Password Reset Routes...
Route::get('password/reset/{token?}', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@showResetForm']);
Route::post('password/email', ['as' => 'auth.password.email',  'uses' => 'Auth\PasswordController@sendResetLinkEmail']);
Route::post('password/reset', ['as' => 'auth.password.reset', 'uses' => 'Auth\PasswordController@reset']);
 