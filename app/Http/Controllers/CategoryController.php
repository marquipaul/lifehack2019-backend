<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $cat = new Category;
        $cat->name = $request->name;
        $cat->status = $request->status;
        $cat->save();

        return $cat;
    }

    public function update(Request $request, $id)
    {
        $cat = Category::find($id);
        $cat->name = $request->name;
        $cat->status = $request->status;
        $cat->save();

        return $cat;
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
