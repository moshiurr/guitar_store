<?php

namespace Tests\Feature\Expense;

use App\Models\Transaction;
use App\Models\User;
use App\Services\TransactionServices;
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

    public function test_get_transactions_count()
    {
        $user = User::factory()->create();

        $transactions = Transaction::factory()->count(5)->create([
            'user_id' => $user->id,
        ]);

        $transactionsServices = new TransactionServices();

        $fromMethod = $transactionsServices->getTransactions($user->id);

        $this->assertCount($transactions->count(), $fromMethod['recent_transactions']);
    }

    public function test_get_transactions_count_zero()
    {
        $user = User::factory()->create();

        $transactions = Transaction::factory()->count(0)->create([
            'user_id' => $user->id,
        ]);

        $transactionsServices = new TransactionServices();

        $fromMethod = $transactionsServices->getTransactions($user->id);

        $this->assertCount($transactions->count(), $fromMethod['recent_transactions']);
    }

    public function test_get_transactions_total()
    {
        $user = User::factory()->create();

        $transactions = Transaction::factory()->count(1)->create([
            'user_id' => $user->id,
        ]);

        $transactionsServices = new TransactionServices();

        $fromMethod = $transactionsServices->getTransactions($user->id);

        $this->assertEquals($transactions->sum('price'), $fromMethod['total_expenses']);
    }

    public function test_get_transactions_total_with_zero()
    {
        $user = User::factory()->create();

        $transactions = Transaction::factory()->count(0)->create([
            'user_id' => $user->id,
        ]);

        $transactionsServices = new TransactionServices();

        $fromMethod = $transactionsServices->getTransactions($user->id);

        $this->assertEquals(0, $fromMethod['total_expenses']);
    }

}
