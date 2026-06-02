<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_product_can_be_created(){
        $company = \App\Models\Company::factory()->create();
        $product = \App\Models\Product::factory()->create([
            'sku' => 'TEST-SKU-999',
            'company_id' => $company->id,
        ]);

        $this->assertDatabaseHas(
            'products', 
            ['sku' => 'TEST-SKU-999']);
    }

    public function test_a_product_belongs_to_a_company(){
        $company = \App\Models\Company::factory()->create();
        $product = \App\Models\Product::factory()->create([
            'company_id' => $company->id
        ]);

        $retrievedCompany = $product->id;

        $this->assertEquals($retrievedCompany, $company->id);
    }
}
