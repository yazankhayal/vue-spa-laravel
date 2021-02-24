<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // all Users
    public function index()
    {
        $Users = User::all()->toArray();
        return array_reverse($Users);
    }

    // edit User
    public function edit($id)
    {
        $User = User::find($id);
        return response()->json($User);
    }

    // update User
    public function update($id, Request $request)
    {
        $edit = $request->id;
        $validation = Validator::make($request->all(), $this->ruls($edit));
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else{
            $User = User::find($id);
            $User->update($request->all());

            return response()->json('The User successfully updated');
        }
    }

    public function ruls($edit){
        return [
            'name' => 'required',
            'email' => 'required|string|email|unique:users,email,' . $edit,
        ];
    }

    // delete User
    public function delete($id)
    {
        $User = User::find($id);
        $User->delete();

        return response()->json('The User successfully deleted');
    }
}
