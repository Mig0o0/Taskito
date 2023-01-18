<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            "name" => "team_leader",
            "display_name" => "Team Leader",
            "description" => "Role Which The Carrier Leads The Team"
        ]);

        Role::create([
            "name" => "web_leader",
            "display_name" => "Web Team Leader",
            "description" => "Role Which The Carrier Leads The Web Team"
        ]);

        Role::create([
            "name" => "flutter_leader",
            "display_name" => "Flutter Team Leader",
            "description" => "Role Which The Carrier Leads The Flutter Team"
        ]);

        Role::create([
            "name" => "machine_leader",
            "display_name" => "Machine Learning Team Leader",
            "description" => "Role Which The Carrier Leads The Machine Learning Team"
        ]);

        Role::create([
            "name" => "machine_member",
            "display_name" => "Machine Learning Team Member",
            "description" => "Role Which The Carrier Operates as ML Member"
        ]);

        Role::create([
            "name" => "flutter_member",
            "display_name" => "Flutter Team Member",
            "description" => "Role Which The Carrier Operates as Flutter Member"
        ]);

        Role::create([
            "name" => "web_member",
            "display_name" => "Web Team Member",
            "description" => "Role Which The Carrier Operates as Web Member"
        ]);

    }
}
