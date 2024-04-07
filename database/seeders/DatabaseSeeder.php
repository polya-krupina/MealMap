<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Group;
use App\Models\Kid;
use App\Models\Kindergarten;
use App\Models\MealType;
use App\Models\Product;
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
    function createMealType($name, $time){
        $mealType = new MealType();
        $mealType->name = $name;
        $mealType->time = $time;
        echo $mealType;
        $mealType->save();
    }

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

        $user = User::first();
        Kid::factory()->create([
            'user_id' => $user->id
        ]);

        $products = Product::factory(10)->create();

        $kids->each(function ($kid) use ($products) {
            $kid->allergies()->attach(
                $products->random(rand(0, 2))->pluck('id')->toArray()
            );
        });

        function createMealType($name, $time){
            $mealType = new MealType();
            $mealType->name = $name;
            $mealType->time = $time;
            $mealType->save();
        }

        createMealType('Завтрак', '08:30:00');
        createMealType('Второй Завтрак', '11:00:00');
        createMealType('Обед', '13:00:00');
        createMealType('Полдник', '15:30:00');
        
        // $mealsTypes = MealType::all();

        // $dishes = Dish::factory(20)->create()
        //     ->each(function(Dish $dish) use ($mealsTypes) {
        //         $dish->meals()->attach(
        //             $mealsTypes->random(rand(1, 4))->pluck('id')->toArray()
        //             );
        //     }); 
    }
}
