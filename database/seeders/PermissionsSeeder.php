<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = ["Can view Dashboard","Can view Client","Can view All Client","Can Edit Client","Can Trash Client",
        "Can view Today Registered Clients","Can Register Client","Can View Trashed Clients","Can Restore Client","Can Delete Client",
        "Can view Transactions",
        "Can view Pay Debt","Can View Pay Debt Form","Can view Todays Transactions","Can View Reports","Can View Todays Revenvue",
        "Can view All Revenue","Can view Pending Revenue","Can View Overdue Debts","Can view Cleared Debts","Can View Permissions",
        "Can Add User Permission","Can Register User","Can View Users","Can Delete User","Can View Registered Users Option","Can View Field Staff"];

        for($i=0; $i < count($permissions); $i++){
           $permission = new Permission();
            if(Permission::where("id",$i)->exists()){
                $permission->id = $i+1;
            }
            else{
               $permission->id = $i;
            } 
            $permission->Permission=$permissions[$i];
            $permission->save();
        }
    }
}
