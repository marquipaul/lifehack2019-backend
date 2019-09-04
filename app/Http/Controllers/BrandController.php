<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Input;

class BrandController extends Controller
{
    public function index()
    {
        $search = Input::get('search');
        $order_by = Input::get('order_by');
        $sort_by = Input::get('sort_by');
        $rowsPerPage = Input::get('rowsPerPage');
        $page = Input::get('page');

            $brands = Brand::orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->with('products');
            

            return $brands->orderBy($order_by, $sort_by)->paginate($rowsPerPage);
    }
    public function store(Request $request)
    {
        $brand = new Brand;
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        return Brand::where('id', $brand->id)->with('products')->first();
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->status = $request->status;
        $brand->save();

        return Brand::where('id', $brand->id)->with('products')->first();
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
