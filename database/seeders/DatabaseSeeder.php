<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Client;
use App\Models\Social;
use App\Models\Vision;
use App\Models\Benefit;
use App\Models\Company;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Certification;
use App\Models\Comodity;
use App\Models\Pinpoint;
use App\Models\TableFilter;
use App\Models\RegionComodity;
use App\Models\ProductComodity;
use App\Models\TeamMember;
use Illuminate\Database\Seeder;
use Database\Seeders\RegionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            "name" => "Owner",
            "username" => "owner",
            "password" => "owner",
            "role" => "owner"
        ]);

        User::create([
            "name" => "Editor 1",
            "username" => "editor1",
            "password" => "editor1",
            "role" => "editor"
        ]);

        User::create([
            "name" => "Editor 2",
            "username" => "editor2",
            "password" => "editor2",
            "role" => "editor"
        ]);

        // company
        Company::create([
            "name" => "PT Crescentia Indo Global (CIG)",
            "slug" => "pt-crescentia-indo-global-(cig)",
            "about" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore temporibus impedit voluptatem atque officia laboriosam eos quasi nesciunt dignissimos corrupti!",
            "address" => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            "phone" => "+62-123-1234-123",
            "logo" => 'companies/cig.png'
        ]);

        // post categories
        Category::create([
            "name" => "Shipping",
            "slug" => "shipping"
        ]);

        Category::create([
            "name" => "Business",
            "slug" => "business"
        ]);

        Category::create([
            "name" => "Language",
            "slug" => "language"
        ]);

        Category::create([
            "name" => "Conference",
            "slug" => "conference"
        ]);

        Category::create([
            "name" => "Market",
            "slug" => "market"
        ]);

        Post::factory(15)->create();
        Client::factory(15)->create();

        // page content
        $this->call([
            PageContentSeeder::class,
            RegionSeeder::class
        ]);

        // table filter

        TableFilter::create([
            'name' => "Comodities",
            "slug" => "comodities",
            "source" => "comodities"
        ]);

        TableFilter::create([
            'name' => "Regions",
            "slug" => "regions",
            "source" => "regions"
        ]);


        // products
        Product::factory(10)->create();

        // comodities
        Comodity::factory(10)->create();
        Social::factory(4)->create();

        // product comodities
        for ($i = 1; $i <= 10; $i++) {
            $number_of_comodities = random_int(1, 5);
            for ($j = 0; $j < $number_of_comodities; $j++) {
                ProductComodity::create([
                    "product_id" => $i,
                    "comodity_id" => random_int(1, 10)
                ]);
            }
        }

        // region comodities
        for ($i = 1; $i <= 38; $i++) {
            $number_of_comodities = random_int(1, 5);
            for ($j = 0; $j < $number_of_comodities; $j++) {
                RegionComodity::create([
                    "region_id" => $i,
                    "comodity_id" => random_int(1, 10)
                ]);
            }
        }

        // region pinpoints
        for ($i = 1; $i <= 45; $i++) {
            Pinpoint::create([
                "region_id" => $i,
                "pos_x" => 20,
                "pos_y" => 20,
            ]);
        }

        TeamMember::factory(10)->create();
        Vision::factory(3)->create();
        Benefit::factory(3)->create();
        Certification::factory(6)->create();
    }
}
