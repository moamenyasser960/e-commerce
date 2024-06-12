<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../sell/post.css">
  </head>

  <body>
  <?php include '/opt/lampp/htdocs/design/components/header.php'?><?php include '/opt/lampp/htdocs/design/components/nav.php'?>

    <form class="sell-form" action="" autocomplete="off">
      <div class="sell-top">
        <span onclick="history.back()"><img src="../icons/chevron.svg" width="24px" alt="back"></span>
        <h3>edit your ad</h3>
      </div>
      <br>

      <div>

        <h3>edit your ad's information:</h3>
        <br>
        <div id="images-cont">
          your ad's photos:



          <label for="input-ad-images">
            <img src="../icons/camera.svg" alt="upload">upload up to 20
            photos
            <div class="ad-images">
              <img src="../images/3.jpg" alt="">
              <img src="../images/2.jpg" alt="">
              <img src="../images/4.jpg" alt="">
              <img src="../images/5.jpg" alt="">
              <img src="../images/6.jpg" alt="">
            </div>
          </label>

          <input id="input-ad-images" type="file" accept="image/*" multiple>
        </div>

        <br>


        <label for="ad-title">your ad's title:</label>
        <input id="ad-title" type="text" required autofocus maxlength="70" minlength="5">
        <span id="hint-title"></span>
        <br>
        <br>

        <label for="ad-brand" name="ad-brand">brand:</label>
        <input id="input-brand" required list="ad-brand">
        <datalist required name="brand" id="ad-brand">
          <option value="all">
          <option value="mercedes">
          <option value="sco">
          <option value="a">
          <option value="rel">
          <option value="q">
          <option value="gs">
          <option value="gr">
          <option value="Other">
        </datalist>
        <span id="invalid-brand"></span>
        <br>
        <br>
        <label for="ad-status" name="ad-status">status:</label>
        <input required list="ad-status" id="status">
        <datalist name="status" id="ad-status">
          <option value="New">
          <option value="Used">
          <option value="Not Working">
        </datalist>
        <span id="invalid-status"></span>
        <br>
        <br>


        <label for="ad-description">your ad's description:</label>
        <textarea name="" id="ad-description" required maxlength="4200" minlength="20"></textarea>
        <span id="hint-description"></span>
        <br>

        <br>

        <label for="ad-price">price:
        </label>
        <div style="  
      display: flex;
      align-items: baseline;
      ">

          <input style="flex: 1;
        " id="ad-price" placeholder="EGP" type="number" required min="0"
            oninput="document.getElementById('for-allowance').checked = false">
          <label oninput="document.getElementById('ad-price').value = ''" for="for-allowance"> <input id="for-allowance"
              type="checkbox">
            For allowance</label>
        </div>
        <br>
        <br>


        <label for="location">your ad's location:</label>
        <input type="text" placeholder="Enter your governorate (Alexandria, for example)" list="locations"
          name="location" id="location" required>
        <datalist id="locations">
          <option value="Cairo">
          <option value="Giza">
          <option value="Sharqia">
          <option value="Dakahlia">
          <option value="Beheira">
          <option value="Minya">
          <option value="Qalyubia">
          <option value="Sohag">
          <option value="Alexandria">
          <option value="Gharbia">
          <option value="Monufia">
          <option value="Faiyum">
          <option value="Kafr El">
          <option value="Qena">

          <option value="Beni Suef">
          <option value="Damietta">
          <option value="Aswan">
          <option value="Ismailia">
          <option value="Luxor">
          <option value="Suez">
          <option value="Port Said">
          <option value="Matrouh">
          <option value="North Sinai">
          <option value="Red Sea">
          <option value="New Valley">
          <option value="South Sinai">
        </datalist>
        <span id="invalid-location"></span><br>
        <label for="location"> in:
        </label>
        <input type="text" placeholder="Write your area (for example Ramses In Cairo)" list="sup-locations"
          name="sup-location" id="sup-location" required>
        <datalist id="sup-locations">

          <option value="New Cairo">
          <option value="New Cairo">
          <option value="Nasr City">
          <option value="Heliopolis">
          <option value="Madinaty">
          <option value="Maadi">

          <option value="Shorouk City">
          <option value="Downtown Cairo">
          <option value="Obour City">
          <option value="Mostakbal City">
          <option value="Shubra">
          <option value="Ain Shams">
          <option value="New Capital City">
          <option value="Mokattam">
          <option value="Helwan">
          <option value="Gesr Al Suez">
          <option value="Marg">
          <option value="Hadayek al-Kobba">
          <option value="Zahraa Al Maadi">
          <option value="Helmeyat El Zaytoun">
          <option value="Salam City">
          <option value="Matareya">
          <option value="Badr City">
          <option value="Sheraton">
          <option value="New Nozha">
          <option value="Hadayek Helwan">
          <option value="Abasiya">
          <option value="Dar al-Salaam">
          <option value="Zamalek">
          <option value="Al Amiriyyah">
          <option value="Zawya al-Hamra">
          <option value="Sayeda Zeinab">
          <option value="Katameya">
          <option value="15 May City">
          <option value="Al Manial">
          <option value="Ezbet El Nakhl">
          <option value="New Heliopolis">
          <option value="Basateen">
          <option value="Almazah">
          <option value="Ramses">
          <option value="Rod al-Farag">
          <option value="6th of October">
          <option value="Sheikh Zayed">
          <option value="Haram">
          <option value="Faisal">
          <option value="Hadayek October">
          <option value="Hadayek al-Ahram">
          <option value="Mohandessin">
          <option value="Imbaba">
          <option value="Dokki">
          <option value="Giza District">
          <option value="Warraq">
          <option value="Moneeb">
          <option value="Boulaq Dakrour">
          <option value="Maryotaya">
          <option value="Tersa">
          <option value="Ard El Lewa">
          <option value="Agouza">
          <option value="Saft El Laban">
          <option value="Bashtil">
          <option value="Hawamdeya">
          <option value="al-Giza">
          <option value="Badrasheen">
          <option value="Oseem">
          <option value="Kit Kat">
          <option value="Baragil">
          <option value="Kerdasa">
          <option value="Abu Rawash">
          <option value="Dahab Island">
          <option value="Nahia">
          <option value="Mansuriyya">
          <option value="Saf">
          <option value="El Ayyat">
          <option value="Manial Shiha">
          <option value="Dahshur">
          <option value="Zagazig">
          <option value="10th of Ramadan">
          <option value="Minya al-Qamh">
          <option value="Bilbeis">
          <option value="Faqous">
          <option value="Deyerb Negm">
          <option value="Abu Hammad">
          <option value="Abu Kabir">
          <option value="Kafr Saqr">
          <option value="Mashtool al-Souk">
          <option value="Hihya">
          <option value="Husseiniya">
          <option value="Alqnayat">
          <option value="New Salhia">
          <option value="Awlad Saqr">
          <option value="Qareen">
          <option value="Ibrahemyah">
          <option value="Mansura">
          <option value="Mit Ghamr">
          <option value="Talkha">
          <option value="New Mansoura">
          <option value="Sinbillawain">
          <option value="Belqas">
          <option value="Dikirnis">
          <option value="Aga">
          <option value="Shirbin">
          <option value="Manzala">
          <option value="Minat al-Nasr">
          <option value="Gamasa">
          <option value="Nabaruh">
          <option value="El Matareya">
          <option value="Akhtab">
          <option value="Bani Ubayd">
          <option value="El Kordy">
          <option value="El Gamaleya">
          <option value="Tama al-Amdeed">
          <option value="Mit Slseel">
          <option value="Damanhour">
          <option value="Kafr al-Dawwar">
          <option value="Etay al-Barud">
          <option value="Kom Hamadah">
          <option value="Badr">
          <option value="Abou Homs">
          <option value="Wadi al-Natrun">
          <option value="Delengat">
          <option value="Abuu al-Matamer">
          <option value="Shubrakhit">
          <option value="Rashid">
          <option value="Nubariyah">
          <option value="Hosh Essa">
          <option value="Mahmoudiyah">
          <option value="Edko">
          <option value="Rahmaniya">
          <option value="Minya City">
          <option value="New Minya">
          <option value="Malawi">
          <option value="Samalut">
          <option value="Beni Mazar">
          <option value="Maghagha">
          <option value="Abu Qurqas">
          <option value="Matay">
          <option value="Deir Mawas">
          <option value="Adwa">
          <option value="Shubra al-Khaimah">
          <option value="Banha">
          <option value="Khosous">
          <option value="Khanka">
          <option value="Bahtim">
          <option value="Qalyub">
          <option value="Qanater al-Khairia">
          <option value="Shebin al-Qanater">
          <option value="Musturad">
          <option value="Tookh">
          <option value="Qaha">
          <option value="Kafr Shukr">
          <option value="Sohag">
          <option value="Akhmim">
          <option value="Girga">
          <option value="Tahta">
          <option value="Tama">
          <option value="Baliana">
          <option value="Maragha">
          <option value="Monsha'a">
          <option value="New Sohag">
          <option value="Juhaynah">
          <option value="Dar el Salam">
          <option value="Sakaltah">
          <option value="Alasirat">
          <option value="Agami">
          <option value="Sidi Beshr">
          <option value="Smoha">
          <option value="Seyouf">
          <option value="Miami">
          <option value="Moharam Bik">
          <option value="Asafra">
          <option value="Al Ibrahimiyyah">
          <option value="Mandara">
          <option value="Awayed">
          <option value="Agami">
          <option value="Sidi Beshr">
          <option value="Sidi Gaber">
          <option value="Laurent">
          <option value="Nakheel">
          <option value="Al Hadrah">
          <option value="Victoria">
          <option value="Abu Qir">
          <option value="Glim">

          <option value="Fleming">
          <option value="Bacchus">
          <option value="Amreya">
          <option value="San Stefano">
          <option value="Borg al-Arab">
          <option value="Maamoura">

          <option value="Bolkly">
          <option value="Raml Station">
          <option value="Montazah">
          <option value="Manshiyya">
          <option value="Kafr Abdo">
          <option value="Roushdy">

          <option value="Sporting">
          <option value="Gianaclis">
          <option value="Cleopatra">
          <option value="Wardian">
          <option value="Azarita">
          <option value="Attarin">

          <option value="Camp Caesar">
          <option value="Dekheila">
          <option value="Zezenia ">
          <option value="Schutz">
          <option value="Gomrok">
          <option value="Tanta">
          <option value="Mahalla al-Kobra">
          <option value="Zefta">
          <option value="Kafr al-Zayat">
          <option value="Samanoud">
          <option value="Santa">
          <option value="Qutour">
          <option value="Basyoun">
          <option value="Asyut City">
          <option value="New Assiut">
          <option value="Fateh">
          <option value="Dairut">
          <option value="Qusiya">
          <option value="Manfalut">
          <option value="Abu Teeg">
          <option value="Abnub">
          <option value="Badari">
          <option value="Sedfa">
          <option value="Ghanayem">
          <option value="Sahel Selim">
          <option value="New Tiba">
          <option value="Shebin al-Koum">
          <option value="Quesna">
          <option value="Sadat">
          <option value="Ashmon">
          <option value="Menouf">
          <option value="Bagour">
          <option value="Berket al-Sabaa">
          <option value="Tala">
          <option value="Shohadaa">
          <option value="Sers al-Lyan">
          <option value="Kafr al-Sheikh City">
          <option value="Desouk">
          <option value="Bella">
          <option value="Qaleen">
          <option value="Sidi Salem">
          <option value="Baltim">
          <option value="Hamoul">
          <option value="Riyadh">
          <option value="Fouh">
          <option value="Motobas">
          <option value="Brolos">
          <option value="Abu Tesht">
          <option value="Dishna">
          <option value="El Waqf">
          <option value="Farshut">
          <option value="Nag Hammadi">
          <option value="Naqada">
          <option value="New Qena">
          <option value="Qena">
          <option value="Qift">
          <option value="Qus">
          <option value="Beni Suef City">
          <option value="New Beni Suef">
          <option value="Al Wasty">
          <option value="Nasser">
          <option value="Beba">
          <option value="Al Feshn">
          <option value="Ehnasia">
          <option value="Samasta">
          <option value="Damietta City">
          <option value="New Damietta">
          <option value="Ras al-Bar">
          <option value="Fareskour">
          <option value="Kafr Saad">
          <option value="Zarqa">
          <option value="Kafr al-Bateekh">
          <option value="Ezbet al-Burj">
          <option value="Saro">
          <option value="el Rodah">
          <option value="Mit Abughalb">
          <option value="Abu Simbel">
          <option value="Aswan">
          <option value="Daraw">
          <option value="Edfu">
          <option value="Kom Ombo">
          <option value="New Aswan">
          <option value="New Tushka">
          <option value="Nasr">
          <option value="Ismailia City">
          <option value="Fayed">
          <option value="Kantara West">
          <option value="Abu Swear">
          <option value="Tal al-Kebeer">
          <option value="Qassaseen">
          <option value="Kantara East">
          <option value="Qurna">
          <option value="Luxor">
          <option value="Luxor">
          <option value="Armant">
          <option value="Esna">
          <option value="Thebes">
          <option value="Ain Sukhna">
          <option value="Suez District">
          <option value="Arbaeen">
          <option value="Faisal District">
          <option value="Attaka">
          <option value="Ganayen">
          <option value="Sharq District">
          <option value="Port Fouad">
          <option value="Zohour District">
          <option value="Dawahy District">
          <option value="Manakh District">
          <option value="Arab District">
          <option value="Ganoub District">
          <option value="North Coast">
          <option value="Alamein">
          <option value="Marsa Matrouh">
          <option value="Dabaa">
          <option value="Hammam">
          <option value="Siwa">
          <option value="El Arish 1">
          <option value="El Hassana">
          <option value="Sheikh Zuweid">
          <option value="Bir El Abd">
          <option value="Nakhl">
          <option value="Rafah">
          <option value="Shurtet El Qasima">
          <option value="Shurtet Rumana">
          <option value="Hurghada">
          <option value="Gouna">
          <option value="Safaga">
          <option value="Sahl Hasheesh">
          <option value="Ras Gharib">
          <option value="Qusair">
          <option value="Marsa Alam">
          <option value="Makadi Bay">
          <option value="Soma Bay">
          <option value="Halayeb & Shalateen">
          <option value="Kharga">
          <option value="Balat">
          <option value="Dakhla">
          <option value="Farafra">
          <option value="Baris">
          <option value="Abu Redis">
          <option value="Dahab">
          <option value="El Tor">
          <option value="Nuweiba">
          <option value="Ras Sedr">
          <option value="Saint Catherine">
          <option value="Sharm El Sheikh">
          <option value="Taba">

        </datalist>

        <span id="invalid-sup-location"></span>



        <br>

        <br>
        <br>

        Review your account:
        <br>

        <div class="seller-in">
          <img class="seller" src="../icons/pngkey.com-user-png-729670.svg" alt="user">
          <div>
            <label for="seller-name">your name:</label>
            <input required id="seller-name" value="Moamen Yasser" type="text">
          </div>
        </div>

        <label for="seller-phone">Your mobile number:</label>

        <input required value="01211451295" id="seller-phone" type="tel"
          onclick="toggle('change-phone-number', 'd-flex')" minlength="10" maxlength="11">
        <br>

        <div class="change-phone-number">
          <span onclick="toggle('change-phone-number', 'd-flex')"><img src="../icons/x.svg" alt="back"></span>
          <span>change your
            mobile number</span>
          <span>We will send a confirmation code to your number</span>
          <input required onkeydown="saveMemento()" id="chang-seller-phone" type="tel" minlength="10" data='01211451295'
            value="01211451295" maxlength="11">
          <p><span>warning!</span>Changing your phone number in this step will also change it in your profile and
            login
            information.<br><span onclick="undo()" id="undo-phone">undo</span></p>
          <button class="btn" type="button">next</button>
        </div>
        <br>
        <br>

        <div>
          <label for="">contact method:</label>

          <br>


          <input onclick="valthis()" checked type="checkbox" id="by-phone" name="contact" value="phone">
          <label for="by-phone">phone</label>


          <input onclick="valthis()" checked type="checkbox" id="by-chat" name="contact" value="chat">
          <label for="by-chat">chat</label><br>
          <span id="check-invalid"></span>
          <br>


          <button class="btn submit" type="submit">edit now</button>
        </div>
      </div>

    </form>

    <?php include '/opt/lampp/htdocs/design/components/footer.php'?>

    <script src="../js/global.js"></script>
    <script src="../sell/post.js"></script>
  </body>

</html>