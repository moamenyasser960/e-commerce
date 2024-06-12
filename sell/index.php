<?php
ob_start();
include dirname(dirname(__FILE__)) . '/components/head.php';

try {
    // mail('moamenyasser960@gmail.com', 'New Ad!', 'In Properties, Cairo.', 'From: head@exeir.com');
    $category = input($_POST["category"]);
    $subCategory = input($_POST["subcategory"]);

    $uploadImages = $_FILES["uploadImages"];
    $uploadedImages = input($_POST["uploadedImages"]);

    $title = input($_POST["title"]);
    $brand = input($_POST["brand"]);
    $status = input($_POST["status"]);
    $description = input($_POST["description"]);
    $price = input($_POST["price"]);
    $location = input($_POST["location"]);
    $area = input($_POST["area"]);
    $deliverable = input($_POST["deliverable"]);
    $contact = input($_POST["contact"]);
    $installment = input($_POST["installment"]);

    $adImage = input($_POST["ad-image"]);

    $type = input($_POST["type"]);
    $branch = input($_POST["branch"]);

    $id = input($_POST['id']);

    $dir = '';
    $result = [];

    if ($id) {
        $showCateg = 'v-none';
        $showSell = 'block';

        $ad = $conn->prepare("SELECT id,user_id,category,subcategory,branch,type,photos,price,brand,status,description,installment,deliverable,contact,title,location,area FROM ad WHERE id=:id");
        $ad->bindParam(':id', $id);
        $ad->execute();

        $result = $ad->fetch();
        $ad = null;

        if ($result['category']) {
            $dir .= $result['category'];
        }
        if ($result['subcategory']) {
            $dir .= ' / ' . $result['subcategory'];
        }
        if ($result['branch']) {
            $dir .= ' / ' . $result['branch'];
        }
        if ($result['type']) {
            $dir .= ' / ' . $result['type'];
        }
    } else {
        $showCateg = 'block';
        $showSell = 'v-none';
    }

    if ($title && $logC) {
        if ($id) {
            $phot = input($_POST['uploadImages']);
            $sql = $conn->prepare("UPDATE ad set title=:t, brand=:b, status=:s, description=:d, price=:p, location=:l, photos=:pho, area=:a, deliverable=:de, contact=:c, category=:ca, subcategory=:sc, branch=:br, type=:ty, installment=:ins WHERE id=:id");
            $sql->bindParam(':pho', $phot);
            $sql->bindParam(':id', $id);
        } else {
            $sql = $conn->prepare("INSERT INTO ad (user_id, title, brand, status, description, price, location, area, deliverable, contact, category, subcategory, branch, type, installment) VALUES ((SELECT id FROM user WHERE phone=:phon OR email=:phon), :t, :b, :s, :d, :p, :l, :a, :de, :c, :ca, :sc, :br, :ty, :ins)");
            $sql->bindParam(':phon', $logC);
        }

        $sqlCount = $conn->prepare("SELECT COUNT(title) FROM `ad` WHERE title=:t");
        $sqlCount->bindParam(':t', $title);
        $sqlCount->execute();
        $sqlResult = $sqlCount->fetch();

        if ($sqlResult["COUNT(title)"] > 0) {
            if ($sqlResult["COUNT(title)"] !== 1 && !$id) {
                $title .= '-' . $sqlResult["COUNT(title)"];
            }
        }

        $sql->bindParam(':t', $title);
        $sql->bindParam(':b', $brand);
        $sql->bindParam(':s', $status);
        $sql->bindParam(':d', $description);
        $sql->bindParam(':p', $price);
        $sql->bindParam(':l', $location);
        $sql->bindParam(':a', $area);
        $sql->bindParam(':de', $deliverable);
        $sql->bindParam(':c', $contact);
        $sql->bindParam(':ca', $category);
        $sql->bindParam(':sc', $subCategory);
        $sql->bindParam(':br', $branch);
        $sql->bindParam(':ty', $type);
        $sql->bindParam(':ins', $installment);

        $sql->execute();

        $sql = null;

        $userId = $conn->prepare("SELECT id FROM ad ORDER BY id DESC");
        $userId->execute();

        $row = $userId->fetch();

        $photos = [$adImage];

        function compress($source, $destination, $quality)
        {

            $info = getimagesize($source);
            $src = imagecreatefrompng('../images/android-chrome-192x192.png');

            if ($info['mime'] == 'image/jpeg') {
                $image = imagecreatefromjpeg($source);
                imagecopymerge($image, $src, 16, 16, 0, 0, 1000, 1000, 40);
                imagejpeg($image, $destination, $quality);
            } elseif ($info['mime'] == 'image/png') {
                $image = imagecreatefrompng($source);
                imagesavealpha($image, true);
                imagepng($image, $destination, -1);
            } else {
                $image = imagecreatefromstring($source);
                imagecopymerge($image, $src, 16, 16, 0, 0, 1000, 1000, 40);
                imagejpeg($image, $destination, $quality);
            }

            if ($image) {
                imagedestroy($image);
                imagedestroy($src);
            }

            return $destination;
        }

        if ($id) {
            $resultN = $id;
        } else {
            $resultN = $row['id'];
        }

        if ($uploadImages['tmp_name'][0]) {
            foreach ($uploadImages["tmp_name"] as $k => $v) {

                $photos_ext = pathinfo($uploadImages["name"][$k], PATHINFO_EXTENSION);

                $photos_name = "$resultN-$k." . $photos_ext;

                if (count($photos) <= 20) {
                    array_push($photos, $photos_name);
                }

                $photos_temp = $uploadImages["tmp_name"][$k];
                $target_file = "../uploads/" . $photos_name;

                move_uploaded_file($photos_temp, $target_file);

                compress($target_file, $target_file, 20);
            }
            $photosR = implode(' -^- ', $photos);
        } else {
            if($id){
                $photosR = $uploadedImages;
            }
        }

        if($photosR ){
            $sqlA = $conn->prepare("UPDATE ad SET photos=:pho WHERE id=$resultN");
        $sqlA->bindParam(':pho', $photosR);
        $sqlA->execute();
        $sqlA = null;
        }

        $sql = null;
        if ($id) {
            header('Location: /design?success=modified');
        } else {
            header('Location: /design?success=publish');
        }
        exit;
    }

} catch (PDOException $e) {
    if (preg_match('/Duplicate/i', $e->getMessage()) == true) {
        echo "<p class='flex alert'>the Ad is duplicate! Try again.</p>";
    } else {
        reportError('sell.php: ' . $e->getMessage());
    }
}
ob_end_flush();
?>
<!DOCTYPE html>
<html <?=$_('lang') === 'AR' ? 'dir="rtl" lang="ar"' : 'lang="en"'?>>

