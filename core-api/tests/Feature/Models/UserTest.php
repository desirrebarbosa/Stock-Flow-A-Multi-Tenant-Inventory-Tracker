<?php

namespace Tests\Feature\Models;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{   

    use RefreshDatabase;
    public function test_a_user_can_be_created(){
        $company = \App\Models\Company::factory()->create(); 
        $user = \User::factory()->create(
            ['email'=>'test@warehouse.com',
             'company_id' => $company->id]);
        $this->assertDatabaseHas('users',['email'=>'test@warehouse.com']);
    }

    public function test_a_user_belongs_to_a_company(){
        $company = \App\Models\Company::factory()->create();  
        $user = \App\Models\User::factory()->create([
            'company_id' => $company->id,
        ]);

        $retrievedCompany = $user->company;

        $this->assertEquals($company->id, $retrievedCompany->id);
    }
}
