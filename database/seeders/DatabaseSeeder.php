<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Factories\PlanFactory;

class DatabaseSeeder extends Seeder
{   
    protected $planFactory;

    public function __construct(PlanFactory $planFactory)
    {
        $this->planFactory = $planFactory;
    }

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        foreach($this->planFactory->plans() as $plan)
        {
            \App\Models\Server\Plan::create([
                'title' => $plan['title'],
                'price_per_month' => $plan['price_per_month']
            ]);
        }
    }
}
