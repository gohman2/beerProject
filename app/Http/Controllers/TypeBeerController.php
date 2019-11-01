<?php

namespace App\Http\Controllers;

use App\Models\TypeBeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeBeerController extends Controller
{
    private $messages = [
        'title.required' => 'Название обязательно к заполнению',
        'title.unique' => 'Название должно быть уникальным',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paginator = TypeBeer::paginate(5);
        return view('beer.type.index', compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beer.type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:type_beers|max:255'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.types.create'))
                ->withErrors($validator)
                ->withInput();
        }

        TypeBeer::create($request->all());
        return redirect()->route('beer.types.index')->with('status', 'Тип пива добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typeBeers = TypeBeer::find($id);
        return view('beer.type.edit', compact('typeBeers') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:type_beers|max:255'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.types.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $manufacturer = TypeBeer::find($id);
        $manufacturer->update($request->all());
        return redirect()->route('beer.types.index')->with('status', 'Тип пива обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypeBeer::find($id)->delete();
        return redirect()->route('beer.types.index')->with('status', 'Тип пива удален!');
    }
}
