<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PriceTest extends TestCase
{
    public function test_price_count_validation(): void
    {
        $response = $this->json('POST', '/api/getServerServicePrice', [
            'domain' => 'string',
            'plan' => 'string',
            'emailSecurity' => 'string',
            'serverCapacity' => 'string'
        ]);

        $response->assertStatus(422);
    }

    public function test_or_domain_service_price_correct(): void
    {
        $response = $this->call('POST', '/api/getServerServicePrice', [
            'domain' => true,
            'plan' => null,
            'emailSecurity' => false,
            'serverCapacity' => 0
        ]);

        $response->assertJson([
            'data' => 8
        ]);
    }

    public function test_or_domain_plus_email_security_service_price_correct(): void
    {
        $response = $this->json('POST', '/api/getServerServicePrice', [
            'domain' => true,
            'plan' => null,
            'emailSecurity' => true,
            'serverCapacity' => 0
        ]);

        $response->assertJson([
            'data' => 104
        ]);
    }

    public function test_or_domain_plus_email_security_plus_plan_first_service_price_correct(): void
    {
        $response = $this->json('POST', '/api/getServerServicePrice', [
            'domain' => true,
            'plan' => 1,
            'emailSecurity' => true,
            'serverCapacity' => 0
        ]);

        $response->assertJson([
            'data' => 210
        ]);
    }
}
