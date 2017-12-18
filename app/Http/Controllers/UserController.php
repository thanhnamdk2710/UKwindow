<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('back-end.users.index')->with(['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->role = $request->role;
        $user->status = 1;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.index')
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
        $user = User::find($id);
        return view('back-end.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->fullname = $request->fullname;
        $user->role = $request->role;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('user.index')
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
        $user = User::find($id);
        if ($user->status == true){
            $user->status = false;
            $user->save();
            return redirect()->route('user.index')
                ->with(['message'=>'Khóa tài khoản thành công', 'alert'=>'success']);
        } else {
            $user->status = true;
            $user->save();
            return redirect()->route('user.index')
                ->with(['message'=>'Mở khóa tài khoản thành công', 'alert'=>'success']);
        }
    }
}
