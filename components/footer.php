<footer>

 <a onclick="backTop()" class="footer-to-top">
  <img alt="" src="/design/icons/drop-down.svg" class="rotate"><br><?=$_('back-top')?>
 </a>

 <div class="footer-one">

  <a href="/design/"><img src="/design/images/android-chrome-192x192.png" alt="<?=$_('home')?>" width="50"></a>

  <div class="footer-follow">
   <?=$_('follow-us')?>
   <a>
    <img src="/design/icons/Facebook-logo.svg" width="36" alt="<?=$_('follow-us')?>">
   </a>
   <a>
    <img src="/design/icons/twitter.svg" width="48" alt="<?=$_('twitter')?>">
   </a>
  </div>

 </div>

 <nav class="footer-about">
  <bl>
   <a href="/design/aboutus/"><?=$_('about-us')?></a>
   <a href="/design/contactus/"><?=$_('contact-us')?></a>
  </bl>
  <bl style="text-align: end">
   <a href="/design/sitemap/"><?=$_('site-map')?></a>
   <a href="/design/help/"><?=$_('help')?></a>
  </bl>
 </nav>


 <article class="footer-download">
    <a href=""><img src="/design/icons/iconAppStoreEN.svg" alt="App Store" width="128"></a>
    <a href=""><img src="/design/icons/iconGooglePlayEN.svg" width="128" alt="Google Play"></a>
    <a href=""><img src="/design/icons/iconAppGallery.svg" width="128" alt="App Gallery"></a>
  </article>

 <article class="footer-copy">
  <div><a href="/design/useconditions/"><?=$_('use-conditions')?></a> | <a
    href="/design/privacy/"><?=$_('privacy-police')?></a></div>
  <div><?=$_('rights-reserved')?></div>
 </article>

</footer>

<?php
if ($signIn) {
    include dirname(dirname(__FILE__)) . '/components/sign.php';
}
?>

<script src="/design/js/script.js"></script>

<noscript>
 <div class='no-result flex'>
  <img src="/design/icons/ban.svg" alt="">
  <?=$_('support-js')?>
 </div>
</noscript>