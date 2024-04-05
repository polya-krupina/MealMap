<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kid;
use App\Models\Kindergarten;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $parentRole = Role::create(['name' => 'parent']); // родитель
        $teacherRole = Role::create(['name'=> 'teacher']); // воспитатель
        $adminRole = Role::create(['name'=> 'admin']); // админ
        $canteenWorkerRole = Role::create(['name'=> 'canteen']); // работник столовой

        $kindergarten = Kindergarten::factory()->create([
            'name' => 'Ромашка'
        ]);

        $groups = Group::factory(2)->create([
            'kindergarten_id' => $kindergarten->id
        ]);

        $kids = Kid::factory(10)->create([
            'group_id'=> $groups[0]->id
        ]);

        $users = User::all()->map(function (User $user) use ($parentRole) { 
            $user->assignRole($parentRole);
        });
    }
}
