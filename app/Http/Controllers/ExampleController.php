<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ExampleController extends Controller
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

    public function index()
    {
        $autores = Autor::all();
        return $this->successResponse($autores);
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required|max:255',
            'genero' => 'required|max:255|in:Hombre,Mujer',
            'pais'   => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $autor = Autor::create($request->all());

        return $this->successResponse($autor, Response::HTTP_CREATED);
    }

    public function show($id_autor)
    {
        $autor = Autor::findOrFail($id_autor);

        return  $this->successResponse($autor);
    }

    public function update(Request $request, $id_autor)
    {
        $rules = [
            'nombre' => 'max:255',
            'genero' => 'max:255|in:Hombre,Mujer',
            'pais'   => 'max:255',
        ];
        $this->validate($request, $rules);
        $autor = Autor::findOrFail($id_autor);

        $autor->fill($request->all());
        if ($autor->isClean()) {
            return $this->errorResponse('Al menos un valor debe cambiar', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $autor->save();

        return $this->successResponse($autor);
    }

    public function destroy($id_autor)
    {
        $autor = Autor::findOrFail($id_autor);
        $autor->delete();
        return $this->successResponse($autor);
    }
}
