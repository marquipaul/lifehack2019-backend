<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;

class ProductController extends Controller
{
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

        return $product;
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

        return $product;
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
