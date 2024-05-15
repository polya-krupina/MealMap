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
            $user->kindergarten_id = 1;
            $user->save();
        });

        $user = User::first();
        Kid::factory()->create([
            'user_id' => $user->id
        ]);

        $user = User::factory(1)->create([
            'kindergarten_id' => 1
        ])->last()->assignRole($canteenWorkerRole);

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
        
        $mealsTypes = MealType::all();

        for( $i = 0; $i < count($mealsTypes); $i++ ){
            $dishes = Dish::factory(10)
                ->create([
                    'meal_type_id' => $mealsTypes[$i]->id,
                    'kindergarten_id' => 1
                ])
                ->each(function ($dish) use ($products) {
                    $dish->products()->attach(
                        $products->random(rand(4, 6))->pluck('id')->toArray()
                    );
                });  
        };
    }
}
