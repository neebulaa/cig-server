<?php

namespace Database\Factories;

use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = File::files('storage/app/server-images/company-logo');
        $image = $images[random_int(0, count($images) - 1)];
        $randomFilename = uniqid() . '.' . $image->getExtension();

        $targetDirectory = 'images/clients/';
        if (!File::exists(public_path($targetDirectory))) {
            File::makeDirectory(public_path($targetDirectory), 0777, true, true);
        }

        File::copy($image->getPathname(), public_path($targetDirectory . $randomFilename));
        $uploadedImagePath = 'clients/' . $randomFilename;

        return [
            "name" => fake()->sentence(1),
            "slug" => fake()->slug(),
            "logo" => $uploadedImagePath
        ];
    }
}
