<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserDeleteRequest;
use App\Http\Requests\AdminUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index( UserRepository $userRepository): View
    {
        $users = $userRepository->getAll();
        $roles = Role::all();

        return view( "directories.users", [
            "users" => $users,
            "roles" => $roles,
            "directoryName" => "Пользователи",
            "baseUrl" => url( "/users" )
        ] );
    }

    public function edit(Request $request, User $user){
        $roles = Role::all();
        return view( "user_edit", [
            "user" => $user,
            "roles" => $roles,
            "directoryName" => $user->name,
            "isNew" => false
        ] );
    }

    public function create(Request $request, User $user){
        $roles = Role::all();
        return view( "user_edit", [
            "user" => $user,
            "roles" => $roles,
            "directoryName" => "Создание нового пользователя",
            "isNew" => true
        ] );
    }

    public function store( AdminUserRequest $request ){
        $user = new User();

        $user->fill( $request->all() )->save();

        return redirect("users");
    }

    public function update( AdminUserRequest $request, User $user){
        $data = $request->all();
        if(is_null($data['password'])){
            unset($data['password']);
        }else{
            $data['password'] = bcrypt($data['password']);
        }
        $user->fill( $data )->save();
        return redirect("users");
    }

    public function delete( AdminUserDeleteRequest $request, User $user ){
        $user->delete();
        return redirect("users");
    }
}
