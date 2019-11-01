<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
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
    public function index()
    {
            $paginator = Manufacturer::paginate(5);
            return view('beer.manufacturer.index', compact('paginator'));
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
     * @param  \Illuminate\Http\Request  $request
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
        $manufacturers = Manufacturer::find($id);
        return view('beer.manufacturer.edit', compact('manufacturers') );
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Manufacturer::find($id)->delete();
        return redirect()->route('beer.manufacturers.index')->with('status', 'Производитель удален!');
    }


}
