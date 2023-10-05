<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemEditController extends Controller
{
    // 編集ページの表示
    public function edit($itemId)
    {
        $item = Item::find($itemId);

        $categories = [];
        if($item->category){
            $categoryName = $item->category->getCategoriesAttribute();
            $categories[] = [
                'firstCategory' => $categoryName[0],
                'secondCategory' => $categoryName[1],
                'thirdCategory' => $categoryName[2],
            ];
        }

        $firstCategoryId = null;
        $secondCategoryId = null;
        $thirdCategoryId = null;

        foreach($categories as $category){
            $firstCategoryName = $category['firstCategory'];
            $secondCategoryName = $category['secondCategory'];
            $thirdCategoryName = $category['thirdCategory'];

            if(!empty($firstCategoryName)){
                $firstCategoryId = Category::where('name', $firstCategoryName)->value('id');
            }
            if(!empty($secondCategoryName)){
                $secondCategoryId = Category::where('name', $secondCategoryName)->value('id');
            }
            if(!empty($thirdCategoryName)){
                $thirdCategoryId = Category::where('name', $thirdCategoryName)->value('id');
            }
        }

        $firstCategories = Category::where('parent_id', null)->get();
        $secondCategories = Category::where('parent_id', '!=', null)->where('name_all', '=', null)->get();
        $thirdCategories = Category::where('name_all', '!=', null)->get();

        return view('items.edit', compact('item', 'categories', 'firstCategoryId', 'secondCategoryId', 'thirdCategoryId', 'firstCategories', 'secondCategories', 'thirdCategories'));
    }

    public function update(Request $request, $itemId)
    {
        $name = $request->input('name');
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if(!$item){
            return redirect()->route('item.list')->with('error', '商品が見つかりませんでした。');
        }

        $item->delete();

        return redirect()->route('item.list')->with('success', '商品が削除されました。');
    }
}
