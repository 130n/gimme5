<div id="container_wide">
    <div class="content">
        <?php
        foreach ($category as $cat):
            $name = $cat->catname;
            echo anchor('site/category/'.$name, $name);
            echo '<br>';
        endforeach;
        ?>
    </div>
</div>