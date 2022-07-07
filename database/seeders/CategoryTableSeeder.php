<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Phones', 'Laptops', 'Cameras', 'Printers', 'Computer Components'];
        $images = ['categories.jpg', 'laptops.jpg', 'avds_large.jpg', 'printers.jpg', 'сomputer-сomponents.jpg'];
        for ($i = 1; $i < 6; $i++)
            DB::table('categories')->insert([
                'title' => $categories[$i-1],
                'description' => "<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br\>".$i."</p>",
                'image' => $images[$i-1],
                'alias' => strtolower(preg_replace('/\s/','-',$categories[$i-1])),
            ]);
    }
}
