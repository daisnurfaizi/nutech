<?php

namespace App\Http\service;

use App\Http\repository\ItemRepositoryImpl;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ItemService
{
    private $itemRepository;
    public function __construct(ItemRepositoryImpl $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function cretateItem($request)
    {
        // ajax request
        if (!empty($request->barangid)) {
            $rulesupdate = [
                'name' => 'required|unique:items,name,' . $request->barangid,
                'buying_price' => 'required|numeric',
                'selling_price' => 'required|numeric',
                'quantity' => 'required|numeric',
                'picture' => 'mimes:png,jpg|max:100' . $request->barangid,
            ];
            $messageupdate = [
                'name.required' => 'Nama barang is required',
                'name.unique' => 'Nama barang is already taken',
                'buying_price.required' => 'Harga Beli is required',
                'buying_price.numeric' => 'Harga Beli must be numeric',
                'selling_price.required' => 'Harga Jual is required',
                'selling_price.numeric' => 'Harga Jual must be numeric',
                'quantity.required' => 'Stok is required',
                'quantity.numeric' => 'Stok must be a number',
                // 'picture.required' => 'Picture is required',
                'picture.mimes' => 'Picture must be a png,jpg',
                'picture.max' => 'Picture must be less than 100kb',
            ];
            $validationupdate = $this->validationform($request, $rulesupdate, $messageupdate);
            if ($validationupdate->fails()) {
                return redirect()->back()->withErrors($validationupdate)->with('status', $validationupdate->errors());
            }
            $image = $request->file('picture');
            if (!empty($image)) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $request->merge(['picture' => $imageName]);
            } else {
                $imageName = null;
            }

            try {
                DB::beginTransaction();
                $this->itemRepository->Update($request, $imageName);
                DB::commit();
                return redirect()->back()->with('success', 'Data berhasil diubah');
            } catch (\Exception $e) {
                DB::rollBack();
                return $e;
                return response()->json(['message' => 'Item creation failed'], 500);
            }
        }
        $rules = [
            'name' => 'required|unique:items',
            'buying_price' => 'required|numeric',
            'selling_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'picture' => 'required|mimes:png,jpg|max:100',
        ];
        $message = [
            'name.required' => 'Nama barang is required',
            'name.unique' => 'Nama barang is already taken',
            'buying_price.required' => 'Harga Beli is required',
            'buying_price.numeric' => 'Harga Beli must be numeric',
            'selling_price.required' => 'Harga Jual is required',
            'selling_price.numeric' => 'Harga Jual must be numeric',
            'quantity.required' => 'Stok is required',
            'quantity.numeric' => 'Stok must be a number',
            'picture.required' => 'Picture is required',
            'picture.mimes' => 'Picture must be a png,jpg',
            'picture.max' => 'Picture must be less than 100kb',
        ];
        $validasiforminput = $this->validationform($request, $rules, $message);
        if ($validasiforminput->fails()) {
            return redirect()->back()->withErrors($validasiforminput)->withInput();
        }
        $image = $request->file('picture');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $request->merge(['picture' => $imageName]);
        try {
            DB::beginTransaction();
            $this->itemRepository->Insert($request, $imageName);
            DB::commit();
            return redirect()->back()->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
            return response()->json(['message' => 'Item creation failed'], 500);
        }
    }

    // update
    public function updateItem(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'quantity' => 'required',
            'picture' => 'image|mimes:png,jpg|max:100',
        ];
        $message = [
            'name.required' => 'Name is required',
            'buying_price.required' => 'Buying price is required',
            'selling_price.required' => 'Selling price is required',
            'quantity.required' => 'Quantity is required',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $request->merge(['picture' => $imageName]);
        }
        try {
            DB::beginTransaction();
            $this->itemRepository->Update($request->all(), $id);
            DB::commit();
            return response()->json(['message' => 'Item updated successfully'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Item update failed'], 500);
        }
    }

    public function getAllItem()
    {
        return $this->itemRepository->SelectAll();
    }

    public function searchItem($id)
    {
        return json_encode(['items' => $this->itemRepository->Search($id)]);
    }

    public function deleteItem($id)
    {
        try {
            DB::beginTransaction();
            $this->itemRepository->Delete($id);
            DB::commit();
            return redirect()->back()->with('success', 'Item deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Item deletion failed'], 500);
        }
    }

    public function validationform($request, $rules, $message)
    {
        $validator = Validator::make($request->all(), $rules, $message);
        return $validator;
    }
}
