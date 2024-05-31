<?php

namespace Database\Seeders;

use App\Models\PageContent;
use App\Models\PageContentValue;
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
            "page" => "main",
            "type" => "text",
            "title" => "Hero content title (before hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => 1,
            "type" => "text",
            "value" => "Exporter"
        ]);

        PageContent::create([
            "key" => "hero-description",
            "page" => "main",
            "type" => "textarea",
            "title" => "Hero content description (after hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => 2,
            "type" => "text",
            "value" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi illo quaerat at expedita, consequuntur quas eos explicabo quis incidunt fuga quod facere aperiam itaque unde aut iure tempora distinctio provident magnam necessitatibus eius cupiditate alias. Dicta quam, itaque sint nostrum qui soluta suscipit. Iusto, quibusdam?"
        ]);

        PageContent::create([
            "key" => "hero-left_button",
            "page" => "main",
            "type"  => "button",
            "title" => "Hero content left button",
        ]);

        PageContentValue::create([
            "page_content_id" => 3,
            "type" => "text",
            "value" => "View our products"
        ]);

        PageContentValue::create([
            "page_content_id" => 3,
            "type" => "link",
            "value" => "#products"
        ]);

        PageContent::create([
            "key" => "hero-right_button",
            "page" => "main",
            "type" => "button",
            "title" => "Hero content right button",
        ]);

        PageContentValue::create([
            "page_content_id" => 4,
            "type" => "text",
            "value" => "Join us"
        ]);

        PageContentValue::create([
            "page_content_id" => 4,
            "type" => "link",
            "value" => "#join-us"
        ]);

        // hero slider content
        PageContent::create([
            "key" => "hero-slider",
            "page" => "main",
            "type" => "text",
            "title" => "Hero content slider text",
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "value" => "Export"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "value" => "Diligent"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "value" => "Creative"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "value" => "Integrity"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "value" => "International"
        ]);

        // about content
        PageContent::create([
            "key" => "about-title",
            "page" => "main",
            "type" => "text",
            "title" => "About content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 6,
            "type" => "text",
            "value" => "About Us",
        ]);

        PageContent::create([
            "key" => "about-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "About content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 7,
            "type" => "text",
            "value" => "The best exporter",
        ]);

        PageContent::create([
            "key" => "about-description",
            "page" => "main",
            "type" => "textarea",
            "title" => "About content description / bio",
        ]);

        PageContentValue::create([
            "page_content_id" => 8,
            "type" => "text",
            "value" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis expedita excepturi voluptatibus! Blanditiis earum explicabo veniam architecto velit, autem recusandae at nulla sapiente error, eveniet adipisci vitae ut dolor doloremque voluptatem illum accusamus. Nesciunt cupiditate dicta voluptatem fugiat commodi, reprehenderit eos architecto illum ipsum animi, sapiente dolor sed ab quam modi perspiciatis voluptatibus itaque quaerat culpa! Exercitationem, option.",
        ]);

        // our vision content
        PageContent::create([
            "key" => "our_vision-title",
            "page" => "main",
            "type" => "text",
            "title" => "Our Vision content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 9,
            "type" => "text",
            "value" => "Our Vision",
        ]);

        PageContent::create([
            "key" => "our_vision-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Our Vision content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 10,
            "type" => "text",
            "value" => "This is the future of CIG",
        ]);

        // benefits content
        PageContent::create([
            "key" => "benefits-title",
            "page" => "main",
            "type" => "text",
            "title" => "Benefits content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 11,
            "type" => "text",
            "value" => "Benefits",
        ]);

        PageContent::create([
            "key" => "benefits-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Benefits content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 12,
            "type" => "text",
            "value" => "Awesome thing you get from us",
        ]);

        // products content
        PageContent::create([
            "key" => "products-title",
            "page" => "main",
            "type" => "text",
            "title" => "Products content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 13,
            "type" => "text",
            "value" => "Products",
        ]);

        PageContent::create([
            "key" => "products-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Products content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 14,
            "type" => "text",
            "value" => "Our Products",
        ]);

        PageContent::create([
            "key" => "products-button",
            "page" => "main",
            "type" => "button",
            "title" => "Products button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => 15,
            "type" => "text",
            "value" => "View all products",
        ]);

        PageContentValue::create([
            "page_content_id" => 15,
            "type" => "link",
            "value" => "/products",
        ]);

        // our comodity content
        PageContent::create([
            "key" => "comodity-title",
            "page" => "main",
            "type" => "text",
            "title" => "Comodity content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 16,
            "type" => "text",
            "value" => "Our Comodity",
        ]);

        PageContent::create([
            "key" => "comodity-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Comodity content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 17,
            "type" => "text",
            "value" => "CIG's Specialities",
        ]);


        // our team content
        PageContent::create([
            "key" => "our_team-title",
            "page" => "main",
            "type" => "text",
            "title" => "Our team content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 18,
            "type" => "text",
            "value" => "Meet Our Team",
        ]);

        PageContent::create([
            "key" => "our_team-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Our team content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 19,
            "type" => "text",
            "value" => "Here is the best person",
        ]);

        // our client content
        PageContent::create([
            "key" => "our_client-title",
            "page" => "main",
            "type" => "text",
            "title" => "Our client content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 20,
            "type" => "text",
            "value" => "Meet Our Client",
        ]);


        PageContent::create([
            "key" => "our_client-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Our client content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 21,
            "type" => "text",
            "value" => "Here is our half",
        ]);

        // article content
        PageContent::create([
            "key" => "article-title",
            "page" => "main",
            "type" => "text",
            "title" => "Article content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 22,
            "type" => "text",
            "value" => "Article",
        ]);

        PageContent::create([
            "key" => "article-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Article content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 23,
            "type" => "text",
            "value" => "Our latest posts",
        ]);

        PageContent::create([
            "key" => "article-button",
            "page" => "main",
            "type" => "button",
            "title" => "Article button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => 24,
            "type" => "text",
            "value" => "View all article",
        ]);

        PageContentValue::create([
            "page_content_id" => 24,
            "type" => "link",
            "value" => "/posts",
        ]);

        //  certification content
        PageContent::create([
            "key" => "certification-title",
            "page" => "main",
            "type" => "text",
            "title" => "Certification content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 25,
            "type" => "text",
            "value" => "Certification",
        ]);

        PageContent::create([
            "key" => "certification-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Certification content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 26,
            "type" => "text",
            "value" => "Our certifications",
        ]);

        //  location content
        PageContent::create([
            "key" => "location-title",
            "page" => "main",
            "type" => "text",
            "title" => "Location content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 27,
            "type" => "text",
            "value" => "Location",
        ]);

        PageContent::create([
            "key" => "location-tagline",
            "page" => "main",
            "type" => "text",
            "title" => "Location content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 28,
            "type" => "text",
            "value" => "This is where we work",
        ]);

        // products page
        PageContent::create([
            "key" => "main-title",
            "page" => "products",
            "type" => "text",
            "title" => "Products page title",
        ]);

        PageContentValue::create([
            "page_content_id" => 29,
            "type" => "text",
            "value" => "Our Products",
        ]);

        PageContent::create([
            "key" => "main-description",
            "page" => "products",
            "type" => "textarea",
            "title" => "Products page description",
        ]);

        PageContentValue::create([
            "page_content_id" => 30,
            "type" => "text",
            "value" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id excepturi impedit at officia pariatur libero ullam. Dolorem quos fuga fugiat aperiam quaerat provident, magnam quibusdam.",
        ]);

        PageContent::create([
            "key" => "filters",
            "page" => "products",
            "type" => "filters",
            "title" => "Products page filter",
        ]);

        PageContentValue::create([
            "page_content_id" => 31,
            "type" => "filter",
            "value" => "comodity",
        ]);

        PageContentValue::create([
            "page_content_id" => 31,
            "type" => "filter",
            "value" => "region",
        ]);

        // article / post page
        PageContent::create([
            "key" => "main-title",
            "page" => "articles",
            "type" => "text",
            "title" => "Articles page title",
        ]);

        PageContentValue::create([
            "page_content_id" => 32,
            "type" => "text",
            "value" => "Articles",
        ]);

        PageContent::create([
            "key" => "main-description",
            "page" => "articles",
            "type" => "textarea",
            "title" => "Articles page description",
        ]);

        PageContentValue::create([
            "page_content_id" => 33,
            "type" => "text",
            "value" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id excepturi impedit at officia pariatur libero ullam. Dolorem quos fuga fugiat aperiam quaerat provident, magnam quibusdam.",
        ]);

        // article page - recent
        PageContent::create([
            "key" => "recent-title",
            "page" => "articles",
            "type" => "text",
            "title" => "Articles page section recent title",
        ]);

        PageContentValue::create([
            "page_content_id" => 34,
            "type" => "text",
            "value" => "Recent",
        ]);

        PageContent::create([
            "key" => "recent-tagline",
            "page" => "articles",
            "type" => "text",
            "title" => "Articles page section recent tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 35,
            "type" => "text",
            "value" => "Latest of our news",
        ]);

        // articles page - activities
        PageContent::create([
            "key" => "activities-title",
            "page" => "articles",
            "type" => "text",
            "title" => "Articles page section activities title",
        ]);

        PageContentValue::create([
            "page_content_id" => 36,
            "type" => "text",
            "value" => "Activities",
        ]);

        PageContent::create([
            "key" => "activities-tagline",
            "page" => "articles",
            "type" => "text",
            "title" => "Articles page section activities tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 37,
            "type" => "text",
            "value" => "What we have done?",
        ]);
    }
}
