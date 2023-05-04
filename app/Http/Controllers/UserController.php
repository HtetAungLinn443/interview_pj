<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;

class UserController extends Controller
{
    public function homePage()
    {
        $item = Item::get();
        $categories = Category::get();
        return view('user.home.homePage', compact('item', 'categories'));
    }

    public function itemDetails($id)
    {
        $item = Item::findOrFail($id);
        return view('user.home.itemDetails', compact('item'));
    }
}