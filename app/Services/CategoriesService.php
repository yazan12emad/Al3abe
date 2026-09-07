<?php

namespace App\Services;

use App\Models\Category;

class CategoriesService
{
    public function __construct()
    {
    }

    public function getSelectedCategories(array $categoriesIds){
         return Category::select(['id', 'name', 'description', 'image_path'])
            ->whereIn('id', $categoriesIds)
             ->get();

    }

}
