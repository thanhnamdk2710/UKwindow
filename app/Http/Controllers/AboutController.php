<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::orderBy('id', 'DESC')->paginate(5);
        return view('back-end.abouts.index')->with('abouts', $abouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.abouts.create');
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
            'title' => 'required|unique:abouts,title',
            'body' => 'required',
        ], [
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $about = new About();
        $about->title = $request->title;
        $about->body = $request->body;
        $about->location = $request->location;
        $about->save();

        return redirect()->route('about.index')
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
        $about = About::find($id);
        return view('back-end.abouts.edit')->with('about', $about);
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
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $about = About::find($id);
        $about->title = $request->title;
        $about->body = $request->body;
        $about->location = $request->location;
        $about->save();

        return redirect()->route('about.index')
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
        $about = About::find($id);
        $about->delete();

        return redirect()->route('about.index')
            ->with(['message' => 'Xóa thành công.', 'alert' => 'success']);
    }
}
