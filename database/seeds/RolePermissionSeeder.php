<?php

use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = \App\Permission::all();
        $admin = \App\Role::whereName('Admin')->first();

        foreach ($permissions as $permission){
            \Illuminate\Support\Facades\DB::table('role_permission')->insert([
                'role_id'=>$admin->id,
                'permission_id'=>$permission->id,
            ]);
        }


        $editor = \App\Role::whereName('Editor')->first();

        foreach ($permissions as $permission){
           if (!in_array($permission->name,['edit_roles'])){
               \Illuminate\Support\Facades\DB::table('role_permission')->insert([
                   'role_id'=>$editor->id,
                   'permission_id'=>$permission->id,
               ]);
           }
        }

        $viewer = \App\Role::whereName('Viewer')->first();

        $viewerRoles = [
            'view_users',
        ];
        foreach ($permissions as $permission){
            if (!in_array($permission->name,$viewerRoles)){
                \Illuminate\Support\Facades\DB::table('role_permission')->insert([
                    'role_id'=>$viewer->id,
                    'permission_id'=>$permission->id,
                ]);
            }
        }
    }
}
