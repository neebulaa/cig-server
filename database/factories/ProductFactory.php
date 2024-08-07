<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = File::files('storage/app/server-images');
        $image = $images[random_int(0, count($images) - 1)];
        $randomFilename = uniqid() . '.' . $image->getExtension();

        $targetDirectory = 'images/products/';
        if (!File::exists(public_path($targetDirectory))) {
            File::makeDirectory(public_path($targetDirectory), 0777, true, true);
        }

        File::copy($image->getPathname(), public_path($targetDirectory . $randomFilename));
        $uploadedImagePath = 'products/' . $randomFilename;

        return [
            "name" => fake()->sentence(random_int(2, 4)),
            "slug" => fake()->slug(),
            "description" => fake()->sentence(random_int(8, 10), true),
            "image" => $uploadedImagePath
        ];
    }
}
