<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemsController extends Controller
{
    // 一覧画面＆検索機能
    public function list(Request $request)
    {
        $keyword = $request->input('keyword');
        $firstCategory = $request->input('firstCategory');
        $secondCategory = $request->input('secondCategory');
        $thirdCategory = $request->input('thirdCategory');
        $brandKeyword = $request->input('brandKeyword');

        $query = Item::query();

        // キーワード検索
        if(!empty($keyword))
        {
            $query->where('name', 'like', '%'.$keyword.'%');
        }

        // カテゴリー検索
        // if(!empty($firstCategory))
        // {
        //     $query->whereHas('category', function($query) use($firstCategory) {
        //         $query->where('name_all', 'like', $firstCategory.'/%');
        //     });
        // }
        // if(!empty($secondCategory))
        // {
        //     $query->whereHas('category', function($query) use($secondCategory) {
        //         $query->where('name_all', 'like', '%/'.$secondCategory.'/%');
        //     });
        // }
        // if(!empty($thirdCategory))
        // {
        //     $query->whereHas('category', function($query) use($thirdCategory) {
        //         $query->where('name_all', 'like', '%/'.$thirdCategory);
        //     });
        // }

        $items = $query->orderBy('id')->paginate(30);
        if($items->count() < 30){
            $items->getCollection()->makeHidden('links'); // これでlinksを非表示にできる
        }

        $categories = [];
        foreach($items as $item) {
            if($item->category){
                $categoryName = $item->category->getCategoriesAttribute();
                $categories[] = [
                    'firstCategory' => $categoryName[0],
                    'secondCategory' => $categoryName[1],
                    'thirdCategory' => $categoryName[2],
                ];
            }
        }

        $firstCategories = Category::where('parent_id', null)->pluck('name');
        $secondCategories = Category::where('parent_id', '!=', null)->where('name_all', '=', null)->pluck('name');
        $thirdCategories = Category::where('name_all', '!=', null)->pluck('name');

        return view('items.list', compact('items', 'categories', 'firstCategories', 'secondCategories', 'thirdCategories', 'keyword', 'firstCategory', 'secondCategory', 'thirdCategory', 'brandKeyword'));
    }

    public function getSecondCategories(Request $request)
    {
        $selectedCategory = $request->input('firstCategory');

        // 選択されたfirstCategoryに紐づくsecondCategoryを取得
        $secondCategories = Category::where('parent_id', $selectedCategory)->pluck('name', 'id');

        // JSON形式でsecondCategoryを返す
        return response()->json($secondCategories);
    }
}
