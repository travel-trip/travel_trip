<?php
//dump($location_tour_types);
if(!empty($location_tour_types)){
    $common_desc = !empty($location_tour_types[0]->long_desc) ? $location_tour_types[0]->long_desc : '';
    $category_name = !empty($location_tour_types[0]->group_name) ? $location_tour_types[0]->group_name : '';
}
$this->load->view('frontend/home/include/header');
?>

<div class="wildlife-baner-outer">
    <img src="<?php echo base_url(); ?>assets/front/images/wildlife-banner.jpg" alt="baner">
    <h1><?= $category_name ?> tour in <?= $country_name; ?></h1>
</div>

<div class="wildlife-main-outer">
    <div class="container">
        <p><?= $common_desc; ?></p>
    </div>
    
    <div class="watching-main">
        <div class="container">
            <?php
            if (!empty($location_tour_types)) {
                $total_recods = count($location_tour_types);
                $counter = 1;
                foreach ($location_tour_types as $loc_tours) {
                    $packagesByCategory = getPackagesByTourTypes($loc_tours->tour_type_id, $loc_tours->country_id);
//                    dump($packagesByCategory);
                    ?>
                    <div class="watching-box">
                        <h2>
                            <?php
                            if (!empty($packagesByCategory)) {
                                echo!empty($packagesByCategory[0]->category_name) ? $packagesByCategory[0]->category_name : '';
                            }
                            ?>
                        </h2>
                        <p><?php
                            if (!empty($packagesByCategory)) {
                                echo !empty($packagesByCategory[0]->category_desc) ? $packagesByCategory[0]->category_desc : '';
                            }
                            ?></p>

                        <div id="w">

                            <nav class="slidernav">
                                <div id="navbtns<?= $counter; ?>" class="clearfix">
                                    <a href="#" class="previous"></a>
                                    <a href="#" class="next"></a>      </div>
                            </nav>

                            <div class="crsl-items<?= $counter; ?>" data-navigation="navbtns<?= $counter; ?>">
                                <div class="crsl-wrap">

                                    <?php
                                    if (!empty($packagesByCategory)) {

                                        foreach ($packagesByCategory as $tour_types_packages) {
                                            ?>
                                            <div class="crsl-item">    
                                                <div class="packges-destination-box">
                                                    <figure>
                                                        <img alt="pakckges" src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg">
                                                        <figcaption>
                                                            <h3><?php echo!empty($tour_types_packages->package_name) ? $tour_types_packages->package_name : '' ?></h3>
                                                        </figcaption>
                                                        <div class="packges-details cf">
                                                            <ul>
                                                                <li>
                                                                    <h4><?php echo!empty($tour_types_packages->day) ? $tour_types_packages->day : '' ?></h4>
                                                                    <h5>Day</h5>
                                                                </li>
                                                                <li>
                                                                    <span>form</span>
                                                                    <h6><img align="price icone" src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png"><?php echo!empty($tour_types_packages->package_price) ? $tour_types_packages->package_price : '' ?></h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div><!-- post #1 -->
                                        <?php }
                                    } ?>

                                </div><!-- @end .crsl-wrap -->
                            </div><!-- @end .crsl-items -->

                        </div>

                    </div>
                    <?php
                    $counter++;
                }
            }
            ?>

        </div>
    </div>
</div>

<div class="wildlife-attraction">
    <div class="container">
        <h2>Wild life Attraction</h2>
        <div class="attraction-left">
            <?php if(!empty($category_attraction)){
                $total_attraction = count($category_attraction);
                foreach($category_attraction as $attractions) {
                    $attractionImage = preg_replace('/[^A-Za-z0-9\,\.\']/', '', $attractions->image);
                    $imageArray = explode(',', $attractionImage);
                    if (!empty($imageArray)) {
                        $img = current($imageArray);
                    }
        ?>
            <div class="attraction-box wildlife-margin">
                <figure><img src="<?php echo base_url('images/attraction/'.$img); ?>" alt=""></figure>
                <div class="attraction-content">
                    <h2><?php echo !empty($attractions->name) ? $attractions->name : null ?></h2>
                    <p><?php echo !empty($attractions->short_desc) ? $attractions->short_desc : null ?></p>
                    <a class="read-more">Read More <img src="<?php echo base_url(); ?>assets/front/images/view-next.png"></a>
                </div>
            </div>
            <?php } } ?>
        </div>
        
    </div>
</div>

<div class="national-parks">
    <h2>Sri Lanka's best <span> wildlife National Parks </span></h2>
    <div class="container">
        <div class="national-parks-left">
            <p> Tiger spotting safaris are undertaken by Jeep, small 6-seater open-top SUV 4x4 vehicles. In Ranthambhore, one of India's most popular national parks, there is also the option of shared canter, an open-topped vehicle that can seat up to 20 people. A canter is the cheaper option but Jeeps offer a much better safari experience so if travelling to Ranthambhore we recommend upgrading to Jeep safari, which should be done at time of booking to ensure availability as the number of Jeep vehicles in Ranthambhore is limited.</p>
            <p>
                Game drives are usually around 3 hours in duration with the option to head out in the morning and afternoon. Morning game drives depart between 6:00-6:30am and return back to your lodge between 9:00-9:30am while afternoon game drives leave between 2:00-2:30pm and return back between 5:00-5:30pm, which gives you plenty of time to enjoy meals and the facilities offered by your lodge.</p>
        </div>
        <div class="national-parks-right">
            <img src="<?php echo base_url(); ?>assets/front/images/nat-prk.jpg" alt="">
        </div>
    </div>
</div>

<?php if(!empty($related_articals)){ ?>
        <div class="articles-on-milan">
        <div class="explore-trip-inner">
            <div class="container">
                <div class="row">
                    <h2>Articles <span>on Wildlife</span></h2>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 explore-box-btm">
                        <?php foreach ($related_articals as $artical) { ?>
                            <div class="explore-box">
                                <figure>
                                    <a href="<?php echo!empty($artical['post_url']) ? $artical['post_url'] : null ?>"><img src="<?php echo!empty($artical['post_image_url']) ? $artical['post_image_url'] : null ?>" alt="tour my india"></a>
                                </figure>

                                <a href="<?php echo!empty($artical['post_url']) ? $artical['post_url'] : null ?>"><h2><?php echo!empty($artical['post_title']) ? $artical['post_title'] : null ?></h2></a>
                                <p><?php echo!empty($artical['post_date']) ? date('l,d-M-Y', strtotime($artical['post_date'])) : null ?></p>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="view-all">
                        <a href="#">view all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.bxslider.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.bxslider').bxSlider();

        var scriptCounter = "<?php echo $total_recods; ?>"
        for (i = 1; i <= scriptCounter; i++) {
                $('.crsl-items'+i).carousel({
                    visible: 4,
                    itemMinWidth: 250,
                    itemEqualHeight: false,
                    itemMargin: 9,
                });
        }
      

        $("a[href=#]").on('click', function (e) {
            e.preventDefault();
        });
    });
</script>
<script src="<?php echo base_url(); ?>assets/front/js/responsiveCarousel.min.js"></script>