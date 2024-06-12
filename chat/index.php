<?php
ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';
ob_end_flush();
?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('my-chats') . ' | ' . $_('amazon')?></title>

 <meta name="description" content="<?=$_('your-chats')?>">


 <meta property="og:title" content="<?=$_('my-chats')?>" />
 <meta name="twitter:title" content="<?=$_('my-chats')?>">

 <meta property="og:description" content="<?=$_('your-chats')?>" />
 <meta name="twitter:description" content="<?=$_('your-chats')?>">


 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">


 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">


</head>

<body id='chat'>

 <?php
ob_start();

if ($mobile) {
    echo '<div id="loader"></div>';
} else {
    include dirname(dirname(__FILE__)) . '/components/header.php';include dirname(dirname(__FILE__)) . '/components/nav.php';
}

ob_end_flush()
?>

 <main>
  <form class="listen-chat-view" enctype="multipart/form-data" method="POST">

   <div class='no-result'>
    <img alt="" src="../icons/ban.svg">
    <?=$_('specific-chat')?>
   </div>

   <div class='not'>
    <div class="listen-chat-head">

     <div class="listen-chat-top">

      <div>
       <span onclick="history.back()">
        <img src="../icons/chevron.svg" alt="<?=$_('back')?>" width="16">
       </span>
       <a id='userId'>
        <img src="../icons/pngkey.com-user-png-729670.svg" class="seller" alt="<?=$_('seller')?>">
        <span id='name'></span>
       </a>
      </div>


      <div>

       <button type='button' id='delete-ico' onclick="toggle('.delete-ad', 'flex')" class='red-on'><img alt=""
         src="../icons/exclamation-triangle.svg"><span class='none'> <?=$_('delete-chat')?></span></button>

       <div><a id='tel'><img src="../icons/telephone.svg" alt="<?=$_('call')?>" width="28">
        </a>
        <span onclick="toggle('.chat', 'block')" class="chat-ico">
         <img src="../icons/chat-square-dots.svg" alt="<?=$_('chats')?>"><span
          class='chat-ico-act'><?=$unreadM?></span></span>
       </div>
      </div>

     </div>

     <hr>

     <a class="listen-chat-header">

      <img class='img' alt="<?=$_('ad-photo')?>">
      <div>
       <p class='listen-title'></p>
       <b class='price'></b>
      </div>

      <img src="../icons/chevron.svg" alt="<?=$_('back')?>" width="28" class="rotate">

     </a>

     <hr>
    </div>


    <div id="listen-chat">
     <?=$resultQuery?>
    </div>

   </div>

   <div class="listen-chat-bottom"
    onmouseleave="remove('.send-image', 'none');remove('.send-voice', 'none');add('.send-image-in', 'v-none')">

    <button onclick="toggle('.send-attachment', 'flex')" type="button" title="<?=$_('send-media')?>"><img width="36"
      src="../icons/paper-clip.svg" alt="<?=$_('media')?>"></button>

    <label for="message" class="emojis">
     <span title="<?=$_('enter-emoji')?>" onclick="toggle('.emojis-in', 'flex')">☺️</span>
     <textarea
      onkeydown="remove('.emojis-in', 'flex');add('.send-image', 'none');add('.send-voice', 'none'); add('.send-image-in', 'flex');remove('.send-image-in', 'v-none')"
      name="message" id="message" placeholder="<?=$_('type-message')?>"
      title="<?=$_('type-message')?>"><?=$_('still-available')?></textarea>


     <button type="button" title="<?=$_('send')?>" id="submit-listen-chat" class="blue"><img src="../icons/send.svg"
       alt="<?=$_('send')?>"></button>

     <div class="emojis-in">
      <span>👋</span>
      <span>😄</span>
      <span>🤝</span>
      <span>😊</span>
      <span>❤️</span>
     </div>

    </label>

    <div onmouseleave="add('.send-attachment', 'none');remove('.send-attachment', 'flex')" class="send-attachment">

     <input type="file" name='upload[]' id="send-video" accept="video/*">

     <label for="send-video" title="<?=$_('send-video')?>"><img src="../icons/camera-video.svg"
       alt="<?=$_('video')?>"><?=$_('video')?></label>

     <button type="button" id="send-location" title="<?=$_('your-current-location')?>">
      <img src="../icons/location-ico.svg" alt="<?=$_('current-location')?>"><span
       id="send-location-res"><?=$_('current-location')?></span>
     </button>


     <input type="file" name='upload[]' id="send-audio" accept="audio/*">

     <label for="send-audio" title="<?=$_('send-audio')?>"><img src="../icons/microphone.svg"
       alt="<?=$_('audio')?>"><?=$_('audio')?></label>



     <input type="file" name='upload[]' id="send-document">

     <label for="send-document" title="<?=$_('send-document')?>"><img src="../icons/file-earmark.svg"
       alt="<?=$_('document')?>"><?=$_('document')?></label>

     <label class="send-image-in v-none" for="send-image-in" title="<?=$_('send-image')?>"><img width="36"
       src="../icons/camera.svg" alt="<?=$_('send-image')?>"><?=$_('camera')?></label>

     <input type="file" name='upload[]' id="send-image-in" accept="image/*">

    </div>

    <label for="send-image" class="send-image" title="<?=$_('send-image')?>"><img width="36" src="../icons/camera.svg"
      alt="<?=$_('send-image')?>"></label>

    <input type="file" name='upload[]' id="send-image" accept="image/*">



    <label for="send-voice" class='send-voice' title="<?=$_('send-voice')?>"><img src="../icons/microphone.svg"
      alt="<?=$_('send-voice')?>"></label>

    <input type="file" name='upload[]' id="send-voice" accept="audio/*">



    <span id="alert-location" class="alert"></span>
   </div>

   <div class='delete-ad'>
    <p><?=$_('sure-delete-chat')?></p>
    <div>
     <span onclick="toggle('.delete-ad', 'flex')"><?=$_('no')?></span>
     <button type='submit' id='delete'><?=$_('yes')?></button>
    </div>
   </div>
  </form>



  <div class="chat">
   <div class="chat-top">
    <span onclick="toggle('.chat', 'block')">
     <img src="../icons/chevron.svg" alt="<?=$_('back')?>" width="16">
    </span> &nbsp;
    <?=$_('your-chats')?>
    <hr>
    <div class="chat-type">
     <span id='allS' class="active"><?=$_('all')?></span>
     <span id='buys'><?=$_('buy')?></span>
     <span id='sales'><?=$_('sell')?></span>
    </div>
   </div>
   <div class="chat-in">

    <div class="chat-status">
     <span id='allR' class="active"><?=$_('all')?></span>
     <span id='unreadMes'><?=$_('unread-messages')?></span>
    </div>

    <div class="no-result">
     <img alt="" src="../icons/ban.svg">
     <?=$_('no-chat')?>
    </div>

    <?=$chatRight?>


    <input type="hidden" name='sales'>

   </div>
  </div>
 </main>
 <?php
ob_start();
if ($mobile) {
    echo '<script src="/design/js/script.js"></script>';
} else {
    include dirname(dirname(__FILE__)) . '/components/footer.php';
}

ob_end_flush()
?>



</body>

</html>