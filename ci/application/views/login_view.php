
<?php
//login data
// Kom ihåg det du skrev i fälten vid uppdatering av sidan. 
// Första variablen är 'name' andra vad det ska stå, alltså 'value'.
$username_field_value = set_value('login_username', 'Användarnamn');
$pwd_field_value = set_value('login_pwd', 'password');

/* Lägger in data i arrayer för varje fält på formuläret. 
 * Här ingår också koden för att kalla på javascripten.
 */
$login_username_data = array(
    'type' => 'text',
    'name' => 'login_username',
    'id' => 'username',
    'value' => $username_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'Användarnamn')",
    'onblur' => "clickrecall(this,'Användarnamn')");
$login_password_data = array(
    'type' => 'password',
    'name' => 'login_pwd',
    'value' => $pwd_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'password')",
    'onblur' => "clickrecall(this,'password')");
?>




<?php
//signup data
// Kom ihåg det du skrev i fälten vid uppdatering av sidan. 
// Första variablen är 'name' andra vad det ska stå, alltså 'value'.

if ($this->session->flashdata('signup_validation_errors')) {
    $username_field_value = $this->session->flashdata('signup_value_username');
    $email_field_value = $this->session->flashdata('signup_value_email');
    $pwd_field_value = $this->session->flashdata('signup_value_pwd');
    $pwd2_field_value = $this->session->flashdata('signup_value_pwd2');
    $checkbox_value = $this->session->flashdata('signup_value_checkbox');
} else {
    $username_field_value = set_value('username', 'Användarnamn');
    $email_field_value = set_value('mail', 'email');
    $pwd_field_value = set_value('pwd', 'password');
    $pwd2_field_value = set_value('pwd2', 'password');
    $checkbox_value = set_value('agreeCheck', FALSE);
}

/** Lägger in data i arrayer för varje fält på formuläret.
 * Här ingår också koden för att kalla på javascripten.
 * */
$username_data = array(
    'type' => 'text',
    'name' => 'username',
    'id' => 'username',
    'value' => $username_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'Användarnamn')",
    'onblur' => "clickrecall(this,'Användarnamn')");
$email_data = array(
    'type' => 'text',
    'name' => 'mail',
    'id' => 'mail',
    'value' => $email_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'email')",
    'onblur' => "clickrecall(this,'email')");
$password_data = array(
    'type' => 'password',
    'name' => 'pwd',
    'value' => $pwd_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'password')",
    'onblur' => "clickrecall(this,'password')");
$password2_data = array(
    'type' => 'password',
    'name' => 'pwd2',
    'value' => $pwd2_field_value,
    'style' => 'width:100%; margin-top: 15px;',
    'onclick' => "clickclear(this, 'password')",
    'onblur' => "clickrecall(this,'password')");
$checkbox_data = array(
    'name' => 'agreeCheck',
    'id' => 'agreeCheck',
    'value' => 'accept',
    'checked' => $checkbox_value
);
?>




<!-- login -->
<div class="login_view">
    <div class="padding">
        <h1>Logga in</h1>
        <?php
        echo form_open('membership/validate_credentials');
        echo form_input($login_username_data);
        echo form_password($login_password_data);
        /*
         * hämtar flashdata för att visa validation errors vid felaktig inmatning
         */
        echo $this->session->flashdata('validation_errors');
        echo form_submit('submit', 'Logga in');
        echo form_close();
        ?>
    </div>
</div>




<!-- signup -->
<div class="signup_view">
    <div class="padding">
        <h1>Skapa konto</h1>
        <?php
        echo form_open('membership/create_account');
        /*
         * Lägger in arrayen av data i fältet.
         */
        echo form_input($username_data);
        echo $this->session->flashdata('signup_error_username');

        echo form_input($email_data);
        echo $this->session->flashdata('signup_error_email');

        echo form_password($password_data);
        echo $this->session->flashdata('signup_error_password');

        echo form_password($password2_data);
        echo $this->session->flashdata('signup_error_password2');

        echo form_checkbox($checkbox_data);
        echo $this->session->flashdata('signup_error_agreeCheck');
        ?>
        <agree>Jag har läst och accepterat</agree>
        <?php
        echo '<a onClick="userAgreementPopup()"> användar villkoren </a>';
        echo form_submit('submit', 'skapa konto');
        ?>

    </div>
</div>




