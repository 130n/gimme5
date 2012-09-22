<div id="container_wide">

    <div class="content">	

        <div id="search_friend">
             <?php echo form_open('site/friend_search'); ?>
            <?php html_escape('Sök efter vänner'); ?>
            <input type="text" name="search_field" value="Sök efter vänner" 
                id="search_friend_field" class="textfield_search" 
                    style="float: left;" onClick="clickclear(this, 'Sök efter vänner')" 
                        onBlur="clickrecall(this,'Sök efter vänner')">
            <input id="friend_search_button" type="submit" name="Search_button" value="">


          </div>

        <div class="border_bottom">
           

  
            <?php
            if (!$row) {
                echo '<h1>Det finns ingen användare med det namet</h1>';
            } 
            else { ?>
                        <h1><br /><br />Sökresultat</h1>
                <?php foreach ($row as $r): { ?> 

                        <!--  Här börjar det som ska loopas  -->
                        <?php //$site=base_url().'user?userID='.$r->userID; ?>

                        <div class="friend_container">
							<div onclick="location.href='<?php echo 'user/' . $r->userID; ?>'" style="cursor:pointer;">
								<?php //echo anchor('site/user/'.$r->userID); ?>
								<img class="friend_img" src="<?php echo base_url() . $r->user_pic_path; ?>" />    
								<h2 class ="user_name"><?php echo $r->username; ?></h2>
								<strong><?php echo $r->mail; ?></strong>
							</div>
			
							</div>

                        <!--  Här slutar det som ska loopas  -->



                        <?php
                    

                } endforeach;
            }
            ?>   
        
    </div> 
</div> 