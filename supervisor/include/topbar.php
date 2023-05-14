<?php 

include("../connection.php");
date_default_timezone_set('Asia/Kolkata');
$current_timestamp = date('Y-m-d H:i:s');;

?>
<!-- NAVBAR -->
<nav>
    <i class='bx bx-menu'></i>
    <div style="margin-left: auto;display: inline-flex;">
        <div style="margin-left: auto; margin-right: 30px;align-self: center;" id="google_translate_element"></div>

    
        <a title="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'] ;}?>" href="#" class="profile">
            <span style="margin-right: 10px;" class=" d-none d-lg-inline text-gray-600 small"><?php  if(isset($_SESSION['name'])){echo $_SESSION['name'] ;}?></span>    
            <img src="./img/undraw_profile_2.svg" alt="<?php  if(isset($_SESSION['name'])){echo $_SESSION['name'] ;}?>">
        </a>
    </div>
</nav>
<!-- NAVBAR -->




<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>