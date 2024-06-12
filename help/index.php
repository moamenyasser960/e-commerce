<?php ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';
ob_end_flush()?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset=UTF-8>
 <meta name=viewport content="width=device-width,initial-scale=1">
 <title><?=$_('help') . ' | ' . $_('amazon')?></title>

 <meta name="description" content="<?=$_('get-help')?>">

 <meta property="og:title" content="<?=$_('help')?>" />
 <meta name="twitter:title" content="<?=$_('help')?>">

 <meta property="og:description" content="<?=$_('get-help')?>" />
 <meta name="twitter:description" content="<?=$_('get-help')?>">


 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">

 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">


</head>

<body>


 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {
    include dirname(dirname(__FILE__)) . '/components/nav.php';
}

ob_end_flush()?>


 <main class='help'>

  <h1><?=$_('help')?></h1>

  <span><?=$_('sell-stuff')?></span>
  <p><?=$_('you-can-sell')?>
  </p>
  <span><?=$_('buy-something')?></span>
  <p><?=$_('you-can-buy')?>
  </p>

  <span><?=$_('how-contact')?></span>

  <?=$_('you-can-contact')?>

 </main>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>
</body>

</html>