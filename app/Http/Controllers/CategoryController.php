<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getSecondCategories(Request $request)
    {
        $selectedCategory = $request->input('firstCategory');

        // 選択されたfirstCategoryに紐づくsecondCategoryを連想配列で取得
        $secondCategories = Category::where('parent_id', $selectedCategory)->get(['id', 'name'])->toArray();
        // 同時にfirstCategoryに紐づくthirdCategoryを取得
        $firstCategoryName = Category::where('id', $selectedCategory)->value('name');
        $thirdCategories = Category::whereNotNull('name_all')->where(function ($query) use ($firstCategoryName) {
            $query->whereRaw("split_part(name_all, '/', 1) = ?", [$firstCategoryName]);
        })->get(['id', 'name']);

        return response()->json([
            'secondCategories' => $secondCategories,
            'thirdCategories' => $thirdCategories,
        ]);
    }

    public function getThirdCategories(Request $request)
    {
        $selectedCategory = $request->input('secondCategory');

        // 選択されたsecondCategoryに紐づくthirdCategoryを連想配列で取得
        $thirdCategories = Category::where('parent_id', $selectedCategory)->get(['id', 'name'])->toArray();

        return response()->json([
            'thirdCategories' => $thirdCategories,
        ]);
    }
}
