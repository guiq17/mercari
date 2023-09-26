<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemsController extends Controller
{
    public function list()
    {
        $items = Item::orderBy('id')->paginate(30);
        $categories = [];

        foreach($items as $item) {
            $categoryName = $item->category->getCategoriesAttribute();
            $categories[] = [
                'firstCategory' => $categoryName[0],
                'secondCategory' => $categoryName[1],
                'thirdCategory' => $categoryName[2],
            ];
        }
        return view('items.list', compact('items', 'categories'));
    }
}
