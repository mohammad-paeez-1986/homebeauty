<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Morilog\Jalali\Jalalian;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $persianAddresses = [
            'تهران، خیابان آزادی، خیابان دانشگاه، پلاک ۱۲۳',
            'اصفهان، چهارباغ بالا، کوچه سعادت، پلاک ۵',
            'شیراز، خیابان زند، روبروی پارک ارم، پلاک ۷۸',
            'مشهد، خیابان امام رضا، نبش امامت ۲۲',
            'تبریز، خیابان امام خمینی، پلاک ۴۵۰',
        ];

        $persianDescriptions = [
            'لطفاً زنگ بزنید قبل از ورود',
            'طبقه سوم بدون آسانسور',
            'کد رهگیری از پست دریافت شده',
            'تحویل به آقای محمدی داده شود',
            'زمان دقیق رعایت شود لطفا',
        ];

        $statuses = ['pending', 'confirmed', 'done', 'canceled'];

        return [
            'user_id' => User::all()->random()->id,
            'address' => fake()->randomElement($persianAddresses),
            'day' => Jalalian::fromDateTime(fake()->dateTimeBetween('now', '+3 days')),
            'time' => fake()->time('H:i'),
            'service_type' => fake()->randomElement(['man', 'woman', 'bearish']),
            'description' => fake()->optional(0.6)->randomElement($persianDescriptions),
            'status' => fake()->randomElement($statuses),
        ];
    }
}
