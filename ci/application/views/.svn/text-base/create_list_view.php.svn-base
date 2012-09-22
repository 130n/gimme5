<?php
// $this->session->keep_flashdata('popup_open');

// $this->session->keep_flashdata('create_list_value_title_desc');		
// $this->session->keep_flashdata('create_list_value_desc1');
// $this->session->keep_flashdata('create_list_value_desc2');
// $this->session->keep_flashdata('create_list_value_desc3');
// $this->session->keep_flashdata('create_list_value_desc4');
// $this->session->keep_flashdata('create_list_value_desc5');

/*
$this->session->keep_flashdata('create_list_value_title');
$this->session->keep_flashdata('create_list_value_post1');
$this->session->keep_flashdata('create_list_value_post2');
$this->session->keep_flashdata('create_list_value_post3');
$this->session->keep_flashdata('create_list_value_post4');
$this->session->keep_flashdata('create_list_value_post5');
$this->session->keep_flashdata('create_list_value_category_value');
$this->session->keep_flashdata('create_list_value_create_list_value_tags');
*/

// Kommer ihåg det du skrev i fälten vid uppdatering av sidan. 
// Första variablen är 'name' andra vad det ska stå, alltså 'value'.
if ($this->session->flashdata('list_validation_errors')) {
    $title_field_value = $this->session->flashdata('create_list_value_title');
    $post1_field_value = $this->session->flashdata('create_list_value_post1');
    $post2_field_value = $this->session->flashdata('create_list_value_post2');
    $post3_field_value = $this->session->flashdata('create_list_value_post3');
    $post4_field_value = $this->session->flashdata('create_list_value_post4');
    $post5_field_value = $this->session->flashdata('create_list_value_post5');
    $tag_field_value = $this->session->flashdata('create_list_value_tags');
	
	$title_desc_value = $this->session->flashdata('create_list_value_title_desc');
	$post1_desc_value = $this->session->flashdata('create_list_value_desc1');
    $post2_desc_value = $this->session->flashdata('create_list_value_desc2');
    $post3_desc_value = $this->session->flashdata('create_list_value_desc3');
    $post4_desc_value = $this->session->flashdata('create_list_value_desc4');
    $post5_desc_value = $this->session->flashdata('create_list_value_desc5');
} 
else {
	
    $title_field_value = set_value('title', 'Skriv din rubrik här');
    $post1_field_value = set_value('post1', 'Första posten');
    $post2_field_value = set_value('post2', 'Andra posten');
    $post3_field_value = set_value('post3', 'Tredje posten');
    $post4_field_value = set_value('post4', 'Fjärde posten');
    $post5_field_value = set_value('post5', 'Femte posten');
    $tag_field_value = set_value('tags', 'Tags');
	
	$title_desc_value = $this->session->flashdata('create_list_value_title_desc');
	$post1_desc_value = $this->session->flashdata('create_list_value_desc1');
	$post2_desc_value = $this->session->flashdata('create_list_value_desc2');
	$post3_desc_value = $this->session->flashdata('create_list_value_desc3');
	$post4_desc_value = $this->session->flashdata('create_list_value_desc4');
	$post5_desc_value = $this->session->flashdata('create_list_value_desc5');
	
}

$tags_data = array(
    'type' => 'text',
    'name' => 'tags',
    'value' => $tag_field_value,
    'onclick' => "clickclear(this, 'Tags')",
    'onblur' => "clickrecall(this,'Tags')",
    'style' => 'width:295px; border: 1px solid #CCC;',
    'class' => "create_list");
