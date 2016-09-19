<?php
//dump($package_category);
?>
<div class="discover-intrest-outer">
    <div class="container">
        <div class="discover-intrest-main">
            <h2>Discover <span>by interest</span></h2>
            <p>Select from thousands of trip plans</p>
            <div class="discover-area cf">
                <div class="col-lg-12">
                    <div class="row">
                        <?php
                        if (!empty($package_category)) {
                            foreach ($package_category as $category) {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 dicover-intrest-btm">
                                    <div class="dicover-intrest">
                                        <figure>
                                            <img src="<?php echo base_url('uploads/tours_group/'.$category->primary_image); ?>" alt="descover">
                                            <div class="discover-deatils">
                                                <img src="<?php echo base_url('uploads/tours_group/'.$category->icon); ?>" alt="descover-icone">
                                                <h3><?php echo!empty($category->group_name) ? $category->group_name : null ?></h3>
                                            </div>
                                        </figure>

                                    </div>
                                </div>
                            <?php }
                        } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
