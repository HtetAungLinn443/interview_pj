<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStore;
use App\Http\Requests\ItemUpdate;
use App\Models\Category;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class ItemController extends Controller
{
    public function itemList()
    {

        return view('admin.itemList');
    }

    public function itemDatatable()
    {
        $items = Item::query();

        return DataTables::of($items)
            ->addIndexColumn()
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = "";

                $edit_icon = '<a href="' . route('admin#itemEdit', $each->id) . '" class="text-success"><i class="fas fa-edit"> </i> </a>';
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fa fa-trash-alt"> </i> </a>';
                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->editColumn('category', function ($each) {
                return $each->category ? $each->category->name : '';
            })
            ->editColumn('price', function ($each) {
                return '$ ' . $each->price;
            })
            ->editColumn('publish', function ($each) {

                if ($each->publish == null) {
                    return '<div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" />
                                </div>';
                } else {
                    return '<div class="form-check form-switch d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" role="switch" checked />
                                </div>';
                }
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })

            ->rawColumns(['action', 'publish', 'description'])
            ->make(true);
    }

    public function itemCreate()
    {
        $categories = Category::get();
        return view('admin.itemCreate', compact('categories'));
    }

    public function itemStore(ItemStore $request)
    {

        $image_names = null;
        if ($request->hasFile('images')) {
            $image_names = [];
            $images_file = $request->file('images');
            foreach ($images_file as $image_file) {
                $file = file($image_file);
                $image_name = uniqid() . '-' . time() . '.' . $image_file->getClientOriginalExtension();
                Storage::disk('public')->put('item/' . $image_name, file_get_contents($image_file));
                $image_names[] = $image_name;
            }

        }

        $data = [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'type' => $request->type,
            'publish' => $request->publish,
            'owner_name' => $request->ownerName,
            'contact_number' => $request->contactNumber,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $image_names,

        ];

        Item::create($data);
        return redirect()->route('admin#itemList')->with(['createSuccess' => 'Item Successfully Create']);
    }

    // item Edit Page
    public function itemEdit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::get();
        return view('admin.itemEdit', compact('item', 'categories'));
    }
    // Item Update
    public function itemUpdate($id, ItemUpdate $request)
    {
        $item = Item::findOrFail($id);
        $image_names = $item->image;
        if ($request->hasFile('images')) {
            $image_names = [];
            $images_file = $request->file('images');
            foreach ($images_file as $image_file) {
                $file = file($image_file);
                $image_name = uniqid() . '-' . time() . '.' . $image_file->getClientOriginalExtension();
                Storage::disk('public')->put('item/' . $image_name, file_get_contents($image_file));
                $image_names[] = $image_name;
            }

        }

        $data = [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'condition' => $request->condition,
            'type' => $request->type,
            'publish' => $request->publish,
            'owner_name' => $request->ownerName,
            'contact_number' => $request->contactNumber,
            'address' => $request->address,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'image' => $image_names,
        ];
        $item->update($data);
        return redirect()->route('admin#itemList')->with(['createSuccess' => 'Item Successfully Update']);

    }
    // item Detele
    public function itemDetele($id)
    {
        Item::where('id', $id)->delete();
        return 'success';
    }
}
