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
use App\Models\Comodity;
use App\Models\Pinpoint;
use App\Models\TeamMember;
use App\Models\TableFilter;
use App\Models\Certification;
use App\Models\RegionComodity;
use App\Models\ProductComodity;
use Illuminate\Database\Seeder;
use Database\Seeders\RegionSeeder;
use Illuminate\Support\Facades\File;

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

        // delete all folders
        $folders = [
            "benefits",
            "certifications",
            "clients",
            "comodities",
            "posts",
            "products",
            "companies",
            "team_members",
            "visions",
        ];

        foreach ($folders as $folder) {
            if (File::exists(public_path("images/$folder"))) {
                File::deleteDirectory(public_path("images/$folder"));
            }
        }


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
            "slug" => "pt-crescentia-indo-global-cig",
            "about" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore temporibus impedit voluptatem atque officia laboriosam eos quasi nesciunt dignissimos corrupti!",
            "address" => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
            "phone" => "+62-123-1234-123",
            "logo" => 'cig.png',
            "iframe_src" => "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.8178486225625!2d109.32138211100892!3d-0.027861435546202098!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d58fa2f8f31cd%3A0x2ba759cc67b0a219!2sNeo%20Shabu-Shabu%20Steak%20%26%20Shake!5e0!3m2!1sid!2sid!4v1719386880277!5m2!1sid!2sid"
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
        $number_of_products = 15;
        Product::factory($number_of_products)->create();

        // comodities
        Comodity::factory(10)->create();
        Social::factory(4)->create();

        // product comodities
        for ($i = 1; $i <= $number_of_products; $i++) {
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