$title_data = array(
    'type' => 'text',
    'name' => 'title',
    'value' => $title_field_value,
    'onclick' => "clickclear(this, 'Skriv din rubrik här')",
    'onblur' => "clickrecall(this,'Skriv din rubrik här')",
    'style' => 'width:295px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
$post1_data = array(
    'type' => 'text',
    'name' => 'post1',
    'value' => $post1_field_value,
    'onclick' => "clickclear(this, 'Första posten')",
    'onblur' => "clickrecall(this,'Första posten')",
    'style' => 'width:270px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
$post2_data = array(
    'type' => 'text',
    'name' => 'post2',
    'value' => $post2_field_value,
    'onclick' => "clickclear(this, 'Andra posten')",
    'onblur' => "clickrecall(this,'Andra posten')",
    'style' => 'width:270px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
$post3_data = array(
    'type' => 'text',
    'name' => 'post3',
    'value' => $post3_field_value,
    'onclick' => "clickclear(this, 'Tredje posten')",
    'onblur' => "clickrecall(this,'Tredje posten')",
    'style' => 'width:270px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
$post4_data = array(
    'type' => 'text',
    'name' => 'post4',
    'value' => $post4_field_value,
    'onclick' => "clickclear(this, 'Fjärde posten')",
    'onblur' => "clickrecall(this,'Fjärde posten')",
    'style' => 'width:270px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
$post5_data = array(
    'type' => 'text',
    'name' => 'post5',
    'value' => $post5_field_value,
    'onclick' => "clickclear(this, 'Femte posten')",
    'onblur' => "clickrecall(this,'Femte posten')",
    'style' => 'width:270px; border: 1px solid #CCC;',
    'class' => "create_list",
	'maxlength' => "38");
	
	
$skriv_beskrivning = 'Skriv din beskrivning här';

	
?>
<div id="container_wide">
    <div class="content">
        <div id="list_box_content">
            <div class="small_content">
                <!--<form action="create_list/make_list" method ="post"> <!-Ändra om det behövs!-->

                <h1>Skapa en lista</h1>

                <?php
				$attributes = array('id' => 'createlist', 'method' => 'post');
                echo form_open('create_list/make_list', $attributes);
				
                $hidden_description_title = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_title',
                    'id' => 'hidden_description_title',
                    'value'   => $this->session->flashdata('create_list_value_title_desc'),
                );
                $hidden_description_desc1 = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_desc1',
                    'id' => 'hidden_description_desc1',
                    'value'   => $this->session->flashdata('create_list_value_desc1'),
                );
                $hidden_description_desc2 = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_desc2',
                    'id' => 'hidden_description_desc2',
                    'value'   => $this->session->flashdata('create_list_value_desc2'),
                );
                $hidden_description_desc3 = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_desc3',
                    'id' => 'hidden_description_desc3',
                    'value'   => $this->session->flashdata('create_list_value_desc3'),
                );
                $hidden_description_desc4 = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_desc4',
                    'id' => 'hidden_description_desc4',
                    'value'   => $this->session->flashdata('create_list_value_desc4'),
                );
                $hidden_description_desc5 = array(
                    'type' => 'hidden',
                    'name'  => 'hidden_description_desc5',
                    'id' => 'hidden_description_desc5',
                    'value'   => $this->session->flashdata('create_list_value_desc5'),
                );
                
				// create hidden forms for descriptions 1-5 (obtained from create_list/make_descriptions)

                $x='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; x';
                // echo $this->session->flashdata('list_validation_errors');
                echo form_input($title_data);
                echo $this->session->flashdata('create_list_error_title');
                //echo form_input($hidden_description_title);
                ?>
                        <!-- Popup för -->
                        <!-- <img src="<?php echo base_url('/images/comment_add.png'); ?>" border="0" width="24px" height="24px" style="cursor: pointer;" 
                            onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_title\',\'title_description\',\'title_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'title_description\' rows=\'4\' cols=\'78\' id=\'title_description\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $title_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10); " 
                            onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/>  -->
                <!-- <div id="title_desc_preview">
                    <?php echo $this->session->flashdata('create_list_value_title_desc'); ?>
                 --></div>
                
                <ol>
                    <li> 
                        <?php
                        echo form_input($post1_data);
				        echo form_input($hidden_description_desc1);
                        ?>
                        <!-- 
