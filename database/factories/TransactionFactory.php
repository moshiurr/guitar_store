<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat('2',0,1000),
            'type' => rand(0,1) ? 'income' : 'expense',
            'user_id' => \App\Models\User::all()->random()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
