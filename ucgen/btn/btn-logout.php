<?php session_start();
require_once(__DIR__.'/../src/config_url.php');?>

<form style="margin:0; padding:0;"action="<?php echo $_src_disconnect;?>" method="post">
    <input type="submit" value="Se déconnecter">
</form>