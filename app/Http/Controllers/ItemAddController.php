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
        // フォームデータからカテゴリー選択値を取得
        $first_category = $request->input('first_category');
        $second_category = $request->input('second_category');
        $third_category = $request->input('third_category');

        // カテゴリー選択値を「/」で結合
        $category_name = $first_category. '/'. $second_category. '/'. $third_category;

        // カテゴリー名に一致するカテゴリーidを取得
        $categoryId = Category::where('name_all', $category_name)->value('id');

        Item::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'category_name' => $categoryId,
            'brand' => $request->input('brand'),
            'condition_id' => $request->input('condition_id'),
            'description' => $request->input('description'),
            'shipping' => 0
        ]);

        return redirect()->route('items.detail', ['id' => $item->id])->with('success', '商品が登録されました。');
    }
}
