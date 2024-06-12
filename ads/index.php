<?php

ob_start();

include dirname(dirname(__FILE__)) . '/components/head.php';

try {

    $category = input($_GET['category']);
    $subcategory = input($_GET["subcategory"]);
    $branch = input($_GET["branch"]);
    $type = input($_GET["type"]);

    $query = "SELECT id,photos,price,title,created,location,area FROM ad WHERE ";

    $search = input($_GET['search']);

    if ($type) {
        $searchAbout = is_array($type) ? $type[0] : $type;
    } elseif ($branch) {
        $searchAbout = $branch;
    } elseif ($subcategory) {
        $searchAbout = $subcategory;
    } elseif ($category) {
        $searchAbout = $category;
    } else {
        $searchAbout = '';
    }

    if ($search) {

        $searches = $conn->prepare("SELECT COUNT(query) FROM search WHERE query=:sear AND category=:cat");
        $searches->bindParam(':sear', $search);
        $searches->bindParam(':cat', $searchAbout);
        $searches->execute();

        if ($searches->fetch()['COUNT(query)'] > 0) {
            $searches = $conn->prepare("UPDATE search SET rank=rank+1 WHERE query=:sear AND category=:cat");
            $searches->bindParam(':sear', $search);
            $searches->bindParam(':cat', $searchAbout);
            $searches->execute();
        } else {
            $searches = $conn->prepare("INSERT INTO search(query, category) VALUES (:sear, :cat)");
            $searches->bindParam(':sear', $search);
            $searches->bindParam(':cat', $searchAbout);
            $searches->execute();
        }
        $searches = null;

        if ($category == 'all') {
            $query .= "description REGEXP '$search' or title REGEXP '$search' or category REGEXP '$search' or subcategory REGEXP '$search' or branch REGEXP '$search' or type REGEXP '$search' or brand REGEXP '$search' or status REGEXP '$search' AND ";
        } else {
            $query .= "(description REGEXP '$search' or title REGEXP '$search' or category REGEXP '$search' or subcategory REGEXP '$search' or branch REGEXP '$search' or type REGEXP '$search' or brand REGEXP '$search' or status REGEXP '$search') AND ";
        }
    }

    if ($category) {
        if ($category == 'all') {
        } else {
            $query .= "category='$category' AND ";
        }
    }

    if ($subcategory) {
        $query .= "subcategory=\"$subcategory\" AND ";
    }

    if ($branch) {
        $query .= "branch=\"$branch\" AND ";
    }

    if ($type) {
        for ($i = 0; $i < count($type); $i++) {
            $typeAll .= "\"$type[$i]\"" . ',';
        }
        $query .= "type IN ($typeAll) AND ";
    }

    $area = input($_GET['area']);

    if ($area) {
        $query .= "area='$area' AND ";
    }

    $location = input($_GET['location']);

    if ($location) {
        $query .= "location='$location' AND ";
    }

    $brand = input($_GET['brand']);

    if ($brand) {
        for ($i = 0; $i < count($brand); $i++) {
            $allbrand .= "\"$brand[$i]\"" . ',';
        }
        $query .= "brand in($allbrand) AND ";
    }

    $status = input($_GET['status']);

    if ($status) {
        for ($i = 0; $i < count($status); $i++) {
            $allStatus .= "\"$status[$i]\"" . ',';
        }
        $query .= "status in($allStatus) AND ";
    }

    $price = input($_GET['price']);
    if ($price) {
        $query .= "price='$price' AND ";
    }

    $installment = input($_GET['installment']);
    if ($installment) {
        $query .= "installment=\"on\" AND ";
    }

    $fromPrice = input($_GET['from-price']);

    if ($fromPrice) {
        $query .= "cast(price as integer) >= $fromPrice AND ";
    }

    $toPrice = input($_GET['to-price']);

    if ($toPrice) {
        $query .= "cast(price as integer) <= $toPrice AND ";
    }

    $ship = input($_GET['ship']);

    if ($ship) {
        $query .= "deliverable='yes' AND ";
    }

    $user_type = input($_GET['user-type']);

    if ($user_type) {
        $query .= "user-type='$user_type' AND ";
    }

    $s = "created DESC";

    $sort = input($_GET['sort']);
    if ($sort) {
        if ($sort == 'oldest') {
            $s = "created";
        }
        if ($sort == 'lowest-price') {
            $s = "CAST(price AS INTEGER)";
        }
        if ($sort == 'highest-price') {
            $s = "CAST(price AS INTEGER) DESC";
        }
        if ($sort == 'lowest-views') {
            $s = "views";
        }
        if ($sort == 'highest-views') {
            $s = "views DESC";
        }
        if ($sort == 'lowest-status') {
            $s = "LENGTH(status) DESC";
        }
        if ($sort == 'highest-status') {
            $s = "LENGTH(status)";
        }
    }

    $page = input($_GET['page']);
    $d = 0;
    if ($page > 1) {
        $d = $page * 40;
    }

    $query .= "ORDER BY $s LIMIT 40 OFFSET $d";

    $query = preg_replace('/,"\)/', '")', $query);
    $query = preg_replace("/,\)/", ')', preg_replace("/(WHERE ORDER|AND ORDER)/i", ' ORDER', $query));

    $listen = $conn->prepare($query);
    $listen->execute();

    $resultQuery = '';
    $listen_result = $listen->fetchAll();
    $listen = null;

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

    $sQuery = $conn->prepare("SELECT query FROM search WHERE category=:cat ORDER BY rank DESC LIMIT 14");
    $sQuery->bindParam(':cat', $searchAbout);
    $sQuery->execute();

    $search_result = $sQuery->fetchAll();

    if ($search_result) {
        $searchResult = '[';
        foreach ($search_result as $result) {
            $searchResult .= "\"$result[query]\",";
        }
        $searchResult .= ']';
        $searchResult = preg_replace('/,]/', ']', $searchResult);
    }

    $sQuery = null;
} catch (PDOException $e) {
    reportError("ads.php: " . $e->getMessage());
}

