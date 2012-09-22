    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <link rel="stylesheet" href=<?php echo base_url("/css/style_statistik.css"); ?> type="text/css" media="screen" title="no title" charset="utf-8">

    <div id="wrapper">
        <div id="header">
            <div id="logo">
                <a href="<?php echo site_url(); ?>"><img src="<?php echo base_url('/images/logo.png'); ?>"></a>
            </div>
            <div id="link_btn">
                <a href="<?php echo site_url(); ?>"><input type="button" value="Gå till hemsidan"></a>
            </div>
        </div>
    <div>

</div>
        <!-- VISITORS -->
        <!-- Google Graphs: Annoted timeline -->
        <script language="JavaScript">
        google.load('visualization', '1', {packages: ['annotatedtimeline']});
        
        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Datum');
            data.addColumn('number', 'Totalt antal besökare');
            data.addColumn('number', 'Unika besök');
            data.addRows([
            <?php 
                $first = TRUE;
                foreach($visitors as $v_row):
                    $month=$v_row->month-1;
                    if($first){
                        $str= '[new Date('.$v_row->year.', '.$month.', '.$v_row->day.'), '.$v_row->visitors.','.$v_row->u_visitors.']';
                        $first=FALSE;
                        echo $str;
                    }
                    else{
                        $str= ', [new Date('.$v_row->year.', '.$month.', '.$v_row->day.'), '.$v_row->visitors.','.$v_row->u_visitors.']';
                        echo $str;
                    }
                endforeach;
            ?>
          ]);
        
          var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
              document.getElementById('visitors_div'));
          annotatedtimeline.draw(data, {'displayAnnotations': false});
        }
        google.setOnLoadCallback(drawVisualization);
        
        </script>

        <!-- CREATED LISTS/ACCOUNTS -->
        <!-- Google Graphs: Annoted timeline -->
        <script language="JavaScript">
        google.load('visualization', '1', {packages: ['annotatedtimeline']});
        
        function drawVisualization() {
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'Datum');
            data.addColumn('number', 'Antal listor');
            data.addColumn('number', 'Antal skapade konton');
            data.addRows([
            <?php 
                $first = TRUE;
                foreach($created as $lu_row):
                    $month=$v_row->month-1;
                    if($first){
                        $str= '[new Date('.$lu_row->year.', '.$month.', '.$lu_row->day.'), '.$lu_row->lists.','.$lu_row->users.']';
                        $first=FALSE;
                        // echo $str;
                    }
                    else{
                        $str= ', [new Date('.$lu_row->year.', '.$lu_row->month.', '.$lu_row->day.'), '.$lu_row->lists.','.$lu_row->users.']';
                    }
                        echo $str;
                endforeach;
            ?>
          ]);
        
          var annotatedtimeline = new google.visualization.AnnotatedTimeLine(
              document.getElementById('accounts_div'));
          annotatedtimeline.draw(data, {'displayAnnotations': false});
        }
        google.setOnLoadCallback(drawVisualization);
        
        </script>
        <div class="box ">
            <div class="heading">
                <h2>Antal besök jämfört med unika besökare</h2>
            </div>
            <div class="main">
                <div id="visitors_div" style="width: 600px; height: 290px;"></div>
            </div>
        </div>


 <div class="box ">
            <div class="heading">
                <h2>Antal besökare</h2>
            </div>
            <div class="main">
                <table>
                    <tr>
                        <th></th>
                        <th>Besökare</th>
                        <th>Unika besökare</ht>
                    </tr>
                    <tr>
                        <td> <h3>Idag</h3> </td>
                        <?php
                        if($day_visitors){ ?>
                            <td>  
                            <?php   foreach($day_visitors as $d):
                                        echo $d->visitors; 
                                    ?>
                            </td>
                            <td>

                            <?php  
                                        echo $d->u_visitors;
                                    endforeach;
                                    ?>

                             </td>
                         <?php } 
                         else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Denna vecka</h3> </td>
                        <?php
                        if($week_visitors){ ?>
                            <td>  
                            <?php   foreach($week_visitors as $w):
                                        echo $w->visitors; 
                                    ?>
                            </td>
                            <td>

                            <?php  
                                        echo $w->u_visitors;
                                    endforeach;
                                    ?>

                             </td>
                         <?php } 
                         else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Denna månad</h3> </td>
                             <?php
                            if($month_visitors){ ?>
                                <td>  
                                <?php   foreach($month_visitors as $m):
                                            echo $m->visitors; 
                                        ?>
                                </td>
                                <td>

                                <?php  
                                            echo $m->u_visitors;
                                        endforeach;
                                        ?>

                                 </td>
                             <?php } 
                             else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Detta år</h3> </td>
                         <?php
                            if($year_visitors){ ?>
                                <td>  
                                <?php   foreach($year_visitors as $y):
                                            echo $y->visitors; 
                                        ?>
                                </td>
                                <td>

                                <?php  
                                            echo $y->u_visitors;
                                        endforeach;
                                        ?>

                                 </td>
                             <?php } 
                             else { 
                            // annars skriver vi ut 0
                                ?>
                                <td> 0 </td>
                                <td> 0 </td>
                            <?php }  ?>

                    </tr>
                    <tr>
                </table>
            </div>
        </div>





        <div class="box ">
            <div class="heading">
                <h2>Antal användarkonton jämfört med antal skapade listor</h2>
            </div>
            <div class="main">
                <div id="accounts_div" style="width: 600px; height: 290px;"></div>
            </div>
        </div>



        <div class="box ">
            <div class="heading">
                <h2>Skapade listor</h2>

            </div>
            <div class="main">
               <table>
                    <tr>
                        <th></th>
                         <th>Listor</th>
                        <th>Unika skapare</ht>
                      
                    </tr>
                    <tr>
                        <td> <h3>Idag</h3> </td>


                         <?php   
                         // om det finns listor
                         if($day_lists){ ?>
                            <td>  
                            <?php   foreach($day_lists as $d):
                                        echo $d->nr_of_lists; 
                                    ?>
                            </td>
                            <td>

                            <?php  
                                        echo $d->u_creators;
                                    endforeach;
                                    ?>

                             </td>
                         <?php } 
                         else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Denna vecka</h3> </td>
                        
                         <?php   
                         // om det finns listor
                         if($week_lists){ ?>
                            <td>  
                            <?php   foreach($week_lists as $w):
                                        echo $w->nr_of_lists; 
                                    ?>
                            </td>
                            <td>

                            <?php  
                                        echo $w->u_creators;
                                    endforeach;
                                    ?>

                             </td>
                         <?php } 
                         else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Denna månad</h3> </td>
                    <?php   
                         // om det finns listor
                         if($month_lists){ ?>
                            <td>  
                            <?php   foreach($month_lists as $m):
                                        echo $m->nr_of_lists; 
                                    ?>
                            </td>
                            <td>

                            <?php  
                                        echo $m->u_creators;
                                    endforeach;
                                    ?>

                             </td>
                         <?php } 
                         else { 
                        // annars skriver vi ut 0
                            ?>
                            <td> 0 </td>
                            <td> 0 </td>
                        <?php }  ?>

                    </tr>
                    <tr>
                        <td> <h3>Detta år</h3> </td>
                         <?php   
                             // om det finns listor
                             if($year_lists){ ?>
                                <td>  
                                <?php   foreach($year_lists as $y):
                                            echo $y->nr_of_lists; 
                                        ?>
                                </td>
                                <td>

                                <?php  
                                            echo $y->u_creators;
                                        endforeach;
                                        ?>

                                 </td>
                             <?php } 
                             else { 
                            // annars skriver vi ut 0
                                ?>
                                <td> 0 </td>
                                <td> 0 </td>
                            <?php }  ?>

                    </tr>
                    <tr>
                </table>
            </div>
        </div>


