// AI Notizie Italia - Main JavaScript v1.0.0
"use strict";

// COOKIE BANNER
(function(){
  const b=document.getElementById("cookie-banner");
  if(b&&!localStorage.getItem("ai-cookies")) setTimeout(()=>b.style.display="flex",2000);
})();
function acceptCookies(){localStorage.setItem("ai-cookies","all");document.getElementById("cookie-banner").style.display="none";}
function declineCookies(){localStorage.setItem("ai-cookies","necessary");document.getElementById("cookie-banner").style.display="none";}

// STICKY HEADER SHADOW
window.addEventListener("scroll",()=>{
  const h=document.getElementById("site-header");
  if(h) h.style.boxShadow=window.scrollY>50?"0 4px 30px rgba(108,58,232,.3)":"none";
});

// READING PROGRESS BAR
const bar=document.createElement("div");
bar.style.cssText="position:fixed;top:70px;left:0;height:3px;background:linear-gradient(90deg,#6C3AE8,#00D4FF);z-index:999;transition:width .1s ease;width:0%";
document.body.appendChild(bar);
document.addEventListener("scroll",()=>{
  const total=document.documentElement.scrollHeight-window.innerHeight;
  bar.style.width=Math.min(100,(window.scrollY/total)*100)+"%";
});

// ANIMATE ON SCROLL
const obs=new IntersectionObserver(entries=>{
  entries.forEach(e=>{if(e.isIntersecting){e.target.style.animation="fadeInUp .6s ease forwards";obs.unobserve(e.target);}});
},{threshold:.1});
document.querySelectorAll(".article-card,.tool-card,.radar-item").forEach(el=>{el.style.opacity="0";obs.observe(el);});

// LOAD MORE
function loadMore(btn){
  const page=parseInt(btn.dataset.page||2);
  btn.textContent="Caricamento..."; btn.disabled=true;
  const fd=new FormData();
  fd.append("action","ai_load_more");
  fd.append("page",page);
  fd.append("nonce",typeof aiItalia!=="undefined"?aiItalia.nonce:"");
  fetch(typeof aiItalia!=="undefined"?aiItalia.ajaxurl:"/wp-admin/admin-ajax.php",{method:"POST",body:fd})
  .then(r=>r.text()).then(html=>{
    if(html.trim()){
      btn.closest("section").querySelector(".grid-3").insertAdjacentHTML("beforeend",html);
      btn.dataset.page=page+1; btn.textContent="Carica Altri"; btn.disabled=false;
    } else { btn.textContent="Nessun altro articolo"; }
  }).catch(()=>{btn.textContent="Riprova";btn.disabled=false;});
}

// SHARE
function share(platform,url,title){
  const u=encodeURIComponent(url||location.href),t=encodeURIComponent(title||document.title);
  const urls={twitter:,linkedin:,telegram:,whatsapp:};
  if(urls[platform]) window.open(urls[platform],"_blank","width=600,height=400");
}

// SMOOTH SCROLL
document.querySelectorAll("a[href^="#"]").forEach(a=>a.addEventListener("click",e=>{e.preventDefault();const t=document.querySelector(a.getAttribute("href"));if(t)t.scrollIntoView({behavior:"smooth"});}));

console.log("%c🤖 AI Notizie Italia v1.0","color:#6C3AE8;font-weight:900;font-size:14px");
