<?php

namespace App\Http\Controllers;

use App\CategoryProduct;
use Illuminate\Http\Request;

class CatProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catProducts = CategoryProduct::orderBy('id', 'DESC')->paginate(5);
        return view('back-end.cat-products.index')->with('catProducts', $catProducts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.cat-products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:category_products,name'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
        ]);

        $catProduct = new CategoryProduct();
        $catProduct->name = $request->name;
        $catProduct->slug = str_slug($request->name);
        $catProduct->sort = $request->sort;
        $catProduct->save();
        return redirect()->route('cat-product.index')
            ->with(['message' => 'Thêm mới thành công.', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catProduct = CategoryProduct::find($id);
        return view('back-end.cat-products.edit')->with('catProduct', $catProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục.',
        ]);

        $catProduct = CategoryProduct::find($id);
        $catProduct->name = $request->name;
        $catProduct->slug = str_slug($request->name);
        $catProduct->sort = $request->sort;
        $catProduct->save();
        return redirect()->route('cat-product.index')
            ->with(['message' => 'Lưu thành công.', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catProduct = CategoryProduct::find($id);
        $catProduct->delete();
        return redirect()->route('cat-product.index')
            ->with(['message' => 'Xóa thành công.', 'alert' => 'success']);
    }
}
