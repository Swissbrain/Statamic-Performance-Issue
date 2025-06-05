<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Statamic\Assets\AssetContainer;
use Statamic\Eloquent\Entries\EntryModel;
use Statamic\Eloquent\Globals\GlobalSetModel;
use Statamic\Eloquent\Globals\VariablesModel;
use Statamic\Eloquent\Structures\NavModel;
use Statamic\Eloquent\Structures\TreeModel;

class StatamicSeeder extends Seeder
{
    public function run(): void
    {
        $home = EntryModel::firstOrCreate(['id' => 1] ,[
            'id' => 1,
            'site' => 'default',
            'published' => true,
            'slug' => 'home',
            'uri' => '/',
            'date' => null,
            'order' => 1,
            'collection' => 'website',
            'blueprint' => 'website',
            'data' => json_decode('{"title":"Home","og_image":null,"og_title":null,"subtitle":null,"seo_title":null,"updated_by":1,"seo_noindex":false,"page_builder":[],"seo_nofollow":false,"schema_jsonld":null,"og_description":null,"seo_description":null,"sitemap_priority":0.5,"seo_canonical_type":"entry","seo_canonical_current":null,"show_subcontent_title":false,"seo_canonical_external":null,"sitemap_change_frequency":"weekly","header_title_background_image":null,"content_builder":[{"id":"m3e8ocgj","animate_images":true,"show_pagination":true,"show_navigation":true,"center_slider":false,"aspect_ratio":"three_to_one","entry_type":"image_with_link","images":["test.jpg","test.jpg"],"type":"image_slider","enabled":true,"width":25,"height":11,"slides":[{"id":"m7iu37of","setting_buttons":"title","image":"test.jpg","image_color_overlay":{"use_color_overlay":false,"color":"#000000","opacity":30},"entry_title":"Kaffeemaschinen und Service\nfür jedes Bedürfnis","text_position":"bottom-center","text_alignment":"left","font_color":"#ffffff","linking":{"link":null,"link_text":null,"title":null,"direction":"left","variant":"primary","target_blank":false,"spacer_feld":null,"icon":null,"icon_position":"left","show_advanced_settings":null,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"space_top":"medium","space_bottom":"medium"},"type":"entry","enabled":true},{"id":"m3o7uemv","setting_buttons":"image","image":"test.jpg","image_color_overlay":{"use_color_overlay":false,"color":"#000000","opacity":30},"entry_title":"Immer Zeit für ein Gespräch","entry_subtitle":"Unsere Kunden liegen uns am Herzen","text_position":"center-center","text_alignment":"left","font_color":"#000000","linking":{"link":"tel:0712448030","link_text":"Beratungsgespräch buchen","title":null,"direction":"left","variant":"primary","target_blank":false,"spacer_feld":null,"icon":"phone","icon_position":"left","show_advanced_settings":null,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"space_top":"medium","space_bottom":"medium"},"type":"entry","enabled":true,"button_alignment":"right"},{"id":"m3ohlgp6","setting_buttons":"image","image":"test.jpg","image_color_overlay":{"use_color_overlay":true,"color":"#000000","opacity":6},"text_alignment":"left","font_color":"#ffffff","linking":{"link":null,"link_text":null,"title":null,"direction":"left","variant":"primary","target_blank":false,"spacer_feld":null,"icon":null,"icon_position":"left","show_advanced_settings":null,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"space_top":"medium","space_bottom":"medium"},"type":"entry","enabled":true,"entry_title":"Grosse Auswahl in unserem Geschäft","text_position":"center-center"}],"space_top":"none","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7erzce4","title":"Die richtige Wahl ist entscheidend","subtitle":"Jeder Kaffee ist so perfekt wie die Maschine","title_positioning":"center","show_in_bold":false,"space_top":"medium","space_bottom":"medium","type":"title_subtitle","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7es2zgu","wysiwyg":"<p style=\"text-align: center;\">Ein Siebträger oder doch lieber einen Vollautomaten? Beide Kaffeesysteme haben in jeder Hinsicht ihren Reiz; Design, Zubereitungsart, technologische Finessen und vieles mehr.<br>So vielfältig wie die Kaffeemaschinen und Vorlieben ist auch unser Sortiment und die Beratung. Inklusive Vermietung an Events. Schauen Sie einfach <a target=\"_blank\" href=\"https://maps.app.goo.gl/QBeJR7PgoBcTM8nx6\">vorbei </a>oder schnuppern Sie in unserem <a target=\"_blank\" href=\"https://shop.kafi.ch/de/categories\">Shop</a>. <br><br></p>","space_top":"medium","space_bottom":"medium","type":"wysiwyg","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7f0gryv","variation":"solid","thickness":"1px","width":"medium","with_logo":true,"space_top":"medium","space_bottom":"large","type":"divider","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e72efo","columns":3,"image_setting":{"aspect_ratio":"two_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"description_custom":null,"width":null,"height":null},"images":[{"id":"m3e72hnc","settings":"link","title_setting":{"title":"Siebträger","subtitle":"Jetzt ist die richtige Zeit zum Kaufen. Gewinnen Sie jetzt einen Gutschein für eine Siebträgermaschine","text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"left","variant":"lines"},"link_setting":{"linking_link":"entry::9","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":true,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"image":"test.jpg","space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e72m3i","settings":"title","title_setting":{"title":"Vollautomaten","subtitle":null,"text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"center","variant":"lines"},"link_setting":{"linking_link":"entry::10","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":true,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"image":"test.jpg","space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e72nyt","image":"test.jpg","settings":"title","title_setting":{"title":"JURA Kaffeewelt","subtitle":null,"text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"left","variant":"lines"},"link_setting":{"linking_link":"entry::3","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":true,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7eqcdjw","settings":"link","title_setting":{"title":"Mühlen & Zubehör","subtitle":null,"text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"center","variant":"lines"},"link_setting":{"linking_link":"entry::32","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"two_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":true,"color":"#000000","opacity":37,"full_width":false},"space_top":"medium","space_bottom":"medium","type":"image","enabled":true,"image":"test.jpg","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7envb1k","settings":"link","title_setting":{"title":"Service","subtitle":null,"text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"center","variant":"lines"},"link_setting":{"linking_link":"entry::12","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"one_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"space_top":"medium","space_bottom":"medium","type":"image","enabled":true,"image":"test.jpg","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7eqwjm1","image":"test.jpg","settings":"title","title_setting":{"title":"Kaffeebohnen","subtitle":null,"text_fuer_backend_feld":null,"text_position":"center-center","text_alignment":"center","variant":"lines"},"link_setting":{"linking_link":null,"linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"two_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"space_top":"medium","space_bottom":"medium","type":"image","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"image_grid","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7exys5x","variation":"solid","thickness":"1px","space_top":"large","space_bottom":"medium","type":"divider","enabled":true,"width":"medium","with_logo":false,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7ey7pg2","columns":[{"id":"m7ey7r1k","column_size":"1/2","sub_content_builder":[{"id":"m7ey7zmb","title":"Rafinesse und Eleganz","subtitle":"Von Espresso bis Milchkaffee","title_positioning":"center","show_in_bold":false,"space_top":"medium","space_bottom":"medium","type":"title_subtitle","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7ey9kng","wysiwyg":"<p>Genuss auf Knopfdruck: Mit einem Vollautomaten holen Sie das Beste aus jeder Bohne – frisch gemahlen, individuell abgestimmt, und immer in Top-Qualität. Die Maschine passt sich Ihren Wünschen an: von der Brühstärke bis zur Kaffeemenge. Keine Kompromisse, keine halben Sachen. Ein Vollautomat macht jeden Tag ein bisschen besser – und jede Tasse zu einem echten Highlight.</p>","space_top":"medium","space_bottom":"medium","type":"wysiwyg","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7kb7wod","positioning":"center","links":[{"id":"m7kb81u7","link_text":"Jura Vollautomaten","direction":"left","variant":"primary","target_blank":false,"icon":"shopping-cart","icon_position":"left","space_top":"medium","space_bottom":"medium","type":"link","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7kb8xi1","link_text":"Andere Vollautomaten","direction":"left","variant":"primary","target_blank":false,"icon_position":"left","space_top":"medium","space_bottom":"medium","type":"link","enabled":true,"icon":"shopping-bag","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"buttons","enabled":true}],"type":"column","enabled":true},{"id":"m7eyktnk","column_size":"1/2","sub_content_builder":[{"id":"m7eykyhi","image":"test.jpg","settings":"image","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":null,"linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"two_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"space_top":"medium","space_bottom":"medium","type":"image","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"column","enabled":true}],"space_top":"large","space_bottom":"large","type":"columns","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7ex1js5","space_top":"large","space_bottom":"large","type":"columns","enabled":true,"columns":[{"id":"m7ex6zkc","column_size":"1/2","sub_content_builder":[{"id":"m7exprpa","settings":"image","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":null,"linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"two_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"space_top":"medium","space_bottom":"medium","type":"image","enabled":true,"image":"test.jpg","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"column","enabled":true},{"id":"m7exwgax","column_size":"1/2","sub_content_builder":[{"id":"m7exwwjq","title":"Ein Style wie in den 50\'s","subtitle":"Für Desing Freaks","title_positioning":"center","show_in_bold":false,"space_top":"medium","space_bottom":"medium","type":"title_subtitle","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7exxbcn","wysiwyg":"<p>Sanft geschwungenen Formen und klaren Linien wie in den 50s Jahren. In der Retrolook Verpackung steckt ein echtes Barista-Tool. Gradgenaue Themperaturvorwahl, einstellbare elektronische Pre-Infusion, Shot-Clock, Portionierelektronik für zwei Mengen, ein Profi-Siebträger und die von aussen zugängliche Brühdruckregulierung bieten alles, was zur optimalen Extraktion hochwertiger Espressi benötigt wird<strong><br><br></strong>Ein &quot;Muss&quot; für alle, die den Style und die Formen des letzten Jahrhunderts lieben.</p>","space_top":"medium","space_bottom":"medium","type":"wysiwyg","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7kbexc8","positioning":"right","links":[{"id":"m7kbf41j","link_text":"Retro erkunden","direction":"left","variant":"secondary","target_blank":true,"icon":"shopping-cart","icon_position":"left","space_top":"medium","space_bottom":"medium","type":"link","enabled":true,"link":"https://shop.kafi.ch/de/categories?q=retro","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"buttons","enabled":true}],"type":"column","enabled":true}],"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3ohd9zb","columns":[{"id":"m3ogsxsj","column_size":"1/2","sub_content_builder":[{"id":"m3oguhqv","title":"Schnell und unkompliziert","subtitle":"Wenn\'s brennt","title_positioning":"center","show_in_bold":false,"space_top":"medium","space_bottom":"medium","type":"title_subtitle","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3oh1eq4","wysiwyg":"<p>Bei uns zähen Serviceleistungen und Reparaturen genauso zu guten Ton wie die Beratung. Deshalb betreiben wir eine eigenen Werkstatt mit Profis und erstklassigen Komponenten für eine schnelle und gerätespezifische Reparatur.</p><p>Kurz gesagt: Bei uns erhalten Sie nicht nur hochwertige Kaffeemaschinen, sondern auch einen umfassenden Service und qualitative Reparaturen.</p>","space_top":"medium","space_bottom":"medium","type":"wysiwyg","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7kbhd50","positioning":"center","links":[{"id":"m7kbhf3b","link":"tel:071 2448030","link_text":"Der direkte Draht in die Werkstatt","direction":"left","variant":"primary","target_blank":false,"icon":"phone","icon_position":"left","space_top":"medium","space_bottom":"medium","type":"link","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"buttons","enabled":true}],"type":"column","enabled":true},{"id":"m3ogxmgr","column_size":"1/2","sub_content_builder":[{"id":"m7vn0zdj","video_setting":"video_local","video_local":null,"space_top":"medium","space_bottom":"medium","type":"video","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"column","enabled":true}],"type":"columns","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7eyudjp","variation":"solid","thickness":"1px","space_top":"medium","space_bottom":"medium","type":"divider","enabled":true,"width":"medium","with_logo":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m7kgq1ls","video_setting":"video_local","space_top":"medium","space_bottom":"medium","type":"video","enabled":true,"video_local":null,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e9bqgb","title":"Kaffeewelt","subtitle":"Brühen & Geniessen","title_positioning":"center","show_in_bold":false,"type":"title_subtitle","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e91yo7","columns":5,"image_setting":{"aspect_ratio":"one_to_one","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"description_custom":null,"width":null,"height":null},"images":[{"id":"m3e92e1f","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e96i42","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e92hqq","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e95vqr","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e9358r","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e93g2d","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e944ag","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e95ksp","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e95s08","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3e96nvw","image":"test.jpg","settings":"link","title_setting":{"title":null,"subtitle":null,"text_fuer_backend_feld":null,"text_position":null,"text_alignment":"left","variant":"simple"},"link_setting":{"linking_link":"https://shop.kafi.ch/de/categories","linking_link_text":null,"linking_title":null,"linking_direction":"left","linking_variant":"primary","linking_target_blank":false,"linking_spacer_feld":null,"linking_icon":null,"linking_icon_position":"left","linking_show_advanced_settings":null,"linking_visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"linking_space_top":"medium","linking_space_bottom":"medium"},"image_setting":{"aspect_ratio":"sixteen_to_nine","description_1_1":null,"description_2_1":null,"description_3_1":null,"description_4_1":null,"beschreibung_benutzerdefiniert":null,"width":1,"height":1,"use_color_overlay":false,"color":"#000000","opacity":30,"full_width":false},"type":"image","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"type":"image_grid","enabled":true,"space_top":"medium","space_bottom":"medium","visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}},{"id":"m3pz4gb8","space_top":"medium","space_bottom":"medium","type":"instagram_feed","enabled":true,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true}}],"show_space_bordering":false,"popup":true,"popup_title":"Neuheit","popup_wysiwyg":[{"type":"paragraph","attrs":{"textAlign":"left"},"content":[{"type":"text","marks":[{"type":"bold"}],"text":"Die neue J10 Piano Black (SA) "},{"type":"hardBreak"},{"type":"text","text":"Die Königin der Vollautomaten jetzt bei uns im Shop. "}]}],"popup_button":{"link":"https://beta.kafi.ch/jura/haushalt/j10-piano-black-sa-40","link_text":"Offerte einholen","title":null,"direction":"left","variant":"primary","target_blank":false,"spacer_feld":null,"icon":"shopping-cart","icon_position":"left","show_advanced_settings":null,"visibility":{"mobile":true,"tablet":true,"laptop":true,"desktop":true},"space_top":"medium","space_bottom":"medium"},"exclude_from_search":false,"popup_image":null}'),
        ]);

        $notFound = EntryModel::firstOrCreate(['id' => 2] ,[
            'id' => 2,
            'site' => 'default',
            'published' => true,
            'slug' => 'not-found',
            'uri' => 'not-found',
            'date' => null,
            'order' => 2,
            'collection' => 'website',
            'blueprint' => 'website',
            'data' => [
                'title' => '404',
                'parent' => null,
                'og_image' => null,
                'og_title' => null,
                'subtitle' => null,
                'seo_title' => null,
                'updated_by' => 1,
                'seo_noindex' => false,
                'page_builder' => [],
                'seo_nofollow' => false,
                'schema_jsonld' => null,
                'og_description' => null,
                'seo_description' => null,
                'sitemap_priority' => 0.5,
                'seo_canonical_type' => 'entry',
                'seo_canonical_current' => null,
                'show_subcontent_title' => false,
                'seo_canonical_external' => null,
                'sitemap_change_frequency' => 'weekly',
                'header_title_background_image' => null,
            ],
        ]);

        /*
         * Create the main and bottom navigation
         */
        $mainNav = NavModel::firstOrCreate(['id' => 1], [
            'id' => 1,
            'handle' => 'main',
            'title' => 'Kopfzeile',
            'settings' => [
                'collections' => ['website'],
                'max_depth' => 3,
            ],
        ]);

        $bottomNav = NavModel::firstOrCreate(['id' => 2], [
            'id' => 2,
            'handle' => 'bottom',
            'title' => 'Fusszeile',
            'settings' => [
                'collections' => ['website'],
                'max_depth' => 2,
            ],
        ]);

        /*
         * Create the trees for the navigations and the pages
         */
        TreeModel::firstOrCreate(['id' => 1], [
            'id' => 1,
            'handle' => 'main',
            'type' => 'navigation',
            'locale' => 'default',
            'tree' => [
                [
                    'entry' => $home->id,
                ],
            ],
        ]);

        TreeModel::firstOrCreate(['id' => 2], [
            'id' => 2,
            'handle' => 'bottom',
            'type' => 'navigation',
            'locale' => 'default',
            'tree' => [
                [
                    'id' => '1',
                    'title' => 'Seiten',
                    'children' => [
                        [
                            'id' => '1',
                            'entry' => $home->id,
                        ],
                    ],
                ],
            ],
        ]);

        TreeModel::firstOrCreate(['id' => 3], [
            'id' => 3,
            'handle' => 'website',
            'type' => 'collection',
            'locale' => 'default',
            'tree' => [
                [
                    'entry' => $home->id,
                ],
                [
                    'entry' => $notFound->id,
                ],
            ],
        ]);

        /*
         * Create the global sets
         */
        $globalBrowser = GlobalSetModel::firstOrCreate(['id' => 1], [
            'id' => 1,
            'handle' => 'browser_appearance',
            'title' => 'Browser Appearance',
            'settings' => [],
        ]);

        $globalConfig = GlobalSetModel::firstOrCreate(['id' => 2], [
            'id' => 2,
            'handle' => 'configuration',
            'title' => 'Configuration',
            'settings' => [],
        ]);

        $globalRedirects = GlobalSetModel::firstOrCreate(['id' => 3], [
            'id' => 3,
            'handle' => 'redirects',
            'title' => 'Redirects',
            'settings' => [],
        ]);

        $globalSeo = GlobalSetModel::firstOrCreate(['id' => 4], [
            'id' => 4,
            'handle' => 'seo',
            'title' => 'SEO',
            'settings' => [],
        ]);

        $globalSocial = GlobalSetModel::firstOrCreate(['id' => 5], [
            'id' => 5,
            'handle' => 'social_media',
            'title' => 'Social Media',
            'settings' => [],
        ]);

        $globalCompany = GlobalSetModel::firstOrCreate(['id' => 6], [
            'id' => 6,
            'handle' => 'company',
            'title' => 'Company',
            'settings' => [],
        ]);

        /*
         * Create the variables for the global sets
         */
        VariablesModel::firstOrCreate(['id' => 1], [
            'id' => 1,
            'handle' => $globalBrowser->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [
                'title_options' => 'text',
                'website_title' => 'Cool Website',
                'base_colors' => [
                    'primary' => '#eddd5e',
                    'secondary' => '#5b8c51',
                    'accent' => '#404a3d',
                ],
                'font_colors' => [
                    'body_font_color' => '#404a3d',
                    'primary_font_color' => '#404a3d',
                    'secondary_font_color' => '#5b8c51',
                ],
                'component_colors' => [
                    'header_background_color' => '#404a3d',
                    'header_text_color' => '#fafafa',
                    'footer_background_color' => '#757c75',
                    'footer_text_color' => '#fafafa',
                    'sub_footer_background_color' => '#404a3d',
                    'sub_footer_text_color' => '#fafafa',
                    'sidebar_background_color' => '#404a3d',
                    'sidebar_item_color' => '#404a3d',
                    'sidebar_item_hover_color' => '#5b8c51',
                    'sidebar_text_color' => '#fafafa',
                ],
                'disable_telephone_detection' => false,
                'disable_email_detection' => false,
                'disable_address_detection' => false,
                'display_standalone' => false,
                'use_theme_color' => false,
                'use_favicons' => false,
            ],
        ]);

        VariablesModel::firstOrCreate(['id' => 2], [
            'id' => 2,
            'handle' => $globalConfig->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [
                'imprint_type' => 'none',
                'imprint_asset' => null,
                'imprint_entry' => null,
                'error_404_entry' => $notFound->id,
                'cookie_notice_type' => 'none',
                'cookie_notice_asset' => null,
                'cookie_notice_entry' => null,
                'privacy_statement_type' => 'none',
                'privacy_statement_asset' => null,
                'privacy_statement_entry' => null,
            ],
        ]);

        VariablesModel::firstOrCreate(['id' => 3], [
            'id' => 3,
            'handle' => $globalRedirects->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [],
        ]);

        VariablesModel::firstOrCreate(['id' => 4], [
            'id' => 4,
            'handle' => $globalSeo->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [
                'use_fathom' => false,
                'breadcrumbs' => false,
                'use_sitemap' => true,
                'json_ld_type' => 'none',
                'tracker_type' => 'none',
                'hreflang_auto' => true,
                'noindex_local' => true,
                'use_plausible' => false,
                'trackers_local' => false,
                'noindex_staging' => true,
                'title_separator' => '·',
                'trackers_staging' => false,
                'noindex_production' => false,
                'use_consent_banner' => false,
                'sitemap_collections' => ['website'],
                'trackers_production' => true,
                'use_social_image_generation' => false,
                'use_cloudflare_web_analytics' => false,
                'use_google_site_verification' => false,
            ],
        ]);

        VariablesModel::firstOrCreate(['id' => 5], [
            'id' => 5,
            'handle' => $globalSocial->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [
                'social_media' => [
                    [
                        'id' => 'trJdEAn4',
                        'type' => 'github',
                        'handle' => 'studio1902',
                        'prefix' => 'https://www.github.com/',
                        'enabled' => false,
                    ],
                ],
            ],
        ]);

        VariablesModel::firstOrCreate(['id' => 6], [
            'id' => 6,
            'handle' => $globalCompany->handle,
            'locale' => 'default',
            'origin' => null,
            'data' => [
                'company_name' => null,
                'street_adress' => null,
                'zip_code' => null,
                'city' => null,
                'email' => null,
                'phone_number' => null,
            ],
        ]);

        if (!\Statamic\Facades\AssetContainer::find('images')) {
            $container = \Statamic\Facades\AssetContainer::make('images')
                ->title('Images')
                ->disk('images')
                ->allowUploads(true)
                ->createFolders(true)
                ->sourcePreset(true)
                ->warmPresets(null);

            $container->save();

            \DB::table('statamic_assets_meta')->insert([
                'container' => 'images',
                'folder' => '/',
                'basename' => 'test.jpg',
                'filename' => 'test',
                'extension' => 'jpg',
                'path' => 'test.jpg',
                'meta' => '{"data":[],"size":179816,"last_modified":1749128896,"width":1472,"height":832,"mime_type":"image\/jpeg","duration":null}'
            ]);
            copy(public_path('test.jpg'), storage_path('app/public/images/test.jpg'));
        }

        if (!\Statamic\Facades\AssetContainer::find('avatars')) {
            $container = \Statamic\Facades\AssetContainer::make('avatars')
                ->title('Avatars')
                ->disk('avatars')
                ->allowUploads(true)
                ->createFolders(true)
                ->sourcePreset(true)
                ->warmPresets(null);

            $container->save();
        }

        if (!\Statamic\Facades\AssetContainer::find('movies')) {
            $container = \Statamic\Facades\AssetContainer::make('movies')
                ->title('Movies')
                ->disk('movies')
                ->allowUploads(true)
                ->createFolders(true)
                ->sourcePreset(true)
                ->warmPresets(null);

            $container->save();
        }

        if (!\Statamic\Facades\AssetContainer::find('documents')) {
            $container = \Statamic\Facades\AssetContainer::make('documents')
                ->title('Documents')
                ->disk('documents')
                ->allowUploads(true)
                ->createFolders(true)
                ->sourcePreset(true)
                ->warmPresets(null);

            $container->save();
        }

    }
}
