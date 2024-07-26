<?php

namespace Tests\Feature;

use Tests\TestCase;

class WorkingDaysTest extends TestCase
{
    public function testWorkingDays()
    {
        // 2024-08-29
        // null -- pracovny den: ANO, weekend NIE, sviatok NIE
        // SK ---- pracovny den: NIE, weekend NIE, sviatok ANO
        // CZ ---- pracovny den: ANO, weekend NIE, sviatok NIE
        foreach ([null, 'SK', 'CZ'] as $country) {
            $response = $this->get(route('working-days.index', [
                'date' => '2024-08-29',
                'country' => $country
            ]));

            $response->assertStatus(200);
            $response->assertJson([
                'is_working_day' => $country != 'SK',
                'is_weekend' => false,
                'is_holiday' => $country == 'SK' || $country == null // null == some country has holiday
            ]);
        }

        // 2024-9-1
        // null -- pracovny den: NIE, weekend ANO, sviatok ANO
        // SK -- pracovny den: NIE, weekend ANO, sviatok ANO
        // CZ -- pracovny den: NIE, weekend ANO, sviatok NIE
        foreach ([null, 'SK', 'CZ'] as $country) {
            $response = $this->get(route('working-days.index', [
                'date' => '2024-09-01',
                'country' => $country
            ]));

            $response->assertStatus(200);
            $response->assertJson([
                'is_working_day' => false,
                'is_weekend' => true,
                'is_holiday' => $country == 'SK' || $country == null
            ]);
        }
    }
}
