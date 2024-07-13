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
        $pcht = PageContent::create([
            "key" => "hero-title",
            "page" => "main",
            "title" => "Hero content title (before hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcht->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Exporter"
        ]);

        $pchd = PageContent::create([
            "key" => "hero-description",
            "page" => "main",
            "title" => "Hero content description (after hero image)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchd->id,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi illo quaerat at expedita, consequuntur quas eos explicabo quis incidunt fuga quod facere aperiam itaque unde aut iure tempora distinctio provident magnam necessitatibus eius cupiditate alias. Dicta quam, itaque sint nostrum qui soluta suscipit. Iusto, quibusdam?"
        ]);

        $pchlb = PageContent::create([
            "key" => "hero-left_button",
            "page" => "main",
            "title" => "Hero content left button",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchlb->id,
            "type" => "text",
            "name" => "Text",
            "value" => "View our products"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchlb->id,
            "type" => "link",
            "name" => "Link",
            "value" => "/products"
        ]);

        $pchrb = PageContent::create([
            "key" => "hero-right_button",
            "page" => "main",
            "title" => "Hero content right button",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchrb->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Join us"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchrb->id,
            "type" => "link",
            "name" => "Link",
            "value" => "#location"
        ]);

        // hero slider content
        $pchs = PageContent::create([
            "key" => "hero-slider",
            "page" => "main",
            "title" => "Hero content slider text",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchs->id,
            "type" => "text",
            "name" => "Text 1",
            "value" => "Export"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchs->id,
            "type" => "text",
            "name" => "Text 2",
            "value" => "Diligent"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchs->id,
            "type" => "text",
            "name" => "Text 3",
            "value" => "Creative"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchs->id,
            "type" => "text",
            "name" => "Text 4",
            "value" => "Integrity"
        ]);

        PageContentValue::create([
            "page_content_id" => $pchs->id,
            "type" => "text",
            "name" => "Text 5",
            "value" => "International"
        ]);

        // pinpoints content
        $pcpnt = PageContent::create([
            "key" => "pinpoints-title",
            "page" => "main",
            "title" => "Pin points content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpnt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Pinpoints",
        ]);

        $pcpntg = PageContent::create([
            "key" => "pinpoints-tagline",
            "page" => "main",
            "title" => "Pin points content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpntg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our region with its speciality",
        ]);

        // h ighlighted regions content
        $pchrt = PageContent::create([
            "key" => "highlighted_regions-title",
            "page" => "main",
            "title" => "Highlighted Region content title (In Mobile)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchrt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Highlighted Regions",
        ]);

        $pchrtg = PageContent::create([
            "key" => "highlighted_regions-tagline",
            "page" => "main",
            "title" => "Highlighted Region content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pchrtg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "The best places on Indonesia",
        ]);

        // about content
        $pcat = PageContent::create([
            "key" => "about-title",
            "page" => "main",
            "title" => "About content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcat->id,
            "type" => "text",
            "name" => "Text",
            "value" => "About Us",
        ]);

        $pcatg = PageContent::create([
            "key" => "about-tagline",
            "page" => "main",
            "title" => "About content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcatg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "The best exporter",
        ]);

        $pcad = PageContent::create([
            "key" => "about-description",
            "page" => "main",
            "title" => "About content description / bio",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcad->id,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis expedita excepturi voluptatibus! Blanditiis earum explicabo veniam architecto velit, autem recusandae at nulla sapiente error, eveniet adipisci vitae ut dolor doloremque voluptatem illum accusamus. Nesciunt cupiditate dicta voluptatem fugiat commodi, reprehenderit eos architecto illum ipsum animi, sapiente dolor sed ab quam modi perspiciatis voluptatibus itaque quaerat culpa! Exercitationem, option.",
        ]);

        // our vision content
        $pcvt = PageContent::create([
            "key" => "our_vision-title",
            "page" => "main",
            "title" => "Our Vision content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcvt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Vision",
        ]);

        $pcvtg = PageContent::create([
            "key" => "our_vision-tagline",
            "page" => "main",
            "title" => "Our Vision content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcvtg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "This is the future of CIG",
        ]);

        // benefits content
        $pcbt = PageContent::create([
            "key" => "benefits-title",
            "page" => "main",
            "title" => "Benefits content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcbt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Benefits",
        ]);

        $pcbtg = PageContent::create([
            "key" => "benefits-tagline",
            "page" => "main",
            "title" => "Benefits content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcbtg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Awesome thing you get from us",
        ]);

        // products content
        $pcpt = PageContent::create([
            "key" => "products-title",
            "page" => "main",
            "title" => "Products content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Products",
        ]);

        $pcptg = PageContent::create([
            "key" => "products-tagline",
            "page" => "main",
            "title" => "Products content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcptg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Products",
        ]);

        $pcpb = PageContent::create([
            "key" => "products-button",
            "page" => "main",
            "title" => "Products button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpb->id,
            "type" => "text",
            "name" => "Text",
            "value" => "View all products",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpb->id,
            "type" => "link",
            "name" => "Link",
            "value" => "/products",
        ]);

        // our comodity content
        $pcct = PageContent::create([
            "key" => "comodity-title",
            "page" => "main",
            "title" => "Comodity content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcct->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our Comodity",
        ]);

        $pcctg = PageContent::create([
            "key" => "comodity-tagline",
            "page" => "main",
            "title" => "Comodity content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcctg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "CIG's Specialities",
        ]);


        // our team content
        $pcott = PageContent::create([
            "key" => "our_team-title",
            "page" => "main",
            "title" => "Our team content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcott->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Meet Our Team",
        ]);

        $pcottg = PageContent::create([
            "key" => "our_team-tagline",
            "page" => "main",
            "title" => "Our team content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcottg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Here is the best person",
        ]);

        // our client content
        $pcoct = PageContent::create([
            "key" => "our_client-title",
            "page" => "main",
            "title" => "Our client content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcoct->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Meet Our Client",
        ]);

        $pcoctg = PageContent::create([
            "key" => "our_client-tagline",
            "page" => "main",
            "title" => "Our client content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcoctg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Here is our half",
        ]);

        // article content
        $pcmat = PageContent::create([
            "key" => "article-title",
            "page" => "main",
            "title" => "Article content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcmat->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Article",
        ]);

        $pcmatg = PageContent::create([
            "key" => "article-tagline",
            "page" => "main",
            "title" => "Article content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcmatg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our latest posts",
        ]);

        $pcmab = PageContent::create([
            "key" => "article-button",
            "page" => "main",
            "title" => "Article button (after tagline)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcmab->id,
            "type" => "text",
            "name" => "Text",
            "value" => "View all article",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcmab->id,
            "type" => "link",
            "name" => "Link",
            "value" => "/articles",
        ]);

        //  certification content
        $pcct = PageContent::create([
            "key" => "certification-title",
            "page" => "main",
            "title" => "Certification content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcct->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Certification",
        ]);

        $pcctg = PageContent::create([
            "key" => "certification-tagline",
            "page" => "main",
            "title" => "Certification content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcctg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our certifications",
        ]);

        //  location content
        $pclt = PageContent::create([
            "key" => "location-title",
            "page" => "main",
            "title" => "Location content title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pclt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Location",
        ]);

        $pcltg = PageContent::create([
            "key" => "location-tagline",
            "page" => "main",
            "title" => "Location content tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcltg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "This is where we work",
        ]);

        // products page
        $pcpmt = PageContent::create([
            "key" => "main-title",
            "page" => "products",
            "title" => "Products page title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpmt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Products Catalog",
        ]);

        $pcpmd = PageContent::create([
            "key" => "main-description",
            "page" => "products",
            "title" => "Products page description",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcpmd->id,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Discover a wide range of Indonesia products in our comprehensive catalog. From traditional crafts to modern goods, find the best of Indonesia here.",
        ]);

        $pccf = PageContent::create([
            "key" => "catalog-filters",
            "page" => "products",
            "title" => "Products page filter",
        ]);

        PageContentValue::create([
            "page_content_id" => $pccf->id,
            "type" => "table_filters",
            "name" => "Can Filter by",
            "value" => "comodities,regions",
        ]);

        // article / post page
        $pcamt = PageContent::create([
            "key" => "main-title",
            "page" => "articles",
            "title" => "Articles page title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcamt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Articles",
        ]);

        $pcamd = PageContent::create([
            "key" => "main-description",
            "page" => "articles",
            "title" => "Articles page description",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcamd->id,
            "type" => "textarea",
            "name" => "Description",
            "value" => "Stay up-to-date on the latest products, business insights, activities, and more with our insightful blog posts",
        ]);

        // article page - latest
        $pcalt =  PageContent::create([
            "key" => "latest-title",
            "page" => "articles",
            "title" => "Articles page section latest title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcalt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Latest",
        ]);

        $pcaltg = PageContent::create([
            "key" => "latest-tagline",
            "page" => "articles",
            "title" => "Articles page section latest tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pcaltg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Follow up with our latest news",
        ]);

        // articles page - travel more
        $pctmt = PageContent::create([
            "key" => "travel_more-title",
            "page" => "articles",
            "title" => "Articles page section travel more title",
        ]);

        PageContentValue::create([
            "page_content_id" => $pctmt->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Travel More",
        ]);

        $pctmtg = PageContent::create([
            "key" => "travel_more-tagline",
            "page" => "articles",
            "title" => "Articles page section travel more tagline (after title)",
        ]);

        PageContentValue::create([
            "page_content_id" => $pctmtg->id,
            "type" => "text",
            "name" => "Text",
            "value" => "Our other posts for you",
        ]);
    }
}