$query = "SELECT COUNT(id)" . preg_replace('/(select id,photos,price,title,created,location,area| LIMIT 40 OFFSET \w+)/i', '', $query);
$listenLen = $conn->prepare($query);
$listenLen->execute();
$res = $listenLen->fetch();
$listenLen = null;

if ($area) {
    $searchLoc = $area;
} elseif ($location) {
    $searchLoc = $location;
} else {
    $searchLoc = $_('egypt');
}

$search = $_($search);
$searchLoc = $_($searchLoc);
$searchAbout = $_($searchAbout);

$fullSearch = ucwords(($search ? "$search {$_('in')} " : '') . ($searchAbout ? $searchAbout : $_('ads')) . " {$_('in')} " . $searchLoc);
$fullSearch = preg_replace('/in ads/i', '', $fullSearch);
ob_end_flush();?>

<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">


 <title><?=$fullSearch . ' | ' . $_('amazon')?></title>
 <meta name="description"
  content="<?=$_('find') . ' ' . $fullSearch . ' ' . $_('best-prices') . ' | ' . $_('amazon')?>">

 <meta property="og:title" content="<?=$fullSearch?>" />
 <meta name="twitter:title" content="<?=$fullSearch?>">

 <meta property="og:description" content="<?=$_('find') . ' ' . $fullSearch . ' ' . $_('best-prices')?>" />
 <meta name="twitter:description" content="<?=$_('find') . ' ' . $fullSearch . ' ' . $_('best-prices')?>">

 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">


 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <?=$cssDevice?>
 <meta name="twitter:creator" content="@Amazon">


</head>

