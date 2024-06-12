<?php
ob_start();
include dirname(dirname(__FILE__)) . '/components/head.php';

try {

    $ad = input($_GET['ad']);

    if ($ad) {
        $sql = $conn->prepare("SELECT id,photos,price,title,created,location,area,category,subcategory,branch,type,brand,installment,status,deliverable,description,favorites,contact,user_id,views FROM ad WHERE title=:t; UPDATE ad SET views = views + 1 WHERE title=:t");
        $sql->bindParam(':t', $ad);
        $sql->execute();
        $ad = $sql->fetch();
        $sql = null;

        $id = $ad['id'];

        $sqlUS = $conn->prepare("SELECT id,phone,created,name FROM user WHERE id=(SELECT user_id FROM ad WHERE id=:i)");
        $sqlUS->bindParam(':i', $id);
        $sqlUS->execute();
        $adUS = $sqlUS->fetch();
        $sqlUS = null;

        $query = "SELECT id,photos,price,title,created,location,area FROM ad WHERE id!=:id AND category=:ca AND subcategory=:suca AND ";

        if ($ad['branch']) {
            $query .= "branch=:br AND ";
        }
        if ($ad['type']) {
            $query .= "type=:ty AND ";
        }
        $query .= "ORDER BY views DESC LIMIT 5";

        $query = preg_replace('/AND ORDER/i', 'ORDER', $query);

        $listen = $conn->prepare($query);

        if ($ad['branch']) {
            $listen->bindParam(':br', $ad['branch']);
        }
        if ($ad['type']) {
            $listen->bindParam(':ty', $ad['type']);
        }

        $listen->bindParam(':id', $id);
        $listen->bindParam(':ca', $ad['category']);
        $listen->bindParam(':suca', $ad['subcategory']);
        $listen->execute();

        $resultQuery = '';
        $listen_result = $listen->fetchAll();

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
        }

    }

    $fa = $conn->prepare("SELECT favorites FROM user WHERE favorites REGEXP '$ad[id] ,' AND id=:id");
    $fa->bindParam(':id', $userId);
    $fa->execute();
    if ($fa->fetchColumn() > 0) {
        $n = "class='card-fav-fill' type='submit' name='remove' value='$ad[id]'";
    } else {
        $n = "class='card-fav' type='submit' name='id' value='$ad[id]'";
    }

    if ($ad['photos']) {
        $firstImg = 'http://localhost/design/uploads/' . explode(' -^- ', $ad['photos'])[explode(' -^- ', $ad['photos'])[0] + 1];
    } else {
        $firstImg = 'http://localhost/design/images/android-chrome-192x192.png';
        $noAd = '<div class="no-result flex fill"><img alt="" src="/design/icons/ban.svg">' . $_('no-ad') . '</div>';
    }

    $report = input($_POST['report']);
    if ($report) {
        $sql = $conn->prepare("INSERT INTO reports(type,comment,ad_id) values(:ty,:co,:id)");
        $sql->bindParam(':ty', $report);
        $sql->bindParam(':co', input($_POST['comment']));
        $sql->bindParam(':id', $id);
        $sql->execute();
        echo "<div class='thanks'><b>$_(thanks)!</b><br>$_(weReport)</div>";
    }

    $connect = $ad['contact'];
} catch (PDOException $e) {
    echo 'no';
    // reportError('ad.php: ' . $e->getMessage());
}

ob_end_flush();
?>

<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?=ucwords($ad['title'])?> | <?=$_('amazon')?></title>
    <meta name="description" content="<?=$ad['description']?> | <?=$_('amazon')?>">

    <meta property="og:title" content="<?=ucwords($ad['title'])?>" />
    <meta name="twitter:title" content="<?=ucwords($ad['title'])?>">

    <meta property="og:description" content="<?=$ad['description']?>" />
    <meta name="twitter:description" content="<?=$ad['description']?>">

    <meta property="og:image" content="<?=$firstImg?>" />
    <meta name="twitter:image" content="<?=$firstImg?>">

    <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

    <?=$cssDevice?>
    <meta name="twitter:creator" content="@<?=$adUS['name']?>">
