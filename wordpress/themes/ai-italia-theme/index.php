<?php get_header();?>
<div class="breaking-ticker"><span class="ticker-label">🔴 LIVE</span><div class="ticker-wrap" id="live-ticker"><?php $tk=new WP_Query(["posts_per_page"=>8]);while($tk->have_posts()):$tk->the_post();echo "<span class=ticker-item>".get_the_title()." <a href=".get_permalink().">Leggi→</a></span>";endwhile;wp_reset_postdata();$tk2=new WP_Query(["posts_per_page"=>8]);while($tk2->have_posts()):$tk2->the_post();echo "<span class=ticker-item>".get_the_title()."</span>";endwhile;wp_reset_postdata();?></div></div>

<main class="container">
<!-- TREND RADAR -->
<section class="trend-radar">
<div class="section-header"><h2 class="section-title"><span class="section-icon">🎯</span>Radar Trend AI <?php echo date("F Y");?></h2></div>
<div class="radar-grid">
<?php $trends=[["🤖","GPT-5 & LLM","🔥 HOT"],["🖼️","AI Generativa","🔥 HOT"],["🦾","AI Agenti","📈 Rising"],["⚖️","EU AI Act","⚠️ Caldo"],["🔬","AI Scientifica","📈 Rising"],["💼","AI nel Lavoro","🔥 HOT"],["🎮","AI & Gaming","❄️ Cool"],["🔐","AI Security","⚠️ Caldo"],["🚗","Guida Autonoma","📈 Rising"],["🏥","AI Medicina","🔥 HOT"]];
foreach($trends as $t):echo "<div class=radar-item><div class=radar-emoji>".$t[0]."</div><div style=font-weight:700;margin:.5rem 0;font-size:.8rem>".$t[1]."</div><div style=font-size:.7rem>".$t[2]."</div></div>";endforeach;?>
</div></section>

<!-- HERO -->
<section class="hero-section">
<div class="hero-grid">
<div><!-- Featured -->
<?php $feat=new WP_Query(["posts_per_page"=>1]);
while($feat->have_posts()):$feat->the_post();?>
<article class="featured-article">
<div class="featured-image">
<?php if(has_post_thumbnail()):the_post_thumbnail("hero-thumb");
else:echo "<div style=background:linear-gradient(135deg,#6C3AE8,#00D4FF);height:100%;display:flex;align-items:center;justify-content:center;font-size:4rem>🤖</div>";endif;?>
</div>
<div class="featured-content">
<div style="margin-bottom:.75rem"><?php $c=get_the_category();if($c)echo "<span class=badge badge-ai>".$c[0]->name."</span>";?></div>
<h2 class="featured-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
<div class="featured-meta"><span>✍️ <?php the_author();?></span><span>📅 <?php echo get_the_date("d M Y");?></span><span>⏱ <?php echo ai_reading_time();?></span></div>
<p style="color:#A0A0C0"><?php echo wp_trim_words(get_the_excerpt(),30);?></p>
<a href="<?php the_permalink();?>" class="tool-btn" style="margin-top:1rem">Leggi Tutto →</a>
</div></article>
<?php endwhile;wp_reset_postdata();?>
</div>
<div><!-- Sidebar articles -->
<?php $side=new WP_Query(["posts_per_page"=>4,"offset"=>1]);
while($side->have_posts()):$side->the_post();?>
<article style="display:flex;gap:1rem;background:#141428;border:1px solid #2A2A4A;border-radius:8px;padding:1rem;margin-bottom:.75rem">
<div style="width:80px;height:65px;border-radius:8px;overflow:hidden;flex-shrink:0">
<?php if(has_post_thumbnail()):the_post_thumbnail("thumbnail",["style"=>"width:100%;height:100%;object-fit:cover"]);
else:echo "<div style=background:linear-gradient(135deg,#6C3AE8,#00D4FF);width:100%;height:100%;display:flex;align-items:center;justify-content:center>🤖</div>";endif;?>
</div>
<div><h4 style="font-size:.85rem;margin-bottom:.3rem"><a href="<?php the_permalink();?>" style="color:#F0F0FF"><?php the_title();?></a></h4>
<div style="font-size:.75rem;color:#6060A0"><?php echo get_the_date("d M Y");?></div></div>
</article>
<?php endwhile;wp_reset_postdata();?>
</div></div></section>

