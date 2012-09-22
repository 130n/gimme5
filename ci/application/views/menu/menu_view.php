<div id="menu">
    <style type="text/css" >
       <?php if($menu){ $str='#menu_li_'.$menu; }
       else{ $str='#menu_li_startsida'; }
           echo $str; ?> #arrow {
                visibility: visible !important;
        }
    </style>
 
    <ul>
        <li id="menu_li_startsida" class="active">
            <?php echo anchor('site', 'Startsida'); ?>
            <div id="arrow"></div>
        </li>

<!--         <li id="menu_li_category">
            <?php echo anchor('site/category', 'Kategorier'); ?>
            <div id="arrow"></div>
        </li> -->

        <li id="menu_li_skapa">
            <?php
            if (!$this->session->userdata('is_logged_in')) {
                ?><a id="skapalista_anc" onclick="showPopup()"> Skapa lista </a><?php
        } else {
            echo anchor('site/create_list', 'Skapa lista');
        }
            ?>
            <div id="arrow"></div>
        </li>

        <li id="menu_li_profile">
            <?php
            if (!$this->session->userdata('is_logged_in')) {
                ?><a id="profile_anc" onclick="showPopup()"> Profil </a><?php
            } else {
                echo anchor('site/profile', 'Profil');
            }
            ?>
            <div id="arrow"></div>
        </li>

        <li id="menu_li_friends">
            <?php
            if (!$this->session->userdata('is_logged_in')) {
                ?><a id="friends_anc" onclick="showPopup()"> Vänner </a><?php
            } else {
                echo anchor('site/friends', 'Vänner');
            }
            ?>
            <div id="arrow"></div>
        </li>

        



            <?php if ($this->session->userdata('is_admin')) { ?>
            <li>
                <?php echo anchor('admin', 'Statistik'); ?>
            </li>
            <?php } ?>
    </ul>
    <div id="logout">
        <ul>
            <?php
            //Möjlighet att logga ut ifall man är inloggad
            if ($this->session->userdata('is_logged_in')) {
                ?>
                <li>
    <?php echo anchor('membership/logout', 'Logga ut  ' . $this->session->userdata('username'));
    ?>
                </li>
            <?php } ?>
        </ul>
    </div> 
</div>