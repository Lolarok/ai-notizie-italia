<?php
// AI Notizie Italia - Theme Functions v1.0.0

function ai_italia_setup(){
  load_theme_textdomain("ai-italia",get_template_directory()."/languages");
  add_theme_support("automatic-feed-links");
  add_theme_support("title-tag");
  add_theme_support("post-thumbnails");
  add_theme_support("html5",["search-form","comment-form","gallery","caption"]);
  register_nav_menus(["primary"=>"Menu Principale","footer"=>"Footer Menu"]);
  set_post_thumbnail_size(1200,630,true);
  add_image_size("card-thumb",400,250,true);
  add_image_size("hero-thumb",800,500,true);
}
add_action("after_setup_theme","ai_italia_setup");

function ai_italia_scripts(){
  wp_enqueue_style("gfonts","https://fonts.googleapis.com/css2?family=Inter:wght@700;800;900&family=Nunito:wght@400;700&display=swap",[],null);
  wp_enqueue_style("ai-style",get_stylesheet_uri(),[],"1.0.0");
  wp_enqueue_script("ai-main",get_template_directory_uri()."/js/main.js",["jquery"],"1.0.0",true);
  wp_localize_script("ai-main","aiItalia",["ajaxurl"=>admin_url("admin-ajax.php"),"nonce"=>wp_create_nonce("ai_nonce")]);
}
add_action("wp_enqueue_scripts","ai_italia_scripts");

register_sidebar(["name"=>"Sidebar","id"=>"sidebar-1","before_widget"=>"<div class=widget>","after_widget"=>"</div>","before_title"=>"<h3>","after_title"=>"</h3>"]);
function ai_tool_cpt(){
  register_post_type("ai_tool",["labels"=>["name"=>"Strumenti AI","add_new_item"=>"Aggiungi Strumento"],"public"=>true,"show_in_rest"=>true,"has_archive"=>true,"supports"=>["title","editor","thumbnail","excerpt"],"menu_icon"=>"dashicons-admin-tools","rewrite"=>["slug"=>"strumenti-ai"]]);
}
add_action("init","ai_tool_cpt");

function ai_reading_time($id=null){
  $w=str_word_count(strip_tags(get_post_field("post_content",$id?:get_the_ID())));
  return max(1,round($w/200))." min di lettura";
}

function ai_seo(){
  if(!is_single()&&!is_page())return;
  $d=wp_trim_words(get_the_excerpt(),25);
  echo "<meta name=description content=".esc_attr($d).">
";
  echo "<meta property=og:title content=".esc_attr(get_the_title()).">
";
  echo "<meta name=twitter:card content=summary_large_image>
";
}
add_action("wp_head","ai_seo",5);

add_filter("excerpt_length",fn()=>25,999);
add_filter("excerpt_more",fn()=>"...");

function ai_schema(){
  if(!is_single())return;
  $s=["@context"=>"https://schema.org","@type"=>"NewsArticle",
    "headline"=>get_the_title(),"datePublished"=>get_the_date("c"),
    "dateModified"=>get_the_modified_date("c"),
    "author"=>["@type"=>"Person","name"=>get_the_author()]];
  echo "<script type=application/ld+json>".json_encode($s)."</script>
";
}
add_action("wp_head","ai_schema");
