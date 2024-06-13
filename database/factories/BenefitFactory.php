<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Benefit>
 */
class BenefitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = File::files('storage/app/server-images/benefits');
        $image = $images[random_int(0, count($images) - 1)];
        $randomFilename = uniqid() . '.' . $image->getExtension();

        $targetDirectory = 'images/benefits/';
        if (!File::exists(public_path($targetDirectory))) {
            File::makeDirectory(public_path($targetDirectory), 0777, true, true);
        }

        File::copy($image->getPathname(), public_path($targetDirectory . $randomFilename));
        $uploadedImagePath = 'benefits/' . $randomFilename;
        return [
            "title" => fake()->sentence(random_int(2, 3)),
            "slug" => fake()->slug(),
            "description" => fake()->sentences(random_int(1, 2), true),
            "icon" => $uploadedImagePath
        ];
    }
}
