<?php
ob_start();
function reportError($error)
{

    echo $error . ': ';
    // try {
    //   $err = urldecode($error);
    //   $error = $GLOBALS['conn']->prepare("INSERT INTO errors (description) VALUES (\"$err\")");
    //   $error->execute();
    // } catch (PDOException $e) {}
}

try {
    function input($d)
    {

        if (is_array($d)) {
            $st = [];
            foreach ($d as $s) {
                $sp = trim($s);
                $sp = stripslashes($s);
                $sp = htmlspecialchars($s);
                array_push($st, $sp);
            }
            return $st;
        } else {
            $d = trim($d);
            $d = stripslashes($d);
            $d = htmlspecialchars($d);
            return $d;
        }

    }

    $getLang = input($_GET['lang']);

    if ($getLang) {
        $lang = $getLang;
        setcookie("lang", $lang, 2147400000, "/");
    } else {
        $lang = $_COOKIE['lang'] ? $_COOKIE['lang'] : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }


    $lang = $lang === 'ar' ? 'ar' : 'en';


    include dirname(dirname(__FILE__)) . "/$lang.php";

    $_ = function ($query) {
        global $l;
        return $l[$query] ? $l[$query] : $query;
    };

    $conn = new PDO("mysql:host=localhost;dbname=website", "root");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $creH = "<a class='btn'>{$_('signIn')}</a><a onclick=\"toggle('.create-acc', 'flex')\">{$_('createAccount')}</a>";
    $signH = "<a class='outline-btn sign-in'>{$_('signIn')}</a>";
    $sellH = "<a class='btn sell'>{$_('sell')}</a>";

    $logIn = $creH;
    $signIn = $signH;
    $sell = $sellH;

    $subH = "<label><button type='submit' name='logOut' value='on'><img alt='' class='blue-on' src='/design/icons/box-arrow-right.svg'><span>{$_('logOut')}</span></button></label>";
    $selH = "<a href='/design/sell' class='btn sell'>{$_('sell')}</a>";

    $name = input($_POST["name"]);
    $email = input($_POST["email"]);
    $phone = input($_POST["phone"]);

    $password = input($_POST["password"]);

    $duplicate = "<p>do you have an account? <a onclick=\"toggle('.log', 'flex');toggle('.create-acc', 'flex')\">sign in</a></p>";

    if ($name && $phone && $password) {
        try {
            $sql = $conn->prepare("INSERT INTO user (name, phone, email, password) VALUES (:n, :ph, :em, :ps)");

            $sql->bindParam(':n', $name);
            $sql->bindParam(':ph', $phone);
            $sql->bindParam(':em', $email);
            $sql->bindParam(':ps', $password);

            $sql->execute();

            $sqlO = $conn->prepare("SELECT COUNT(id) FROM user WHERE phone=:e AND password=:p");
            $sqlO->bindParam(':e', $phone);
            $sqlO->bindParam(':p', $password);
            $sqlO->execute();

            if ($sqlO->fetchColumn() > 0) {
                setcookie("log", $phone, time() + (24 * 60 * 60), "/");
                setcookie("password", $password, time() + (24 * 60 * 60), "/");
                $logIn = $subH;
                $signIn = "";
                $sell = $sellH;
            }

        } catch (PDOException $e) {
            $createErr = 'flex';
            if (preg_match('/Duplicate/i', $e->getMessage()) == true) {
                $duplicate = "<p style='color:red;margin: 0'>you have an account <a onclick=\"toggle('.log', 'flex');toggle('.create-acc', 'flex')\">sign in</a> or <a onclick=\"toggle('.forgot-pass', 'flex');toggle('.create-acc', 'flex')\">reset your password</a></p>";
            }
        }
        $sql = null;
        $sqlO = null;
    }

    $log = input($_POST["log"]);
    $logPassword = input($_POST["log-password"]);
    $remember = input($_POST["remember"]);

    // $valAcc = "<a onclick=\"toggle('.forgot-pass', 'flex')\" class='blue'>Forgot your password?</a>";
    $valAcc = '';

    if ($log && $logPassword) {
        $sql = $conn->prepare("SELECT COUNT(email OR phone) FROM user WHERE (email=:e OR phone=:e) AND password=:p");
        $sql->bindParam(':e', $log);
        $sql->bindParam(':p', $logPassword);
        $sql->execute();

        if ($sql->fetchColumn() > 0) {
            setcookie("log", $log, time() + (24 * 60 * 60), "/");
            setcookie("password", $logPassword, time() + (24 * 60 * 60), "/");

            if ($remember) {
                setcookie("log", $log, 2147400000, "/");
                setcookie("password", $logPassword, 2147400000, "/");
            }
        } else {
            $sql = $conn->prepare("SELECT COUNT(email OR phone) FROM user WHERE (email=:e OR phone=:e)");
            $sql->bindParam(':e', $log);
            $sql->execute();

            $logErr = 'flex';

            if ($sql->fetchColumn() > 0) {
                $valAcc = "<p class='red-c'>the password is not valid</p>" . $valAcc;
            } else {
                $valAcc = "<p><span class='red-c'>you don't have an account, </span><a onclick=\"toggle('.create-acc', 'flex')\" class='blue'>create one</a> or try again</p>";
            }
        }
        $sql = null;
    }

//   $newPassword = input($_POST["new-password"]);
//   $restoreEmail = "moamenyasser960@gmail.com";
// $restoreEmail = input($_GET["restore-email"]);

//   if ($newPassword && $restoreEmail) {

//     $sql = $conn->prepare("UPDATE user SET password = :n WHERE email = :r");

//     $sql->bindParam(':r', $restoreEmail);
//     $sql->bindParam(':n', $newPassword);

//     $sql->execute();

//     $sql = null;
//   }

    $logC = input($_COOKIE["log"]);
    $password = input($_COOKIE["password"]);

    if ($logC) {
        $logIn = $subH;
        $signIn = "";
        $sell = $selH;
    }

    if ($_POST["logOut"]) {
        setcookie("log", '', time() - (24 * 60 * 60), "/");
        setcookie("password", '', time() - (24 * 60 * 60), "/");

        $logIn = $creH;
        $signIn = $signH;
        $sell = $selH;
    }

    $sql = $conn->prepare("SELECT id,name,phone FROM user WHERE phone=:id or email=:id");
    $sql->bindParam(':id', $logC);
    $sql->execute();
    $user = $sql->fetch();
    $userId = $user['id'];
    $sql = null;

    $stg = $conn->prepare("SELECT SUM(seen) FROM chat WHERE user=:us");
    $stg->bindParam(':us', $userId);
    $stg->execute();
    $unreadM = $stg->fetch()['SUM(seen)'];

    $adId = input($_GET['id']);
    $removeId = input($_GET['remove']);

    if ($logC && $adId) {
        $f = $conn->prepare("SELECT favorites FROM user WHERE favorites REGEXP '$adId ,' AND id=:us");
        $f->bindParam(':us', $userId);
        $f->execute();
        if ($f->fetchColumn() > 0) {
        } else {
            $favorites = $conn->prepare("UPDATE ad SET favorites = favorites+1 WHERE id=:id;UPDATE user SET favorites=CONCAT(COALESCE(favorites, ''),:id, ' ,') WHERE phone=:ph OR email=:ph");
            $favorites->bindParam(':ph', $logC);
            $favorites->bindParam(':id', $adId);
            $favorites->execute();
            $favorites = null;
        }
        $f = null;
    }
    ;if ($removeId) {
        $rmvf = $conn->prepare("UPDATE ad SET favorites = favorites-1 WHERE id=:id; UPDATE user SET favorites=REPLACE(favorites, CONCAT(:id, ' ,'), '') WHERE phone=:ph OR email=:ph");
        $rmvf->bindParam(':ph', $logC);
        $rmvf->bindParam(':id', $removeId);
        $rmvf->execute();
        $rmvf = null;
    }

    $replace = preg_replace('/\[\]/', '%5B%5D', urldecode($_GET['search']));
    $removeS = preg_replace('/\[\]/', '%5B%5D', urldecode($_GET['remove-search']));

    if ($logC && $replace) {
        $fav = $conn->prepare("SELECT searches FROM user WHERE searches REGEXP '$replace ,' AND id=:id");
        $fav->bindParam(':id', $userId);
        $fav->execute();
        if ($fav->fetchColumn() > 0) {
        } else {
            $searches = $conn->prepare("UPDATE user SET searches=CONCAT(COALESCE(searches, ''),:sea, ' ,') WHERE phone=:ph OR email=:ph");
            $searches->bindParam(':ph', $logC);
            $searches->bindParam(':sea', $replace);
            $searches->execute();
            $searches = null;
        }
        $fav = null;
    }
    if ($logC && $removeS) {
        $rmvVaf = $conn->prepare("UPDATE user SET searches=REPLACE(searches, CONCAT(:sea, ' ,'), '') WHERE phone=:ph OR email=:ph");
        $rmvVaf->bindParam(':ph', $logC);
        $rmvVaf->bindParam(':sea', $removeS);
        $rmvVaf->execute();
        $rmvVaf = null;
    }

    $adIdSh = input($_GET['ad-id']);
    if ($adIdSh && input($_GET['show-number'])) {
        $show = $conn->prepare("UPDATE ad SET display_number=display_number+1 WHERE id=:id");
        $show->bindParam(':id', $adIdSh);
        $show->execute();
        $show = null;
    }

    $messageError = input($_GET['error']);
    if ($messageError) {
        reportError($messageError);
    }

    $mobile = preg_match('/(mobile|iOS|iPod|Tablet|KFAPWI|KFOT|KFTT|Kindle|KFJWA|KFJWI|BlackBerry|iPad|Android|iPhone|Phone)/i', $_SERVER['HTTP_USER_AGENT']);

    $searcheQuery = input($_GET['query']);

    if ($searcheQuery) {
        if ($searcheQuery == 'all') {
            $query = $conn->prepare("SELECT DISTINCT(query) FROM search ORDER BY rank DESC LIMIT 10");
        } else {
            $query = $conn->prepare("SELECT DISTINCT(query) FROM search WHERE query REGEXP :sear ORDER BY rank DESC LIMIT 10");
            $query->bindParam(':sear', $searcheQuery);
        }
        $query->execute();

        $search_result = $query->fetchAll();

        $resultQuery = '[';
        if ($search_result) {
            foreach ($search_result as $result) {
                $resultQuery .= "\"$result[query]\",";
            }
        }
        $resultQuery .= ']';
        $resultQuery = preg_replace('/,]/', ']', $resultQuery);

        echo $resultQuery;

        $query = null;
    }

    $cssDevice = $mobile ? '/design/css/nav-mobile.css' : '/design/css/nav-comp.css';
    $cssDevice = "<link rel='stylesheet' href='$cssDevice'>";
} catch (PDOException $e) {
    $error = "<span class='alert flex'>{$_('error-try')}</span>";
    reportError('head.php: ' . $e->getMessage());
}

ob_end_flush();
