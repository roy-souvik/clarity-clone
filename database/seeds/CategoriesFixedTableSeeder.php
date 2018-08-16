<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesFixedTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the root category
        $rootId = DB::table('categories')->insertGetId([
            'name' => 'root',
            'description' => 'this is a root, never show this',
            'slug' => 'root'
        ]);

        $firstLevelCategories = [
            "Business",
            "Sales & Marketing",
            "Funding",
            "Product & Design",
            "Technology",
            "Skills & Management",
            "Industries",
            "Other"
        ];

        $firstLevelBanners = [
            "business.jpg",
            "sales-and-marketing.jpg",
            "funding.jpg",
            "product-and-design.jpg",
            "technology.jpg",
            "skills-and-management.jpg",
            "industries.jpg",
            "others.jpg"
        ];

        // Create a few top level categories
        $topCategoryCount = count($firstLevelCategories);
        $topCategories = factory(App\Category::class, $topCategoryCount)->create();
        $topCategoryIds = $topCategories->lists('id')->toArray();
        for($i = $rootId + 1; $i <= $topCategoryCount + $rootId; $i++) {
            $category = Category::where('id', $i)->get()->first();
            $category->name = $firstLevelCategories[ $i - ($rootId + 1) ];
            $category->banner = $firstLevelBanners[ $i - ($rootId + 1) ];
            $category->parent = $rootId;
            $category->slug = str_slug($firstLevelCategories[ $i - ($rootId + 1) ]);
            $category->save();
        }

        // Create some child level App\Category instances...
        $categoryCount = 30;
        $categories = factory(App\Category::class, $categoryCount)->create();
        $categoryIds = $categories->lists('id')->toArray();
        for($i=0; $i<$categoryCount; $i++) {
            $randomizedTopCategoryIds = $topCategoryIds;
            shuffle($randomizedTopCategoryIds);
            for($j=0; $j<$topCategoryCount; $j++){
                $subcategory = Category::where('id', $categoryIds[$i])->get()->first();
                $subcategory->parent = $randomizedTopCategoryIds[$j];
                $subcategory->slug = str_slug($subcategory->name);
                $subcategory->save();
            }

        }
        print_r('Category table seeded' . PHP_EOL);
    }
}
