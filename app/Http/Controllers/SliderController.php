<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use Illuminate\Http\Request;
use App\Sliders;
use Illuminate\Support\Facades\Storage;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Sliders::orderBy('id', 'DESC')->paginate(4);
        return view('back-end.sliders.index')->with('sliders', $sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        $slider = new Sliders();
        if ($request->hasFile('image')) {
            $fileName = $request->image->store('public/sliders');
            $slider->path = Storage::url($fileName);
        }
        $slider->title = $request->title;
        if ($request->link != '') {
            $slider->link = $request->link;
        }
        $slider->status = 0;
        $slider->save();
        return redirect()->route('slider.index')
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
        $slider = Sliders::find($id);
        return view('back-end.sliders.edit')->with('slider', $slider);
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
        $slider = Sliders::find($id);
        if ($request->hasFile('image')) {
            $fileSlider = substr($slider->path, 1);
            if (File::exists($fileSlider)) {
                File::delete($fileSlider);
            }
            $fileName = $request->image->store('public/sliders');
            $slider->path = Storage::url($fileName);
        }
        $slider->title = $request->title;
        if ($request->link != '') {
            $slider->link = $request->link;
        }
        $slider->status = 0;
        $slider->save();
        return redirect()->route('slider.index')
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
        $slider = Sliders::find($id);
        if ($slider->status == 1) {
            $slider->status = 0;
            $slider->save();
            return redirect()->route('slider.index')
                ->with(['message' => 'Ẩn banner', 'alert' => 'success']);
        } else {
            $slider->status = 1;
            $slider->save();
            return redirect()->route('slider.index')
                ->with(['message' => 'Hiện banner', 'alert' => 'success']);
        }
    }
}
