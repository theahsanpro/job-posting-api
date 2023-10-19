<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Carbon;

class JobTest extends TestCase
{
    public function test_get_jobs(): void
    {
        $response = $this->get('/api/jobs');

        $response->assertStatus(200);
    }

    public function test_get_job(): void
    {
        $response = $this->get('/api/jobs/6');

        $response->assertStatus(200);
    }

    public function test_delete_job(): void
    {
        $response = $this->delete('/api/jobs/6');

        $response->assertStatus(200);
    }

    public function test_post_job(): void
    {
        $response = $this->post('/api/jobs', [
            'title' => 'Unit Test',
            'description' => 'Unit Test',
            'salary' => 30000,
            'company' => 'Unit Test',
        ]);

        $response->assertStatus(200);
    }

    public function test_update_job(): void
    {
        $response = $this->put('/api/jobs/7', [
            'title' => 'Unit Test Updates',
            'description' => 'Unit Test Updated',
            'salary' => 20000,
            'company' => 'Unit Test',
        ]);

        $response->assertStatus(200);
    }
}