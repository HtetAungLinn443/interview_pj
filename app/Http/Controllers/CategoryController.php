<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStore;
use App\Http\Requests\CategoryUpdate;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    // category List Page
    public function categoryList()
    {

        return view('admin.categoryList');

    }

    // datatable ajax
    public function categoryDatatable()
    {
        $categories = Category::query();

        return DataTables::of($categories)
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = "";

                $edit_icon = '<a href="' . route('admin#categoryEdit', $each->id) . '" class="text-success"><i class="fas fa-edit"> </i> </a>';
                $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fa fa-trash-alt"> </i> </a>';

                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';

            })
            ->addIndexColumn()
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
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->rawColumns(['action', 'publish'])
            ->make(true);
    }
    // category Create Page
    public function categoryCreate()
    {
        return view('admin.categoryCreate');
    }

    // category Store
    public function categoryStore(CategoryStore $request)
    {

        $data = [
            'name' => $request->categoryName,
            'publish' => $request->publish,

        ];

        if ($request->hasFile('image')) {
            $category_image_file = $request->file('image');
            $category_image_name = uniqid() . $category_image_file->getClientOriginalName();

            Storage::disk('public')->put('category/' . $category_image_name, file_get_contents($category_image_file));
            $data['image'] = $category_image_name;
        }
        Category::create($data);
        return redirect()->route('admin#categoryList')->with(['createSuccess' => 'Category Successfully create']);

    }

    public function categoryEdit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categoryEdit', compact('category'));
    }

    public function categoryUpdate($id, CategoryUpdate $request)
    {

        $data = [
            'name' => $request->categoryName,
            'publish' => $request->publish,
        ];
        $category = Category::findOrFail($id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete('category/' . $category->image);

            $category_image_file = $request->file('image');
            $category_image_name = uniqid() . $category_image_file->getClientOriginalName();
            Storage::disk('public')->put('category/' . $category_image_name, file_get_contents($category_image_file));
            $data['image'] = $category_image_name;

        }
        $category->update($data);

        return redirect()->route('admin#categoryList')->with(['createSuccess' => 'Category Successfully Update']);

    }

    // categort Detele
    public function categortDetele($id)
    {
        Category::where('id', $id)->delete();
        return 'success';
    }
}
