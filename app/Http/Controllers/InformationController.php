<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information = Information::find(1);
        return view('back-end.information.index')->with('information', $information);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $this->validate($request, [
            'company_name' => 'required',
            'address' => 'required',
            'logo' => 'image',
            'address_company' => 'required',
            'office' => 'required',
        ], [
            'logo.image' => 'Vui lòng chọn đúng định dạng hình ảnh JPG, PNG, JPEG, GIF.',
            'company_name.required' => 'Vui lòng nhập tiêu đề.',
            'address.required' => 'Vui lòng nhập tiêu đề.',
            'address_company.required' => 'Vui lòng nhập tiêu đề.',
            'office.required' => 'Vui lòng nhập tiêu đề.',
        ]);

        $information = Information::find($id);
        $information->company_name = $request->company_name;
        $information->address = $request->address;
        $information->address_company = $request->address_company;
        $information->office = $request->office;
        $information->video = $request->video;
        if ($request->hasFile('logo')) {
            $fileName = $request->logo->store('public/info');
            $information->logo = Storage::url($fileName);
        }
        $information->save();

        return redirect()->route('information.index')
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
        //
    }
}
