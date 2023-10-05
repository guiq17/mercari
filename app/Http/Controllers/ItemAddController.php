<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\ItemRequest;

class ItemAddController extends Controller
{
    public function add()
    {
        $firstCategories = Category::where('parent_id', null)->get();
        $secondCategories = Category::where('parent_id', '!=', null)->where('name_all', '=', null)->get();
        $thirdCategories = Category::where('name_all', '!=', null)->get();

        return view('items.add', compact('firstCategories', 'secondCategories', 'thirdCategories'));
    }

    public function create(ItemRequest $request)
    {
        $third_category = $request->input('thirdCategory');

        $item = Item::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_name' => $third_category,
            'brand' => $request->input('brand'),
            'condition_id' => $request->input('condition_id'),
            'description' => $request->input('description'),
            'shipping' => 0
        ]);

        if($item && $third_category){
            $category = Category::where('id', $third_category)->first();
            if($category){
                $item->category()->associate($category);
                $item->save();
            }
        }

        return redirect()->route('item.detail', ['id' => $item->id])->with('success', '商品が登録されました。');
    }
}