<body id='ads'>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/header.php';include dirname(dirname(__FILE__)) . '/components/nav.php';
ob_end_flush()?>

 <main class="ads">


  <section class="ads-filter">
   <a id='save-search' data-search='search'><img alt="" src='../icons/heart.svg'><?=$_('save')?></a>
   <div>
    <a onclick="toggle('.sort-by', 'block')"><img alt="" src="../icons/sort.svg"><?=$_('sort-by')?></a>
    <a onclick="toggle('.filters', 'block')"><img alt="" src="../icons/filter.svg"><?=$_('filters')?></a>
   </div>
   <hr>

   <input type="hidden" id='searchIn' value="<?=$search?>">

   <div class="sort-by">
    <span onclick="toggle('.sort-by', 'block')"><img alt="" src="../icons/x.svg" width="46" class="invert"
      alt="<?=$_('close')?>"></span>
    <a class='latest'><?=$_('date-latest')?></a>
    <a class='oldest'><?=$_('date-oldest')?></a>
    <hr>
    <a class='lowest-price'><?=$_('price-lowest')?></a>
    <a class='highest-price'><?=$_('price-highest')?></a>
    <hr>
    <a class='lowest-views'><?=$_('views-lowest')?></a>
    <a class='highest-views'><?=$_('views-highest')?></a>
    <hr>
    <a class='lowest-status'><?=$_('status-lowest')?></a>
    <a class='highest-status'><?=$_('status-highest')?></a>
   </div>

   <div class="filters">


    <div class="filters-top">
     <span onclick="toggle('.filters', 'block')"><img src="../icons/x.svg" width="46" alt="<?=$_('close')?>"></span>
     <div class="filter-price">
      <span id="ads-results"></span>
     </div>
    </div>
    <div class="filter-location">
     <span onclick="toggle('.filter-location-in', 'block')">
      <img alt="" src="../icons/location-ico.svg" width="24">
      <?=$_('change-location')?> <img alt="" src="../icons/drop-down.svg" class="invert">
     </span>
     <hr>

     <div class="filter-location-in">
      <div>
       <input type="search" id="find-location" placeholder="find a place">
      </div>
      <hr>

      <div>
       <a id="cairo"><?=$_('all-in') . $_('cairo')?><ri>❭</ri></a>
       <ul>
        <a id="new-cairo"><?=$_('new-cairo')?></a>
        <a id="nasr-city"><?=$_('nasr-city')?></a>
        <a id="heliopolis"><?=$_('heliopolis')?></a>
        <a id="madinaty"><?=$_('madinaty')?></a>
        <a id="maadi"><?=$_('maadi')?></a>

        <a id="shorouk-city"><?=$_('shorouk-city')?></a>
        <a id="downtown-cairo"><?=$_('downtown-cairo')?></a>
        <a id="obour-city"><?=$_('obour-city')?></a>
        <a id="mostakbal-city"><?=$_('mostakbal-city')?></a>
        <a id="shubra"><?=$_('shubra')?></a>
        <a id="ain-shams"><?=$_('ain-shams')?></a>
        <a id="new-capital-city"><?=$_('new-capital-city')?></a>
        <a id="mokattam"><?=$_('mokattam')?></a>
        <a id="helwan"><?=$_('helwan')?></a>
        <a id="gesr-al-suez"><?=$_('gesr-al-suez')?></a>
        <a id="marg"><?=$_('marg')?></a>
        <a id="hadayek-al-kobba"><?=$_('hadayek-al-kobba')?></a>
        <a id="zahraa-al-maadi"><?=$_('zahraa-al-maadi')?></a>
        <a id="helmeyat-el-zaytoun"><?=$_('helmeyat-el-zaytoun')?></a>
        <a id="salam-city"><?=$_('salam-city')?></a>
        <a id="matareya"><?=$_('matareya')?></a>
        <a id="badr-city"><?=$_('badr-city')?></a>
        <a id="sheraton"><?=$_('sheraton')?></a>
        <a id="new-nozha"><?=$_('new-nozha')?></a>
        <a id="hadayek-helwan"><?=$_('hadayek-helwan')?></a>
        <a id="abasiya"><?=$_('abasiya')?></a>
        <a id="dar-al-salaam"><?=$_('dar-al-salaam')?></a>
        <a id="zamalek"><?=$_('zamalek')?></a>
        <a id="al-amiriyyah"><?=$_('al-amiriyyah')?></a>
        <a id="zawya-al-hamra"><?=$_('zawya-al-hamra')?></a>
        <a id="sayeda-zeinab"><?=$_('sayeda-zeinab')?></a>
        <a id="katameya"><?=$_('katameya')?></a>
        <a id="15-may-city"><?=$_('15-may-city')?></a>
        <a id="al-manial"><?=$_('al-manial')?></a>
        <a id="ezbet-el-nakhl"><?=$_('ezbet-el-nakhl')?></a>
        <a id="new-heliopolis"><?=$_('new-heliopolis')?></a>
        <a id="basateen"><?=$_('basateen')?></a>
        <a id="almazah"><?=$_('almazah')?></a>
        <a id="ramses"><?=$_('ramses')?></a>
        <a id="rod-al-farag"><?=$_('rod-al-farag')?></a>


       </ul>
      </div>

      <div>
       <a id="giza"><?=$_('all-in') . $_('giza')?><ri>❭</ri></a>
       <ul>
        <a id="6th-of-october"><?=$_('6th-of-october')?></a>
        <a id="sheikh-zayed"><?=$_('sheikh-zayed')?></a>
        <a id="haram"><?=$_('haram')?></a>
        <a id="faisal"><?=$_('faisal')?></a>
        <a id="hadayek-october"><?=$_('hadayek-october')?></a>
        <a id="hadayek-al-ahram"><?=$_('hadayek-al-ahram')?></a>
        <a id="mohandessin"><?=$_('mohandessin')?></a>
        <a id="imbaba"><?=$_('imbaba')?></a>
        <a id="dokki"><?=$_('dokki')?></a>
        <a id="giza-district"><?=$_('giza-district')?></a>
        <a id="warraq"><?=$_('warraq')?></a>
        <a id="moneeb"><?=$_('moneeb')?></a>
        <a id="boulaq-dakrour"><?=$_('boulaq-dakrour')?></a>
        <a id="maryotaya"><?=$_('maryotaya')?></a>
        <a id="tersa"><?=$_('tersa')?></a>
        <a id="ard-el-lewa"><?=$_('ard-el-lewa')?></a>
        <a id="agouza"><?=$_('agouza')?></a>
        <a id="saft-el-laban"><?=$_('saft-el-laban')?></a>
        <a id="bashtil"><?=$_('bashtil')?></a>
        <a id="hawamdeya"><?=$_('hawamdeya')?></a>
        <a id="al-giza"><?=$_('al-giza')?></a>
        <a id="badrasheen"><?=$_('badrasheen')?></a>
        <a id="oseem"><?=$_('oseem')?></a>
        <a id="kit-kat"><?=$_('kit-kat')?></a>
        <a id="baragil"><?=$_('baragil')?></a>
        <a id="kerdasa"><?=$_('kerdasa')?></a>
        <a id="abu-rawash"><?=$_('abu-rawash')?></a>
        <a id="dahab-island"><?=$_('dahab-island')?></a>
        <a id="nahia"><?=$_('nahia')?></a>
        <a id="mansuriyya"><?=$_('mansuriyya')?></a>
        <a id="saf"><?=$_('saf')?></a>
        <a id="el-ayyat"><?=$_('el-ayyat')?></a>
        <a id="manial-shiha"><?=$_('manial-shiha')?></a>
        <a id="dahshur"><?=$_('dahshur')?></a>
       </ul>
      </div>

      <div>
       <a id="sharqia"><?=$_('all-in') . $_('sharqia')?><ri>❭</ri></a>
       <ul>
        <a id="zagazig"><?=$_('zagazig')?></a>
        <a id="10th-of-ramadan"><?=$_('10th-of-ramadan')?></a>
        <a id="minya-al-qamh"><?=$_('minya-al-qamh')?></a>
        <a id="bilbeis"><?=$_('bilbeis')?></a>
        <a id="faqous"><?=$_('faqous')?></a>
        <a id="deyerb-negm"><?=$_('deyerb-negm')?></a>
        <a id="abu-hammad"><?=$_('abu-hammad')?></a>
        <a id="abu-kabir"><?=$_('abu-kabir')?></a>
        <a id="kafr-saqr"><?=$_('kafr-saqr')?></a>
        <a id="mashtool-al-souk"><?=$_('mashtool-al-souk')?></a>
        <a id="hihya"><?=$_('hihya')?></a>
        <a id="husseiniya"><?=$_('husseiniya')?></a>
        <a id="alqnayat"><?=$_('alqnayat')?></a>
        <a id="new-salhia"><?=$_('new-salhia')?></a>
        <a id="awlad-saqr"><?=$_('awlad-saqr')?></a>
        <a id="qareen"><?=$_('qareen')?></a>
        <a id="ibrahemyah"><?=$_('ibrahemyah')?></a>
       </ul>
      </div>

      <div>
       <a id="dakahlia"><?=$_('all-in') . $_('dakahlia')?><ri>❭</ri></a>
       <ul>
        <a id="mansura"><?=$_('mansura')?></a>
        <a id="mit-ghamr"><?=$_('mit-ghamr')?></a>
        <a id="talkha"><?=$_('talkha')?></a>
        <a id="new-mansoura"><?=$_('new-mansoura')?></a>
        <a id="sinbillawain"><?=$_('sinbillawain')?></a>
        <a id="belqas"><?=$_('belqas')?></a>
        <a id="dikirnis"><?=$_('dikirnis')?></a>
        <a id="aga"><?=$_('aga')?></a>
        <a id="shirbin"><?=$_('shirbin')?></a>
        <a id="manzala"><?=$_('manzala')?></a>
        <a id="minat-al-nasr"><?=$_('minat-al-nasr')?></a>
        <a id="gamasa"><?=$_('gamasa')?></a>
        <a id="nabaruh"><?=$_('nabaruh')?></a>
        <a id="el-matareya"><?=$_('el-matareya')?></a>
        <a id="akhtab"><?=$_('akhtab')?></a>
        <a id="bani-ubayd"><?=$_('bani-ubayd')?></a>
        <a id="el-kordy"><?=$_('el-kordy')?></a>
        <a id="el-gamaleya"><?=$_('el-gamaleya')?></a>
        <a id="tama-al-amdeed"><?=$_('tama-al-amdeed')?></a>
        <a id="mit-slseel"><?=$_('mit-slseel')?></a>
       </ul>
      </div>

      <div>
       <a id="beheira"><?=$_('all-in') . $_('beheira')?><ri>❭</ri></a>
       <ul>
        <a id="damanhour"><?=$_('damanhour')?></a>
        <a id="kafr-al-dawwar"><?=$_('kafr-al-dawwar')?></a>
        <a id="etay-al-barud"><?=$_('etay-al-barud')?></a>
        <a id="kom-hamadah"><?=$_('kom-hamadah')?></a>
        <a id="badr"><?=$_('badr')?></a>
        <a id="abou-homs"><?=$_('abou-homs')?></a>
        <a id="wadi-al-natrun"><?=$_('wadi-al-natrun')?></a>
        <a id="delengat"><?=$_('delengat')?></a>
        <a id="abuu-al-matamer"><?=$_('abuu-al-matamer')?></a>
        <a id="shubrakhit"><?=$_('shubrakhit')?></a>
        <a id="rashid"><?=$_('rashid')?></a>
        <a id="nubariyah"><?=$_('nubariyah')?></a>
        <a id="hosh-essa"><?=$_('hosh-essa')?></a>
        <a id="mahmoudiyah"><?=$_('mahmoudiyah')?></a>
        <a id="edko"><?=$_('edko')?></a>
        <a id="rahmaniya"><?=$_('rahmaniya')?></a>
       </ul>
      </div>

      <div>
       <a id="minya"><?=$_('all-in') . $_('minya')?><ri>❭</ri></a>
       <ul>
        <a id="minya-city"><?=$_('minya-city')?></a>
        <a id="new-minya"><?=$_('new-minya')?></a>
        <a id="malawi"><?=$_('malawi')?></a>
        <a id="samalut"><?=$_('samalut')?></a>
        <a id="beni-mazar"><?=$_('beni-mazar')?></a>
        <a id="maghagha"><?=$_('maghagha')?></a>
        <a id="abu-qurqas"><?=$_('abu-qurqas')?></a>
        <a id="matay"><?=$_('matay')?></a>
        <a id="deir-mawas"><?=$_('deir-mawas')?></a>
        <a id="adwa"><?=$_('adwa')?></a>
       </ul>
      </div>

      <div>
       <a id="qalyubia"><?=$_('all-in') . $_('qalyubia')?><ri>❭</ri></a>
       <ul>
        <a id="shubra-al-khaimah"><?=$_('shubra-al-khaimah')?></a>
        <a id="banha"><?=$_('banha')?></a>
        <a id="khosous"><?=$_('khosous')?></a>
        <a id="khanka"><?=$_('khanka')?></a>
        <a id="qalyub"><?=$_('qalyub')?></a>
        <a id="qanater-al-khairia"><?=$_('qanater-al-khairia')?></a>
        <a id="shebin-al-qanater"><?=$_('shebin-al-qanater')?></a>
        <a id="tookh"><?=$_('tookh')?></a>
        <a id="qaha"><?=$_('qaha')?></a>
        <a id="kafr-shukr"><?=$_('kafr-shukr')?></a>
       </ul>
      </div>

      <div>
       <a id="sohag"><?=$_('all-in') . $_('sohag')?><ri>❭</ri></a>
       <ul>
        <a id="sohag"><?=$_('sohag')?></a>
        <a id="akhmim"><?=$_('akhmim')?></a>
        <a id="girga"><?=$_('girga')?></a>
        <a id="tahta"><?=$_('tahta')?></a>
        <a id="tama"><?=$_('tama')?></a>
        <a id="baliana"><?=$_('baliana')?></a>
        <a id="maragha"><?=$_('maragha')?></a>
        <a id="monsha"><?=$_('monsha')?></a>
        <a id="new-sohag"><?=$_('new-sohag')?></a>
        <a id="juhaynah"><?=$_('juhaynah')?></a>
        <a id="dar-el-salam"><?=$_('dar-el-salam')?></a>
        <a id="sakaltah"><?=$_('sakaltah')?></a>
        <a id="alasirat"><?=$_('alasirat')?></a>
       </ul>
      </div>

      <div>
       <a id="alexandria"><?=$_('all-in') . $_('alexandria')?><ri>❭</ri></a>
       <ul>
        <a id="agami"><?=$_('agami')?></a>
        <a id="sidi-beshr"><?=$_('sidi-beshr')?></a>
        <a id="smoha"><?=$_('smoha')?></a>
        <a id="seyouf"><?=$_('seyouf')?></a>
        <a id="miami"><?=$_('miami')?></a>
        <a id="moharam-bik"><?=$_('moharam-bik')?></a>
        <a id="asafra"><?=$_('asafra')?></a>
        <a id="al-ibrahimiyyah"><?=$_('al-ibrahimiyyah')?></a>
        <a id="mandara"><?=$_('mandara')?></a>
        <a id="awayed"><?=$_('awayed')?></a>
        <a id="agami"><?=$_('agami')?></a>
        <a id="sidi-beshr"><?=$_('sidi-beshr')?></a>
        <a id="sidi-gaber"><?=$_('sidi-gaber')?></a>
        <a id="laurent"><?=$_('laurent')?></a>
        <a id="nakheel"><?=$_('nakheel')?></a>
        <a id="al-hadrah"><?=$_('al-hadrah')?></a>
        <a id="victoria"><?=$_('victoria')?></a>
        <a id="abu-qir"><?=$_('abu-qir')?></a>
        <a id="glim"><?=$_('glim')?></a>

        <a id="fleming"><?=$_('fleming')?></a>
        <a id="bacchus"><?=$_('bacchus')?></a>
        <a id="amreya"><?=$_('amreya')?></a>
        <a id="san-stefano"><?=$_('san-stefano')?></a>
        <a id="borg-al-arab"><?=$_('borg-al-arab')?></a>
        <a id="maamoura"><?=$_('maamoura')?></a>

        <a id="bolkly"><?=$_('bolkly')?></a>
        <a id="raml-station"><?=$_('raml-station')?></a>
        <a id="montazah"><?=$_('montazah')?></a>
        <a id="manshiyya"><?=$_('manshiyya')?></a>
        <a id="kafr-abdo"><?=$_('kafr-abdo')?></a>
        <a id="roushdy"><?=$_('roushdy')?></a>

        <a id="sporting"><?=$_('sporting')?></a>
        <a id="gianaclis"><?=$_('gianaclis')?></a>
        <a id="cleopatra"><?=$_('cleopatra')?></a>
        <a id="wardian"><?=$_('wardian')?></a>
        <a id="azarita"><?=$_('azarita')?></a>
        <a id="attarin"><?=$_('attarin')?></a>

        <a id="camp-caesar"><?=$_('camp-caesar')?></a>
        <a id="dekheila"><?=$_('dekheila')?></a>
        <a id="zezenia"><?=$_('zezenia')?></a>
        <a id="schutz"><?=$_('schutz')?></a>
        <a id="gomrok"><?=$_('gomrok')?>
        </a>
       </ul>
      </div>

      <div>
       <a id="gharbia"><?=$_('all-in') . $_('gharbia')?><ri>❭</ri></a>
       <ul>

        <a id="tanta"><?=$_('tanta')?></a>
        <a id="mahalla-al-kobra"><?=$_('mahalla-al-kobra')?></a>
        <a id="zefta"><?=$_('zefta')?></a>
        <a id="kafr-al-zayat"><?=$_('kafr-al-zayat')?></a>
        <a id="samanoud"><?=$_('samanoud')?></a>
        <a id="santa"><?=$_('santa')?></a>
        <a id="qutour"><?=$_('qutour')?></a>
        <a id="basyoun"><?=$_('basyoun')?></a>
       </ul>
      </div>

      <div>
       <a id="asyut"><?=$_('all-in') . $_('asyut')?><ri>❭</ri></a>
       <ul>
        <a id="asyut-city"><?=$_('asyut-city')?></a>
        <a id="new-assiut"><?=$_('new-assiut')?></a>
        <a id="fateh"><?=$_('fateh')?></a>
        <a id="dairut"><?=$_('dairut')?></a>
        <a id="qusiya"><?=$_('qusiya')?></a>
        <a id="manfalut"><?=$_('manfalut')?></a>
        <a id="abu-teeg"><?=$_('abu-teeg')?></a>
        <a id="abnub"><?=$_('abnub')?></a>
        <a id="badari"><?=$_('badari')?></a>
        <a id="sedfa"><?=$_('sedfa')?></a>
        <a id="ghanayem"><?=$_('ghanayem')?></a>
        <a id="sahel-selim"><?=$_('sahel-selim')?></a>
        <a id="new-tiba"><?=$_('new-tiba')?></a>
       </ul>
      </div>

      <div>
       <a id="monufia"><?=$_('all-in') . $_('monufia')?><ri>❭</ri></a>
       <ul>
        <a id="shebin-al-koum"><?=$_('shebin-al-koum')?></a>
        <a id="quesna"><?=$_('quesna')?></a>
        <a id="sadat"><?=$_('sadat')?></a>
        <a id="ashmon"><?=$_('ashmon')?></a>
        <a id="menouf"><?=$_('menouf')?></a>
        <a id="bagour"><?=$_('bagour')?></a>
        <a id="berket-al-sabaa"><?=$_('berket-al-sabaa')?></a>
        <a id="tala"><?=$_('tala')?></a>
        <a id="shohadaa"><?=$_('shohadaa')?></a>
        <a id="sers-al-lyan"><?=$_('sers-al-lyan')?></a>
       </ul>
      </div>

      <div>
       <a id="kafr-el-sheikh"><?=$_('all-in') . $_('kafr-el-sheikh')?><ri>❭</ri></a>
       <ul>
        <a id="kafr-al-sheikh-city"><?=$_('kafr-al-sheikh-city')?></a>
        <a id="desouk"><?=$_('desouk')?></a>
        <a id="bella"><?=$_('bella')?></a>
        <a id="qaleen"><?=$_('qaleen')?></a>
        <a id="sidi-salem"><?=$_('sidi-salem')?></a>
        <a id="baltim"><?=$_('baltim')?></a>
        <a id="hamoul"><?=$_('hamoul')?></a>
        <a id="riyadh"><?=$_('riyadh')?></a>
        <a id="fouh"><?=$_('fouh')?></a>
        <a id="motobas"><?=$_('motobas')?></a>
        <a id="brolos"><?=$_('brolos')?></a>
       </ul>
      </div>

      <div>
       <a id="qena"><?=$_('all-in') . $_('qena')?><ri>❭</ri></a>
       <ul>


        <a id="abu-tesht"><?=$_('abu-tesht')?></a>
        <a id="dishna"><?=$_('dishna')?></a>
        <a id="el-waqf"><?=$_('el-waqf')?></a>
        <a id="farshut"><?=$_('farshut')?></a>
        <a id="nag-hammadi"><?=$_('nag-hammadi')?></a>
        <a id="naqada"><?=$_('naqada')?></a>
        <a id="new-qena"><?=$_('new-qena')?></a>
        <a id="qena"><?=$_('qena')?></a>
        <a id="qift"><?=$_('qift')?></a>
        <a id="qus"><?=$_('qus')?></a>
       </ul>
      </div>

      <div>
       <a id="beni-suef"><?=$_('all-in') . $_('beni-suef')?><ri>❭</ri></a>
       <ul>
        <a id="beni-suef-city"><?=$_('beni-suef-city')?></a>
        <a id="new-beni-suef"><?=$_('new-beni-suef')?></a>
        <a id="al-wasty"><?=$_('al-wasty')?></a>
        <a id="nasser"><?=$_('nasser')?></a>
        <a id="beba"><?=$_('beba')?></a>
        <a id="al-feshn"><?=$_('al-feshn')?></a>
        <a id="ehnasia"><?=$_('ehnasia')?></a>
        <a id="samasta"><?=$_('samasta')?></a>
       </ul>
      </div>

      <div>
       <a id="damietta"><?=$_('all-in') . $_('damietta')?><ri>❭</ri></a>
       <ul>
        <a id="damietta-city"><?=$_('damietta-city')?></a>
        <a id="new-damietta"><?=$_('new-damietta')?></a>
        <a id="ras-al-bar"><?=$_('ras-al-bar')?></a>
        <a id="fareskour"><?=$_('fareskour')?></a>
        <a id="kafr-saad"><?=$_('kafr-saad')?></a>
        <a id="zarqa"><?=$_('zarqa')?></a>
        <a id="kafr-al-bateekh"><?=$_('kafr-al-bateekh')?></a>
        <a id="ezbet-al-burj"><?=$_('ezbet-al-burj')?></a>
        <a id="saro"><?=$_('saro')?></a>
        <a id="el-rodah"><?=$_('el-rodah')?></a>
        <a id="mit-abughalb"><?=$_('mit-abughalb')?></a>
       </ul>
      </div>

      <div>
       <a id="aswan"><?=$_('all-in') . $_('aswan')?><ri>❭</ri></a>
       <ul>
        <a id="abu-simbel"><?=$_('abu-simbel')?></a>
        <a id="aswan"><?=$_('aswan')?></a>
        <a id="daraw"><?=$_('daraw')?></a>
        <a id="edfu"><?=$_('edfu')?></a>
        <a id="kom-ombo"><?=$_('kom-ombo')?></a>
        <a id="new-aswan"><?=$_('new-aswan')?></a>
        <a id="new-tushka"><?=$_('new-tushka')?></a>
        <a id="nasr"><?=$_('nasr')?></a>
       </ul>
      </div>

      <div>
       <a id="ismailia"><?=$_('all-in') . $_('ismailia')?><ri>❭</ri></a>
       <ul>
        <a id="ismailia-city"><?=$_('ismailia-city')?></a>
        <a id="fayed"><?=$_('fayed')?></a>
        <a id="kantara-west"><?=$_('kantara-west')?></a>
        <a id="abu-swear"><?=$_('abu-swear')?></a>
        <a id="tal-al-kebeer"><?=$_('tal-al-kebeer')?></a>
        <a id="qassaseen"><?=$_('qassaseen')?></a>
        <a id="kantara-east"><?=$_('kantara-east')?></a>
       </ul>
      </div>


      <div>
       <a id="faiyum"><?=$_('all-in') . $_('faiyum')?><ri>❭</ri></a>
       <ul>
        <a id="atssa"><?=$_('atssa')?></a>
        <a id="fayoum-city"><?=$_('fayoum-city')?></a>
        <a id="new-fayoum"><?=$_('new-fayoum')?></a>
        <a id="tamiya"><?=$_('tamiya')?></a>
        <a id="yusuf-al-sadiq"><?=$_('yusuf-al-sadiq')?></a>
        <a id="ibshway"><?=$_('ibshway')?></a>
       </ul>
      </div>






      <div>
       <a id="luxor"><?=$_('all-in') . $_('luxor')?><ri>❭</ri></a>
       <ul>
        <a id="qurna"><?=$_('qurna')?></a>
        <a id="luxor"><?=$_('luxor')?></a>
        <a id="luxor"><?=$_('luxor')?></a>
        <a id="armant"><?=$_('armant')?></a>
        <a id="esna"><?=$_('esna')?></a>
        <a id="thebes"><?=$_('thebes')?></a>
       </ul>
      </div>

      <div>
       <a id="suez"><?=$_('all-in') . $_('suez')?><ri>❭</ri></a>
       <ul>
        <a id="ain-sukhna"><?=$_('ain-sukhna')?></a>
        <a id="suez-district"><?=$_('suez-district')?></a>
        <a id="arbaeen"><?=$_('arbaeen')?></a>
        <a id="faisal-district"><?=$_('faisal-district')?></a>
        <a id="attaka"><?=$_('attaka')?></a>
        <a id="ganayen"><?=$_('ganayen')?></a>
       </ul>
      </div>

      <div>
       <a id="port-said"><?=$_('all-in') . $_('port-said')?><ri>❭</ri></a>
       <ul>
        <a id="sharq-district"><?=$_('sharq-district')?></a>
        <a id="port-fouad"><?=$_('port-fouad')?></a>
        <a id="zohour-district"><?=$_('zohour-district')?></a>
        <a id="dawahy-district"><?=$_('dawahy-district')?></a>
        <a id="manakh-district"><?=$_('manakh-district')?></a>
        <a id="arab-district"><?=$_('arab-district')?></a>
        <a id="ganoub-district"><?=$_('ganoub-district')?></a>
       </ul>
      </div>

      <div>
       <a id="matrouh"><?=$_('all-in') . $_('matrouh')?><ri>❭</ri></a>
       <ul>
        <a id="north-coast"><?=$_('north-coast')?></a>
        <a id="alamein"><?=$_('alamein')?></a>
        <a id="marsa-matrouh"><?=$_('marsa-matrouh')?></a>
        <a id="dabaa"><?=$_('dabaa')?></a>
        <a id="hammam"><?=$_('hammam')?></a>
        <a id="siwa"><?=$_('siwa')?></a>
       </ul>
      </div>

      <div>
       <a id="north-sinai"><?=$_('all-in') . $_('north-sinai')?><ri>❭</ri></a>
       <ul>
        <a id="el-arish-1"><?=$_('el-arish-1')?></a>
        <a id="el-hassana"><?=$_('el-hassana')?></a>
        <a id="sheikh-zuweid"><?=$_('sheikh-zuweid')?></a>
        <a id="bir-el-abd"><?=$_('bir-el-abd')?></a>
        <a id="nakhl"><?=$_('nakhl')?></a>
        <a id="rafah"><?=$_('rafah')?></a>
        <a id="shurtet-el-qasima"><?=$_('shurtet-el-qasima')?></a>
        <a id="shurtet-rumana"><?=$_('shurtet-rumana')?></a>
       </ul>
      </div>

      <div>
       <a id="red-sea"><?=$_('all-in') . $_('red-sea')?><ri>❭</ri></a>
       <ul>
        <a id="hurghada"><?=$_('hurghada')?></a>
        <a id="gouna"><?=$_('gouna')?></a>
        <a id="safaga"><?=$_('safaga')?></a>
        <a id="sahl-hasheesh"><?=$_('sahl-hasheesh')?></a>
        <a id="ras-gharib"><?=$_('ras-gharib')?></a>
        <a id="qusair"><?=$_('qusair')?></a>
        <a id="marsa-alam"><?=$_('marsa-alam')?></a>
        <a id="makadi-bay"><?=$_('makadi-bay')?></a>
        <a id="soma-bay"><?=$_('soma-bay')?></a>
        <a id="halayeb-shalateen"><?=$_('halayeb-shalateen')?></a>
       </ul>
      </div>

      <div>
       <a id="new-valley"><?=$_('all-in') . $_('new-valley')?><ri>❭</ri></a>
       <ul>
        <a id="kharga"><?=$_('kharga')?></a>
        <a id="balat"><?=$_('balat')?></a>
        <a id="dakhla"><?=$_('dakhla')?></a>
        <a id="farafra"><?=$_('farafra')?></a>
        <a id="baris"><?=$_('baris')?></a>
       </ul>
      </div>

      <div>
       <a id="south-sinai"><?=$_('all-in') . $_('south-sinai')?><ri>❭</ri></a>
       <ul>
        <a id="abu-redis"><?=$_('abu-redis')?></a>
        <a id="dahab"><?=$_('dahab')?></a>
        <a id="el-tor"><?=$_('el-tor')?></a>
        <a id="nuweiba"><?=$_('nuweiba')?></a>
        <a id="ras-sedr"><?=$_('ras-sedr')?></a>
        <a id="saint-catherine"><?=$_('saint-catherine')?></a>
        <a id="sharm-el-sheikh"><?=$_('sharm-el-sheikh')?></a>
        <a id="taba"><?=$_('taba')?></a>
       </ul>
      </div>



     </div>
    </div>

    <div>
     <div>
      <hr>
      <?=$_('category')?>
      <ul class='subcategory'>
      </ul>
      <span class='textClick'><?=$_('show-more')?></span>
     </div>
     <div>
      <hr>
      <?=$_('branch')?>
      <ul class='branch'>
      </ul>
      <span class='textClick'><?=$_('show-more')?></span>
     </div>

     <div>
      <hr>
      <span id='field'><?=$_('type')?></span>
      <ul class='type'>
      </ul>
      <span class='textClick'><?=$_('show-more')?></span>
     </div>

     <div>
      <hr><?=$_('brand')?>

      <ul class='brand'>
      </ul>
      <span class='textClick'><?=$_('show-more')?></span>
     </div>

     <hr>

     <div class='status'>
      <?=$_('status')?>
      <ul>
       <li>
        <label><input name='status[]' type='checkbox' value="new"><?=$_('new')?></label>
       </li>
       <li>
        <label><input name='status[]' type='checkbox' value="used"><?=$_('used')?></label>
       </li>
       <li>
        <label><input name='status[]' type='checkbox' value="not-working"><?=$_('not-working')?></label>
       </li>
      </ul>
      <hr>
     </div>





     <span id='salary'><?=$_('price')?></span>

     <ul class="filter-price">
      <li>
       <input type="text" id='from-price' pattern='[0-9]{0,}' name="from-price" placeholder="<?=$_('from')?>">
       &nbsp;<input type="text" pattern='[0-9]{0,}' id='to-price' name="to-price" placeholder="<?=$_('to')?>">
      </li>
     </ul>

     <ul id='allowance'>
      <li>
       <label><input type="checkbox" name="price" value='allowance'><?=$_('allowance')?></label>
      </li>
      <li>
       <label><input type="checkbox" name="installment"><?=$_('installment')?></label>
      </li>
     </ul>


     <div class='ship'>
      <hr>
      <li>
       <label><input type="checkbox" name="ship" value='yes'><?=$_('can-delivered')?></label>
      </li>
     </div>
     </ul>
     <br>
     <a id='search-filter' class="submit"><?=$_('search')?></a>
    </div>
  </section>

  <section class="ads-result-right">
   <div class="directory">
    <?=$_('dir-top')?>
   </div>


   <section class="listen-cards">
    <?=$resultQuery?>
   </section>

   <div class="toggle-pages">
    <a><?=$res['COUNT(id)']?></a>
   </div>

   <ul class="trend-searches">
    <?=$searchResult?>
   </ul>

  </section>
 </main>

 <a class="sell-on-fly btn" href='/design/sell'>
  <img alt="" src="../icons/camera.svg">
  <?=$_('sellNow')?>
 </a>

 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';
ob_end_flush()?>

</body>

</html>
