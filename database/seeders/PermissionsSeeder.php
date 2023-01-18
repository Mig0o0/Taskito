<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            "name" => "add_task",
            "display_name" => "Add Task",
            "description" => "Permission Which Let Carrier To Add The Task"
        ]);

        Permission::create([
            "name" => "delete_task",
            "display_name" => "Delete Task",
            "description" => "Permission Which Let Carrier To Delete The Task"
        ]);

        Permission::create([
            "name" => "notify_users",
            "display_name" => "Notify Users",
            "description" => "Permission Which Let Carrier To Notify Users by Getting a New Tasks Or a Help in Specific Problem"
        ]);
    }
}
