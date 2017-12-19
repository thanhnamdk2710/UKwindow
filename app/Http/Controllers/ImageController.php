<?php

namespace App\Http\Controllers;

use App\CategoryImage;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catImages = CategoryImage::all();
        $images = Image::orderBy('id', 'DESC')->get();
        return view('back-end.image.index')->with(['images' => $images, 'catImages' => $catImages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $catImages = CategoryImage::all();
        return view('back-end.image.create')->with('catImages', $catImages);
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
            'image' => 'required|image',
            'title' => 'required'
        ], [
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'Vui lòng chọn đúng định dạng hình ảnh JPG, PNG, JPEG, GIF.',
            'title.required' => 'Vui lòng nhập tên thư mục.',
        ]);

        $image = new Image();
        $image->title = $request->title;
        if ($request->hasFile('image')) {
            $fileName = $request->image->store('public/images');
            $image->path = Storage::url($fileName);
        }
        $image->category_id = $request->category_id;
        $image->save();

        return redirect()->route('image.index')
            ->with(['message', 'Thêm mới thành công', 'alert' => 'success']);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        $fileProduct = substr($image->path, 1);
        if (File::exists($fileProduct)){
            File::delete($fileProduct);
        }
        $image->delete();

        return redirect()->route('image.index')
            ->with(['message', 'Xóa thành công', 'alert' => 'success']);
    }
}
