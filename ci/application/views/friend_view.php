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


   <?php /*echo form_open('site/search'); ?>
    9          <!-- css id: search dropdown -->
   10:         <input type="text" name="search_field" value="Search" id="search_field" class="textfield_search" style="float: left;" onClick="clickclear(this, 'Search')" onBlur="clickrecall(this,'Search')">
   11       <input id="search_button" type="submit" name="Search_button" value="">

           */ ?>
        </div>

        <div class="border_bottom">
            <h1><br /><br /><br />Vänförfrågningar</h1>
            <?php
            if (!$request) {
                echo '<h1>Du har inga vänförfrågningar</h1>';
            } 
            else {
                foreach ($request as $r): {
                        ?> 

                        <!--  Här börjar det som ska loopas  -->
                        <?php //$site=base_url().'user?userID='.$r->userID; ?>

                        <div class="friend_container"> 
						<div onclick="location.href='<?php echo 'user/' . $r->userID; ?>'" style="cursor:pointer;">
                            <?php //echo anchor('site/user/'.$r->userID); ?>
								<img class="friend_img" src="<?php echo base_url() . $r->user_pic_path; ?>" /> 
								<h2 class ="user_name"><?php echo $r->username; ?></h2>
								<strong><?php echo $r->mail; ?></strong>
								</div>
                            <input type="button" id="neka_knapp" Value="Neka" onclick="location.href='<?php echo site_url('site/deny_friend_request/' . $r->user1.'/redirect_to_friends'); ?>'" />
                            <input type="button" id="acceptera_knapp" Value="Acceptera" onclick="location.href='<?php echo site_url('site/accept_friend_request/' . $r->user1.'/redirect_to_friends'); ?>'" /> 
                        </div>

                        <!--  Här slutar det som ska loopas  -->

                        <!--  Här bötjar testdata  -->

                        <?php
                    } endforeach;
            }
            ?>   
        </div>

        
        <h1><br />Vänner</h1>
            <?php
            if (!$row) {
                echo '<h1>Du har inga vänner</h1>';
            } else {
                foreach ($row as $r): {
                    // så att enbart bekräftade relationer visas
                    if($r->is_confirmed){
                        ?> 

                        <!--  Här börjar det som ska loopas  -->
                        <?php //$site=base_url().'user?userID='.$r->userID; ?>

                        <div class="friend_container">
							<div onclick="location.href='<?php echo 'user/' . $r->userID; ?>'" style="cursor:pointer;">
								<?php //echo anchor('site/user/'.$r->userID); ?>
								<img class="friend_img" src="<?php echo base_url() . $r->user_pic_path; ?>" />    
								<h2 class ="user_name"><?php echo $r->username; ?></h2>
								<strong><?php echo $r->mail; ?></strong>
							</div>
							<input type="button" id="Ta_bort" value="Ta bort" onclick="location.href='<?php echo site_url('site/remove_friend/'.$r->userID.'/redirect_to_friends'); ?>'" /> 
							</div>

                        <!--  Här slutar det som ska loopas  -->

                        <!--  Här bötjar testdata  -->


                        <?php
                    }
                } endforeach;
            }
            ?>   
        
    </div> 
</div> 