<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beer extends Model
{
    protected $fillable = [ 'title', 'description' ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function typeBeer()
    {
        return $this->belongsTo(TypeBeer::class, 'type_id');
    }

    public function setManufacturer($id)
    {
        if($id == null) {return;}
        $this->manufacturer_id = $id;
        $this->save();
    }

    public function setTypeBeer($id)
    {
        if($id == null) {return;}
        $this->type_id = $id;
        $this->save();
    }

    public function getManufacturerTitle()
    {
        return ($this->manufacturer != null)
            ?   $this->manufacturer->title
            :   'Нет производителя';
    }

    public function getTypeBeerTitle()
    {
        return ($this->typeBeer != null)
            ?   $this->typeBeer->title
            :   'Тип не выбран';
    }

    public static function add($fields)
    {
        $beer = new static;
        $beer->fill($fields);
        $beer->save();

        return $beer;
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->save();
    }
}
