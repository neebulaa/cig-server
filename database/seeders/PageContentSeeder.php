<?php

namespace Database\Seeders;

use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // hero content
        PageContent::create([
            "key" => "hero-title",
            "type" => "text",
            "title" => "Hero content title (before hero image)",
            "value" => ""
        ]);

        PageContent::create([
            "key" => "hero-description",
            "type" => "text",
            "title" => "Hero content description (after hero image)",
            "value" => ""
        ]);

        PageContent::create([
            "key" => "hero-left-button",
            "type"  => "button",
            "title" => "Hero content left button",
            "value" => '{"title": "", "link": ""}'
        ]);

        PageContent::create([
            "key" => "hero-left-button",
            "type" => "button",
            "title" => "Hero content left button",
            "value" => '{"title": "", "link": ""}'
        ]);

        // hero slider content
        PageContent::create([
            "key" => "hero-slider-1",
            "type" => "text",
            "title" => "Hero content slider",
            "value" => 'Export'
        ]);

        PageContent::create([
            "key" => "hero-slider-2",
            "type" => "text",
            "title" => "Hero content slider",
            "value" => 'Export'
        ]);

        PageContent::create([
            "key" => "hero-slider-3",
            "type" => "text",
            "title" => "Hero content slider",
            "value" => 'Export'
        ]);

        PageContent::create([
            "key" => "hero-slider-4",
            "type" => "text",
            "title" => "Hero content slider",
            "value" => 'Export'
        ]);

        PageContent::create([
            "key" => "hero-slider-5",
            "type" => "text",
            "title" => "Hero content slider",
            "value" => 'Export'
        ]);

        // about content
        PageContent::create([
            "key" => "about-title",
            "type" => "text",
            "title" => "About content title",
            "value" => "About Us",
        ]);

        PageContent::create([
            "key" => "about-tagline",
            "type" => "text",
            "title" => "About content tagline (after title)",
            "value" => "",
        ]);

        PageContent::create([
            "key" => "about-description",
            "type" => "text",
            "title" => "About content description / bio",
            "value" => "",
        ]);

        // our vision content
        PageContent::create([
            "key" => "our_vision-title",
            "type" => "text",
            "title" => "Our Vision content title",
            "value" => "Our Vision",
        ]);

        PageContent::create([
            "key" => "our_vision-tagline",
            "type" => "text",
            "title" => "Our Vision content tagline (after title)",
            "value" => "",
        ]);

        // benefits content
        PageContent::create([
            "key" => "benefits-title",
            "type" => "text",
            "title" => "Benefits content title",
            "value" => "Benefits",
        ]);

        PageContent::create([
            "key" => "benefits-tagline",
            "type" => "text",
            "title" => "Benefits content tagline (after title)",
            "value" => "",
        ]);

        // products content
        PageContent::create([
            "key" => "products-title",
            "type" => "text",
            "title" => "Products content title",
            "value" => "Products",
        ]);

        PageContent::create([
            "key" => "products-tagline",
            "type" => "text",
            "title" => "Products content tagline (after title)",
            "value" => "",
        ]);

        // our comodity content
        PageContent::create([
            "key" => "comodity-title",
            "type" => "text",
            "title" => "Comodity content title",
            "value" => "Our Comodity",
        ]);

        PageContent::create([
            "key" => "comodity-tagline",
            "type" => "text",
            "title" => "Comodity content tagline (after title)",
            "value" => "",
        ]);

        // our comodity content
        PageContent::create([
            "key" => "our_team-title",
            "type" => "text",
            "title" => "Our team content title",
            "value" => "Meet Our Team",
        ]);

        PageContent::create([
            "key" => "our_team-tagline",
            "type" => "text",
            "title" => "Our team content tagline (after title)",
            "value" => "Here is the best person",
        ]);

        // our client content
        PageContent::create([
            "key" => "our_client-title",
            "type" => "text",
            "title" => "Our client content title",
            "value" => "Meet Our Client",
        ]);

        PageContent::create([
            "key" => "our_client-tagline",
            "type" => "text",
            "title" => "Our client content tagline (after title)",
            "value" => "Here is our half",
        ]);

        // article content
        PageContent::create([
            "key" => "article-title",
            "type" => "text",
            "title" => "Article content title",
            "value" => "Article",
        ]);

        PageContent::create([
            "key" => "article-tagline",
            "type" => "text",
            "title" => "Article content tagline (after title)",
            "value" => "Our latest news",
        ]);

        //  certification content
        PageContent::create([
            "key" => "certification-title",
            "type" => "text",
            "title" => "Certification content title",
            "value" => "Certification",
        ]);

        PageContent::create([
            "key" => "certification-tagline",
            "type" => "text",
            "title" => "Certification content tagline (after title)",
            "value" => "Our Certifications",
        ]);

        //  certification content
        PageContent::create([
            "key" => "location-title",
            "type" => "text",
            "title" => "Location content title",
            "value" => "Location",
        ]);

        PageContent::create([
            "key" => "location-tagline",
            "type" => "text",
            "title" => "Location content tagline (after title)",
            "value" => "Our Location",
        ]);

        //  footer content
        PageContent::create([
            "key" => "location-title",
            "type" => "text",
            "title" => "Location content title",
            "value" => "Location",
        ]);

        PageContent::create([
            "key" => "location-tagline",
            "type" => "text",
            "title" => "Location content tagline (after title)",
            "value" => "Our Location",
        ]);
    }
}
