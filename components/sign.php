<form method='POST' class="sign-in-form log  <?=$logErr?>">

 <div>
  <p><?=$_('sign-in-create')?></p>
 </div>

 <label>
  <?=$_('your-email-number')?><input minlength='9' required class='phoneOrEmail' type="text" autocomplete="email"
   name='log' placeholder="<?=$_('type-number-email')?>">
  <span class='inv'></span>
 </label>

 <label><?=$_('your-password')?><input name='log-password' required minlength='6' type="password"></label>
 <label><input type="checkbox" name='remember'><?=$_('remember-me')?></label>

 <?=$valAcc?>

 <input type="submit" value="Sign In">
 <a onclick="toggle('.create-acc', 'flex')" class='blue'><?=$_('create-account')?></a>

</form>

<form method='POST' class="sign-in-form create-acc  <?=$createErr?>">

 <h3><?=$_('create-account')?></h3>

 <label><?=$_('your-name')?><input type="text" minlength='2' maxlength='24' name="name" required
   placeholder="<?=$_('first-last-name')?>"></label>

 <label><?=$_('phone-number')?><input minlength='9' maxlength='16' type="tel" name="phone" required
   placeholder="<?=$_('type-number')?>"><span class='inv'></span></label>
 <label><?=$_('email-optional')?><input type="email" name="email" placeholder="<?=$_('type-email')?>"><span
   class='inv'></span></label>

 <hr>

 <label><?=$_('password')?><input id='new-password' type="password" minlength='6' required
   placeholder="<?=$_('least-6')?>"><span class='inv'></span></label>



 <label><?=$_('re-password')?><input id='retype-password' minlength='6' name='password' type="password" required><span
   class='inv'></span></label>


 <input type="submit" value="Create">

 <?=$duplicate?>

</form>