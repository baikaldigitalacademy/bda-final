<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserDeleteRequest;
use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class UserController extends Controller
{
    public function index( UserRepository $userRepository ): View
    {
        $users = $userRepository->getAll();

        return view( "users.index", [ "users" => $users ] );
    }

    public function edit( Request $request, User $user, RoleRepository $roleRepository ){
        $roles = $roleRepository->getAll();

        return view( "users.edit", [
            "user" => $user,
            "roles" => $roles,
            "isNew" => false
        ] );
    }

    public function create( Request $request, User $user, RoleRepository $roleRepository ){
        $roles = $roleRepository->getAll();

        return view( "users.edit", [
            "user" => $user,
            "roles" => $roles,
            "isNew" => true
        ] );
    }

    public function store( AdminUserStoreRequest $request ){
        $userData = $request->all();
        $user = new User();

        $userData[ "password" ] = bcrypt( $userData[ "password" ] );
        $user->fill( $userData )->save();

        return redirect( "users" );
    }

    public function update( AdminUserUpdateRequest $request, User $user ){
        $user->fill( $request->all() )->save();

        return redirect( "users" );
    }

    public function destroy( AdminUserDeleteRequest $request, User $user ){
        // TODO if throw query exception ? (try ... catch)
        $user->delete();

        return redirect( "users" );
    }
}
