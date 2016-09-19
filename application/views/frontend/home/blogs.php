<div class="articles-on-milan">
    <div class="explore-trip-inner">
    <div class="container">
        <div class="row">
            <h2>Blogs</h2>
        </div>
    </div>
</div>
</div>


<div class="explore-trip-inner">
    <div class="container">
        <div class="row">
            
            <?php
            if (!empty($blogs)) {
                foreach ($blogs as $blog) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 explore-box-btm">
                        <div class="explore-box">
                            <figure>
                                <a href="<?php echo!empty($blog['link']) ? $blog['link'] : '' ?>" target="_blank"><img src="<?php echo!empty($blog['image_src']) ? $blog['image_src'] : '' ?>" alt="tour my india"></a>
                            </figure>
                            <a href="<?php echo!empty($blog['link']) ? $blog['link'] : '' ?>" target="_blank"><h2><?php echo!empty($blog['title']) ? $blog['title'] : '' ?></h2></a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            
        </div>
    </div>
</div>