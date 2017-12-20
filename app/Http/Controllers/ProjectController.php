<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'DESC')->paginate(10);
        return view('back-end.projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.projects.create');
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

        $project = new Project();
        $project->title = $request->title;
        $project->slug = str_slug($request->title);
        if ($request->hasFile('image')) {
            $fileName = $request->image->store('public/news');
            $project->image = Storage::url($fileName);
        }
        $project->body = $request->body;
        $project->save();

        return redirect()->route('project.index')
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
        $project = Project::find($id);
        return view('back-end.projects.edit')->with('project', $project);
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

        $project = Project::find($id);
        $project->title = $request->title;
        $project->slug = str_slug($request->title);
        if ($request->hasFile('image')) {
            $fileProduct = substr($project->image, 1);
            if (File::exists($fileProduct)) {
                File::delete($fileProduct);
            }
            $fileName = $request->image->store('public/news');
            $project->image = Storage::url($fileName);
        }
        $project->body = $request->body;
        $project->save();

        return redirect()->route('project.index')
            ->with(['message' => 'Thêm mới thành công', 'alert' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);

        $fileProduct = substr($project->image, 1);
        if (File::exists($fileProduct)) {
            File::delete($fileProduct);
        }
        $project->delete();

        return redirect()->route('project.index')
            ->with(['message' => 'Xóa thành công', 'alert' => 'success']);
    }
}
