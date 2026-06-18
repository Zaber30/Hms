<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Doctor;
use Laravolt\Avatar\Facade as Avatar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{

    /**
     * Define the model's default state.

     *
     * @return array<string, mixed>
     */
    protected $model = Doctor::class;
    public function definition(): array
    {
        //  $imagePath=fake()->image(storage_path('app/public/doctor_profiles'),200,200,'people',false);
        $filename = 'doctor_' . fake()->unique()->numberBetween(1, 9999) . '.png';
       $path = storage_path('app/public/doctor_profiles/' . $filename);

       Avatar::create(fake()->name())->save($path);

        return [
            //
            'user_id'=>User::factory(),
            'bmdc_registration_number'=>fake()->unique()->numerify('BMDC-####'),
            'phone'=>fake()->phoneNumber(),
            'gender'=>fake()->randomElement(['male','female','other']),
            'qualification'=>fake()->randomElement(['Mbbs','MD','FCPS']),
            'experience_years'=>fake()->numberBetween(1,40),
            'bio'=>fake()->sentence(39),
            'clinic_address'=>fake()->address(),
            'consultation_fee'=>fake()->randomFloat(2,500,444),
            'profile_image'=>'doctor_profiles/'. $filename,


        ];
    }
}
