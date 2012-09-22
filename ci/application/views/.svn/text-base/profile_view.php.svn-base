<head>  <link rel="stylesheet" href="<?php echo base_url('/css/profile.css'); ?>" type="text/css" media="screen" title="no title" charset="utf-8"></head>
<?php
if ($this->session->flashdata('upload_error')) {
    ?> 
    <body onload="showPicturePopup()"> 	</body>
    <?php
}
?>

<div id="profile_container">
    <?php foreach ($profile as $p) : ?>
        <div class="content">
            <img src="<?php echo base_url() . $p->user_pic_path; ?> " width="160" border="0" class="user_img" />
            <div class="user_name"> <?php echo $p->username; ?></div>
            <form>
                <table width="160px" border="0" cellspacing="3">
                    <tr> <?php 

                        $member = $this->session->userdata('is_logged_in');
                        $is_friend = false;

                        // kollar om den inloggade användaren är vän med användarens profilsida
                        if($this->session->userdata('userID') != $p->userID && $member && $friends){

                            foreach ($friends as $f) :

                                if ($f->userID == $p->userID) { 
                                    $is_friend = true;
                                }
                            endforeach;
                        }
                        // om det är den inloggade användaren eller en väns konto så visas email
                        if($this->session->userdata('userID') == $p->userID || $is_friend) { ?>
                            <td><strong>Email: </strong><label><?php echo $p->mail ?></label></td>
                            <?php 
                        }
						
						$url = current_url();
						
                        // om det är den inloggade användaren så visas editera bild, editera lösenord och lösenord.
                        if($this->session->userdata('userID') == $p->userID) { ?>

                    <td><input name="Edit" type="image" src="<?php echo base_url('/images/edit_icon.png'); ?>" border="0" class="edit_icon" onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=\'<?php echo site_url('membership/update_email')?>\' method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; x </a><br></br><b><FONT COLOR=\'#585858\'>Skriv in din nya email</FONT><b><input type=\'text\' name=\'email_update\' value = \'<?php echo htmlspecialchars($p->mail); ?>\' maxlength=\'50\' size=\'150\' style=\'width:85%; height:22px\' class=\'update_password\'/><input type=\'hidden\' name=\'hidden_url\' value=\'<?php echo $url; ?>\' /><br></br><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form><br></br><br></br><br></br></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);"/></td>
                    </tr>
                    <tr>
                        <td><strong>Lösenord: </strong><label>******</label></td>
                        <td><input name="Edit" type="image" src="<?php echo base_url('/images/edit_icon.png'); ?>" border="0" class="edit_icon" onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=\'<?php echo site_url('membership/update_password')?>\' method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; x </a><br><b><FONT COLOR=\'#585858\'>Skriv in ditt nya lösenord</FONT></b><input type=\'password\' name=\'password_update\' maxlength=\'50\' size=\'100\' style=\'width:85%; height:22px\' class=\'update_password\'/><br><b><FONT COLOR=\'#585858\'>Skriv in ditt gamla lösenord</FONT></b><input type=\'password\' name=\'password_old\' maxlength=\'50\' size=\'100\' style=\'width:85%; height:22px\' class=\'update_password\'/><input type=\'hidden\' name=\'hidden_url\' value=\'<?php echo $url; ?>\' /><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);"/></td>
                    </tr>
                    <?php } ?>
                </table>      
            </form>

			<?php 
			echo $this->session->flashdata('update_email_error');
			echo $this->session->flashdata('update_password_error');
			echo $this->session->flashdata('old_password_error');
			?>
			
            <?php
            // visar ändra bild, radera bild och radera konto om det är användarens konto
            $data['url'] = current_url();

            if ($this->session->userdata('userID') == $p->userID) {
                ?>

                <input name="change_pic" type="button"  Value="Ändra bild" class="Knapp"  onclick = "showPicturePopup()" />
                <input name="remove_pic" type="button" Value="Ta bort bild" class="Knapp" onclick="location.href='<?php echo site_url('membership/remove_pic/'); ?>'" />
                <input name="Radera konto" type="button" Value="Radera Konto" class="Knapp" onclick="nd(); return overlib('<div>    <form action=\'<?php echo site_url('membership/delete_account/')?>\' method=\'post\' id =\'create_description\'>    <br /><br /><br /><br /><br /><br /><br /><br />    <a value=\'close\' onclick=\'nd()\'> <h4> x </h4> </a>     <br /><br /><br />     <h2>Du är på väg att radera ditt konto!</h2>     <p>Om du tar bort ditt konto kommer alla dina kontouppgifer och <br /> listor att raderas. </p>     <br /><br />      <input type=\'hidden\' name=\'hidden_url\' value=\'<?php echo $url; ?>\' />     <input type=\'submit\' name=\'delete_account_button\' id =\'delete_account_button\' value=\'Ta bort konto\' onclick=\'nd(); location.href=\'<?php echo site_url('membership/delete_account/'); ?>\';\' />       </form><input type=\'button\' name=\'cancel_button\' id =\'cancel_button\' value=\'Avbryt\' onclick=\'nd()\';>      <br></br><br></br><br></br>   </div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/delete_account_bg.png'); ?>', WIDTH, 678, HEIGHT, 456, STICKY, CENTERPOPUP);"/>


            <?php
            }

            // visar lägg till vän och ta bort vän om det inte är användarens konto 
            else {

              
                // om användaren inte är inloggad visas logga in-popup vid tryck på lägg till vän
                if (!$member){ ?>

                    <input name="add_friend" type="button" class="Knapp" Value="Lägg till vän"  onclick="showPopup()" />


                <?php
                }

                // användaren är inloggad, visa lägg till vän eller ta bort vän
                else {
                
                    // om användaren inte är med i listan över den inloggade användarens vänner så visas lägg till vän 
                    if (!$is_friend) {
                        ?>
                        <input name="add_friend" type="button" class="Knapp" Value="Lägg till vän"  onclick="location.href='<?php echo site_url('site/friend_request/' . $p->userID); ?>'" />
                    <?php
                    }

                    // annars visas ta bort vän
                    else {
                        ?>
                        <input name="remove_friend" type="button" class="Knapp" Value="Ta bort vän"  onclick="location.href='<?php echo site_url('site/remove_friend/' . $p->userID); ?>'" />

                    <?php
                    }
                }

            }?>

            </form>
        </div>
<?php endforeach; ?>
</div> 


<!--popup börjar här-->
<div id="popupPicture">  
    <a id="popupPictureClose">x</a>    
    <p id="pictureArea">  
        <!-- p har ingen slut tagg -->

    </p>


    <tabel with="260" border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td>
        <onload="cangeScreenSize(200,300)">
            <h3 align="center">Ladda upp en profilbild</h3>
            </td>
            </tr>
            <tr>
                <td>
                    <!---Ladda upp bild---->
                    <?php echo form_open_multipart('site/do_upload'); ?>
                    <?php echo $this->session->flashdata('upload_error'); ?>
                    <?php echo 'Välj en bildfild med filändelsen .jpg, .png eller .gif. Bilden får vara max 1 mb stor och inte större än 1024x768 pixlar'; ?>

                    <input type="file" name="userfile" size="20" />

                    <br /><br />

                    <input type="submit" value="upload" />
                    <?php echo form_close(); ?>
                </td>
            </tr>
    </tabel>
</div>  
<div id="backgroundPicturePopup"></div> 

