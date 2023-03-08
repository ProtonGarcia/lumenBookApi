<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/books', 'Book\BookController@index');
$router->post('/books/store', 'Book\BookController@store');
$router->get('/books/{book}', 'Book\BookController@show');
$router->put('/books/update/{book}', 'Book\BookController@update');
// $router->patch('/books/{book}', 'BookController@update');
$router->delete('/books/delete/{book}', 'Book\BookController@destroy');