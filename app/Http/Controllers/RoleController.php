<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\QueryException;
use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Http\Requests\AdminRoleRequest;
use App\Http\Requests\AdminRoleDeleteRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleRepository $roleRepository
     *
     * @return View
     */
    public function index( RoleRepository $roleRepository ): View
    {
        $roles = $roleRepository->getAll();

        return view( "directories.simple", [
            "data" => $roles,
            "directoryName" => "Роли",
            "baseUrl" => url( "/roles" )
        ] );
    }

    public function store( AdminRoleRequest $request ){
        $position = new Role();
        $position->fill( $request->all() )->save();

        return $position->id;
    }

    public function update( AdminRoleRequest $request, Role $role){
        $role->fill( $request->all() )->save();
    }

    public function delete( AdminRoleDeleteRequest $request, Role $role ){
        try {
            $role->delete();
        }catch (QueryException $exception){
            return response(
                "Cannot delete or update a parent row: a foreign key constraint fails.",
                400);
        }
    }
}
