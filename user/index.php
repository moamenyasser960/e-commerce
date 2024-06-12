<?php
ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    $user_id = input($_GET['user-id']);
    $u = $conn->prepare("SELECT name,phone,created FROM user WHERE id=:id");
    $u->bindParam(':id', $user_id);
    $u->execute();
    $userRes = $u->fetch();

    $listen = $conn->prepare("SELECT id,photos,price,title,created,location,area FROM ad WHERE user_id=:id ORDER BY created DESC");
    $listen->bindParam(':id', $user_id);
    $listen->execute();
    $listen_result = $listen->fetchAll();

    $listen = null;

    if ($listen_result) {
        $resultQuery = '[';

        foreach ($listen_result as $result) {
            $fn = $conn->prepare("SELECT favorites FROM user WHERE favorites REGEXP '$result[id] ,' AND id=:id");
            $fn->bindParam(':id', $userId);
            $fn->execute();

            $t = "class='card-fav' type='submit' name='id'";
            if ($fn->fetchColumn() > 0) {
                $t = "class='card-fav-fill' type='submit' name='remove'";
            }
            $resultQuery .= <<<t
            {"photos":"$result[photos]","price":"$result[price]","title":"$result[title]","area":"$result[area]", "location":"$result[location]","created":"$result[created]", "id":"$result[id]", "class":"$t"},
            t;
        }
        $resultQuery .= ']';
        $resultQuery = preg_replace('/},]/', '}]', $resultQuery);
        $userName = $userRes['name'];
    }
} catch (PDOException $e) {reportError('user.php: ' . $e->getMessage());}

ob_end_flush();

?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$userName . ' ' . $_('profile') . ' | ' . $_('amazon')?></title>

 <meta name="description" content="<?=$_('user-ads-desc')?>">


 <meta property="og:title" content="<?=$userName . ' ' . $_('profile')?>" />
 <meta name="twitter:title" content="<?=$userName . ' ' . $_('profile')?>">

 <meta property="og:description" content="<?=$_('user-ads-desc')?>" />
 <meta name="twitter:description" content="<?=$_('user-ads-desc')?>">

 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">
 <?=$cssDevice?>
<meta name="twitter:creator" content="@Amazon">


</head>

<body id='u'>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {
    include dirname(dirname(__FILE__)) . '/components/nav.php';
}
ob_end_flush()?>

 <main class="listen-view">
  <section class="listen-content">
   <article class="listen-seller">
    <img src="../icons/pngkey.com-user-png-729670.svg" alt="<?=$_('seller')?>" class='seller'>
    <div>
     <div>
      <b>
       <?=$userName?>
      </b>
      <br>
      <span><?=$_('member-since')?> <span class='date'><?=$userRes['created']?></span>
      </span>
      <br>
      <br>
     </div>

     <div style=" position: relative; ">
      <span onclick="toggle('.listen-share', 'flex')">
       <img class="share" width="24" src="../icons/share-svgrepo-com.svg" alt="<?=$_('share')?>">
      </span>
      <div class="listen-share arrow-top">
       <a id="shareTW" target="_blank" title="<?=$_('share-x')?>">
        <img src="../icons/twitter.svg" alt="<?=$_('share-x')?>">
      </a>
       <a id="shareFB" target="_blank" title="<?=$_('share-face')?>">
        <img src="../icons/Facebook-logo.svg" alt="<?=$_('share-face')?>">
      </a>
       <a id="shareMS" target="_blank" title="<?=$_('share-mess')?>">
        <img src="../icons/messenger.svg" alt="<?=$_('share-mess')?>">
      </a>
       <a id="shareWA" target="_blank" title="<?=$_('share-whats')?>">
        <img src="../icons/WhatsApp.svg" style=" width: 2.35rem; height: 2.35rem; " alt="<?=$_('share-whats')?>">
      </a>
      </div>
     </div>
    </div>
    <span id="show-PhNu" class="btn">
     <img alt="" src="../icons/telephone.svg" class="invert"><span id="show-PhNu-sh"> <?=$_('showPhone')?></span>
    </span>

    <a id="listen-sms" class="outline-btn blue"><img alt="" src="../icons/chat-square-dots.svg"> <?=$_('sms')?></a>

   </article>
  </section>
  <section class="card-layer">
   <article class="cards-category">
    <h2><?=$_('user-ads')?></h2>
   </article>
   <article class="cards-row">
    <?=$resultQuery?>
   </article>


   <span class="listen-call none" id="<?=$userRes['phone']?>"></span>

  </section>
 </main>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>

</body>

</html>