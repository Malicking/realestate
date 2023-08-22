<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // grouper les privilèges par 'group_name'
    public static function getpermissionGroups () {
        $permission_groups = DB::table('permissions')->select('group_name')
                                ->groupBy('group_name')->orderBy('group_name', 'asc')->get();
        return $permission_groups;
    } // fin de la fonction


    // listes de privilèges par groupe ('group_name')
    public static function getpermissionByGroupName ($group_name) {
        $permissions = DB::table('permissions')->select('name', 'id')
                        ->where('group_name', $group_name)->get();
        return $permissions;
    } // fin de la fonction


    // modification des privilèges d'un rôle
    public static function roleHasPermissions ($role, $permissions) {

        $hasPermission = true;

        foreach ($permissions as $perm) {
            if (!$role->hasPermissionTo($perm->name)) {
                $hasPermission = false;
            }

            return $hasPermission;
        }

    } // fin de la fonction
}