</head>

<body id='ad'>

    <?php
ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';
if ($mobile) {
} else {include dirname(dirname(__FILE__)) . '/components/nav.php';}
ob_end_flush()
?>

    <?=$noAd ? $noAd : ''?>

    <div class="directory <?=$noAd ? 'none' : ''?>">
        <?php
ob_start();
if (!$noAd) {
    echo $_('dir-top') . "<a href='/design/ads/?category=$ad[category]'>{$_($ad['category'])}</a><a href='/design/ads/?category=$ad[category]&subcategory=$ad[subcategory]'>{$_($ad['subcategory'])}</a>";
    if ($ad['type'] && $ad['branch']) {echo "<a href='/design/ads/?category=$ad[category]&subcategory=$ad[subcategory]&branch=$ad[branch]'>{$_($ad['branch'])}</a><a href='/design/ads/?category=$ad[category]&subcategory=$ad[subcategory]&branch=$ad[branch]&type=$ad[type]'>{$_($ad['type'])}</a>";} else {
        if ($ad['branch']) {echo "<a href='/design/ads/?category=$ad[category]&subcategory=$ad[subcategory]&branch=$ad[branch]'>{$_($ad['branch'])}</a>";}
        if ($ad['type']) {echo "<a href='/design/ads/?category=$ad[category]&subcategory=$ad[subcategory]&type=$ad[type]'>{$_($ad['type'])}</a>";}
    }
}
ob_end_flush()
?>
    </div>
    <main class="listen-view vert-card <?=$noAd ? 'none' : ''?>">

        <section class="listen-image">

            <span class="close-up-right"
                onclick="toggle('.listen-image','open-slide'); toggle('.close-up-right', 'block');"><img
                    src="../icons/x.svg" alt="<?=$_('close')?>"></span>

            <article class="listen-images-in"
                onclick="add('.listen-image','open-slide'); add('.close-up-right','block');">
                <?=$ad['photos']?>
            </article>



            <div class="listen-image-number">
                <img alt="<?=$_('photos')?>" src="../icons/camera.svg">
                <span id="listen-image-numbers">1 / 4</span>
            </div>

            <span id="prevButton">❮</span>
            <span id="nextButton">❯</span>


            <article id="listen-small-image">
            </article>
        </section>


        <section class="listen-content">
            <div>
                <div class="listen-price">
                    <span class='price'><?=$ad['price']?></span>
                    <div>

                        <span onclick="toggle('.listen-share', 'flex')">
                            <img class="share" width="24" src="../icons/share-svgrepo-com.svg" alt="<?=$_('share')?>">

                        </span>

                        <input id='adFav' <?=$n?>>

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
                                <img src="../icons/WhatsApp.svg" style="width: 2.35rem;height: 2.35rem"
                                    alt="<?=$_('share-whats')?>">
                            </a>

                        </div>
                    </div>

                </div>
            </div>

            <h1 class='listen-title'>
                <?=$ad['title']?>
            </h1>
            <div class="location-in">

                <span id='location'>
                    <img width="20" src="../icons/location-ico.svg" alt="<?=$_('location')?>">
                    <?=$_($ad['location']) . ', ' . $_($ad['area']) . '.'?>
                </span>

                <span class='date'>
                    <?=$ad['created']?>
                </span>

            </div>
            </div>

            <div class="listen-details">
                <b><?=$_('details')?></b>
                <?php
