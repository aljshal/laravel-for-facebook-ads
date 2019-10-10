<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * User 값 얻기
     * @param $id
     * @return user
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * User 생성
     * @param Request $request
     * @return User
     */
    public function store(Request $request)
    {
        $email = $request->input('email');
        $user = User::where('email', '=', $email)->get();
        if($user->isEmpty())
        {
            $user = new User;
            $input = $request->all();
            $user->fill($input)->save();
            $user->save();
        }
        else
        {
            echo 'Already exist';
        }
        return $user;
    }

    /**
     * User 업데이트
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $input = $request->all();
        $user->fill($input)->save();
        return $user;
    }
}
