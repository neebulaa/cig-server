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
            "title" => "Hero content title (before hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => 1,
            "type" => "text",
            "name" => "Text",
            "value" => "Exporter"
        ]);

        PageContent::create([
            "key" => "hero-description",
            "page" => "main",
            "title" => "Hero content description (after hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => 2,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi illo quaerat at expedita, consequuntur quas eos explicabo quis incidunt fuga quod facere aperiam itaque unde aut iure tempora distinctio provident magnam necessitatibus eius cupiditate alias. Dicta quam, itaque sint nostrum qui soluta suscipit. Iusto, quibusdam?"
        ]);

        PageContent::create([
            "key" => "hero-left_button",
            "page" => "main",
            "title" => "Hero content left button",
        ]);

        PageContentValue::create([
            "page_content_id" => 3,
            "type" => "text",
            "name" => "Text",
            "value" => "View our products"
        ]);

        PageContentValue::create([
            "page_content_id" => 3,
            "type" => "link",
            "name" => "Link",
            "value" => "#products"
        ]);

        PageContent::create([
            "key" => "hero-right_button",
            "page" => "main",
            "title" => "Hero content right button",
        ]);

        PageContentValue::create([
            "page_content_id" => 4,
            "type" => "text",
            "name" => "Text",
            "value" => "Join us"
        ]);

        PageContentValue::create([
            "page_content_id" => 4,
            "type" => "link",
            "name" => "Link",
            "value" => "#join-us"
        ]);

        // hero slider content
        PageContent::create([
            "key" => "hero-slider",
            "page" => "main",
            "title" => "Hero content slider text",
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "name" => "Text 1",
            "value" => "Export"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "name" => "Text 2",
            "value" => "Diligent"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "name" => "Text 3",
            "value" => "Creative"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "name" => "Text 4",
            "value" => "Integrity"
        ]);

        PageContentValue::create([
            "page_content_id" => 5,
            "type" => "text",
            "name" => "Text 5",
            "value" => "International"
        ]);

        // about content
        PageContent::create([
            "key" => "about-title",
            "page" => "main",
            "title" => "About content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 6,
            "type" => "text",
            "name" => "Text",
            "value" => "About Us",
        ]);

        PageContent::create([
            "key" => "about-tagline",
            "page" => "main",
            "title" => "About content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 7,
            "type" => "text",
            "name" => "Text",
            "value" => "The best exporter",
        ]);

        PageContent::create([
            "key" => "about-description",
            "page" => "main",
            "title" => "About content description / bio",
        ]);

        PageContentValue::create([
            "page_content_id" => 8,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis expedita excepturi voluptatibus! Blanditiis earum explicabo veniam architecto velit, autem recusandae at nulla sapiente error, eveniet adipisci vitae ut dolor doloremque voluptatem illum accusamus. Nesciunt cupiditate dicta voluptatem fugiat commodi, reprehenderit eos architecto illum ipsum animi, sapiente dolor sed ab quam modi perspiciatis voluptatibus itaque quaerat culpa! Exercitationem, option.",
        ]);

        // our vision content
        PageContent::create([
            "key" => "our_vision-title",
            "page" => "main",
            "title" => "Our Vision content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 9,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Vision",
        ]);

        PageContent::create([
            "key" => "our_vision-tagline",
            "page" => "main",
            "title" => "Our Vision content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 10,
            "type" => "text",
            "name" => "Text",
            "value" => "This is the future of CIG",
        ]);

        // benefits content
        PageContent::create([
            "key" => "benefits-title",
            "page" => "main",
            "title" => "Benefits content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 11,
            "type" => "text",
            "name" => "Text",
            "value" => "Benefits",
        ]);

        PageContent::create([
            "key" => "benefits-tagline",
            "page" => "main",
            "title" => "Benefits content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 12,
            "type" => "text",
            "name" => "Text",
            "value" => "Awesome thing you get from us",
        ]);

        // products content
        PageContent::create([
            "key" => "products-title",
            "page" => "main",
            "title" => "Products content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 13,
            "type" => "text",
            "name" => "Text",
            "value" => "Products",
        ]);

        PageContent::create([
            "key" => "products-tagline",
            "page" => "main",
            "title" => "Products content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 14,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Products",
        ]);

        PageContent::create([
            "key" => "products-button",
            "page" => "main",
            "title" => "Products button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => 15,
            "type" => "text",
            "name" => "Text",
            "value" => "View all products",
        ]);

        PageContentValue::create([
            "page_content_id" => 15,
            "type" => "link",
            "name" => "Link",
            "value" => "/products",
        ]);

        // our comodity content
        PageContent::create([
            "key" => "comodity-title",
            "page" => "main",
            "title" => "Comodity content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 16,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Comodity",
        ]);

        PageContent::create([
            "key" => "comodity-tagline",
            "page" => "main",
            "title" => "Comodity content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 17,
            "type" => "text",
            "name" => "Text",
            "value" => "CIG's Specialities",
        ]);


        // our team content
        PageContent::create([
            "key" => "our_team-title",
            "page" => "main",
            "title" => "Our team content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 18,
            "type" => "text",
            "name" => "Text",
            "value" => "Meet Our Team",
        ]);

        PageContent::create([
            "key" => "our_team-tagline",
            "page" => "main",
            "title" => "Our team content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 19,
            "type" => "text",
            "name" => "Text",
            "value" => "Here is the best person",
        ]);

        // our client content
        PageContent::create([
            "key" => "our_client-title",
            "page" => "main",
            "title" => "Our client content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 20,
            "type" => "text",
            "name" => "Text",
            "value" => "Meet Our Client",
        ]);

        PageContent::create([
            "key" => "our_client-tagline",
            "page" => "main",
            "title" => "Our client content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 21,
            "type" => "text",
            "name" => "Text",
            "value" => "Here is our half",
        ]);

        // article content
        PageContent::create([
            "key" => "article-title",
            "page" => "main",
            "title" => "Article content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 22,
            "type" => "text",
            "name" => "Text",
            "value" => "Article",
        ]);

        PageContent::create([
            "key" => "article-tagline",
            "page" => "main",
            "title" => "Article content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 23,
            "type" => "text",
            "name" => "Text",
            "value" => "Our latest posts",
        ]);

        PageContent::create([
            "key" => "article-button",
            "page" => "main",
            "title" => "Article button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => 24,
            "type" => "text",
            "name" => "Text",
            "value" => "View all article",
        ]);

        PageContentValue::create([
            "page_content_id" => 24,
            "type" => "link",
            "name" => "Link",
            "value" => "/posts",
        ]);

        //  certification content
        PageContent::create([
            "key" => "certification-title",
            "page" => "main",
            "title" => "Certification content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 25,
            "type" => "text",
            "name" => "Text",
            "value" => "Certification",
        ]);

        PageContent::create([
            "key" => "certification-tagline",
            "page" => "main",
            "title" => "Certification content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 26,
            "type" => "text",
            "name" => "Text",
            "value" => "Our certifications",
        ]);

        //  location content
        PageContent::create([
            "key" => "location-title",
            "page" => "main",
            "title" => "Location content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 27,
            "type" => "text",
            "name" => "Text",
            "value" => "Location",
        ]);

        PageContent::create([
            "key" => "location-tagline",
            "page" => "main",
            "title" => "Location content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 28,
            "type" => "text",
            "name" => "Text",
            "value" => "This is where we work",
        ]);

        // products page
        PageContent::create([
            "key" => "main-title",
            "page" => "products",
            "title" => "Products page title",
        ]);

        PageContentValue::create([
            "page_content_id" => 29,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Products",
        ]);

        PageContent::create([
            "key" => "main-description",
            "page" => "products",
            "title" => "Products page description",
        ]);

        PageContentValue::create([
            "page_content_id" => 30,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id excepturi impedit at officia pariatur libero ullam. Dolorem quos fuga fugiat aperiam quaerat provident, magnam quibusdam.",
        ]);

        PageContent::create([
            "key" => "catalog-filters",
            "page" => "products",
            "title" => "Products page filter",
        ]);

        PageContentValue::create([
            "page_content_id" => 31,
            "type" => "table_filters",
            "name" => "Can Filter by",
            "value" => "comodities,regions",
        ]);

        // article / post page
        PageContent::create([
            "key" => "main-title",
            "page" => "articles",
            "title" => "Articles page title",
        ]);

        PageContentValue::create([
            "page_content_id" => 32,
            "type" => "text",
            "name" => "Text",
            "value" => "Articles",
        ]);

        PageContent::create([
            "key" => "main-description",
            "page" => "articles",
            "title" => "Articles page description",
        ]);

        PageContentValue::create([
            "page_content_id" => 33,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Id excepturi impedit at officia pariatur libero ullam. Dolorem quos fuga fugiat aperiam quaerat provident, magnam quibusdam.",
        ]);

        // article page - recent
        PageContent::create([
            "key" => "recent-title",
            "page" => "articles",
            "title" => "Articles page section recent title",
        ]);

        PageContentValue::create([
            "page_content_id" => 34,
            "type" => "text",
            "name" => "Text",
            "value" => "Recent",
        ]);

        PageContent::create([
            "key" => "recent-tagline",
            "page" => "articles",
            "title" => "Articles page section recent tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 35,
            "type" => "text",
            "name" => "Text",
            "value" => "Latest of our news",
        ]);

        // articles page - activities
        PageContent::create([
            "key" => "activities-title",
            "page" => "articles",
            "title" => "Articles page section activities title",
        ]);

        PageContentValue::create([
            "page_content_id" => 36,
            "type" => "text",
            "name" => "Text",
            "value" => "Activities",
        ]);

        PageContent::create([
            "key" => "activities-tagline",
            "page" => "articles",
            "title" => "Articles page section activities tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 37,
            "type" => "text",
            "name" => "Text",
            "value" => "What we have done?",
        ]);

        // pinpoints content
        PageContent::create([
            "key" => "pinpoints-title",
            "page" => "main",
            "title" => "Pin points content title",
        ]);

        PageContentValue::create([
            "page_content_id" => 38,
            "type" => "text",
            "name" => "Text",
            "value" => "Pinpoints",
        ]);

        PageContent::create([
            "key" => "pinpoints-tagline",
            "page" => "main",
            "title" => "Pin points content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => 39,
            "type" => "text",
            "name" => "Text",
            "value" => "Our region with its speciality",
        ]);
    }
}
