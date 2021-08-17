<?php

namespace Database\Factories;

use App\Common\Config\MyConfig;
use App\Models\Order;
use App\Models\Profile;
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
        $status = array_flip(MyConfig::getSelectData('status', 'order'));
        $shippingMethods = array_flip(MyConfig::getSelectData('shipping_method', 'order'));
        $paymentMethods = array_flip(MyConfig::getSelectData('payment_method', 'order'));
        return [
            'user_id' => Profile::factory()->create()->user_id,
            'address' => $this->faker->address(),
            'status' => $status[array_rand($status, 1)],
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
