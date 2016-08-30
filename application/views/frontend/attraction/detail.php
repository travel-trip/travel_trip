<link href="<?php echo base_url()?>assets/front/css/bxslider.css" type="text/css" rel="stylesheet">
<?php
//$this->load->view('frontend/home/include/header');
$imageArray = array();
$country_name = '';
if(!empty($attraction_details)){
    $country_name = getCountryNameById(!empty($attraction_details->country_id) ? $attraction_details->country_id : null);

$attractionImage = preg_replace('/[^A-Za-z0-9\,\.\-\']/', '', $attraction_details->image);
$imageArray = explode(',',$attractionImage);
}

?>
<div class="main-attraction">
    <div class="container">
        <h1><?php echo !empty($attraction_details->attraction_name) ? $attraction_details->attraction_name : '' ?> IN <?php echo !empty($country_name->name) ? $country_name->name : ''?></h1>
        <div class="main-attraction-left">
            <p><?php echo !empty($attraction_details->discription) ? $attraction_details->discription : '' ?></p>
        </div>
        <div class="main-attraction-right">
            
            <?php
            if (!empty($imageArray)) {
                echo '<ul class="bxslider">';
                foreach ($imageArray as $key => $val) {
                        $img = base_url() . 'images/attraction/' . $val;
                    ?>
                    <li><img src="<?php echo $img; ?>" /></li>
                <?php
                }
                echo '</ul>';
            }
            ?>
           
            <div class="tickets">
                <div class="tickets-box">
                    <figure><img src="<?php echo base_url(); ?>assets/front/images/tickets.png" /></figure>
                    <h2>Ticket</h2>
                    <p><span><?php echo !empty($attraction_details->nationl_fee_charge) ? $attraction_details->nationl_fee_charge : '' ?></span></p>
                </div>
                <div class="tickets-box">
                    <figure><img src="<?php echo base_url(); ?>assets/front/images/closed.png" /></figure>
                    <h2>Closed</h2>
                    <p><?php echo !empty($attraction_details->closed_day) ? $attraction_details->closed_day : '' ?></p>
                </div>
                <div class="tickets-box">
                    <figure><img src="<?php echo base_url(); ?>assets/front/images/clock.png" /></figure>
                    <h2>bed time</h2>
                    <p>jan-mar apr-may</p>
                </div>
                <div class="tickets-box nopadding">
                    <div class="summer">
                        <img src="<?php echo base_url(); ?>assets/front/images/summer.png" />
                        <h2>Summer</h2>
                        <p><?php echo !empty($attraction_details->time_summer_from) ? $attraction_details->time_summer_from : '' ?>&ndash;<?php echo !empty($attraction_details->time_summer_to) ? $attraction_details->time_summer_to : '' ?></p>
                    </div>
                    <div class="winter">
                        <img src="<?php echo base_url(); ?>assets/front/images/winter.png" />
                        <h2>Winter</h2>
                        <p><?php echo !empty($attraction_details->time_winter_from) ? $attraction_details->time_winter_from : '' ?>&ndash;<?php echo !empty($attraction_details->time_winter_to) ? $attraction_details->time_winter_to : '' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="explore">
    <div class="container">
        <h2>Explor in <?php echo !empty($attraction_details->attraction_name) ? $attraction_details->attraction_name : null ?></h2>
        <div class="mytab">
            <ul class="nav nav-tabs responsive" id="myTab">
                <li role="presentation" class="active"><a href="#history" aria-controls="home" role="tab" data-toggle="tab">history</a></li>
                <li role="presentation"><a href="#Getting_There" aria-controls="profile" role="tab" data-toggle="tab">Getting There</a></li>
                <li role="presentation"><a href="#Things" aria-controls="messages" role="tab" data-toggle="tab">Things to Do</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="history">
                    <?php echo !empty($attraction_details->history) ? $attraction_details->history : '';?>
                </div>


                <div role="tabpanel" class="tab-pane" id="Getting_There">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="paxkges-area">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="Things">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="paxkges-area">
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>

                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                    <div class="packges-destination-box">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                            <figcaption>
                                                <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                            </figcaption>
                                            <div class="packges-details cf">
                                                <ul>
                                                    <li>
                                                        <h4>5</h4>
                                                        <h5>hours</h5>
                                                    </li>
                                                    <li>
                                                        <span>form</span>
                                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                    </li>
                                                </ul>
                                            </div>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="main-reviews background">
    <div class="container">
        <div id="w">
            <h2>Reviews</h2>

            <nav class="slidernav">
                <div id="navbtns" class="clearfix">
                    <a href="#" class="previous"></a>
                    <a href="#" class="next"></a>
                </div>
            </nav>

            <div class="crsl-items" data-navigation="navbtns">
                <div class="crsl-wrap">
                    <div class="crsl-item">    
                        <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="" />
                        <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
                        <h3>Mike rozar</h3>
                    </div><!-- post #1 -->

                    <div class="crsl-item">
                        <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="" />
                        <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
                        <h3>Mike rozar</h3>
                    </div><!-- post #2 -->

                    <div class="crsl-item">
                        <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="" />
                        <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
                        <h3>Mike rozar</h3>
                    </div><!-- post #3 -->

                    <div class="crsl-item">
                        <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="" />
                        <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
                        <h3>Mike rozar</h3>
                    </div><!-- post #4 -->

                    <div class="crsl-item">
                        <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="" />
                        <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
                        <h3>Mike rozar</h3>
                    </div><!-- post #5 -->
                </div><!-- @end .crsl-wrap -->
            </div><!-- @end .crsl-items -->

        </div>
    </div>
</div>

<div class="shrilanka-packges-by-destination-outer">
    <div class="packges-by-destination-outer">
        <div class="container">
            <div class="packges-by-destination-main">
                <h1>Related Trips</h1>
            </div>
            <div class="mytab">
                <!-- Nav tabs -->

                <!-- Tab panes -->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="paxkges-area">
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                <div class="packges-destination-box">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                        <figcaption>
                                            <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                        </figcaption>
                                        <div class="packges-details cf">
                                            <ul>
                                                <li>
                                                    <h4>5</h4>
                                                    <h5>hours</h5>
                                                </li>
                                                <li>
                                                    <span>form</span>
                                                    <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                <div class="packges-destination-box">
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets/front/images/packges-imges.jpg" alt="pakckges">
                                        <figcaption>
                                            <h3>Day Out at Jaladhama Resort Sri Lanka</h3>
                                        </figcaption>
                                        <div class="packges-details cf">
                                            <ul>
                                                <li>
                                                    <h4>5</h4>
                                                    <h5>hours</h5>
                                                </li>
                                                <li>
                                                    <span>form</span>
                                                    <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone">2.250</h6>
                                                </li>
                                            </ul>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/front/js/jquery.bxslider.min.js"></script>

<script>
$(document).ready(function(){
    
  $('.bxslider').bxSlider();
  
  $('.crsl-items').carousel({
    visible: 2,
    itemMinWidth: 455,
    itemEqualHeight: false,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
  
var header = $('.header-outer');
header.addClass('opaque');  
});
</script>

<script src="<?php echo base_url(); ?>assets/front/js/responsiveCarousel.min.js"></script>
