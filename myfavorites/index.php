<?php
ob_start();
include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    if ($logC) {

        $saved = $conn->prepare("SELECT favorites FROM user WHERE phone=:ph OR email=:ph");
        $saved->bindParam(':ph', $logC);
        $saved->execute();
        $saved_result = join("','", explode(' ,', join("", $saved->fetch(PDO::FETCH_ASSOC))));
        $saved_result = substr($saved_result, 0, -3);

        $listen = $conn->prepare("SELECT id,photos,price,title,created,location,area FROM ad WHERE id in ('$saved_result') ORDER BY created DESC");
        $listen->execute();
        $listen_result = $listen->fetchAll();

        $resultQuery = '[';

        foreach ($listen_result as $result) {
            $resultQuery .= <<<t
        {"photos":"$result[photos]","price":"$result[price]","title":"$result[title]","area":"$result[area]", "location":"$result[location]","created":"$result[created]", "id":"$result[id]"},
        t;
        }

        $resultQuery .= ']';
        $resultQuery = preg_replace('/},]/', '}]', $resultQuery);
    }
} catch (PDOException $e) {
    reportError('myFavorites: ' . $e->getMessage());
}
ob_end_flush();
?>


<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('my-favorites') . ' | ' . $_('Amazon')?></title>

 <meta name="description" content="<?=$_('favorites-desc')?>">

 <meta property="og:title" content="<?=$_('my-favorites')?>" />
 <meta name="twitter:title" content="<?=$_('my-favorites')?>">

 <meta property="og:description" content="<?=$_('favorites-desc')?>" />
 <meta name="twitter:description" content="<?=$_('favorites-desc')?>">



 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">

 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
<meta name="twitter:creator" content="@Amazon">


</head>

<body class='saved fav'>
 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {
    include dirname(dirname(__FILE__)) . '/components/nav.php';
}
ob_end_flush()?>


 <main>
  <div class="saved-top">
   <a href="/design/mysearches"><?=$_('saved-searches')?></a>
   <a href="/design/myfavorites" class="active"><?=$_('favorites')?></a>
  </div>
  <hr>



  <section class="saved-searches">

   <?=$resultQuery?>

  </section>

  <div class='no-result'><img alt="" src='../icons/ban.svg'><?=$_('save-ads')?>
  </div>
 </main>


 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>





</body>

</html>