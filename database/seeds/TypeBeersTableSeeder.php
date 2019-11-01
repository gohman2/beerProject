<?php

use Illuminate\Database\Seeder;

class TypeBeersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typeBeers[] = ['title' => 'Светлое'];
        $typeBeers[] = ['title' => 'Темное'];
        $typeBeers[] = ['title' => 'Полутемное'];
        \Illuminate\Support\Facades\DB::table('type_beers')->insert($typeBeers);
    }
}
