<style type="text/css" >
   <?php if($tab_page){ $str='#tab_page_'.$tab_page; }
   else{ $str='#tab_page_latest_lists'; }
       echo $str; ?> {
			/* Safari 4+, Chrome 1-9 */
			background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#ffffff), to(#ffffff)) !important; 
			/* Safari 5.1+, Mobile Safari, Chrome 10+ */
		   	background-image: -webkit-linear-gradient(top, #ffffff, #ffffff) !important; 
		    /* Firefox 3.6+ */
		    background-image: -moz-linear-gradient(top, #ffffff, #ffffff) !important;
		    /* IE 10+ */
		    background-image: -ms-linear-gradient(top, #ffffff, #ffffff) !important;
		    /* Opera 11.10+ */
		    background-image: -o-linear-gradient(top, #ffffff, #ffffff) !important;
		    color: black !important;
		    border: 1px solid white !important;
		}
    }
</style>

<div id="tab">
	<ol id="tabs">
		<li id="tab_page_latest_lists"><?php echo anchor('site/index', 'Senaste'); ?></li>
		<li id="tab_page_friends"><?php echo anchor('site/friends_lists', 'Vänner'); ?></li>
		<li id="tab_page_most_popular"><?php echo anchor('site/most_popular', 'Mest populära'); ?></a></li>
	</ol>
</div>