<head>

 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">



 <title><?=$_('sell-tit') . ' | ' . $_('amazon')?></title>
 <meta name="description" content="<?=$_('sell-desc')?>">

 <meta property="og:title" content="<?=$_('sell-tit')?>" />
 <meta name="twitter:title" content="<?=$_('sell-tit')?>">

 <meta property="og:description" content="<?=$_('sell-desc')?>" />
 <meta name="twitter:description" content="<?=$_('sell-desc')?>">




 <meta property="og:image" content="http://localhost/design/images/android-chrome-192x192.png" />
 <meta name="twitter:image" content="http://localhost/design/images/android-chrome-192x192.png">


 <?php include dirname(dirname(__FILE__)) . '/components/head.html'?>

 <meta name="twitter:creator" content="@Amazon">

 <link rel="stylesheet" href="../css/nav-mobile.css">

</head>

<body id='sell'>
 <?php ob_start();

if ($mobile) {
    echo '<div id="loader"></div>';
} else {
    include dirname(dirname(__FILE__)) . '/components/header.php';
}

ob_end_flush()?>


 <form enctype="multipart/form-data" method="POST" class='sell'>

  <section class='categ <?=$showCateg?>'>

   <div class="sell-top">
    <span onclick="history.back()"><img src="../icons/chevron.svg" width="24px" alt="<?=$_('back')?>"></span>
    <h3><?=$_('post-ad')?></h3>
   </div>

   <h3><?=$_('choose-category')?></h3>

   <div class='saveCategory none'>
   </div>

   <nav id="nav">


    <div class="parent-click">
    </div>

    <div class="parent-click">
     <a id="vehicles"><?=$_('vehicles')?></a>

     <div class="click-show">
      <a id="cars-for-sale"><?=$_('cars-for-sale')?></a>
      <a id="cars-for-rent"><?=$_('cars-for-rent')?></a>
      <a id="cars-spare-parts"><?=$_('cars-spare-parts')?></a>
      <a id="tires-batteries-oils-accessories"><?=$_('tires-batteries-oils-accessories')?></a>
      <a id="motorcycles-accessories"><?=$_('motorcycles-accessories')?></a>
      <a id="boats-watercraft"><?=$_('boats-watercraft')?></a>
      <a id="heavy-trucks-buses-other-vehicles"><?=$_('heavy-trucks-buses-other-vehicles')?></a>
     </div>


    </div>

    <div class="parent-click">
     <a id="properties"><?=$_('properties')?></a>
     <div class="click-show">

      <a id="apartments-for-sale"><?=$_('apartments-for-sale')?></a>
      <a id="apartments-for-rent"><?=$_('apartments-for-rent')?></a>
      <a id="villas-for-sale"><?=$_('villas-for-sale')?></a>
      <a id="villas-for-rent"><?=$_('villas-for-rent')?></a>
      <a id="vacation-homes-for-sale"><?=$_('vacation-homes-for-sale')?></a>
      <a id="vacation-homes-for-rent"><?=$_('vacation-homes-for-rent')?></a>
      <a id="commercial-for-sale"><?=$_('commercial-for-sale')?></a>
      <a id="commercial-for-rent"><?=$_('commercial-for-rent')?></a>
      <a id="buildings-lands"><?=$_('buildings-lands')?></a>
     </div>
    </div>

    <div class="parent-click">
     <a id="mobiles-tablets"><?=$_('mobiles-tablets')?></a>

     <div class="click-show">

      <a id="mobile-phones"><?=$_('mobile-phones')?></a>
      <a id="tablets"><?=$_('tablets')?></a>
      <a id="mobile-tablet-accessories"><?=$_('mobile-tablet-accessories')?></a>
      <a id="mobile-numbers"><?=$_('mobile-numbers')?></a>
     </div>
    </div>
    <div class="parent-click">
     <a id="electronics-appliances"><?=$_('electronics-appliances')?></a>
     <div class="click-show">
      <a id="home-appliances"><?=$_('home-appliances')?></a>
      <a id="computers-accessories"><?=$_('computers-accessories')?></a>
      <a id="video-games-consoles"><?=$_('video-games-consoles')?></a>
      <a id="cameras-photography"><?=$_('cameras-photography')?></a>
      <a id="tv-audio-video"><?=$_('tv-audio-video')?></a>
     </div>
    </div>
    <div class="parent-click">
     <a id="furniture-decor"><?=$_('furniture-decor')?></a>

     <div class="click-show">

      <a id="bathroom"><?=$_('bathroom')?></a>
      <a id="bedroom"><?=$_('bedroom')?></a>
      <a id="dining-room"><?=$_('dining-room')?></a>
      <a id="fabrics-curtains-carpets"><?=$_('fabrics-curtains-carpets')?></a>
      <a id="garden-outdoor"><?=$_('garden-outdoor')?></a>
      <a id="home-decoration"><?=$_('home-decoration')?></a>
      <a id="kitchen-kitchenware"><?=$_('kitchen-kitchenware')?></a>
      <a id="lightings"><?=$_('lightings')?></a>
      <a id="living-room" class="border-bottom"><?=$_('living-room')?></a>
      <a id="other-furniture"><?=$_('other-furniture')?></a>

     </div>
    </div>
    <div class="parent-click">
     <a id="business-industrial-agriculture"><?=$_('business-industrial-agriculture')?></a>

     <div class="click-show">

      <a id="industrial-equipment"><?=$_('industrial-equipment')?></a>
      <a id="construction"><?=$_('construction')?></a>
      <a id="office-furniture-equipment"><?=$_('office-furniture-equipment')?></a>
      <a id="restaurants-equipment"><?=$_('restaurants-equipment')?></a>
      <a id="medical-equipment"><?=$_('medical-equipment')?></a>
      <a id="agriculture"><?=$_('agriculture')?></a>
      <a class="border-bottom" id="whole-business-for-sale"><?=$_('whole-business-for-sale')?></a>
      <a id="other-business-industrial-agriculture"><?=$_('other-business-industrial-agriculture')?></a>

     </div>
    </div>
    <div class="parent-click">
     <a id="jobs"><?=$_('jobs')?></a>
     <div class="click-show border-bottom">
      <a id="accounting-finance-banking"><?=$_('accounting-finance-banking')?></a>
      <a id="customer-service-call-center"><?=$_('customer-service-call-center')?></a>
      <a id="drivers-delivery"><?=$_('drivers-delivery')?></a>
      <a id="designers"><?=$_('designers')?></a>
      <a id="education"><?=$_('education')?></a>
      <a id="engineering"><?=$_('engineering')?></a>
      <a id="guarding-security"><?=$_('guarding-security')?></a>
      <a id="hr"><?=$_('hr')?></a>
      <a id="it-telecom"><?=$_('it-telecom')?></a>
      <a id="legal-lawyers"><?=$_('legal-lawyers')?></a>
      <a id="management-consulting"><?=$_('management-consulting')?></a>
      <a id="marketing-and-public-relations"><?=$_('marketing-and-public-relations')?></a>
      <a id="medical-healthcare-nursing"><?=$_('medical-healthcare-nursing')?></a>
      <a id="sales"><?=$_('sales')?></a>
      <a id="secretarial"><?=$_('secretarial')?></a>
      <a id="tourism-travel"><?=$_('tourism-travel')?></a>
      <a class="border-bottom" id="workers-technicians"><?=$_('workers-technicians')?></a>

      <a id="other-job"><?=$_('other-job')?></a>

     </div>
    </div>


    <div class="parent none">
     <div class="click-show type">
     </div>
     <div class="click-show branch">
     </div>
    </div>

    <div class="nav-links border-y top block-a">

     <div>
      <a id="fashion-beauty"><?=$_('fashion-beauty')?></a>
      <div>
       <a id="men-clothing"><?=$_('men-clothing')?></a>
       <a class="border-bottom" id="women-clothing"><?=$_('women-clothing')?></a>
       <a id="men-accessories-personal-care"><?=$_('men-accessories-personal-care')?></a>
       <a id="women-accessories-cosmetics-personal-care"><?=$_('women-accessories-cosmetics-personal-care')?></a>
      </div>
     </div>

     <div>
      <a id="pets-accessories"><?=$_('pets-accessories')?></a>
      <div>
       <a id="birds-pigeons"><?=$_('birds-pigeons')?></a>
       <a id="cats"><?=$_('cats')?></a>
       <a id="dogs"><?=$_('dogs')?></a>
       <a id="other-pets-animals"><?=$_('other-pets-animals')?></a>
       <a id="accessories-pet-care-products"><?=$_('accessories-pet-care-products')?></a>
      </div>
     </div>

     <div>
      <a id="kids-babies"><?=$_('kids-babies')?></a>
      <div>
       <a id="baby-mom-healthcare"><?=$_('baby-mom-healthcare')?></a>
       <a id="baby-clothing"><?=$_('baby-clothing')?></a>
       <a id="baby-feeding-tools"><?=$_('baby-feeding-tools')?></a>
       <a id="cribs-strollers-carriers"><?=$_('cribs-strollers-carriers')?></a>
       <a id="toys"><?=$_('toys')?></a>
       <a id="other-baby-items"><?=$_('other-baby-items')?></a>
      </div>
     </div>

     <div>

      <a id="services"><?=$_('services')?></a>
      <div>
       <a id="business"><?=$_('business')?></a>
       <a id="cars"><?=$_('cars')?></a>
       <a id="events"><?=$_('events')?></a>
       <a id="education"><?=$_('education')?></a>
       <a id="health-beauty"><?=$_('health-beauty')?></a>
       <a id="home-services-maintenance"><?=$_('home-services-maintenance')?></a>
       <a id="medical"><?=$_('medical')?></a>
       <a id="pets"><?=$_('pets')?></a>
       <a id="other-services"><?=$_('other-services')?></a>
      </div>
     </div>

     <div>
      <a id="books-sports-hobbies"><?=$_('books-sports-hobbies')?></a>
      <div>
       <a id="antiques-collectibles"><?=$_('antiques-collectibles')?></a>
       <a id="bicycles"><?=$_('bicycles')?></a>
       <a id="books"><?=$_('books')?></a>
       <a id="board-card-games"><?=$_('board-card-games')?></a>
       <a id="movies-audios"><?=$_('movies-audios')?></a>
       <a id="sports-equipment"><?=$_('sports-equipment')?></a>
       <a id="study-tools"><?=$_('study-tools')?></a>
       <a id="tickets-vouchers"><?=$_('tickets-vouchers')?></a>
       <a id="luggage"><?=$_('luggage')?></a>
       <a id="other-items"><?=$_('other-items')?></a>
      </div>
     </div>

    </div>

   </nav>

  </section>



  <section class="sell-form <?=$showSell?>">
   <input type="hidden" name='id' value='<?=$id?>'>
   <div class="sell-top">
    <a class='return'><img src="../icons/chevron.svg" width="24px" alt="<?=$_('back')?>"></a>
    <h3><?=$_('post-ad')?></h3>
   </div>
   <div class="directory">
    <span id="directory"><?=$dir?></span>
    <a class='return'><?=$_('change')?></a>
   </div>
   <hr>
   <br>

   <div>

    <h3><?=$_('include-information')?>:</h3>
    <br>
    <div id="images-cont">
     <?=$_('ad-photos')?>
     <label for="input-listen-images"><img src="../icons/camera.svg" alt="<?=$_('upload')?>">
      <?=$_('up-photos')?>
     </label>

     <input id="input-listen-images" name='uploadImages[]' type="file" accept="image" multiple>

     <input id='uploaded' name='uploadedImages' type='hidden'>
     <div class='listen-images-out listen-images'><?=$result['photos']?></div>

    </div>

    <br>



    <label><?=$_('ad-title')?><input id="listen-title" value='<?=$result['title']?>' name="title" type="text" required
      autofocus maxlength="70" minlength="5">
     <span class="inv"></span></label>



    <label id='brand'>
     <br><br><?=$_('brand')?><div class="datalist-head"><?=$result['brand']?></div>
     <div class="brand datalist"></div><span class="hint"><?=$_('click-change')?></span>
    </label>



    <label class="status">
     <br><br><?=$_('status')?><div class="datalist-head"><?=$result['status']?></div>
     <div class="statusIn datalist">
      <label id="new"><?=$_('new')?></label>
      <label id="used"><?=$_('used')?></label>
      <label id="not-working"><?=$_('not-working')?></label>
     </div><span class="hint"><?=$_('click-change')?></span>
    </label>
    <br>
    <br>


    <label><?=$_('ad-description')?><textarea name="description" id="listen-description" required maxlength="4200"
      minlength="20"><?=$result['description']?></textarea>
     <span class="inv"></span></label>
    <br>

    <br>

    <label><span id='salary'><?=$_('price')?></span>
     <div class='price'>
      <input style="width: 100% !important" id="listen-price" placeholder="EGP" type="number" name="price" required max="1000000000" value='<?=is_numeric($result['price']) ? $result['price'] : ''?>'>

      <label class='fill-check' class='in-job'><input name="price" value="allowance" type="checkbox" <?php if ($result['price'] == 'allowance') {echo 'checked';}?>><?=$_('for-allowance')?></label>

      <hr class='vr'>

      <label class='fill-check' class='in-job'><input name="installment" type="checkbox" value="on" <?php if ($result['installment']) {echo 'checked';}?>><?=$_('installment-available')?></label>
     </div>

    </label>
    <br>
    <br>


    <label><?=$_('your-governorate')?></label>
    <div class="locationH datalist-head"><?=$result['location']?></div>
    <div class="location datalist">
     <label id='cairo'><?=$_('cairo')?></label>
     <label id='giza'><?=$_('giza')?></label>
     <label id='sharqia'><?=$_('sharqia')?></label>
     <label id='dakahlia'><?=$_('dakahlia')?></label>
     <label id='beheira'><?=$_('beheira')?></label>
     <label id='minya'><?=$_('minya')?></label>
     <label id='qalyubia'><?=$_('qalyubia')?></label>
     <label id='sohag'><?=$_('sohag')?></label>
     <label id='alexandria'><?=$_('alexandria')?></label>
     <label id='gharbia'><?=$_('gharbia')?></label>
     <label id='asyut'><?=$_('asyut')?></label>
     <label id='monufia'><?=$_('monufia')?></label>
     <label id='faiyum'><?=$_('faiyum')?></label>
     <label id='kafr-el-sheikh'><?=$_('kafr-el-sheikh')?></label>
     <label id='qena'><?=$_('qena')?></label>

     <label id='beni-suef'><?=$_('beni-suef')?></label>
     <label id='damietta'><?=$_('damietta')?></label>
     <label id='aswan'><?=$_('aswan')?></label>
     <label id='ismailia'><?=$_('ismailia')?></label>
     <label id='luxor'><?=$_('luxor')?></label>
     <label id='suez'><?=$_('suez')?></label>
     <label id='port-said'><?=$_('port-said')?></label>
     <label id='matrouh'><?=$_('matrouh')?></label>
     <label id='north-sinai'><?=$_('north-sinai')?></label>
     <label id='red-sea'><?=$_('red-sea')?></label>
     <label id='new-valley'><?=$_('new-valley')?></label>
     <label id='south-sinai'><?=$_('south-sinai')?></label>
    </div>
    <span class="hint"><?=$_('click-change')?></span>
    <br>
    <label><?=$_('your-area')?></label>

    <div class="areaHead datalist-head"><?=$result['area']?></div>

    <div class="datalist area">

     <div class="cairo">

      <label id="new-cairo"><?=$_('new-cairo')?></label>
      <label id="nasr-city"><?=$_('nasr-city')?></label>
      <label id="heliopolis"><?=$_('heliopolis')?></label>
      <label id="madinaty"><?=$_('madinaty')?></label>
      <label id="maadi"><?=$_('maadi')?></label>

      <label id="shorouk-city"><?=$_('shorouk-city')?></label>
      <label id="downtown-cairo"><?=$_('downtown-cairo')?></label>
      <label id="obour-city"><?=$_('obour-city')?></label>
      <label id="mostakbal-city"><?=$_('mostakbal-city')?></label>
      <label id="shubra"><?=$_('shubra')?></label>
      <label id="ain-shams"><?=$_('ain-shams')?></label>
      <label id="new-capital-city"><?=$_('new-capital-city')?></label>
      <label id="mokattam"><?=$_('mokattam')?></label>
      <label id="helwan"><?=$_('helwan')?></label>
      <label id="gesr-al-suez"><?=$_('gesr-al-suez')?></label>
      <label id="marg"><?=$_('marg')?></label>
      <label id="hadayek-al-kobba"><?=$_('hadayek-al-kobba')?></label>
      <label id="zahraa-al-maadi"><?=$_('zahraa-al-maadi')?></label>
      <label id="helmeyat-el-zaytoun"><?=$_('helmeyat-el-zaytoun')?></label>
      <label id="salam-city"><?=$_('salam-city')?></label>
      <label id="matareya"><?=$_('matareya')?></label>
      <label id="badr-city"><?=$_('badr-city')?></label>
      <label id="sheraton"><?=$_('sheraton')?></label>
      <label id="new-nozha"><?=$_('new-nozha')?></label>
      <label id="hadayek-helwan"><?=$_('hadayek-helwan')?></label>
      <label id="abasiya"><?=$_('abasiya')?></label>
      <label id="dar-al-salaam"><?=$_('dar-al-salaam')?></label>
      <label id="zamalek"><?=$_('zamalek')?></label>
      <label id="al-amiriyyah"><?=$_('al-amiriyyah')?></label>
      <label id="zawya-al-hamra"><?=$_('zawya-al-hamra')?></label>
      <label id="sayeda-zeinab"><?=$_('sayeda-zeinab')?></label>
      <label id="katameya"><?=$_('katameya')?></label>
      <label id="15-may-city"><?=$_('15-may-city')?></label>
      <label id="al-manial"><?=$_('al-manial')?></label>
      <label id="ezbet-el-nakhl"><?=$_('ezbet-el-nakhl')?></label>
      <label id="new-heliopolis"><?=$_('new-heliopolis')?></label>
      <label id="basateen"><?=$_('basateen')?></label>
      <label id="almazah"><?=$_('almazah')?></label>
      <label id="ramses"><?=$_('ramses')?></label>
      <label id="rod-al-farag"><?=$_('rod-al-farag')?></label>
     </div>

     <div class="giza">

      <label id="6th-of-october"><?=$_('6th-of-october')?></label>
      <label id="sheikh-zayed"><?=$_('sheikh-zayed')?></label>
      <label id="haram"><?=$_('haram')?></label>
      <label id="faisal"><?=$_('faisal')?></label>
      <label id="hadayek-october"><?=$_('hadayek-october')?></label>
      <label id="hadayek-al-ahram"><?=$_('hadayek-al-ahram')?></label>
      <label id="mohandessin"><?=$_('mohandessin')?></label>
      <label id="imbaba"><?=$_('imbaba')?></label>
      <label id="dokki"><?=$_('dokki')?></label>
      <label id="giza-district"><?=$_('giza-district')?></label>
      <label id="warraq"><?=$_('warraq')?></label>
      <label id="moneeb"><?=$_('moneeb')?></label>
      <label id="boulaq-dakrour"><?=$_('boulaq-dakrour')?></label>
      <label id="maryotaya"><?=$_('maryotaya')?></label>
      <label id="tersa"><?=$_('tersa')?></label>
      <label id="ard-el-lewa"><?=$_('ard-el-lewa')?></label>
      <label id="agouza"><?=$_('agouza')?></label>
      <label id="saft-el-laban"><?=$_('saft-el-laban')?></label>
      <label id="bashtil"><?=$_('bashtil')?></label>
      <label id="hawamdeya"><?=$_('hawamdeya')?></label>
      <label id="al-giza"><?=$_('al-giza')?></label>
      <label id="badrasheen"><?=$_('badrasheen')?></label>
      <label id="oseem"><?=$_('oseem')?></label>
      <label id="kit-kat"><?=$_('kit-kat')?></label>
      <label id="baragil"><?=$_('baragil')?></label>
      <label id="kerdasa"><?=$_('kerdasa')?></label>
      <label id="abu-rawash"><?=$_('abu-rawash')?></label>
      <label id="dahab-island"><?=$_('dahab-island')?></label>
      <label id="nahia"><?=$_('nahia')?></label>
      <label id="mansuriyya"><?=$_('mansuriyya')?></label>
      <label id="saf"><?=$_('saf')?></label>
      <label id="el-ayyat"><?=$_('el-ayyat')?></label>
      <label id="manial-shiha"><?=$_('manial-shiha')?></label>
      <label id="dahshur"><?=$_('dahshur')?></label>
     </div>

     <div class="sharqia">
      <label id="zagazig"><?=$_('zagazig')?></label>
      <label id="10th-of-ramadan"><?=$_('10th-of-ramadan')?></label>
      <label id="minya-al-qamh"><?=$_('minya-al-qamh')?></label>
      <label id="bilbeis"><?=$_('bilbeis')?></label>
      <label id="faqous"><?=$_('faqous')?></label>
      <label id="deyerb-negm"><?=$_('deyerb-negm')?></label>
      <label id="abu-hammad"><?=$_('abu-hammad')?></label>
      <label id="abu-kabir"><?=$_('abu-kabir')?></label>
      <label id="kafr-saqr"><?=$_('kafr-saqr')?></label>
      <label id="mashtool-al-souk"><?=$_('mashtool-al-souk')?></label>
      <label id="hihya"><?=$_('hihya')?></label>
      <label id="husseiniya"><?=$_('husseiniya')?></label>
      <label id="alqnayat"><?=$_('alqnayat')?></label>
      <label id="new-salhia"><?=$_('new-salhia')?></label>
      <label id="awlad-saqr"><?=$_('awlad-saqr')?></label>
      <label id="qareen"><?=$_('qareen')?></label>
      <label id="ibrahemyah"><?=$_('ibrahemyah')?></label>
     </div>
     <div class="dakahlia">


      <label id="mansura"><?=$_('mansura')?></label>
      <label id="mit-ghamr"><?=$_('mit-ghamr')?></label>
      <label id="talkha"><?=$_('talkha')?></label>
      <label id="new-mansoura"><?=$_('new-mansoura')?></label>
      <label id="sinbillawain"><?=$_('sinbillawain')?></label>
      <label id="belqas"><?=$_('belqas')?></label>
      <label id="dikirnis"><?=$_('dikirnis')?></label>
      <label id="aga"><?=$_('aga')?></label>
      <label id="shirbin"><?=$_('shirbin')?></label>
      <label id="manzala"><?=$_('manzala')?></label>
      <label id="minat-al-nasr"><?=$_('minat-al-nasr')?></label>
      <label id="gamasa"><?=$_('gamasa')?></label>
      <label id="nabaruh"><?=$_('nabaruh')?></label>
      <label id="el-matareya"><?=$_('el-matareya')?></label>
      <label id="akhtab"><?=$_('akhtab')?></label>
      <label id="bani-ubayd"><?=$_('bani-ubayd')?></label>
      <label id="el-kordy"><?=$_('el-kordy')?></label>
      <label id="el-gamaleya"><?=$_('el-gamaleya')?></label>
      <label id="tama-al-amdeed"><?=$_('tama-al-amdeed')?></label>
      <label id="mit-slseel"><?=$_('mit-slseel')?></label>
     </div>
     <div class="beheira">
      <label id="damanhour"><?=$_('damanhour')?></label>
      <label id="kafr-al-dawwar"><?=$_('kafr-al-dawwar')?></label>
      <label id="etay-al-barud"><?=$_('etay-al-barud')?></label>
      <label id="kom-hamadah"><?=$_('kom-hamadah')?></label>
      <label id="badr"><?=$_('badr')?></label>
      <label id="abou-homs"><?=$_('abou-homs')?></label>
      <label id="wadi-al-natrun"><?=$_('wadi-al-natrun')?></label>
      <label id="delengat"><?=$_('delengat')?></label>
      <label id="abuu-al-matamer"><?=$_('abuu-al-matamer')?></label>
      <label id="shubrakhit"><?=$_('shubrakhit')?></label>
      <label id="rashid"><?=$_('rashid')?></label>
      <label id="nubariyah"><?=$_('nubariyah')?></label>
      <label id="hosh-essa"><?=$_('hosh-essa')?></label>
      <label id="mahmoudiyah"><?=$_('mahmoudiyah')?></label>
      <label id="edko"><?=$_('edko')?></label>
      <label id="rahmaniya"><?=$_('rahmaniya')?></label>
     </div>
     <div class="minya">


      <label id="minya-city"><?=$_('minya-city')?></label>
      <label id="new-minya"><?=$_('new-minya')?></label>
      <label id="malawi"><?=$_('malawi')?></label>
      <label id="samalut"><?=$_('samalut')?></label>
      <label id="beni-mazar"><?=$_('beni-mazar')?></label>
      <label id="maghagha"><?=$_('maghagha')?></label>
      <label id="abu-qurqas"><?=$_('abu-qurqas')?></label>
      <label id="matay"><?=$_('matay')?></label>
      <label id="deir-mawas"><?=$_('deir-mawas')?></label>
      <label id="adwa"><?=$_('adwa')?></label>
     </div>

     <div class="qalyubia">
      <label id="shubra-al-khaimah"><?=$_('shubra-al-khaimah')?></label>
      <label id="banha"><?=$_('banha')?></label>
      <label id="khosous"><?=$_('khosous')?></label>
      <label id="khanka"><?=$_('khanka')?></label>
      <label id="qalyub"><?=$_('qalyub')?></label>
      <label id="qanater-al-khairia"><?=$_('qanater-al-khairia')?></label>
      <label id="shebin-al-qanater"><?=$_('shebin-al-qanater')?></label>
      <label id="tookh"><?=$_('tookh')?></label>
      <label id="qaha"><?=$_('qaha')?></label>
      <label id="kafr-shukr"><?=$_('kafr-shukr')?></label>
     </div>
     <div class="sohag">

      <label id="sohag"><?=$_('sohag')?></label>
      <label id="akhmim"><?=$_('akhmim')?></label>
      <label id="girga"><?=$_('girga')?></label>
      <label id="tahta"><?=$_('tahta')?></label>
      <label id="tama"><?=$_('tama')?></label>
      <label id="baliana"><?=$_('baliana')?></label>
      <label id="maragha"><?=$_('maragha')?></label>
      <label id="monsha"><?=$_('monsha')?></label>
      <label id="new-sohag"><?=$_('new-sohag')?></label>
      <label id="juhaynah"><?=$_('juhaynah')?></label>
      <label id="dar-el-salam"><?=$_('dar-el-salam')?></label>
      <label id="sakaltah"><?=$_('sakaltah')?></label>
      <label id="alasirat"><?=$_('alasirat')?></label>
     </div>
     <div class="alexandria">

     
      <label id="agami"><?=$_('agami')?></label>
      <label id="smoha"><?=$_('smoha')?></label>
      <label id="seyouf"><?=$_('seyouf')?></label>
      <label id="miami"><?=$_('miami')?></label>
      <label id="moharam-bik"><?=$_('moharam-bik')?></label>
      <label id="asafra"><?=$_('asafra')?></label>
      <label id="al-ibrahimiyyah"><?=$_('al-ibrahimiyyah')?></label>
      <label id="mandara"><?=$_('mandara')?></label>
      <label id="awayed"><?=$_('awayed')?></label>
      <label id="sidi-beshr"><?=$_('sidi-beshr')?></label>
      <label id="sidi-gaber"><?=$_('sidi-gaber')?></label>
      <label id="laurent"><?=$_('laurent')?></label>
      <label id="nakheel"><?=$_('nakheel')?></label>
      <label id="al-hadrah"><?=$_('al-hadrah')?></label>
      <label id="victoria"><?=$_('victoria')?></label>
      <label id="abu-qir"><?=$_('abu-qir')?></label>
      <label id="glim"><?=$_('glim')?></label>

      <label id="fleming"><?=$_('fleming')?></label>
      <label id="bacchus"><?=$_('bacchus')?></label>
      <label id="amreya"><?=$_('amreya')?></label>
      <label id="san-stefano"><?=$_('san-stefano')?></label>
      <label id="borg-al-arab"><?=$_('borg-al-arab')?></label>
      <label id="maamoura"><?=$_('maamoura')?></label>

      <label id="bolkly"><?=$_('bolkly')?></label>
      <label id="raml-station"><?=$_('raml-station')?></label>
      <label id="montazah"><?=$_('montazah')?></label>
      <label id="manshiyya"><?=$_('manshiyya')?></label>
      <label id="kafr-abdo"><?=$_('kafr-abdo')?></label>
      <label id="roushdy"><?=$_('roushdy')?></label>

      <label id="sporting"><?=$_('sporting')?></label>
      <label id="gianaclis"><?=$_('gianaclis')?></label>
      <label id="cleopatra"><?=$_('cleopatra')?></label>
      <label id="wardian"><?=$_('wardian')?></label>
      <label id="azarita"><?=$_('azarita')?></label>
      <label id="attarin"><?=$_('attarin')?></label>

      <label id="camp-caesar"><?=$_('camp-caesar')?></label>
      <label id="dekheila"><?=$_('dekheila')?></label>
      <label id="zezenia"><?=$_('zezenia')?></label>
      <label id="schutz"><?=$_('schutz')?></label>
      <label id="gomrok"><?=$_('gomrok')?></label>
     </div>
     <div class="gharbia">


      <label id="tanta"><?=$_('tanta')?></label>
      <label id="mahalla-al-kobra"><?=$_('mahalla-al-kobra')?></label>
      <label id="zefta"><?=$_('zefta')?></label>
      <label id="kafr-al-zayat"><?=$_('kafr-al-zayat')?></label>
      <label id="samanoud"><?=$_('samanoud')?></label>
      <label id="santa"><?=$_('santa')?></label>
      <label id="qutour"><?=$_('qutour')?></label>
      <label id="basyoun"><?=$_('basyoun')?></label>
     </div>
     <div class="asyut">
      <label id="asyut-city"><?=$_('asyut-city')?></label>
      <label id="new-assiut"><?=$_('new-assiut')?></label>
      <label id="fateh"><?=$_('fateh')?></label>
      <label id="dairut"><?=$_('dairut')?></label>
      <label id="qusiya"><?=$_('qusiya')?></label>
      <label id="manfalut"><?=$_('manfalut')?></label>
      <label id="abu-teeg"><?=$_('abu-teeg')?></label>
      <label id="abnub"><?=$_('abnub')?></label>
      <label id="badari"><?=$_('badari')?></label>
      <label id="sedfa"><?=$_('sedfa')?></label>
      <label id="ghanayem"><?=$_('ghanayem')?></label>
      <label id="sahel-selim"><?=$_('sahel-selim')?></label>
      <label id="new-tiba"><?=$_('new-tiba')?></label>
     </div>
     <div class="monufia">
      <label id="shebin-al-koum"><?=$_('shebin-al-koum')?></label>
      <label id="quesna"><?=$_('quesna')?></label>
      <label id="sadat"><?=$_('sadat')?></label>
      <label id="ashmon"><?=$_('ashmon')?></label>
      <label id="menouf"><?=$_('menouf')?></label>
      <label id="bagour"><?=$_('bagour')?></label>
      <label id="berket-al-sabaa"><?=$_('berket-al-sabaa')?></label>
      <label id="tala"><?=$_('tala')?></label>
      <label id="shohadaa"><?=$_('shohadaa')?></label>
      <label id="sers-al-lyan"><?=$_('sers-al-lyan')?></label>
     </div>
     <div class="faiyum">
      <label id="atssa"><?=$_('atssa')?></label>
      <label id="fayoum-city"><?=$_('fayoum-city')?></label>
      <label id="ibshway"><?=$_('ibshway')?></label>
      <label id="new-fayoum"><?=$_('new-fayoum')?></label>
      <label id="sinnuras"><?=$_('sinnuras')?></label>
      <label id="tamiya"><?=$_('tamiya')?></label>
      <label id="yusuf-al-sadiq"><?=$_('yusuf-al-sadiq')?></label>
     </div>
     <div class="kafr-el-sheikh">
      <label id="kafr-cityal-sheikh"><?=$_('kafr-cityal-sheikh')?></label>
      <label id="desouk"><?=$_('desouk')?></label>
      <label id="bella"><?=$_('bella')?></label>
      <label id="qaleen"><?=$_('qaleen')?></label>
      <label id="sidi-salem"><?=$_('sidi-salem')?></label>
      <label id="baltim"><?=$_('baltim')?></label>
      <label id="hamoul"><?=$_('hamoul')?></label>
      <label id="riyadh"><?=$_('riyadh')?></label>
      <label id="fouh"><?=$_('fouh')?></label>
      <label id="motobas"><?=$_('motobas')?></label>
      <label id="brolos"><?=$_('brolos')?></label>
     </div>
     <div class="qena">
      <label id="abu-tesht"><?=$_('abu-tesht')?></label>
      <label id="dishna"><?=$_('dishna')?></label>
      <label id="el-waqf"><?=$_('el-waqf')?></label>
      <label id="farshut"><?=$_('farshut')?></label>
      <label id="nag-hammadi"><?=$_('nag-hammadi')?></label>
      <label id="naqada"><?=$_('naqada')?></label>
      <label id="new-qena"><?=$_('new-qena')?></label>
      <label id="qena"><?=$_('qena')?></label>
      <label id="qift"><?=$_('qift')?></label>
      <label id="qus"><?=$_('qus')?></label>
     </div>
     <div class="beni-suef">
      <label id="beni-suef-city"><?=$_('beni-suef-city')?></label>
      <label id="new-beni-suef"><?=$_('new-beni-suef')?></label>
      <label id="al-wasty"><?=$_('al-wasty')?></label>
      <label id="nasser"><?=$_('nasser')?></label>
      <label id="beba"><?=$_('beba')?></label>
      <label id="al-feshn"><?=$_('al-feshn')?></label>
      <label id="ehnasia"><?=$_('ehnasia')?></label>
      <label id="samasta"><?=$_('samasta')?></label>
     </div>
     <div class="damietta">
      <label id="damietta-city"><?=$_('damietta-city')?></label>
      <label id="new-damietta"><?=$_('new-damietta')?></label>
      <label id="ras-al-bar"><?=$_('ras-al-bar')?></label>
      <label id="fareskour"><?=$_('fareskour')?></label>
      <label id="kafr-saad"><?=$_('kafr-saad')?></label>
      <label id="zarqa"><?=$_('zarqa')?></label>
      <label id="kafr-al-bateekh"><?=$_('kafr-al-bateekh')?></label>
      <label id="ezbet-al-burj"><?=$_('ezbet-al-burj')?></label>
      <label id="saro"><?=$_('saro')?></label>
      <label id="el-rodah"><?=$_('el-rodah')?></label>
      <label id="mit-abughalb"><?=$_('mit-abughalb')?></label>
     </div>
     <div class="aswan">
      <label id="abu-simbel"><?=$_('abu-simbel')?></label>
      <label id="aswan"><?=$_('aswan')?></label>
      <label id="daraw"><?=$_('daraw')?></label>
      <label id="edfu"><?=$_('edfu')?></label>
      <label id="kom-ombo"><?=$_('kom-ombo')?></label>
      <label id="new-aswan"><?=$_('new-aswan')?></label>
      <label id="new-tushka"><?=$_('new-tushka')?></label>
      <label id="nasr"><?=$_('nasr')?></label>
     </div>
     <div class="ismailia">
      <label id="ismailia-city"><?=$_('ismailia-city')?></label>
      <label id="fayed"><?=$_('fayed')?></label>
      <label id="kantara-west"><?=$_('kantara-west')?></label>
      <label id="abu-swear"><?=$_('abu-swear')?></label>
      <label id="tal-al-kebeer"><?=$_('tal-al-kebeer')?></label>
      <label id="qassaseen"><?=$_('qassaseen')?></label>
      <label id="kantara-east"><?=$_('kantara-east')?></label>
     </div>
     <div class="luxor">
      <label id="qurna"><?=$_('qurna')?></label>
      <label id="luxor"><?=$_('luxor')?></label>
      <label id="luxor"><?=$_('luxor')?></label>
      <label id="armant"><?=$_('armant')?></label>
      <label id="esna"><?=$_('esna')?></label>
      <label id="thebes"><?=$_('thebes')?></label>
     </div>
     <div class="suez">
      <label id="ain-sukhna"><?=$_('ain-sukhna')?></label>
      <label id="suez-district"><?=$_('suez-district')?></label>
      <label id="arbaeen"><?=$_('arbaeen')?></label>
      <label id="faisal-district"><?=$_('faisal-district')?></label>
      <label id="attaka"><?=$_('attaka')?></label>
      <label id="ganayen"><?=$_('ganayen')?></label>
     </div>
     <div class="port-said">
      <label id="sharq-district"><?=$_('sharq-district')?></label>
      <label id="port-fouad"><?=$_('port-fouad')?></label>
      <label id="zohour-district"><?=$_('zohour-district')?></label>
      <label id="dawahy-district"><?=$_('dawahy-district')?></label>
      <label id="manakh-district"><?=$_('manakh-district')?></label>
      <label id="arab-district"><?=$_('arab-district')?></label>
      <label id="ganoub-district"><?=$_('ganoub-district')?></label>
     </div>
     <div class="matrouh-said">
      <label id="north-coast"><?=$_('north-coast')?></label>
      <label id="alamein"><?=$_('alamein')?></label>
      <label id="marsa-matrouh"><?=$_('marsa-matrouh')?></label>
      <label id="dabaa"><?=$_('dabaa')?></label>
      <label id="hammam"><?=$_('hammam')?></label>
      <label id="siwa"><?=$_('siwa')?></label>
     </div>
     <div class="north-sinai">
      <label id="el-arish-1"><?=$_('el-arish-1')?></label>
      <label id="el-hassana"><?=$_('el-hassana')?></label>
      <label id="sheikh-zuweid"><?=$_('sheikh-zuweid')?></label>
      <label id="bir-el-abd"><?=$_('bir-el-abd')?></label>
      <label id="nakhl"><?=$_('nakhl')?></label>
      <label id="rafah"><?=$_('rafah')?></label>
      <label id="shurtet-el-qasima"><?=$_('shurtet-el-qasima')?></label>
      <label id="shurtet-rumana"><?=$_('shurtet-rumana')?></label>
     </div>
     <div class="red-sea">
      <label id="hurghada"><?=$_('hurghada')?></label>
      <label id="gouna"><?=$_('gouna')?></label>
      <label id="safaga"><?=$_('safaga')?></label>
      <label id="sahl-hasheesh"><?=$_('sahl-hasheesh')?></label>
      <label id="ras-gharib"><?=$_('ras-gharib')?></label>
      <label id="qusair"><?=$_('qusair')?></label>
      <label id="marsa-alam"><?=$_('marsa-alam')?></label>
      <label id="makadi-bay"><?=$_('makadi-bay')?></label>
      <label id="soma-bay"><?=$_('soma-bay')?></label>
      <label id="halayeb-shalateen"><?=$_('halayeb-shalateen')?></label>
     </div>

     <div class="new-valley">
      <label id="kharga"><?=$_('kharga')?></label>
      <label id="balat"><?=$_('balat')?></label>
      <label id="dakhla"><?=$_('dakhla')?></label>
      <label id="farafra"><?=$_('farafra')?></label>
      <label id="baris"><?=$_('baris')?></label>
     </div>

     <div class="south-sinai">
      <label id="abu-redis"><?=$_('abu-redis')?></label>
      <label id="dahab"><?=$_('dahab')?></label>
      <label id="el-tor"><?=$_('el-tor')?></label>
      <label id="nuweiba"><?=$_('nuweiba')?></label>
      <label id="ras-sedr"><?=$_('ras-sedr')?></label>
      <label id="saint-catherine"><?=$_('saint-catherine')?></label>
      <label id="sharm-el-sheikh"><?=$_('sharm-el-sheikh')?></label>
      <label id="taba"><?=$_('taba')?></label>
     </div>

    </div>

    <span class="hint"><?=$_('click-change')?></span>

    <div class='ship'>
     <br>
     <br>

     <label class='fill-check'><input name="deliverable" value='on' type="checkbox"
       <?php if ($result['deliverable']) {echo 'checked';}?>><?=$_('is-deliverable')?></label>

     <br>
    </div>
    <br>
    <br>
    <span class="small-color"><?=$_('review-account')?></span>
    <br>

    <div class="seller-in">
     <img class="seller" src="../icons/pngkey.com-user-png-729670.svg" alt="<?=$_('user')?>">
     <div>
      <label><?=$_('your-name')?><input type='text' readonly value="<?=$user['name']?>"></label>
     </div>
    </div>

    <label><?=$_('your-number')?><input type='text' readonly value="<?=$user['phone']?>"></label>

    <br>
    <br>

    <div class="contact-method">
     <label><?=$_('contact-method')?></label>

     <br>


     <label><input type="radio" name="contact" value="phone"
       <?php if ($result['contact'] == 'phone') {echo 'checked';}?>><?=$_('phone')?></label>
     <label><input type="radio" name="contact" value="chat"
       <?php if ($result['contact'] == 'chat') {echo 'checked';}?>><?=$_('chat')?></label>
     <hr class='vr'>
     <label><input checked type="radio" name="contact" value="both"
       <?php if ($result['contact'] == 'both') {echo 'checked';}?>><?=$_('both')?></label><br>
     <br>

     <button class="btn submit" type="submit"><?=$_('post-now')?></button>
    </div>
   </div>

  </section>


 </form>




 <?php ob_start();include dirname(dirname(__FILE__)) . '/components/footer.php';ob_end_flush()?>

</body>

</html>