

    <div class="newfriends">
        <h1>Vänförfrågningar</h1>
        <div id="scroll_newfriends">

            <!--  Här börjar data som ska loopas  -->

            <?php
            if (!$request) {
                echo '<h1>Du har inga vänförfrågningar</h1>';
            } else {
                foreach ($request as $r): {
                        ?> 

                        <div class="friendnotation">
                            <img id="user_bild"src="<?php echo base_url() . $r->user_pic_path; ?>"  />   
                            <strong><?php
            //länk funkar men kanske cssa det 
            echo anchor('site/user/' . $r->userID, $r->username);

        
                        ?></strong>
                            <!-- <strong id="friendnotation_name"><?php //echo $r ->username;  ?></strong> -->
                            <div id="svarsknapp">

                                <input name="deny_friend" type="button" class="Knapp" id="Neka_knapp" Value="Neka"  onclick="location.href='<?php echo site_url('site/deny_friend_request/' . $r->user1); ?>'" />
                                <input name="accept_friend" type="button" class="Knapp" id="Acceptera_knapp" Value="Acceptera"  onclick="location.href='<?php echo site_url('site/accept_friend_request/' . $r->user1); ?>'" />
                            
                            </div>
                            <div class="divider">
                            </div>
                        </div>

                        <?php
                    } endforeach;
            }
            ?> 

            <!--  Här slutar data som ska loopas  -->

            <!--
            
            <div class="friendnotation">
                    <img id="user_bild" src="		php för att hömta bild		" />
                    <strong id="friendnotation_name">		php för att hämta namn		</strong>
                    <div id="svarsknapp">
                            <button type="button" id="Neka_knapp">Neka</button>
                            <button type="button" id="Acceptera_knapp">Acceptera</button>
                    </div>
                    <div class="divider">
                    </div>
            </div> 
            
            -->							
        </div>
    </div>

    <div id="box2">
        <h1>Vänner</h1>
        <div id="scroll_box2">

            <!--  Här börjar data som ska loopas  -->			
            <?php

            
            $nr_of_friends=0;
            if ($friend) {   
                foreach ($friend as $r): {
                    if($r->is_confirmed==1){
                        ?> 

                        <?php //$site=base_url().'site/user?userID='.$r->userID;  ?>

                        <div class="friendnotation" onclick="location.href='<?php echo site_url('site/user/' . $r->userID); ?>'" style="cursor:pointer;">

                            <?php
                            // echo anchor('site/user/'.$r->userID, '<img src="'.$image.'">'); 
                            // 		echo anchor('site/user/'.$r->userID, $r->userName); 
                            ?>
                            <img id="user_bild"src="<?php echo base_url() . $r->user_pic_path; ?>"  />   
                            <strong id="friendnotation_name"><?php echo $r->username; ?></strong> <br>
                            <strong id="friendnotation_name"><?php echo $r->mail; ?></strong>
                            <div class="divider">
                            </div>
                        </div>

                        <?php
                        $nr_of_friends +=1;
                    } 
                    
                    }
                endforeach;
                    
            }
            if($nr_of_friends == 0) {
                        echo '<h1>Du har inte lagt till någon vän än</h1>';
                
            } 
                               
            
            ?> 		
            <!--  Här slutar data som ska loopas  -->		
        </div>	
  