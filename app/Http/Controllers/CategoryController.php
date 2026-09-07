<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function allCategories()
    {
        try {
            $categories = Category::select(['id', 'name', 'description', 'image_path'])->get();
            return $this->jsonResponse($categories, 200);
        } catch (\Exception $e) {
            return $this->jsonResponse('There was an error retrieving categories', 500);
        }
    }



    // get the categories ID and number of questions


    public function store(Request $request)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $category)
    {
        //
    }
}
