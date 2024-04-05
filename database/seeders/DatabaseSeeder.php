<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Kid;
use App\Models\Kindergarten;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        $kindergarten = Kindergarten::factory()->create([
            'name' => 'Ромашка'
        ]);

        $groups = Group::factory(2)->create([
            'kindergarten_id' => $kindergarten->id
        ]);

        $kids = Kid::factory(10)->create([
            'group_id'=> $groups[0]->id
        ]);
    }
}
