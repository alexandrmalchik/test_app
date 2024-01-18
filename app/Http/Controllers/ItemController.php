<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class ItemController extends Controller
{
    public function index()
    {
        if ($items = Redis::get('items.all')) {
            return json_decode($items);
        }
        $items = Item::paginate(5)->toArray();
        Redis::set('items.all', json_encode($items));

        return $items;
    }
}
