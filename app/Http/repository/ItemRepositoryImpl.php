<?php

namespace App\Http\repository;

use App\Http\interface\Item;
use App\Models\Item as ModelsItem;

class ItemRepositoryImpl implements Item
{
    public function Insert($request, $imagename)
    {

        $item = ModelsItem::create([
            'name' => $request->name,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'picture' => $imagename,
        ]);
        return $item;
    }

    public function Update($request, $imagename)
    {
        $item = ModelsItem::find($request->barangid);
        $item->name = $request->name;
        $item->buying_price = $request->buying_price;
        $item->selling_price = $request->selling_price;
        $item->quantity = $request->quantity;
        if ($imagename != null) {
            $item->picture = $imagename;
        }
        $item->save();
        return $item;
    }
    public function Delete($param)
    {
        $delete = ModelsItem::where('id', $param)->delete();
        return $delete;
    }
    public function SelectAll()
    {
        // paginate all items orderby created at
        $items = ModelsItem::orderBy('created_at', 'desc')->paginate(10);
        // $items = ModelsItem::paginate(10);
        return $items;
    }
    public function SelectById()
    {
        // TODO: Implement SelectById() method.
    }

    public function search($request)
    {
        // search by any field
        $items = ModelsItem::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('buying_price', 'like', '%' . $request->search . '%')
            ->orWhere('selling_price', 'like', '%' . $request->search . '%')
            ->orWhere('quantity', 'like', '%' . $request->search . '%')
            ->orWhere('picture', 'like', '%' . $request->search . '%')
            ->paginate(10);
        return $items;
    }
}
