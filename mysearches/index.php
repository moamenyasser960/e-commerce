<?php
ob_start();
include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    if ($logC) {
        $saved = $conn->prepare("SELECT searches FROM user WHERE phone=:ph OR email=:ph");
        $saved->bindParam(':ph', $logC);
        $saved->execute();

        $saved_result = join(" -^- ", explode(' ,', join("", $saved->fetch(PDO::FETCH_ASSOC))));
    }
} catch (PDOException $e) {reportError('mySearches.php: ' . $e->getMessage());}

ob_end_flush();?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('saved-searches'). ' | '. $_('amazon')?></title>

 <meta name="description" content="<?=$_('saved-searches-desc')?>">

 <meta property="og:title" content="<?=$_('saved-searches')?>" />
 <meta name="twitter:title" content="<?=$_('saved-searches')?>">

 <meta property="og:description" content="<?=$_('saved-searches-desc')?>" />
 <meta name="twitter:description" content="<?=$_('saved-searches-desc')?>">


 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">

 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
<meta name="twitter:creator" content="@Amazon">


</head>

<body class='saved searches'>
 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {
    include dirname(dirname(__FILE__)) . '/components/nav.php';
}
ob_end_flush()?>


 <main>
  <div class="saved-top">

   <a href="/design/mysearches" class="active"><?=$_('saved-searches')?></a>
   <a href="/design/myfavorites"><?=$_('favorites')?></a>
  </div>
  <hr>
  <section class="saved-searches">

   <?=$saved_result?>

  </section>
  <div class='no-result'><img alt="" src='../icons/ban.svg'><?=$_('save-searches')?></div>
 </main>





 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>



</body>

</html>