<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::all();
        return view('admin.index')->with('users', $users);
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

    /*
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
    public function edit(User $user)
    {
        if(Gate::denies('manage-users')){
            return redirect(route('admin.users.index'));
        }

        return view('admin.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request,User  $user)
    {

        $this->validate($request,[
            'name' => 'required',
            'email' => 'required'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->roles()->sync($request->input('roles'));
        if($user->save()){
            session()->flash('success', 'Successfully Updated');
        }else{
            session()->flash('error', 'Error Updating');
        }


        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('admin.users.index'));
        }
        //Delete users as well as the role_user record
        $user->roles()->detach();
        if ($user->delete()) {
            session()->flash('success', 'Successfully Deleted');
        } else {
            session()->flash('error', 'Error Deletion');
        }
        return redirect(route('admin.users.index'));
    }
}
