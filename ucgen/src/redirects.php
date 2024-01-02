<!-- redirects.php -->

<?php require_once('config_url.php');?>
<script>
    
    function redirectToAdminRegister(){
        window.location.href = '<?php echo $_admin_register?>';
    }

    function redirectToAdminManager(){
        window.location.href = '<?php echo $_user_manager?>';
    }

    function redirectToCorrection(){
        window.location.href = '<?php echo $_uc_correction?>';
    }

    function redirectToManagement(){
        window.location.href = '<?php echo $_uc_manager?>';
    }

    function redirectToProfile(){
        window.location.href = '<?php echo $_profile?>';
    }

    function redirectToGen(){
        window.location.href = '<?php echo $_uc_generator?>';
    }

    function redirectToChangePassword(){
        window.location.href = '<?php echo $_change_password?>';
    }

</script>