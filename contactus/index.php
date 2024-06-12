<?php
ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $name = input($_POST['name']);
        $email = input($_POST['email']);
        $message = input($_POST['message']);

        $send = $conn->prepare("INSERT INTO contact(message, name, email, user_id) VALUES (:me,:na,:em,:id)");
        $send->bindParam(':me', $message);
        $send->bindParam(':na', $name);
        $send->bindParam(':em', $email);
        $send->bindParam(':id', $userId);
        $send->execute();

        header('Location: /design?success=send-message');
        exit;
    }
} catch (PDOException $e) {
    reportError('contactUs.php: ' . $e->getMessage());
}

ob_end_flush();
?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('contact-us') . ' | ' . $_('amazon')?></title>

 <meta name="description" content="<?=$_('contact-desc') . ' | ' . $_('amazon')?>">

 <meta property="og:title" content="<?=$_('contact-us')?>" />
 <meta name="twitter:title" content="<?=$_('contact-us')?>">

 <meta property="og:description" content="<?=$_('contact-desc')?>." />
 <meta name="twitter:description" content="<?=$_('contact-desc')?>.">

 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png"/>
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

 <form onsubmit="toggle('.thanks', 'block')" class="contact-us" method='POST'>
  <h1><?=$_('contact-us')?></h1>
  <textarea placeholder="<?=$_('type-message')?>" name='message' minlength="1" autofocus required></textarea>
  <br>
  <br>
  <label><?=$_('your-name')?><input type="text" name="name"></label>

  <br>
  <br>
  <label><?=$_('mobile-email')?><input type="text" autocomplete="email" name='email'></label>
  <br>
  <br>
  <input type="submit">
  <p><?=$_('via-email')?> <a href="mailto:moamenyasser960@gmail.com"><?=$_('@amazon')?></a></p>

</form>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>

</body>

</html>