<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Manufacturer;
use App\Models\TypeBeer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BeerController extends Controller
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

        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $typeBeers = TypeBeer::pluck('title', 'id')->all();

        $mId = false;
        $tId = false;

        if ($request->get('manufacturer_id') !== null && $request->get('type_id') !== null) {
            $mId = (int)$request->get('manufacturer_id');
            $tId = (int)$request->get('type_id');
            $beers = Beer::where('manufacturer_id', '=', $mId)->where('type_id', '=', $tId)->paginate(5);
        } else {
            $beers = Beer::paginate(5);
        }

        return view('beer.index', compact(
            'beers',
            'manufacturers',
            'typeBeers',
            'mId',
            'tId'

        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $typeBeers = TypeBeer::pluck('title', 'id')->all();

        return view('beer.create', compact(
            'manufacturers', 'typeBeers'
        ));
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
            'title' => 'required|unique:beers'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.action.create'))
                ->withErrors($validator)
                ->withInput();
        }

        $beer = Beer::add($request->all());
        $beer->setManufacturer($request->get('manufacturer_id'));
        $beer->setTypeBeer($request->get('type_id'));
        return redirect()->route('beer.action.index')->with('status', 'Пиво добавленно!');
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
        $beer = Beer::find($id);
        $manufacturers = Manufacturer::pluck('title', 'id')->all();
        $typeBeers = TypeBeer::pluck('title', 'id')->all();
        $selectedManufacturer = $beer->manufacturer_id;
        $selectedType = $beer->type_id;

        return view('beer.edit', compact(
            'beer',
            'manufacturers',
            'typeBeers',
            'selectedManufacturer',
            'selectedType'
        ));
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
            'title' => 'required'
        ],
            $this->messages);

        if ($validator->fails()) {
            return redirect(route('beer.action.create'))
                ->withErrors($validator)
                ->withInput();
        }
        $beer = Beer::find($id);
        $beer->edit($request->all());
        $beer->setManufacturer($request->get('manufacturer_id'));
        $beer->setTypeBeer($request->get('type_id'));
        return redirect()->route('beer.action.index')->with('status', 'Пиво обновленно!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Beer::find($id)->delete();
        return redirect()->route('beer.action.index')->with('status', 'Пиво удалено!');
    }
}
