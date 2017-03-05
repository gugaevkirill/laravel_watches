<?php

namespace Tests\Feature;

use App\Models\Catalog\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class testHealth extends TestCase
{
    public function testPagesStatus()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        // Catalog
        foreach (['watches', 'jewelry', 'accessories'] as $cat) {
            $response = $this->get("/$cat");
            $response->assertStatus(200);

            if ($productId = Product::where('category_slug', $cat)->first(['id'])) {
                $response = $this->get("/$cat/$productId");
                $response->assertStatus(200);
            }
        };

        $response = $this->get('/sell');
        $response->assertStatus(200);

        $response = $this->get('/repair');
        $response->assertStatus(200);

        $response = $this->get('/about');
        $response->assertStatus(200);

        $response = $this->get('/contacts');
        $response->assertStatus(200);

        $response = $this->get('/not_exists');
        $response->assertStatus(404);
    }
}
