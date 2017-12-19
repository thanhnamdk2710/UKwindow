<?php

namespace App\Http\Controllers;

use App\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use File;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('id', 'DESC')->paginate(10);
        return view('back-end.news.index')->with('news', $news);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.news.create');
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
            'title' => 'required|unique:news,title',
            'body' => 'required',
        ], [
            'image.required' => 'Vui lòng chọn hình ảnh.',
            'image.image' => 'Vui lòng chọn đúng định dạng hình ảnh JPG, PNG, JPEG, GIF.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $news = new News();
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        if ($request->hasFile('image')) {
            $fileName = $request->image->store('public/news');
            $news->image = Storage::url($fileName);
        }
        $news->body = $request->body;
        $news->save();

        return redirect()->route('news.index')
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
        $news = News::find($id);
        return view('back-end.news.show')->with('news', $news);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        return view('back-end.news.edit')->with('news', $news);
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
            'image' => 'image',
            'title' => 'required',
            'body' => 'required',
        ], [
            'image.image' => 'Vui lòng chọn đúng định dạng hình ảnh JPG, PNG, JPEG, GIF.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $news = News::find($id);
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        if ($request->hasFile('image')) {
            $fileProduct = substr($news->image, 1);
            if (File::exists($fileProduct)){
                File::delete($fileProduct);
            }
            $fileName = $request->image->store('public/news');
            $news->image = Storage::url($fileName);
        }
        $news->body = $request->body;
        $news->save();

        return redirect()->route('news.index')
            ->with(['message', 'Thêm mới thành công', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = News::find($id);

        $fileProduct = substr($news->image, 1);
        if (File::exists($fileProduct)){
            File::delete($fileProduct);
        }
        $news->delete();

        return redirect()->route('news.index')
            ->with(['message', 'Xóa thành công', 'alert' => 'success']);
    }
}
