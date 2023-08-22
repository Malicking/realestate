<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use App\Exports\PermissionExport;
use App\Imports\PermissionImport;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\User;

class RoleController extends Controller
{
    // ******************************* Les Privilèges *******************************
    public function allPermission () {
        $permissions = Permission::all();
        return view('backend.pages.permissions.permission_all', compact('permissions'));
    } // fin de la fonction


    public function addPermission () {
        return view('backend.pages.permissions.permission_add');
    } // fin de la fonction


    public function storePermission (Request $request) {

        $permission = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notif = array('message' => 'Permission créée avec succès.', 'alert-type' => 'success');

        return redirect()->route('permission.all')->with($notif);

    } // fin de la fonction


    public function editPermission ($id) {
        $permission = Permission::find($id);
        return view('backend.pages.permissions.permission_edit', compact('permission'));
    } // fin de la fonction


    public function updatePermission (Request $request) {

        $perm_id = $request->id;

        $permission = Permission::findOrFail($perm_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'updated_at' => Carbon::now(),
        ]);

        $notif = array(
            'message' => 'Permission actualisée avec succès.', 
            'alert-type' => 'success'
        );

        return redirect()->route('permission.all')->with($notif);

    } // fin de la fonction


    public function deletePermission ($id) {
        
        Permission::findOrFail($id)->delete();

        $notif = array(
            'message' => 'Permission supprimée avec succès.', 
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction 


    public function importPermission () {
        return view('backend.pages.permissions.permission_import');
    } // fin de la fonction  


    public function exportPermission () {
        return Excel::download(new PermissionExport, 'permissions.xlsx');
    } // fin de la fonction  


    public function importPermissionSave (Request $request) {
        
        Excel::import(new PermissionImport, $request->file('import_file'));

        $notif = array(
            'message' => 'Privilèges importés avec succès', 'alert-type' => 'success');
        
        return back()->with($notif);

    } // fin de la fonction   


    // ***************************** Les roles *****************************
    public function allRole () {
        $roles = Role::all();
        return view('backend.pages.roles.role_all', compact('roles'));
    } // fin de la fonction 


    public function addRole () {
        return view('backend.pages.roles.role_add');
    } // fin de la fonction 


    public function storeRole (Request $request) {

        Role::create([
            'name' => $request->name,
        ]);

        $notif = array('message' => 'Rôle ajouté avec succès.', 'alert-type' => 'success');

        return redirect()->route('roles.all')->with($notif);

    } // fin de la fonction 


    public function editRole ($id) {
        $role = Role::findOrFail($id);
        return view('backend.pages.roles.role_edit', compact('role'));
    } // fin de la fonction 


    public function updateRole (Request $request) {

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now(),
        ]);

        $notif = array('message' => 'Rôle édité avec succès.', 'alert-type' => 'success');

        return redirect()->route('roles.all')->with($notif);

    } // fin de la fonction 


    public function deleteRole ($id) {

        Role::findOrFail($id)->delete();

        $notif = array('message' => 'Rôle supprimé avec succès.', 'alert-type' => 'success');

        return back()->with($notif);

    } // fin de la fonction 


    // **************************** privilèges par rôle ****************************
    public function addRolePermission () {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.rolesetup.roles_permission_add', compact('roles', 'permissions', 'permission_groups'));
    } // fin de la fonction  


    public function storeRolePermission (Request $request) {
        
        $data = array();
        $permissions = $request->permission;

        foreach ($permissions as $key => $item) {
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        $notif = array(
            'message' => 'Privilèges du rôle ajoutés avec succès.', 
            'alert-type' => 'success'
        );

        return redirect()->route('roles.permission.all')->with($notif);

    } // fin de la fonction  

    
    public function allRolePermission () {
        $roles = Role::all();
        return view('backend.pages.rolesetup.roles_permission_all', compact('roles'));
    } // fin de la fonction  


    public function editRolePermission ($id) {

        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();

        return view('backend.pages.rolesetup.roles_permission_edit', compact('role', 'permissions', 'permission_groups'));

    } // fin de la fonction  
    
    
    public function updateRolePermission (Request $request) {
        
        $r_id = $request->id;

        $role = Role::findOrFail($r_id);
        $permissions = $request->permission;

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        $notif = array(
            'message' => 'Privilèges édités avec succès, pour le role '.$role->name,
            'alert-type' => 'success',
        );

        return redirect()->route('roles.permission.all')->with($notif);

    } // fin de la fonction  
    

    public function deleteRolePermission ($id) {

        $role = Role::findOrFail($id);

        if (!is_null($role)) {
            $role->delete();
        }

        $notif = array(
            'message' => 'Privilèges du rôle supprimé avec succès.', 
            'alert-type' => 'success'
        );

        return back()->with($notif);

    } // fin de la fonction  
}

