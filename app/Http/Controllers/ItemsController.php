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
        $selectedFirstCategory = $request->input('firstCategory');
        $selectedSecondCategory = $request->input('secondCategory');
        $selectedThirdCategory = $request->input('thirdCategory');
        $brandKeyword = $request->input('brandKeyword');

        $query = Item::query();

        // キーワード検索(条件をクエリに適用)
        if(!empty($keyword))
        {
            $query->where('name', 'like', '%'.$keyword.'%');
        }
        if(!empty($brandKeyword))
        {
            $query->where('brand', 'like', '%'.$brandKeyword.'%');
        }

        // カテゴリー検索
        if(!empty($selectedFirstCategory))
        {
            $firstCategoryName = Category::where('id', $selectedFirstCategory)->value('name');
            $query->whereHas('category', function($query) use($firstCategoryName) {
                $query->whereRaw("split_part(name_all, '/', 1) = ?", [$firstCategoryName]);
            });
        }
        if(!empty($selectedSecondCategory))
        {
            $secondCategoryName = Category::where('id', $selectedSecondCategory)->value('name');
            $query->whereHas('category', function($query) use($secondCategoryName) {
                $query->whereRaw("split_part(name_all, '/', 2) = ?", [$secondCategoryName]);
            });
        }
        if(!empty($selectedThirdCategory))
        {
            $thirdCategoryName = Category::where('id', $selectedThirdCategory)->value('name');
            $query->whereHas('category', function($query) use($thirdCategoryName) {
                $query->whereRaw("split_part(name_all, '/', 3) = ?", [$thirdCategoryName]);
            });
        }

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

        $firstCategories = Category::where('parent_id', null)->get();
        $secondCategories = Category::where('parent_id', '!=', null)->where('name_all', '=', null)->get();
        $thirdCategories = Category::where('name_all', '!=', null)->get();

        return view('items.list', compact('items', 'categories', 'firstCategories', 'secondCategories', 'thirdCategories', 'keyword', 'selectedFirstCategory', 'selectedSecondCategory', 'selectedThirdCategory', 'brandKeyword'));
    }

    // 商品詳細画面表示
    public function detail($id)
    {
        $item = Item::find($id);

        $categories = [];
        if($item->category){
            $categoryName = $item->category->getCategoriesAttribute();
            $categories[] = [
                'firstCategory' => $categoryName[0],
                'secondCategory' => $categoryName[1],
                'thirdCategory' => $categoryName[2],
            ];
        }

        $pageNumber = request('page');

        // 前のページのurlをセッションに保存
        session()->put('previous_page', url()->previous());

        return view('items.detail', compact('item', 'categories', 'pageNumber'));
    }
}
