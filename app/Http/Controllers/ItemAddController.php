<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemAddController extends Controller
{
    public function add()
    {
        $firstCategories = Category::where('parent_id', null)->get();
        $secondCategories = Category::where('parent_id', '!=', null)->where('name_all', '=', null)->get();
        $thirdCategories = Category::where('name_all', '!=', null)->get();

        return view('items.add', compact('firstCategories', 'secondCategories', 'thirdCategories'));
    }
}
