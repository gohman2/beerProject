<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Manufacturer;
use App\Models\TypeBeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
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
    public function index(Request $request)
    {
        $tId = false;
        $typeBeers = TypeBeer::pluck('title', 'id')->all();
        if ($request->get('type_id') !== null) {

            $tId = (int)$request->get('type_id');
            $paginator = Beer::join('manufacturers', 'beers.manufacturer_id', '=', 'manufacturers.id')
                ->where('beers.type_id', '=', $tId)
                ->select('manufacturers.title', 'manufacturers.id')
                ->groupBy('manufacturers.id')
                ->paginate(5);
        } else {
            $paginator = Manufacturer::paginate(5);
        }
        return view('beer.manufacturer.index', compact('paginator', 'typeBeers', 'tId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('beer.manufacturer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:manufacturers|max:255'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.manufacturers.create'))
                ->withErrors($validator)
                ->withInput();
        }

        Manufacturer::create($request->all());
        return redirect()->route('beer.manufacturers.index')->with('status', 'Производитель добавлен!');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manufacturers = Manufacturer::find($id);
        return view('beer.manufacturer.edit', compact('manufacturers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:manufacturers|max:255'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.manufacturers.edit', $id))
                ->withErrors($validator)
                ->withInput();
        }

        $manufacturer = Manufacturer::find($id);
        $manufacturer->update($request->all());
        return redirect()->route('beer.manufacturers.index')->with('status', 'Производитель обновлен!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getBeer = Manufacturer::find($id)->beer()->where('manufacturer_id', '=', $id)->first();
        if ($getBeer === null) {
            Manufacturer::destroy($id);
            return redirect()->route('beer.manufacturers.index')->with('status', 'Производитель удален!');
        } else {
            return redirect()->route('beer.manufacturers.index')->with('status', 'Невозможно удалить производителя так как он используется');
        }
    }


}
