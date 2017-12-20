<?php

namespace App\Http\Controllers;

use App\Factory;
use Illuminate\Http\Request;

class FactoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $factories = Factory::orderBy('id', 'DESC')->paginate(5);
        return view('back-end.factories.index')->with('factories', $factories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.factories.create');
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
            'title' => 'required|unique:abouts,title',
            'body' => 'required',
        ], [
            'title.unique' => 'Tiêu đề đã tồn tại.',
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $factory = new Factory();
        $factory->title = $request->title;
        $factory->body = $request->body;
        $factory->save();

        return redirect()->route('factory.index')
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
        $factory = Factory::find($id);
        return view('back-end.factories.edit')->with('factory', $factory);
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
            'title' => 'required',
            'body' => 'required',
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề.',
            'body.required' => 'Vui lòng nhập nội dung.',
        ]);

        $factory = Factory::find($id);
        $factory->title = $request->title;
        $factory->body = $request->body;
        $factory->save();

        return redirect()->route('factory.index')
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
        $factory = Factory::find($id);
        $factory->delete();

        return redirect()->route('factory.index')
            ->with(['message' => 'Xóa thành công.', 'alert' => 'success']);
    }
}
