<?php

namespace Database\Factories;

use App\Common\Config\MyConfig;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $shippingMethods = MyConfig::getSelectData('shipping_method');
        $paymentMethods = MyConfig::getSelectData('payment_method');
        return [
            'user_id' => User::all()->random()->id,
            'address' => $this->faker->address(),
            'status' => 'pending',
            'note' => $this->faker->text(),
            'phone' => '0886862961',
            'shipping_method' => $shippingMethods[array_rand($shippingMethods, 1)],
            'payment_method' => $paymentMethods[array_rand($paymentMethods, 1)],
        ];
    }
    //$table->id();
    //$table->foreignId('user_id')->constraint();
    //$table->string('address');
    //$table->string('status');
    //$table->string('note')->nullable();
    //$table->string('phone')->nullable();
    //$table->foreignId('created_by')->nullable();
    //$table->foreignId('modified_by')->nullable();
    //$table->timestamps();
}