<!-- ULTIME NOTIZIE -->
<section style="margin:3rem 0">
<div class="section-header"><h2 class="section-title"><span class="section-icon">📰</span>Ultime Notizie AI</h2><a href="<?php echo home_url("/notizie");?>" class="section-link">Tutte le notizie →</a></div>
<div class="grid-3">
<?php $news=new WP_Query(["posts_per_page"=>6,"offset"=>5]);
while($news->have_posts()):$news->the_post();?>
<article class="article-card">
<div class="card-image"><?php if(has_post_thumbnail()):the_post_thumbnail("card-thumb");
else:echo "<div style=background:linear-gradient(135deg,#2A2A4A,#1A1A3A);height:100%;display:flex;align-items:center;justify-content:center;font-size:2.5rem>🤖</div>";endif;?></div>
<div class="card-content">
<div style="font-size:.75rem;color:#6060A0;margin-bottom:.5rem"><?php echo get_the_date("d M Y");?> · <?php echo ai_reading_time();?></div>
<h3 class="card-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
<p style="font-size:.85rem;color:#A0A0C0;flex:1"><?php echo wp_trim_words(get_the_excerpt(),20);?></p>
<div class="card-footer"><span>✍️ <?php the_author();?></span><a href="<?php the_permalink();?>" style="color:#00D4FF">Leggi →</a></div>
</div></article>
<?php endwhile;wp_reset_postdata();?>
</div>
<div style="text-align:center;margin-top:2rem">
<button class="btn-newsletter" onclick="loadMore(this)" data-page="2">Carica Altri Articoli</button>
</div></section>

<!-- STRUMENTI AI GRATIS -->
<section class="tools-section" id="strumenti-gratis">
<div class="section-header"><h2 class="section-title"><span class="section-icon">🛠️</span>Migliori Strumenti AI Gratis</h2><a href="<?php echo home_url("/strumenti-ai");?>" class="section-link">Tutti →</a></div>
<p style="color:#A0A0C0;margin-bottom:2rem">Selezionati con piano gratuito reale — nessuna carta di credito richiesta.</p>
<div class="grid-4">
<?php $tools=[["💬","Claude AI","Chatbot","Alternativa premium a ChatGPT. Piano gratuito generoso.","https://claude.ai"],["🌐","Perplexity AI","Ricerca","Motore di ricerca AI con fonti citate in tempo reale.","https://perplexity.ai"],["🖼️","Adobe Firefly","Immagini","Genera immagini professionali. 25 crediti/mese gratis.","https://firefly.adobe.com"],["🎵","Suno AI","Musica","Crea brani completi da un prompt. 50 canzoni/giorno.","https://suno.ai"],["🎬","Runway ML","Video","Generazione video AI. Piano free con watermark.","https://runwayml.com"],["📝","Notion AI","Produttività","AI per note e documenti inclusa nel piano free.","https://notion.so"],["💻","GitHub Copilot","Coding","Assistente AI per programmatori. Gratis per studenti.","https://github.com/features/copilot"],["🗣️","ElevenLabs","Voce","TTS ultra-realistico. 10.000 char/mese gratis.","https://elevenlabs.io"]];
foreach($tools as $t){
  echo "<div class=tool-card>";
  echo "<div class=tool-free-badge>GRATIS ✓</div>";
  echo "<div class=tool-header><div class=tool-logo>".$t[0]."</div><div><div style=font-weight:800>".$t[1]."</div><div style=font-size:.75rem;color:#6060A0>".$t[2]."</div></div></div>";
  echo "<p class=tool-description>".$t[3]."</p>";
  echo "<a href=".$t[4]." target=_blank rel=noopener class=tool-btn>Prova Gratis →</a>";
  echo "</div>";
}?>
</div></section>

<!-- NEWSLETTER -->
<section class="newsletter-section" id="newsletter">
<h2>📧 Newsletter AI Italia</h2>
<p>Le notizie più importanti sull'AI ogni settimana. Gratis, sempre.</p>
<form class="newsletter-form" method="post">
<input type="email" name="email" placeholder="La tua email..." required>
<button type="submit">Iscriviti Gratis 🚀</button>
</form>
<p style="color:rgba(255,255,255,.6);font-size:.8rem;margin-top:1rem">🔒 Nessuno spam. Disiscrizione in un click.</p>
</section>

</main>
<div class="cookie-banner" id="cookie-banner">
<p class="cookie-text">🍪 Utilizziamo cookie per migliorare la tua esperienza. <a href="/cookie-policy">Cookie Policy</a></p>
<div><button class="btn-cookie-accept" onclick="acceptCookies()">Accetta Tutti</button></div>
</div>
<?php get_footer();?>