onload=\'getHidden(description1, post1_desc_preview);\'
                         -->
                        <!-- Måste stå på en gastronomisk jätterad för att fungera. -->
                        <input type='button' name='open_desc' id = 'open_desc' value='Skriv motivering' style="cursor: pointer;" 
                             onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_desc1\',\'description1\',\'post1_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'description1\' rows=\'4\' cols=\'78\' id=\'description1\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $post1_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);" 
                             onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/>
                             <?php
                                echo $this->session->flashdata('create_list_error_post1');
                            ?>
                <div id="post1_desc_preview" class="preview">
                    <?php echo $this->session->flashdata('create_list_value_desc1'); ?>
                </div>
                    </li>
                    <li> 
                        <?php
                        echo form_input($post2_data);
				        echo form_input($hidden_description_desc2);
                        ?>
                        <!-- Måste stå på en gastronomisk jätterad för att fungera. -->
                        <input type='button' name='open_desc' id = 'open_desc' value='Skriv motivering' style="cursor: pointer;" 
                             onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_desc2\',\'description2\',\'post2_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'description2\' rows=\'4\' cols=\'78\' id=\'description2\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $post2_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);" 
                             onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/> 
                             <?php
                                echo $this->session->flashdata('create_list_error_post2');
                            ?>
                <div id="post2_desc_preview" class="preview">
                    <?php echo $this->session->flashdata('create_list_value_desc2'); ?>
                </div>
                    </li>
                    <li>
                        <?php
                        echo form_input($post3_data);
				echo form_input($hidden_description_desc3);
                        ?> 
                        <!-- Måste stå på en gastronomisk jätterad för att fungera. -->
                        <input type='button' name='open_desc' id = 'open_desc' value='Skriv motivering' style="cursor: pointer;" 
                             onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_desc3\',\'description3\',\'post3_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'description3\' rows=\'4\' cols=\'78\' id=\'description3\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $post3_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);" 
                             onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/> 
                            <?php
                                echo $this->session->flashdata('create_list_error_post3');
                            ?>
                        <div id="post3_desc_preview" class="preview">
                    <?php echo $this->session->flashdata('create_list_value_desc3'); ?>
                        </div>
                    </li>
                    <li> 
                        <?php
                        echo form_input($post4_data);
                echo form_input($hidden_description_desc4);
                        ?> 
                        <!-- Måste stå på en gastronomisk jätterad för att fungera. -->
                        <input type='button' name='open_desc' id = 'open_desc' value='Skriv motivering' style="cursor: pointer;" 
                             onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_desc4\',\'description4\',\'post4_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'description4\' rows=\'4\' cols=\'78\' id=\'description4\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $post4_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);" 
                             onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/> 
                            <?php
                                echo $this->session->flashdata('create_list_error_post4');
                            ?>
                        <div id="post4_desc_preview" class="preview">
                    <?php echo $this->session->flashdata('create_list_value_desc4'); ?>
                        </div>
                    </li>
                    <li>
                        <?php
                            echo form_input($post5_data);
                            echo form_input($hidden_description_desc5);
                        ?> 
                        <!-- Måste stå på en gastronomisk jätterad för att fungera. -->
                        <input type='button' name='open_desc' id = 'open_desc' value='Skriv motivering' style="cursor: pointer;" 
                             onclick="this.style.background='lightblue'; nd(); return overlib('<div><form action=javascript:setHidden(\'hidden_description_desc5\',\'description5\',\'post5_desc_preview\'); method=\'post\' id =\'create_description\'><a value=\'close\' onclick=\'nd()\'><?php echo $x; ?></a><textarea name=\'description5\' rows=\'4\' cols=\'78\' id=\'description5\' maxlength=\'300\' size=\'150\' style=\'width:85%; height:70px\' class=\'create_list\'><?php echo $post5_desc_value; ?></textarea><input type=\'submit\' name=\'save_description\' id = \'save_description\' value=\'Spara och stäng\' onclick=\'nd();\'/></form></div>', FULLHTML,  BACKGROUND, '<?php echo base_url('/images/popup_description4.gif'); ?>', STICKY, OFFSETX -10, OFFSETY, -10);" 
                             onmouseout="this.style.background='';" onmouseover="this.style.background='lightblue'"/> 
                             <?php
                                echo $this->session->flashdata('create_list_error_post5');
                            ?>
                        <div id="post5_desc_preview" class="preview">
                    <?php echo $this->session->flashdata('create_list_value_desc5'); ?>
                        </div>
                    </li>
                </ol>

                <?php
                //echo form_dropdown('category', $options);
                echo form_dropdown('category', $category, $this->session->flashdata('category_value'));
                echo $this->session->flashdata('create_list_error_category');
                ?>
                <h2>Skriv in dina taggar här, separerade med komma:</h2>
                <?php
                echo form_input($tags_data);
                echo $this->session->flashdata('create_list_error_tags');

                echo form_submit('submit', 'Skapa lista');
                ?> 
            </div>
        </div>
    </div>
</div>
