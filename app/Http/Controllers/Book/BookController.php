<?php

namespace App\Http\Controllers\Book;

use App\Models\Book;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;

class BookController extends BaseController
{
    use ApiResponse;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function index()
    {
        $books = Book::all();

        return $this->jsonResponse('metodo index books', $books, 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max: 255',
            'description' => 'required|max: 255',
            'price' => 'required|max: 255',
            'author_id' => 'required|max: 255',
        ];

        if (!$this->validate($request, $rules)) {
            return $this->jsonResponse('Revisar todos los datos', null, 500);
        };

        $book = new Book();

        if (!$book->create($request->all())) {
            return $this->jsonResponse('No se inserto el Libro', null, 500);
        }

        return $this->jsonResponse('Libro insertado', null, 201);
    }

    public function show($book)
    {

        $book = Book::where('id', $book)->first();
        return $this->jsonResponse('Busqueda de usuarios', $book, 200);
    }

    public function update(Request $request, $book)
    {
        $book = Book::where('id', $book)->first();

        if (!$book) {
            return $this->jsonResponse('No se encontraron resultados', null, 404);
        }

        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->jsonResponse('No se encontraron cambios, al menos un cambio debe ser realizado', null, 500);
        }

        if (!$book->save()) {
            return $this->jsonResponse('No se realizo la actualizacion', null, 500);
        }
        return $this->jsonResponse('registro actualizado', null, 200);
    }

    public function destroy($book)
    {
        $book = Book::where('id', $book)->first();

        if (!$book) {
            return $this->jsonResponse('No se encontraron resultados', null, 404);
        }

        if (!$book->delete()) {
            return $this->jsonResponse('No se elimino el registro', null, 500);
        }

        return $this->jsonResponse('Registro eliminado', null, 200);
    }
}
