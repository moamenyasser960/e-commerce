<?php
ob_start();

include dirname(dirname(__FILE__)) . '/components/head.php';

$removeId = input($_POST['remove']);

try {

    if ($removeId) {
        $remove = $conn->prepare("DELETE FROM ad WHERE id=:id");
        $remove->bindParam(':id', $removeId);
        $remove->execute();
        $remove = null;
    }

    $sort = input($_GET['sort']);
    $sorted = 'created';
    if ($sort) {
        if ($sort == 'latest') {
            $sorted = 'created';
        } else {
            $sorted = $sort;
        }
    }

    $listen = $conn->prepare("SELECT id,photos,price,title,created,views,favorites,display_number,chats FROM ad WHERE user_id=:ad ORDER BY $sorted DESC");
    $listen->bindParam(':ad', $userId);

    $listen->execute();

    $listen_result = $listen->fetchAll();

    $resultQuery = '[';

    foreach ($listen_result as $result) {
        $resultQuery .=<<<r
        { "photos":"$result[photos]", "price":"$result[price]", "id":"$result[id]", "title":"$result[title]", "chats":"$result[chats]", "display_number":"$result[display_number]", "views":"$result[views]", "favorites":"$result[favorites]", "created":"$result[created]" },
    r;
    }

    $listen = null;

    $resultQuery .= ']';
    $resultQuery = preg_replace('/},]/', '}]', $resultQuery);

    $t = $conn->prepare("SELECT SUM(seen) FROM chat WHERE user=:us AND ad not in (SELECT id from ad WHERE user_id=:us) AND seen=1");
    $t->bindParam(':us', $userId);
    $t->execute();
    $tr = $t->fetch()['SUM(seen)'];
    $t = null;
} catch (PDOException $e) {
    reportError('myAds.php: '.$e->getMessage());
}
ob_end_flush();?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('my-ads'). ' | '. $_('amazon')?></title>

 <meta name="description" content="<?=$_('myads-desc')?>">

 <meta property="og:title" content="<?=$_('my-ads')?>" />
 <meta name="twitter:title" content="<?=$_('my-ads')?>">

 <meta property="og:description" content="<?=$_('myads-desc')?>" />
 <meta name="twitter:description" content="<?=$_('myads-desc')?>">



 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
<meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">

 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

<?=$cssDevice?>
<meta name="twitter:creator" content="@Amazon">

</head>

<body class='myads'>
 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {
    include dirname(dirname(__FILE__)) . '/components/nav.php';
}
ob_end_flush()?>


 <main>
  <section class="dash-over-view">
   <span>overview</span>
   <a href='/design/chat/'><img alt="" src="../icons/chat-square-dots.svg" class="invert"><?=$_('new-chats')?> <span
     id='new-chats'><?=$tr?></span></a>
   <div><img alt="" src="../icons/telephone.svg"><?=$_('show-number')?><span id='show-number'>0</span>
   </div>

   <div><img alt="" src="../icons/eye.svg"><?=$_('views')?><span id='views'>0</span>
   </div>

   <div><img alt="" src="../icons/heart.svg"><?=$_('favorites')?><span id='favorites'>0</span>
   </div>


  </section>

  <div class='sort'>
   <span onclick="toggle('.sort-by', 'block')" class='blue-on'><img alt="" src="../icons/sort.svg"> <?=$_('sort-by')?></span>

   <div class="sort-by">
    <span onclick="toggle('.sort-by', 'block')"><img src="../icons/x.svg" width="46" class="invert" alt="<?=$_('close')?>"></span>
    <a class='latest'><?=$_('by-date')?></a>
    <hr>
    <a class='views'><?=$_('by-views')?></a>
    <hr>
    <a class='display-namber'><?=$_('by-show')?></a>
    <hr>
    <a class='favorites'><?=$_('by-favorites')?></a>
    <hr>
    <a class='chats'><?=$_('by-chats')?></a>
   </div>
  </div>

  <div class='no-result'>
   <img alt="" src="../icons/ban.svg">
   <?=$_('no-ads')?>
  </div>

  <section>

   <form action='../sell/' method='POST' id="dash-cards">
    <?=$resultQuery?>
   </form>

   <form method='POST' class='delete-ad'>
    <p><?=$_('delete-ad')?></p>
    <button type='submit' id='delete-ad' name='remove'><?=$_('yes')?></button>
    <span onclick="remove('.delete-ad', 'block')"><?=$_('no')?></span>
   </form>
  </section>


 </main>


 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>





</body>

</html>