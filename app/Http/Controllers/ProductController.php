<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use App\Http\Requests\ProductRequest;
use App\Product;
use File;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('back-end.products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catProducts = CategoryProduct::all();
        return view('back-end.products.create')->with('catProducts', $catProducts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->product_code = $request->product_code;
        if ($request->hasFile('image')) {
            $fileName = $request->image->store('public/products');
            $product->image = Storage::url($fileName);
        }
        $product->price = $request->price;
        $product->material = $request->material;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('product.index')
            ->with(['message' => 'Thêm mới thành công', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $catProducts = CategoryProduct::all();
        return view('back-end.products.show')
            ->with(['catProducts' => $catProducts, 'product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $catProducts = CategoryProduct::all();
        return view('back-end.products.edit')
            ->with(['catProducts' => $catProducts, 'product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = str_slug($request->name);
        $product->product_code = $request->product_code;
        if ($request->hasFile('image')) {
            $fileProduct = substr($product->image, 1);
            if (File::exists($fileProduct)) {
                File::delete($fileProduct);
            }
            $fileName = $request->image->store('public/products');
            $product->image = Storage::url($fileName);
        }
        $product->price = $request->price;
        $product->material = $request->material;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('product.index')
            ->with(['message' => 'Lưu thành công', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $fileProduct = substr($product->image, 1);
        if (File::exists($fileProduct)) {
            File::delete($fileProduct);
        }
        $product->delete();

        return redirect()->route('product.index')
            ->with(['message' => 'Xóa thành công', 'alert' => 'success']);
    }
}
