<?php $this->load->view('frontend/home/include/header'); ?>
<div class="benner-in-milan">
    <div class="baner-outer">
        <img src="<?php echo base_url()?>uploads/loction/<?php echo !empty($details->banner_image) ? $details->banner_image : ''?>" alt="baner">
        <div class="benner-text"><?php echo !empty($details->loction) ? $details->loction : ''?></div>
    </div>
</div>

<div class="mailn-packges-by-destination-outer">
    <?php if(!empty($one_day_packages) || !empty($multi_day_packages)) { ?>
    <div class="packges-by-destination-outer">
        <div class="container">
            <div class="packges-by-destination-main">
                <h1>Best tours &amp; <span>Things to do in <?php echo !empty($details->loction) ? $details->loction : ''?></span></h1>
            </div>
            <div class="milanTab">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs responsive inner" id="milanTab">
                    <li role="presentation" class="active"><a href="#Day" aria-controls="Day" role="tab" data-toggle="tab">Day Tours </a></li>
                    <li role="presentation"><a href="#Multi" aria-controls="Multi" role="tab" data-toggle="tab">Multi Tours  </a></li> 
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="Day">
                        <div class="col-lg-12">
                            <div class="row">
                                <?php if(!empty($one_day_packages)) { ?>
                                <div class="paxkges-area">
                                    <?php 
                                            foreach($one_day_packages as $oneday_packages) {
                                                  if (empty($oneday_packages->primary_image)) {
                                                        $image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }
                                                    $imageSrc = FCPATH . 'uploads/tour_itinerary/' . trim($oneday_packages->primary_image);
                                                    if (file_exists($imageSrc)) {
                                                        $image_path = base_url() . 'uploads/tour_itinerary/' . $oneday_packages->primary_image;
                                                    } else {
                                                        $image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }
                                                   
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man day-out">
                                            <div class="packges-destination-box">
                                                <figure>
                                                    <a href="<?php echo base_url('home/package/'.$oneday_packages->slug);?>"><img src="<?php echo $image_path;?>" alt="pakckges"></a>
                                                    <figcaption>
                                                        <h3><?php echo !empty($oneday_packages->name) ? $oneday_packages->name : ''?></h3>
                                                    </figcaption>
                                                    <div class="packges-details cf">
                                                        <ul>
                                                            <li>
                                                                <h4><?php echo !empty($oneday_packages->day) ? $oneday_packages->day : ''?></h4>
                                                                <h5>Day</h5>
                                                            </li>
                                                            <li>
                                                                <span>from</span>
                                                                <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone"><?php echo !empty($oneday_packages->package_price) ? number_format($oneday_packages->package_price,2) : ''?></h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    <?php }  ?>
                                </div>
                                <?php } else { ?>
                                    <div class="no-records">Packages Not Available.</div>
                               <?php } ?>
                                
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="Multi">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="paxkges-area">
                                    <?php if(!empty($multi_day_packages)) {
                                            foreach($multi_day_packages as $multi_packages) {
                                                  if (empty($packages->primary_image)) {
                                                        $muti_image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }
                                                    $mutliImageSrc = FCPATH . 'uploads/tour_itinerary/' . trim($multi_packages->primary_image);
                                                    if (file_exists($mutliImageSrc)) {
                                                        $muti_image_path = base_url() . 'uploads/tour_itinerary/' . $multi_packages->primary_image;
                                                    } else {
                                                        $muti_image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }
                                                   
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man day-out">
                                            <div class="packges-destination-box">
                                                <figure>
                                                    <a href="<?php echo base_url('home/package/'.$multi_packages->slug);?>"><img src="<?php echo $muti_image_path;?>" alt="pakckges"></a>
                                                    <figcaption>
                                                        <h3><?php echo !empty($multi_packages->name) ? $multi_packages->name : ''?></h3>
                                                    </figcaption>
                                                    <div class="packges-details cf">
                                                        <ul>
                                                            <li>
                                                                <h4><?php echo !empty($multi_packages->day) ? $multi_packages->day : ''?></h4>
                                                                <h5>Day</h5>
                                                            </li>
                                                            <li>
                                                                <span>form</span>
                                                                <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone"><?php echo !empty($multi_packages->package_price) ? number_format($multi_packages->package_price,2) : ''?></h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    <?php } } ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php } ?>
</div>

<div class="milan-discover-trip-outer">
    <div class="discover-trip-outer milan">
        <div class="container">
            <div class="explor-trip-main">
                <h2>Discover  <span><?php echo !empty($details->loction) ? $details->loction : ''?></span></h2>
                <div class="explore-trip-area cf">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                <div class="explore-trip-cont">
                                    <p>
                                       <?php echo !empty($details->long_desc) ? $details->long_desc : null; ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                <div class="explore-trip-cont-detils">
                                    <ul>
                                        <li>
                                            <h3>Best Time To Visit</h3>
                                        </li>
                                        <?php
                                        if (!empty($best_time_visit)) {
                                            
                                            foreach ($best_time_visit as $best_time) {
                                                ?>
                                                <li>
                                                    <h3><?php echo !empty($best_time->best_time_from) ? $best_time->best_time_from : null ?>&ndash;<?php echo !empty($best_time->best_time_to) ? $best_time->best_time_to : null?></h3>
                                                    <p><?php echo !empty($best_time->description) ? $best_time->description : null ?></p>
                                                </li>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($locationAttraction[0]->attractions)) { ?>
    <div class="milan-attraction-trip-outer">
        <div class="attraction-trip-outer">
            <div class="container">
                <div class="attraction-trip-main">
                    <h2>Top experiences <span>Attraction in <?php echo!empty($details->loction) ? $details->loction : '' ?></span></h2>
                    <?php
                    $attractionCategory = getCategroyAttraction();
                    ?>
                    <div class="attraction-trip-area cf">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="attraction-trip-cont">
                                        <select class="selectpicker drpdwn" id="attraction_category">
                                            <option value="">Select</option>
                                            <?php foreach ($attractionCategory as $category) { ?>
                                                <option value="<?= $category->id ?>"><?= $category->name; ?></option>
                                            <?php } ?>
                                        </select>	

                                        <div class="container">
                                            <!-- Controls -->
                                            <div class="controls pull-right">
                                                <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example" data-slide="prev"></a>
                                                <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example" data-slide="next"></a>
                                            </div>

                                        </div>

                                        <div id="carousel-example" class="carousel slide" data-ride="carousel">
                                            <!-- Wrapper for slides -->
                                            <div class="carousel-inner loction-attraction">
                                                <?php
                                                $totalRecord = count($locationAttraction[0]->attractions);
                                                $counter = 0;
                                                $attraction_counter = 1;
                                                $img = '';
                                                $sliderDiv = '';

                                                foreach ($locationAttraction[0]->attractions as $attraction) {

                                                    $imageSrc = FCPATH . 'images/attraction/' . trim($attraction->primary_image);

                                                    if (empty($attraction->primary_image)) {
                                                        $img = base_url() . 'uploads/loction/no-preview1.png';
                                                    } else {
                                                        if (file_exists($imageSrc)) {
                                                            $img = base_url() . 'images/attraction/' . $attraction->primary_image;
                                                        } else {
                                                            $img = base_url() . 'uploads/loction/no-preview1.png';
                                                        }
                                                    }

                                                    if ($counter % 4 == 0 || $counter == 0) {
                                                        $active = ($counter == 0) ? 'active' : '';
                                                        if ($counter > 0) {
                                                            echo '</div></div>';
                                                        }
                                                        echo '<div class="item ' . $active . '"><div class="row">';
                                                    }
                                                    ?>

                                                    <div class="col-sm-3 col-xs-6 carousel-width">
                                                        <div class="col-item">
                                                            <figure>
                                                                <a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>" target="_blank"><img src="<?php echo $img; ?>" class="img-responsive" alt="" /></a>
                                                                <div class="milan-deatils">
                                                                    <div class="diamond"><a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>"><h2><?= $attraction_counter; ?></h2></a></div>

                                                                    <a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>"><h3><span><?php echo!empty($attraction->name) ? $attraction->name : NULL ?></span></h3></a>
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $counter++;
                                                    $attraction_counter++;
                                                }
                                                ?>

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
    </div>
<?php } ?> 

<div class="milan-glance-trip-outer">
    <div class="glance-trip-outer">
        <div class="container">
            <div class="glance-trip-main">
                <h2>At a  <span>Glance</span></h2>
                <div class="glance-trip-area cf">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="glance-trip-cont">
                                    <ul class="glance">
                                        <li><p>Population:</p><span><?php echo !empty($countryInfo->population) ? $countryInfo->population : ''?></span></li>
                                        <li><p>Language:</p><span><?php echo !empty($countryInfo->language) ? $countryInfo->language : ''?></span></li>
                                        <li><p>Currency:</p><span><?php echo !empty($countryInfo->currency) ? $countryInfo->currency : ''?></span></li>
                                        <li><p>Time zone:</p><span><?php echo !empty($countryInfo->time_zone) ? $countryInfo->time_zone : ''?></span></li>
                                        <li><p>Electricity:</p><span><?php echo !empty($countryInfo->electcity) ? $countryInfo->electcity : ''?></span></li>
                                        <li><p>Dialing code:</p><span><?php echo !empty($countryInfo->stdcode) ? $countryInfo->stdcode : ''?></span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="glance-trip-cont">
                                    <p>A good tour that provided a great introduction to Sri Lanka and had the right balance of sights, history, culture, and included activities. Ajith, our leader did an excellent job in organising all aspects of the trip.</p>
                                    <figure>
                                        <img src="<?php echo base_url()?>assets/front/images/shrilanka-graph.png" alt="" />
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

<?php if (!empty($details->travel_tips)) { ?>
    <div class="milan-travel-trip-outer">
        <div class="travel-trip-outer milan">
            <div class="container">
                <div class="travel-trip-main">			
                    <div class="travel-trip-area cf">
                        <div class="col-lg-12">
                            <?php echo !empty($details->travel_tips) ? $details->travel_tips : '' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if(!empty($relatedArtical)){?>
<div class="articles-on-milan">
    <div class="explore-trip-inner">
        <div class="container">
            <div class="row">
                <h2>Articles <span>on <?php echo !empty($details->loction) ? $details->loction : ''?></span></h2>
                <?php foreach ($relatedArtical as $artical) { ?>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 explore-box-btm">
                        <div class="explore-box">
                            <figure>
                                <a href="<?php echo !empty($artical['post_url']) ? $artical['post_url'] : null ?>"><img src="<?php echo !empty($artical['post_image_url']) ? $artical['post_image_url'] : null ?>" alt="tour my india"></a>
                            </figure>

                            <a href="<?php echo !empty($artical['post_url']) ? $artical['post_url'] : null ?>"><h2><?php echo !empty($artical['post_title']) ? $artical['post_title'] : null ?></h2></a>
                            <p><?php echo !empty($artical['post_date']) ? date('l,d-M-Y',strtotime($artical['post_date'])) : null ?></p>
                        </div>
                    </div>
                    <?php } ?>

            </div>
        </div>
    </div>
</div>
<?php } ?>

<script>
     $( document ).ready(function() {
         
        var locationId = <?php echo !empty($details->id) ? $details->id : ''?>;
//        alert(locationId);
        $('#attraction_category').change(function(){
           var baseUrl = '<?php echo base_url();?>';
           var categoryId = $(this).val();
           if(categoryId){
                $.ajax({
                    url: baseUrl+'ajaxController/getAttractionByCategory',
                    data: {'id':categoryId,'commonId':locationId,'by':'location'},
                    type: 'POST',
                    success: function (resp) {
                        var data = jQuery.parseJSON(resp);
                        if(data.response === 'true'){
                            $('.loction-attraction').html(data.html);
                            $('.controls').show();
                        }else{
                            $('.loction-attraction').html(data.html);
                            $('.controls').hide();
                        }
                       
                    }
                });
           }
          
        });

          $("#accordion").accordion({
            collapsible: true
        });
         fakewaffle.responsiveTabs(['xs', 'sm']);
     });

</script>


