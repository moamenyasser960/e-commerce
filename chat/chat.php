<?php
ob_start();

include dirname(dirname(__FILE__)) . '/components/head.php';

$adChat = input($_GET['ad-id']);
$message = input($_POST['message']);

$tit = $conn->prepare("SELECT title,photos,price FROM ad WHERE id=:ad");
$tit->bindParam(':ad', $adChat);
$tit->execute();
$titR = $tit->fetch();

$tit = null;

$delete = input($_POST['delete']);

if ($logC) {
    try {
        if ($delete) {
            $tit = $conn->prepare("DELETE FROM chat WHERE user=:id AND ad=:ad");
            $tit->bindParam(':id', $userId);
            $tit->bindParam(':ad', $adChat);
            $tit->execute();
            $tit = null;
        } else {
            $fileN = $_FILES['upload']["name"];
            $files = [];

            foreach ($fileN as $k => $v) {
                if ($fileN[$k]) {
                    array_push($files, $fileN[$k] . ' -^-(' . $_FILES['upload']['size'][$k] . ')');

                    $photos_temp = $_FILES['upload']["tmp_name"][$k];
                    $target_file = "../uploads/" . $fileN[$k];

                    move_uploaded_file($photos_temp, $target_file);

                    $info = getimagesize($target_file);

                    if ($info['mime'] == 'image/jpeg') {
                        $image = imagecreatefromjpeg($target_file);
                        imagejpeg($image, $target_file, -1);
                    } elseif ($info['mime'] == 'image/gif') {
                        $image = imagecreatefromgif($target_file);
                        imagejpeg($image, $target_file, -1);
                    } elseif ($info['mime'] == 'image/png') {
                        $image = imagecreatefrompng($target_file);
                        imagesavealpha($image, true);
                        imagepng($image, $target_file, -1);
                    }

                    if ($image) {
                        imagedestroy($image);
                    }
                }
            }

            $filesR = implode(' -^- ', $files);

            if ($message || $filesR) {

                $chSql = $conn->prepare("SELECT message FROM chat WHERE ad=:ad AND user=:us ORDER BY created DESC");
                $chSql->bindParam(':ad', $adChat);
                $chSql->bindParam(':us', $userId);
                $chSql->execute();
                $chSqlR = $chSql->fetch()['message'];

                if ($chSqlR) {
                    if ($chSqlR != $message && $chSqlR != $filesR) {
                        $sql = $conn->prepare("INSERT INTO chat (user, ad, message) VALUES (:us, :ad, :me)");
                        $sql->bindParam(':us', $userId);
                        $sql->bindParam(':ad', $adChat);
                        if ($filesR != '') {
                            $sql->bindParam(':me', $filesR);
                        } else {
                            $sql->bindParam(':me', $message);
                        }

                        $sql->execute();
                        $sql = null;
                    }
                } else {
                    $sql = $conn->prepare("INSERT INTO chat (user, ad, message) VALUES (:us, :ad, :me)");
                    $sql->bindParam(':us', $userId);
                    $sql->bindParam(':ad', $adChat);
                    if ($filesR != '') {
                        $sql->bindParam(':me', $filesR);
                    } else {
                        $sql->bindParam(':me', $message);
                    }
                    $sql->execute();
                    $sql = null;
                }
                $chSql = null;
            }
        }

        $showM = $conn->prepare("SELECT user, message, created, seen FROM chat WHERE user IN(:us, (SELECT user_id FROM ad WHERE id=:ad)) AND ad=:ad");
        $showM->bindParam(':us', $userId);
        $showM->bindParam(':ad', $adChat);
        $showM->execute();
        $showRes = $showM->fetchAll(PDO::FETCH_ASSOC);

        $showM = null;

        $resultQuery = '[';
        $seen = 'message-check';

        if ($adChat && $userId) {
            $seen = 'message-seen';
            $seenM = $conn->prepare("UPDATE chat SET seen=0 WHERE user=:us AND ad=:ad");
            $seenM->bindParam(':us', $userId);
            $seenM->bindParam(':ad', $adChat);
            $seenM->execute();
            $seenM = null;

            $stg = $conn->prepare("UPDATE ad SET chats = chats + (SELECT COUNT(DISTINCT(user)) FROM chat WHERE ad=:ad) WHERE id=:ad");
            $stg->bindParam(':ad', $adChat);
            $stg->execute();
            $stg = null;
        }

        if ($showRes) {
            foreach ($showRes as $result) {
                $resultQuery .= <<<r
                {"message" : "$result[message]", "user" : "$result[user]", "created" : "$result[created]", "seen" : "$seen"},
                r;
            }
        }

        $ch = $conn->prepare("SELECT DISTINCT(ad) FROM chat WHERE user=:id");
        $ch->bindParam(':id', $userId);
        $ch->execute();
        $chRes = $ch->fetchAll(PDO::FETCH_ASSOC);
        $ch = null;

        $s = '';
        foreach ($chRes as $res) {
            $s .= "$res[ad], ";
        }
        $s = $s ? preg_replace('/, $/', '', $s) : "''";
        $chats = $conn->prepare("SELECT photos,title FROM ad WHERE id IN($s)");
        $chats->execute();
        $chatsRes = $chats->fetchAll(PDO::FETCH_ASSOC);

        $gt = $conn->prepare("SELECT DISTINCT(ad) FROM chat WHERE user=:us ORDER BY created DESC, seen DESC");
        $gt->bindParam(':us', $userId);
        $gt->execute();
        $gtRes = $gt->fetchAll(PDO::FETCH_ASSOC);

        $gt = null;

        $chatRight = '[';

        $c = $conn->prepare("SELECT user_id, id FROM ad");
        $c->execute();

        foreach ($c->fetchAll(PDO::FETCH_ASSOC) as $s) {
            if ($s['user_id'] != $userId) {
                $buyer .= $s['id'] . ' ,';
            }
        }

        $c = null;

        for ($i = 0; $i < count($gtRes); $i++) {
            $p = $chatsRes[$i]['photos'];
            $tt = $chatsRes[$i]['title'];

            $ad = $gtRes[$i]['ad'];

            $a = $conn->prepare("SELECT message,created,seen FROM chat WHERE user IN(:us, (SELECT user_id FROM ad WHERE id=:ad)) AND ad=:ad ORDER BY created DESC LIMIT 1");
            $a->bindParam(':us', $userId);
            $a->bindParam(':ad', $ad);
            $a->execute();
            $aRes = $a->fetchAll(PDO::FETCH_ASSOC);

            foreach ($aRes as $res) {
                $cr = $res['created'];
                $ms = $res['message'];
                $ss = $res['seen'];
            }

            $sa = 'class=';
            $co = '';

            if ($ss == 1) {
                $gtg = $conn->prepare("SELECT COUNT(ad) FROM chat WHERE user=:us AND ad=:ad AND seen=1");
                $gtg->bindParam(':us', $userId);
                $gtg->bindParam(':ad', $ad);
                $gtg->execute();
                $co = '<span>' . implode('', $gtg->fetch(PDO::FETCH_ASSOC)) . '</span>';
                $sa .= 'active';

                $gtg = null;
            }

            if ($ad == $adChat) {
                $sa .= 'now';
            }

            $chatRight .= <<<a
            {"class" : "$sa", "ad" : "$ad", "unread" : "$co", "img" : "$p", "title" : "$tt", "message" : "$ms", "date" : "$cr"},
            a;
        }

        $chats = null;

        $resultQuery .= ']';
        $resultQuery = preg_replace('/},]/', '}]', $resultQuery);

        $chatRight .= ']';
        $chatRight = preg_replace('/},]/', '}]', $chatRight);

        $tn = $conn->prepare("SELECT id,name,phone FROM user WHERE id=(SELECT user_id FROM ad WHERE id=:ad)");
        $tn->bindParam(':ad', $adChat);
        $tn->execute();
        $sqlR = $tn->fetch();

    } catch (PDOException $e) {
        echo $e->getMessage() . '<br>';
    }

}

echo <<<a
{
    "values":{"userId":"$sqlR[id]","name":"$sqlR[name]","phone":"$sqlR[phone]","title":"$titR[title]","photos":"$titR[photos]","price":"$titR[price]","buyer":"$buyer"},
    "right":$chatRight,
    "chat":$resultQuery
}
a;

ob_end_flush();
