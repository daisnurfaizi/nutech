<?php

namespace App\Http\Controllers;

use App\Http\repository\ItemRepositoryImpl;
use App\Http\service\ItemService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('items.index2', [
            'items' => $this->getAll()
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        // ajax request
        $itemRepository = new ItemRepositoryImpl();
        $itemService = new ItemService($itemRepository);
        return $itemService->cretateItem($request);
    }

    public function getAll()
    {
        $itemRepository = new ItemRepositoryImpl();
        $itemService = new ItemService($itemRepository);
        return $itemService->getAllItem();
    }

    public function search(Request $request)
    {
        // dd($request);
        $itemRepository = new ItemRepositoryImpl();
        $itemService = new ItemService($itemRepository);
        return $itemService->searchItem($request);
    }

    public function destroy($data)
    {
        $itemRepository = new ItemRepositoryImpl();
        $itemService = new ItemService($itemRepository);
        return $itemService->deleteItem($data);
    }
}
