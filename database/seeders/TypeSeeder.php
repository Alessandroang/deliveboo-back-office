<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $_types = ['Italiano', 'Cinese', 'Giapponese', 'Messicano', 'Indiano', 'Pesce', 'Carne', 'Pizza'];

        foreach ($_types as $_type) {
            $type = new Type();
            $type->name = $_type;
            $type->description = $faker->sentence;

            $type->save();
        }
    }
}