if ($ad['brand']) {
    echo "<div>{$_('brand')} <span>{$_($ad['brand'])}</span></div>";
}
if ($ad['installment']) {
    echo "<div>{$_('installment')} <span>{$_('yes')}</span></div>";
}
if ($ad['price'] == 'allowance') {
    echo "<div>{$_('allowance')}<span>{$_('yes')}</span></div>";
}
if ($ad['status']) {
    echo "<div>{$_('status')} <span>{$_($ad['status'])}</span></div>";
}
if ($ad['deliverable']) {
    echo "<div>{$_('deliverable')} <span>{$_('yes')}</span></div>";
}
?>
            </div>

            <div class="listen-description">
                <b><?=$_('desc')?></b>
                <p id='description'>
                    <?=$ad['description']?>
                </p>
                <span class='textClick'><?=$_('show-more')?></span>
            </div>



            <div class="favorite-num blue">
                <span class='vr'><img src="../icons/heart.svg" alt="<?=$_('favorites')?>"><?=$ad['favorites']?></span>
                <span><img src="../icons/eye.svg" alt="<?=$_('views')?>"><?=$ad['views']?></span>
            </div>

            <article class="listen-seller">
                <img src="../icons/pngkey.com-user-png-729670.svg" alt="<?=$_('seller')?>" class='seller'>
                <div>
                    <b>
                        <?=$adUS['name']?>
                    </b>
                    <br>
                    <span><?=$_('member-since')?> <span class='date'><?=$adUS['created']?></span></span>
                    <br>

                    <a href="/design/user/?user-id=<?=$adUS['id']?>"><?=$_('see-profile')?><ri>❭</ri></a>
                    <br>
                </div>
                <?php
$phone = "<span id='show-PhNu' class='btn'><img alt='' src='../icons/telephone.svg' class='invert'> {$_('showPhone')}</span>";
$chat = "<a href='/design/chat/?ad-id=' class='chatAd outline-btn blue'><img src='../icons/chat-square-dots.svg'>{$_('goChat')}</a>";

if ($connect == 'both') {
    echo $phone . $chat;
} elseif ($connect == 'phone') {
    echo $phone;
} elseif ($connect == 'chat') {
    echo $chat;
}
?>
            </article>



        </section>
        <div class="listen-info">
            <hr>

            <div class="listen-report">
                <span><?=$_('ad-id')?> <span id='ad-id'><?=$id?></span></span>
                <b onclick="toggle('.listen-form-report', 'flex')"><img alt="" src="../icons/exclamation-triangle.svg">
                    <?=$_('report')?></b>
            </div>

            <form class="listen-form-report" method='POST'>

                <span onclick="toggle('.listen-form-report', 'flex')"><img src="../icons/x.svg"
                        alt="<?=$_('close')?>"></span>
                <h3><?=$_('report')?></h3>

                <label><input type="radio" name="report" value='offensive'><?=$_('offensive')?></label>

                <label><input type="radio" name="report" value='fraud'><?=$_('fraud')?></label>

                <label><input type="radio" name="report" value='sold'><?=$_('sold')?></label>

                <label><input type="radio" name="report" value='unavailable'><?=$_('unavailable')?></label>

                <label><input type="radio" name="report" value='fake'><?=$_('fake')?></label>

                <label><input type="radio" name="report" value='other'><?=$_('other')?></label>

                <textarea name="comment" minlength='4' placeholder="<?=$_('comment')?>"></textarea>

                <button type='submit' class="btn"><?=$_('complaint')?></button>
            </form>


            <hr>
        </div>

        <section class="card-layer">
            <article class="cards-category">
                <h2><?=$_('related-ads')?>
                </h2>
            </article>



            <article class="cards-row">
                <?=$resultQuery?>
            </article>
        </section>

        <div class="listen-contact">
            <?php
$phone = "<a id='listen-sms'><img alt='' src='../icons/chat-square-dots.svg'> {$_('sms')}</a><a id='listen-call' href='tel:$adUS[phone]'><img alt='' src='../icons/telephone.svg'> {$_('call')}</a>";
$chat = "<a class='chatAd' href='/design/chat/?ad-id='><img alt='' src='../icons/chat-square-dots.svg'> {$_('chat')}</a>";

if ($connect == 'both') {
    echo $phone . $chat;
} elseif ($connect == 'phone') {
    echo $phone;
} elseif ($connect == 'chat') {
    echo $chat;
}
?>



        </div>



    </main>



    <?php ob_start();include dirname(dirname(__FILE__)) . "/components/footer.php";
ob_end_flush()?>





</body>

</html>