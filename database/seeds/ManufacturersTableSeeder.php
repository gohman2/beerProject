<?php

use Illuminate\Database\Seeder;

class ManufacturersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manufacturers = [];
        for($i = 1; $i <= 10; $i++){
            $mName = 'Производитель #'.$i;
            $manufacturers[] = [
                'title'     => $mName,
            ];
        }
        \Illuminate\Support\Facades\DB::table('manufacturers')->insert($manufacturers);
    }
}
