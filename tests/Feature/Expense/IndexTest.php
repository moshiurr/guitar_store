<?php

namespace Tests\Feature\Expense;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_expense_index_page_displayed()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/expense');

        $response->assertOk();
    }

    public function test_expense_not_accessible_for_guest()
    {
        $response = $this
            ->get('/expense');

        $response->assertRedirect('/login');
    }

}
