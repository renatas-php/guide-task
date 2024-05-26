<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlanTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_or_any_plan_exists(): void
    {   
        $response = \App\Models\Server\Plan::count();

        $this->assertGreaterThanOrEqual(1, $response);        
    }

    public function test_or_any_plan_price_match_price_from_task_description(): void
    {   
        $response = \App\Models\Server\Plan::pluck('price_per_month')->toArray();

        $this->assertGreaterThanOrEqual([890, 1230, 2990], $response);        
    }
}
