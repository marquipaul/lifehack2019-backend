<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductController extends Controller
{
    public function index()
    {
        $search = Input::get('search');
        $order_by = Input::get('order_by');
        $sort_by = Input::get('sort_by');
        $rowsPerPage = Input::get('rowsPerPage');
        $page = Input::get('page');

            $products = Product::orWhere('name', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->with('brand', 'category');
            

        return $products->orderBy($order_by, $sort_by)->paginate($rowsPerPage);
    }
    public function store(Request $request)
    {
        $product = new Product;
        $product->user_id = Auth::user()->id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->tax = $request->tax;
        $product->minimum_order = $request->minimum_order;
        $product->status = $request->status;
        $product->save();

        return Product::where('id', $product->id)->with('brand', 'category')->first();
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->user_id = Auth::user()->id;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->unit = $request->unit;
        $product->price = $request->price;
        $product->tax = $request->tax;
        $product->minimum_order = $request->minimum_order;
        $product->status = $request->status;
        $product->save();

        return Product::where('id', $product->id)->with('brand', 'category')->first();
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return response()->json([
            'message' => 'Successfully Deleted'
        ]);
    }
}
