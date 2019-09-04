<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    public function index()
    {
        $search = Input::get('search');
        $order_by = Input::get('order_by');
        $sort_by = Input::get('sort_by');
        $rowsPerPage = Input::get('rowsPerPage');
        $page = Input::get('page');

            $category = Category::orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->with('products');
            

        return $category->orderBy($order_by, $sort_by)->paginate($rowsPerPage);
    }
    public function store(Request $request)
    {
        $cat = new Category;
        $cat->name = $request->name;
        $cat->status = $request->status;
        $cat->save();

        return Category::where('id', $cat->id)->with('products')->first();
    }

    public function update(Request $request, $id)
    {
        $cat = Category::find($id);
        $cat->name = $request->name;
        $cat->status = $request->status;
        $cat->save();

        return Category::where('id', $cat->id)->with('products')->first();
    }

    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();

        return response()->json([
            'message' => 'Successfully Deleted'
        ]);
    }
}
