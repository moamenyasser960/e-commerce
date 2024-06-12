<?php
ob_start();include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    if ($logC) {

        $userIn = $conn->prepare("SELECT name,phone,email,password FROM user WHERE id=:id");
        $userIn->bindParam(':id', $userId);
        $userIn->execute();
        $in = $userIn->fetch();
        $userIn = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = input($_POST['name']);
            $phone = input($_POST['phone']);
            $email = input($_POST['email']);
            $password = input($_POST['password']);

            $query = 'UPDATE user SET ';
            if ($name) {
                $query .= "name=\"$name\", ";
            }
            if ($phone) {
                $query .= "phone=\"$phone\", ";
            }
            if ($email) {
                $query .= "email=\"$email\", ";
            }
            if ($password) {
                $query .= "password=\"$password\", ";
            }

            $query .= "WHERE id=:id";
            $query = preg_replace('/\, WHERE/i', ' WHERE', $query);

            $userIn = $conn->prepare($query);
            $userIn->bindParam(':id', $userId);
            $userIn->execute();

            header('Location: /design?success=edit-settings');
            exit;
        }
    }

} catch (PDOException $e) {
    reportError('mySettings.php: ' . $e->getMessage());
}

ob_end_flush();?>

<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title><?=$_('my-settings') . ' | ' . $_('amazon')?></title>

 <meta name="description" content="<?=$_('settings-desc')?>">

 <meta property="og:title" content="<?=$_('my-settings')?>" />
 <meta name="twitter:title" content="<?=$_('my-settings')?>">

 <meta property="og:description" content="<?=$_('settings-desc')?>" />
 <meta name="twitter:description" content="<?=$_('settings-desc')?>">

 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">


 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">


</head>

<body id='settings'>

 <?php
ob_start();
if ($mobile) {
    echo '<div id="loader"></div>';
} else {
    include dirname(dirname(__FILE__)) . '/components/header.php';include dirname(dirname(__FILE__)) . '/components/nav.php';
}
ob_end_flush()
?>

 <form class="sell-form" method="post" autocomplete="off">
  <div class="sell-top">
   <span onclick="history.back()"><img src="../icons/chevron.svg" width="24px" alt="<?=$_('back')?>"></span>
   <h2><?=$_('your-profile')?></h2>
  </div>
  <br>

  <div>

   <h1><?=$_('edit-profile')?></h1>

   <br>

   <div class="seller-in">
    <img class="seller" src="../icons/pngkey.com-user-png-729670.svg" alt="<?=$_('user')?>">
    <div>
     <label><?=$_('your-name')?> <input required value="<?=$in['name']?>" name='name' type="text">
     </label>
    </div>
   </div>

   <label><?=$_('your-number')?> <input required value="<?=$in['phone']?>" id='seller-phone' pattern="[0-9]{0,}"
     type="tel" name='phone' minlength="9" maxlength='16'>
    <span class="inv"></span></label>

   <br>
   <br>

   <label><?=$_('your-email')?> <input value='<?=$in['email']?>' placeholder="<?=$_('example-mail')?>" name='email'
     type="email"></label>

   <br>
   <br>

   <hr>
   <br>
   <h3><?=$_('change-password')?></h3>
   <br>

   <label><?=$_('current-password')?> <input type="text" readonly value='<?=$in['password']?>' minlength="6">
   </label>

   <br>
   <br>
   <br>

   <label><?=$_('new-password')?><input type="password" required id='editPass' minlength="6">
    <span class="inv"></span></label>


   <br>
   <label><?=$_('retype-new-password')?> <input type="password" id='editPassTwo' name='password' required minlength="6">
    <span class="inv"></span></label>

   <br>
   <br>


   <button class="btn submit" type="submit"><?=$_('edit-now')?></button>
  </div>

 </form>

 <?php
ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush();

?>

</body>

</html>