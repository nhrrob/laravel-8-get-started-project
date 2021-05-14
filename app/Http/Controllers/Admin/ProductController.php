<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        //permission group = product (e.x. product list, product edit)
        parent::__construct('product'); 
    }
    
    public function index()
    {
        $data['products'] = Product::latest()->get();
        return view('admin.product.index', $data);
    }

    public function create()
    {
        return view('admin.product.create');
    }

    public function store(ProductRequest $request)
    {
        try{
            $product = Product::create($request->all());

            $notification = array(
                'message' => 'Product saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.products.index')->with($notification);

        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            return redirect()->route('admin.products.index')->with($notification);
        }
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $data['product'] = $product;
        return view('admin.product.edit', $data);
    }

    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $product->update($request->all());

            $notification = array(
                'message' => 'Product saved successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.products.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.products.index')->with($notification);
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

            return redirect()->route('admin.products.index')->with($notification);
        } catch (Exception $e) {
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->route('admin.products.index')->with($notification);
        }
    }
}
