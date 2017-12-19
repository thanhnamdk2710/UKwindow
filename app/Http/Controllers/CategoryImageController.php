<?php

namespace App\Http\Controllers;

use App\CategoryImage;
use Illuminate\Http\Request;

class CategoryImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catImages = CategoryImage::paginate(5);
        return view('back-end.cat-image.index')->with('catImages', $catImages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.cat-image.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:category_images,name'
        ], [
            'name.required' => 'Vui lòng nhập tên thư mục.',
            'name.unique' => 'Tên thư mục đã tồn tại.',
        ]);

        $catImage = new CategoryImage();
        $catImage->name = $request->name;
        $catImage->slug = str_slug($request->name);
        $catImage->save();

        return redirect()->route('cat-image.index')
            ->with(['message' => 'Thêm mới thành công.', 'alert' => 'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $catImage = CategoryImage::find($id);
        return view('back-end.cat-image.edit')->with('catImage', $catImage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập tên thư mục.',
        ]);

        $catImage = CategoryImage::find($id);
        $catImage->name = $request->name;
        $catImage->slug = str_slug($request->name);
        $catImage->save();

        return redirect()->route('cat-image.index')
            ->with(['message' => 'Lưu thành công.', 'alert' => 'success']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $catImage = CategoryImage::find($id);
        $catImage->delete();

        return redirect()->route('cat-image.index')
            ->with(['message' => 'Xóa thành công.', 'alert' => 'success']);
    }
}
