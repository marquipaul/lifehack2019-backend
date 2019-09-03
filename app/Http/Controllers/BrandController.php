<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        return $brand;
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        return $brand;
    }

    public function destroy($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return response()->json([
            'message' => 'Successfully Deleted'
        ]);
    }
}
