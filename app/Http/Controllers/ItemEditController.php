<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\ItemRequest;

class ItemEditController extends Controller
{
    // 編集ページの表示
    public function edit($id)
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

    public function update(ItemRequest $request, $id)
    {
        // フォームデータを取得
        $data = $request->only(['name', 'price', 'thirdCategory', 'brand', 'condition_id', 'description']);
        unset($data['_token']);

        // thirdCAtegoryのidを取得
        $category_id = $data['thirdCategory'];

        // データベースを更新
        $item = Item::find($id);
        $item->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'category_name' => $category_id,
            'brand' => $data['brand'],
            'condition_id' => $data['condition_id'],
            'description' => $data['description'],
        ]);

        // 成功メッセージをフラッシュ
        session()->flash('success', '商品が更新されました。');

        // 編集画面にリダイレクト
        return redirect()->route('item.edit', ['id' => $id]);
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if(!$item){
            return redirect()->route('item.list');
        }
        
        $item->delete();

        return redirect()->route('item.list')->with('success', '商品が削除されました。');
    }
}
