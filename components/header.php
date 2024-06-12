<div id="loader">
 <div class="loader-span"></div>
</div>

<header class="header">
 <div class="flex">
  <a href="/design">
   <img src="/design/images/android-chrome-192x192.png" alt="<?=$_('home')?>" width="46" />
  </a>

  <div title="<?=$_('chose-location')?>" onclick="toggle('.header-map','block');" class="location-header">
   <div>
    <img alt="" src="/design/icons/location-ico.svg" width="24" class="invert" />

    <span><?=$_('egypt')?></span>
    <img alt="" src="/design/icons/drop-down.svg" />

    <span class="header-map"></span>

    <div class="header-map">
     <a id="cairo"><?=$_('cairo')?><fw>❭</fw></a>

     <a id="giza"><?=$_('giza')?><fw>❭</fw></a>

     <a id="sharqia"><?=$_('sharqia')?><fw>❭</fw></a>

     <a id="dakahlia"><?=$_('dakahlia')?><fw>❭</fw></a>

     <a id="beheira"><?=$_('beheira')?><fw>❭</fw></a>

     <a id="minya"><?=$_('minya')?><fw>❭</fw></a>

     <a id="qalyubia"><?=$_('qalyubia')?><fw>❭</fw></a>

     <a id="sohag"><?=$_('sohag')?><fw>❭</fw></a>

     <a id="alexandria"><?=$_('alexandria')?><fw>❭</fw></a>

     <a id="gharbia"><?=$_('gharbia')?><fw>❭</fw></a>

     <a id="asyut"><?=$_('asyut')?><fw>❭</fw></a>

     <a id="monufia"><?=$_('monufia')?><fw>❭</fw></a>

     <a id="faiyum"><?=$_('faiyum')?><fw>❭</fw></a>

     <a id="kafr-el-sheikh"><?=$_('kafr-el-sheikh')?><fw>❭</fw></a>

     <a id="qena"><?=$_('qena')?><fw>❭</fw></a>

     <a id="beni-suef"><?=$_('beni-suef')?><fw>❭</fw></a>

     <a id="damietta"><?=$_('damietta')?><fw>❭</fw></a>

     <a id="aswan"><?=$_('aswan')?><fw>❭</fw></a>

     <a id="ismailia"><?=$_('ismailia')?><fw>❭</fw></a>

     <a id="luxor"><?=$_('luxor')?><fw>❭</fw></a>

     <a id="suez"><?=$_('suez')?><fw>❭</fw></a>

     <a id="port-said"><?=$_('port-said')?><fw>❭</fw></a>

     <a id="matrouh"><?=$_('matrouh')?><fw>❭</fw></a>

     <a id="north-sinai"><?=$_('north-sinai')?><fw>❭</fw></a>

     <a id="red-sea"><?=$_('red-sea')?><fw>❭</fw></a>

     <a id="new-valley"><?=$_('new-valley')?><fw>❭</fw></a>

     <a id="south-sinai"><?=$_('south-sinai')?><fw>❭</fw></a>
    </div>
   </div>
  </div>
 </div>

 <div onmouseleave="remove('.hamburger-menu', 'block');add('.hamburger-menu', 'none')" class="header-hamburger">
  <a onclick="toggle('.log', 'flex')" href="#" class="sign-in-header">
   <span><?=$_('sign in')?> ›</span>
   <img alt="" src="/design/icons/pngkey.com-user-png-729670.svg" class="invert" width="36" />
  </a>
  <span onclick="toggle('.hamburger-menu', 'block')">≡</span>
  <form method="POST" class="hamburger-menu">
   <div class="listen-seller">
    <img alt="" src="/design/icons/pngkey.com-user-png-729670.svg" alt="<?=$_('seller')?>" class="seller" />
    <div>
     <b><?=$_('welcome')?><span id="welName"><?=$user['name']?></span>.</b>

     <a href="/design/mysettings/"><?=$_('my-settings')?><ri>❭</ri></a>
    </div>
   </div>

   <hr />

   <a href="/design/sell">
    <img alt="" src="/design/icons/camera.svg" />
    <?=$_('sellNow')?>
   </a>
   <a href="/design/myfavorites">
    <img alt="" src="/design/icons/heart.svg" />
    <?=$_('my-favorites')?>
   </a>
   <a href="/design/mysearches">
    <img alt="" src="/design/icons/search.svg" />
    <?=$_('my-searches')?>
   </a>
   <a href="/design/myads">
    <img alt="" src="/design/icons/rectangle-list.svg" />
    <?=$_('my-ads')?>
   </a>
   <a href="/design/chat" class="my-chat">
    <img alt="" src="/design/icons/chat-square-dots.svg" />
    <span>
     <?=$unreadM?>
    </span>
    <?=$_('my-chats')?>
   </a>
   <a href="/design/help">
    <img alt="" src="/design/icons/info-circle.svg" />
    <?=$_('help')?>
   </a>

   <hr />
   <a id="lang"><img src="/design/icons/globe.svg" alt="<?=$_('language')?>" /><b><?=$_('lang') === 'AR' ? 'EN': 'AR'?></b></a>

   <hr />

   <?=$logIn?>
  </form>
 </div>

 <div class="search-top">
  <select title="<?=$_('chose-category')?>" class="selectCategory">
   <option value="all"><?=$_('all')?></option>
   <option value="vehicles"><?=$_('vehicles')?></option>
   <option value="properties"><?=$_('properties')?></option>
   <option value="mobiles-tablets"><?=$_('mobiles-tablets')?></option>
   <option value="electronics-appliances"><?=$_('electronics-appliances')?></option>
   <option value="furniture-decor"><?=$_('furniture-decor')?></option>
   <option value="business-industrial-agriculture"><?=$_('business-industrial-agriculture')?></option>
   <option value="books-sports-hobbies"><?=$_('books-sports-hobbies')?></option>
   <option value="pets-accessories"><?=$_('pets-accessories')?></option>
   <option value="kids-babies"><?=$_('kids-babies')?></option>
   <option value="fashion-beauty"><?=$_('mobiles-tablets')?></option>
   <option value="services"><?=$_('services')?></option>
   <option value="jobs"><?=$_('jobs')?></option>
  </select>

  <div class="search-header-res">
   <input type="search" name="search" placeholder="<?=$_('search-for')?>" autocomplete="off" class="search-header" />

   <div class="search-result trend-result"></div>
  </div>
  <button type="submit" id="search" title="<?=$_('search-now')?>">
   <img src="/design/icons/search.svg" width="32" class="invert" alt="<?=$_('search')?>" style="max-width: 28px" />
  </button>
 </div>

 <?=$error?>
 <?=$signIn?>
 <?=$sell?>
</header>