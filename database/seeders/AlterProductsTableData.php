<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class AlterProductsTableData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::all();
        foreach ($products as $product) {
            $category_id = rand(1, 5);
            DB::table('products')
                ->where('id', $product['id'])
                ->update([
                        'category_id' => $category_id,
                    ]
                );
        }

    }
}
