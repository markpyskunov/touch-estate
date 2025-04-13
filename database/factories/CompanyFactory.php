<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Company;
use App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'code' => Company::generateUniqueCode(),
            'name' => $this->faker->company(),
            'address_id' => Address::factory()->create()->id,
            'contact_id' => Contact::factory()->create()->id,
        ];
    }
}
