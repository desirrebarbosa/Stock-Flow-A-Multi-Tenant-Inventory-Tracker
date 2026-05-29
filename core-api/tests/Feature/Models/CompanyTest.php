<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    use RefreshDatabase;
    public function test_a_company_can_be_created(){
        $company = \App\Models\Company::factory()->create(['name'=>'Acme Corp']);
        
        $this->assertDatabaseHas('companies', ['name' => 'Acme Corp']);
    }
}
