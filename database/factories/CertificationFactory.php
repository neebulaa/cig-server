<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certification>
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = File::files('storage/app/server-images/certifications');
        $image = $images[0];
        $randomFilename = uniqid() . '.' . $image->getExtension();

        $targetDirectory = 'images/certifications/';
        if (!File::exists(public_path($targetDirectory))) {
            File::makeDirectory(public_path($targetDirectory), 0777, true, true);
        }

        File::copy($image->getPathname(), public_path($targetDirectory . $randomFilename));
        $uploadedImagePath = 'certifications/' . $randomFilename;
        return [
            "title" => fake()->sentence(random_int(3, 4)),
            "slug" => fake()->slug(),
            "description" => fake()->sentences(random_int(1, 2), true),
            "image" => $uploadedImagePath
        ];
    }
}
