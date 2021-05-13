<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function index()
    {
        $data['products'] = Product::latest()->get();
        return view('product.index', $data);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());

            $notification = array(
                'message' => 'Product saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('products.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('products.index')->with($notification);
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $data['product'] = $product;
        return view('product.edit', $data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $product->update($request->all());

            $notification = array(
                'message' => 'Product saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('products.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('products.index')->with($notification);
        }
    }

    public function destroy(Product $product)
    {
        try{
            Product::find($product->id)->delete();

            $notification = array(
                'message' => 'Product deleted successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('products.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('products.index')->with($notification);
        }
    }
}
