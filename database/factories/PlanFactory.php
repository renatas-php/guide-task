<?php

namespace Database\Factories;

class PlanFactory
{
    public function plans(): array
    {
        return [
            [
                'title' => 'Planas 1',
                'price_per_month' => 890,
            ],
            [
                'title' => 'Planas 2',
                'price_per_month' => 1230,
            ],
            [
                'title' => 'Planas 3',
                'price_per_month' => 2990,
            ],
        ];
    }
}
