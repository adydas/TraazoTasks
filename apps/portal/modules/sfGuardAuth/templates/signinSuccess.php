<?php use_helper('Form'); ?>
<?php use_helper('Validation'); ?>

<!-- LOGIN FORM ------------------------------------------->
<div id="login_wrapper">
	
    <!-- FORGOT PASSWORD FORM -->
    <div id="forgot_password_wrapper" style="display: none;">
        <div id="forgot_password_content">
        
        </div>
    </div>
	<div id="login_form">
		<?php use_helper('I18N') ?>
        
         <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
            <table>
            <?php echo $form ?>
            </table>
            <div class="form_actions_wrapper">
                <input type="submit" value="<?php echo __('sign in') ?>" />
            </div>
        </form>
                    
        <a id="forgot_password" href="<?php echo url_for('@request_password') ?>"><?php echo __('Forgot your password?') ?></a>
        <br/><br/>
        New User? <?= link_to ("Sign up now!", "@account_create", array("id"=>"new_user_button")) ?>
    </div>
</div>
