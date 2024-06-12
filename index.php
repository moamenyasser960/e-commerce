<?php
ob_start();include dirname(__FILE__) . '/components/head.php';

try {
    function cardsRow($category)
    {
        global $l, $_;
        $userId = $GLOBALS['userId'];
        $listen = $GLOBALS['conn']->prepare("SELECT id,photos,price,title,created,location,area FROM ad WHERE category='$category' ORDER BY created DESC LIMIT 4");
        $listen->execute();
        $listen_result = $listen->fetchAll();

        if ($listen_result) {
            $resultQuery = '[';
            foreach ($listen_result as $result) {
                $fn = $GLOBALS['conn']->prepare("SELECT favorites FROM user WHERE favorites REGEXP '$result[id] ,' AND id=:id");
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
        }
        echo $resultQuery;
    }

} catch (PDOException $e) {reportError('home.php: ' . $e->getMessage());}

ob_end_flush();
?>

<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">

 <title><?=$_('head-tit')?></title>

 <meta name="description" content="<?=$_('head-desc')?>">

 <meta property="og:title" content="<?=$_('head-tit')?>" />
 <meta name="twitter:title" content="<?=$_('head-tit')?>">

 <meta property="og:description" content="<?=$_('head-desc')?>" />
 <meta name="twitter:description" content="<?=$_('head-desc')?>">

 <meta property="og:image" content="http://localhost/design/images/home.jpeg" />
 <meta name="twitter:image" content="http://localhost/design/images/home.jpeg">
 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">

 <?php include dirname(__FILE__) . '/components/head.html'?>

</head>

<body>

 <?php ob_start();
include dirname(__FILE__) . '/components/header.php';include dirname(__FILE__) . '/components/nav.php';
ob_end_flush();?>

 <main class="home vert-card">

  <section class="listen-image">

   <article class="listen-images-in">

    <a href="/design/ads/">
     <img src="images/home.jpeg" alt="<?=$_('amazon-buy-sell')?>">
    </a>

    <a href="/design/ads/?category=vehicles">
     <img src="images/vehicles.jpeg" alt="<?=$_('buy-vehicles')?>">
    </a>

    <a href="/design/ads/?category=properties">
     <img src="images/properties.jpeg" alt="<?=$_('buy-properties')?>">
    </a>


    <a href="/design/ads/?category=mobiles-tablets">
     <img src="images/mobiles.jpeg" alt="<?=$_('buy-mobiles')?>">
    </a>

    <a href="/design/ads/?category=electronics-appliances">
     <img src="images/electronics.jpeg" alt="<?=$_('buy-electronics')?>">
    </a>


    <a href="/design/ads/?category=furniture-decor">
     <img src="images/furniture.jpeg" alt="<?=$_('buy-furniture')?>">
    </a>

    <a href="/design/ads/?category=business-industrial-agriculture">
     <img src="images/business.jpeg" alt="<?=$_('buy-business')?>">
    </a>


    <a href="/design/ads/?category=jobs">
     <img src="images/jobs.jpeg" alt="<?=$_('find-jobs')?>">
    </a>

    <a href="/design/ads/?category=fashion-beauty">
     <img src="images/fashion.jpeg" alt="<?=$_('buy-fashion')?>">
    </a>


    <a href="/design/ads/?category=pets-accessories">
     <img src="images/pets.jpeg" alt="<?=$_('buy-pets')?>">
    </a>

    <a href="/design/ads/?category=kids-babies">
     <img src="images/kids.jpeg" alt="<?=$_('buy-kids-needs')?>">
    </a>


    <a href="/design/ads/?category=services">
     <img src="images/services.jpeg" alt="<?=$_('buy-services')?>">
    </a>

    <a href="/design/ads/?category=books-sports-hobbies">
     <img src="images/books.jpeg" alt="<?=$_('buy-books')?>">
    </a>
   </article>


   <div class="listen-image-number">
    <img alt="<?=$_('photos')?>" src="icons/camera.svg">
    <span id="listen-image-numbers"></span>
   </div>

   <span id="prevButton">❮</span>
   <span id="nextButton">❯</span>

  </section>

  <section class="cards">

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=properties'><?=$_('properties')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('properties')?>
    </article>
   </article>


   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=vehicles'><?=$_('vehicles')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('vehicles')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=mobiles-tablets'><?=$_('mobiles-tablets')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('mobiles-tablets')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=electronics-appliances'><?=$_('electronics-appliances')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('electronics-appliances')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=furniture-decor'><?=$_('furniture-decor')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('furniture-decor')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=business-industrial-agriculture'><?=$_('business-industrial-agriculture')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('business-industrial-agriculture')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=fashion-beauty'><?=$_('fashion-beauty')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('fashion-beauty')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=pets-accessories'><?=$_('pets-accessories')?>
      <ri>❭</ri>
     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('pets-accessories')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=kids-babies'><?=$_('kids-babies')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('kids-babies')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=books-sports-hobbies'><?=$_('books-sports-hobbies')?>
      <ri>❭</ri>
     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('books-sports-hobbies')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=jobs'><?=$_('jobs')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('jobs')?>
    </article>
   </article>

   <article class="card-layer">

    <article class="cards-category">
     <a href='/design/ads/?category=services'><?=$_('services')?>
      <ri>❭</ri>

     </a>
    </article>

    <article class="cards-row">
[{"photos":"0 -^- ad.svg","price":"20","title":"a thing for sall in california in united states of america","area":"california", "location":"america","created":"2024-06-09T20:17:28.935Z", "id":"1", "class":"class='card-fav-fill' type='submit' name='remove'"}]
    <?php cardsRow('services')?>
    </article>
   </article>


  </section>

 </main>



 <a class="sell-on-fly btn" href='/design/sell'>
  <img alt="" src="icons/camera.svg">
  <?=$_('sellNow')?>
 </a>

 <?php
$message = $_GET['success'];

if ($message == 'modified') {
    echo "<div class='thanks'><b>{$_('modified')}</b></div>";
} elseif ($message == 'publish') {
    echo "<div class='thanks'><b>{$_('published')}</b></div>";
} elseif ($message == 'edit-settings') {
    echo "<div class='thanks'><b>{$_('profileModified')}</b></div>";
} elseif ($message == 'send-message') {
    echo " <div class='thanks'><p><b>{$_('thanks')}!</b><br>{$_('sent')}</p></div>";
}
?>

 <?php ob_start();include dirname(__FILE__) . '/components/footer.php'?>

</body>

</html>