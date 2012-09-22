<div id="header">
    <div id="logo">
        <a href="<?php echo site_url(); ?>">
            <img src="<?php echo base_url('/images/logo.png'); ?>">
        </a>
    </div>
    <div id="search_box">
        <?php echo form_open('site/search'); ?>
        <!-- css id: search dropdown -->
        <input type="text" name="search_field" value="Sök..." id="search_field" class="textfield_search" style="float: left;" onClick="clickclear(this, 'Sök...')" onBlur="clickrecall(this,'Sök...')">
		<input id="search_button" type="submit" name="Search_button" value="">
		
		<?php echo form_dropdown('category', $category_dropdown, 1, 'id="search_dropdown"'); ?>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="main">
    <!--popup börjar här-->
    <div id="popupContact">  
        <a id="popupContactClose">x</a>    
        <p id="contactArea">  

        </p>


        <table width="0" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td>
            <onload="changeScreenSize(200,300)">

                <h3 align="center">Du är inte inloggad!</h3>
                <p align="center">För att ta del av hela sidans innehåll <br />  vänligen logga in. </p>
                <p align="center">Har du inget användarkonto?</p>

                
                <div id="logo" align="center">
        <a href="<?php echo site_url(); ?>">
            <img src="<?php echo base_url('/images/Knapp.jpg'); ?>">
        </a>
    </div>    


                </div>
                </td>
                </tr>
        </table>
    </div>  
</div>

<div id="backgroundPopup"></div>
