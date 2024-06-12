<?php ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';
ob_end_flush()?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset=UTF-8>
 <meta name=viewport content="width=device-width,initial-scale=1">
 <title><?=$_('use-conditions') . ' | '.$_('amazon')?></title>

 <meta name="description" content="<?=$_('conditions-desc')?>">

 <meta property="og:title" content="<?=$_('use-conditions')?>" />
 <meta name="twitter:title" content="<?=$_('use-conditions')?>">

 <meta property="og:description" content="<?=$_('conditions-desc')?>" />
 <meta name="twitter:description" content="<?=$_('conditions-desc')?>">


 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">


 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">

</head>

<body id='use'>
 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {} else {
 include dirname(dirname(__FILE__)) . '/components/nav.php';
}

ob_end_flush()?>

 <main class=privacy>

  <?=$_('main-conditions')?>

 </main>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>
</body>

</html>