
<?php $this->load->view('frontend/home/include/header'); ?>
<!--BANNER-PART-PAGE-->
<div class="shri-lanka-benner">
    <div class="baner-outer">
        <?php
        $country_id = !empty($country_data[0]->id) ? $country_data[0]->id : null;
        $bannerImg = base_url('country_image/'.$country_data[0]->banner_image); ?>
        <img src="<?php echo $bannerImg; ?>" alt="baner">
        <div class="benner-text"><?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?></div>
        <div class="trip-counting">
            <?php if(!empty($country_data)){?>
            <p><?php echo !empty($country_data[0]->packages) ? $country_data[0]->packages[0]->counted_rows.'<span>Trips</span>' : ''?></p>
            <p><?php echo !empty($country_data[0]->attractions) ? $country_data[0]->attractions[0]->counted_rows.'<span>Experiences</span>' : ''?></p>
            <p><?php echo !empty($country_data[0]->loctions) ? $country_data[0]->loctions[0]->counted_rows.'<span>Destinations</span>' : ''?></p>
            <?php } ?>
        </div>
    </div>
</div>

<!--PACKGEGS-BY-DESTINATION-->
<div class="sri-lanka-tours-travel">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3><?php echo !empty($country_data[0]->tag_line) ? $country_data[0]->tag_line : ''?></h3>
                <p><?php echo !empty($country_data[0]->short_desc) ? $country_data[0]->short_desc : ''?></p>
            </div>
        </div>
    </div>
</div>

<?php if(!empty($country_package[0]->packages)) { ?>
<div class="shrilanka-packges-by-destination-outer">
    <div class="packges-by-destination-outer">
        <div class="container">
            <div class="packges-by-destination-main">
                <h1><?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?><span> &nbsp;Tours &amp; Travel</span></h1>
            </div>
            <div class="mytab">
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="FirstTimer">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="paxkges-area">
                                    <?php
                                            foreach($country_package[0]->packages as $packages) {
                                                 $imageSrc = FCPATH . 'uploads/tour_itinerary/' . trim($packages->primary_image);
                                                    if (file_exists($imageSrc)) {
                                                        $image_path = base_url() . 'uploads/tour_itinerary/' . $packages->primary_image;
                                                    } else {
                                                        $image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }

                                                    if (empty($packages->primary_image)) {
                                                        $image_path = base_url() . 'uploads/loction/no-preview.png';
                                                    }
                                        ?>
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man day-out">
                                            <div class="packges-destination-box">
                                                <figure>
                                                    <a href="<?php echo base_url('home/package/'.$packages->slug);?>"><img src="<?php echo $image_path;?>" alt="pakckges"></a>
                                                    <figcaption>
                                                        <h3><?php echo !empty($packages->name) ? $packages->name : ''?></h3>
                                                    </figcaption>
                                                    <div class="packges-details cf">
                                                        <ul>
                                                            <li>
                                                                <h4><?php echo !empty($packages->day) ? $packages->day : ''?></h4>
                                                                <h5>Day</h5>
                                                            </li>
                                                            <li>
                                                                <span>form</span>
                                                                <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone"><?php echo !empty($packages->package_price) ? number_format($packages->package_price,2) : ''?></h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </figure>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    
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

<!--DESCOVER-INTREST-->
<?php if(!empty($country_location)){ ?>
<div class="shrilanka-destination-intrest-outer">
    <div class="destination-intrest-outer">
        <div class="container">
            <div class="destination-intrest-main">
                <h2>TOP <span>destinations</span></h2>
                <div class="discover-area cf">
                    <div class="col-lg-12">
                        <div class="row">
                            <?php 
                                $newArray = array_slice($country_location, 0,4);
                                $count = 0;
                                $img_src = '';
                                    foreach($newArray as $destination){
                                       
                                ?>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 destination-width">
                                <div class="destinations-intrest">
                                    <figure>
                                        <a href="<?php echo base_url('location/'.$destination->slug)?>" target="_blank"><img src="<?php echo base_url('uploads/loction/' . $destination->primary_image); ?>" alt="destination"></a>								
                                    </figure>
                                    <p><a href="<?php echo base_url('location/'.$destination->slug)?>" target="_blank"><?php echo !empty($destination->loction) ? $destination->loction : NULL?></a></p>							
                                </div>
                            </div>
                            <?php $count++; } ?>
                            
                        </div>
                    </div>

                    <div class="discover-area bottom">
                        <div class="col-lg-12">
                            <div class="row">
                                <ul class="destinations-name">
                                    <?php if (!empty($country_location)){
                                        $array2 = array_slice($country_location, 4,20);
                                                foreach ($array2 as $withoutImg) {
                                            ?>
                                            <li><a href="<?php echo base_url('location/'.$withoutImg->slug)?>"><?php echo !empty($withoutImg->loction) ? $withoutImg->loction : NULL ?></a></li>	
                                    <?php }
                                } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="sri-lanka-attraction">
    <div class="attraction-trip-outer">
        <div class="container">
            <div class="attraction-trip-main">
                <h2>Top experiences <span>Attraction in <?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?></span></h2>
                <div class="attraction-trip-area cf">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="attraction-trip-cont">
                                    <?php 
                                        $condition_array = array('country_id'=>$country_id);
                                        $attractionCategory = getCategroyAttraction($condition_array);
                                    ?>
                                    <div id="loading-img" style="display: none;"><img src="<?php echo base_url('assets/front/images/loading_spinner.gif')?>" alt="loader"></div>
                                    <select class="selectpicker drpdwn" id="attraction_category">
                                        <option value="">Select</option>
                                        <?php foreach ($attractionCategory as $category) {?>
                                            <option value="<?= $category->id?>"><?= $category->name;?></option>
                                        <?php } ?>
                                    </select>	

                                    <div class="container">
                                        <!-- Controls -->
                                        <div class="controls pull-right">
                                            <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example4" data-slide="prev"></a>
                                            <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example4" data-slide="next"></a>
                                        </div>

                                    </div>

                                    <div id="carousel-example4" class="carousel slide" data-ride="">
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">

                                            <?php
                                            if (!empty($country_attraction[0]->attractions)) {
                                                $totalRecord = count($country_attraction[0]->attractions);
                                                $counter = 0;
                                                $attraction_counter = 1;
                                                $img = '';
                                                $sliderDiv = '';

                                                foreach ($country_attraction[0]->attractions as $attraction) {

                                                    $imageSrc = FCPATH . 'images/attraction/' . trim($attraction->primary_image);

                                                    if (empty($attraction->primary_image)) {
                                                        $img = base_url() . 'uploads/loction/no-preview.png';
                                                    } else {
                                                        if (file_exists($imageSrc)) {
                                                            $img = base_url() . 'images/attraction/' . $attraction->primary_image;
                                                        } else {
                                                            $img = base_url() . 'uploads/loction/no-preview.png';
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
                                                                <a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>" target="_blank"><img src="<?php echo $img; ?>" class="img-responsive custom-attraction-img" alt="" /></a>
                                                                <div class="milan-deatils">
                                                                    <div class="diamond"><a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>"><h2><?= $attraction_counter; ?></h2></a></div>

                                                                    <a href="<?php echo base_url('home/attraction/' . $attraction->slug); ?>"><h3><span><?php echo!empty($attraction->name) ? $attraction->name : NULL ?></span></h3></a>
                                                                </div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                            <?php $counter++;
                                            $attraction_counter++;
                                        }
                                    } ?>

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
    </div>
</div>


<div class="shri-lanka-discover-trip-outer">
    <div class="discover-trip-outer">
        <div class="container">
            <div class="explor-trip-main">
                <h2>Discover  <span><?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?></span></h2>
                <div class="explore-trip-area cf">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                                <div class="explore-trip-cont">
                                    <div class ="country-discover" style="max-height: 625px; overflow: hidden;"><?php echo !empty($country_data[0]->description) ? $country_data[0]->description : ''?></div>
                                    <?php 
                                    $string_length = strlen($country_data[0]->description);
                                    if($string_length > 1800) { ?>
                                        <a class="more_link" href="javascript:;" style="display: inline;">Show More</a>
                                        <a class="less_link" href="javascript:;" style="display: none;">Less</a>
                                    <?php } ?>
                                    
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
<?php
$capitalCity = '';
$countryId = !empty($country_data[0]->id) ? $country_data[0]->id : null;
$capitalCity = CapitalCityByCountry($countryId);
?>
<div class="shri-lanka-glance-trip-outer">
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
                                        <li><p>Capital city:</p><span><?php echo !empty($capitalCity) ? $capitalCity: 'N/A'?></span></li>
                                        <li><p>Population:</p><span><?php echo !empty($country_data[0]->population) ? $country_data[0]->population : ''?></span></li>
                                        <li><p>Language:</p><span><?php echo !empty($country_data[0]->language) ? $country_data[0]->language : ''?></span></li>
                                        <li><p>Currency:</p><span><?php echo !empty($country_data[0]->currency) ? $country_data[0]->currency : ''?></span></li>
                                        <li><p>Time zone:</p><span><?php echo !empty($country_data[0]->time_zone) ? $country_data[0]->time_zone : ''?></span></li>
                                        <li><p>Electricity:</p><span><?php echo !empty($country_data[0]->electcity) ? $country_data[0]->electcity : ''?></span></li>
                                        <li><p>Dialing code:</p><span><?php echo !empty($country_data[0]->stdcode) ? $country_data[0]->stdcode : ''?></span></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="glance-trip-cont">
                                    <p>A good tour that provided a great introduction to Sri Lanka and had the right balance of sights, history, culture, 
                                        and included activities. Ajith, our leader did an excellent job in organising all aspects of the trip.</p>
                                    <figure>
                                        <img src="<?php echo base_url(); ?>assets/front/images/shrilanka-graph.png" alt="" />
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



 <?php if(!empty($country_faq)){ ?>
<div class="shri-lanka-outside">
    <div class="outside">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4>FAQs on <?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?></h4>
                    <div id="accordion">
                        <?php
                            foreach($country_faq as $faq){ ?>
                        <h3><span></span><?php echo!empty($faq->question) ? $faq->question: null; ?></h3>
                        <div>
                            <div class="box">
                                <div class="station">
                                    <h5><?php echo!empty($faq->answer) ? $faq->answer: null; ?></h5>
                                </div>
                            </div>
                        </div>
                         <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if(!empty($country_data[0]->travel_tips)) { ?>
<div class="shri-lanka-travel-trip-outer">
    <div class="travel-trip-outer">
        <div class="container">
            <div class="travel-trip-main">			
                <div class="travel-trip-area cf">
                    <div class="col-lg-12">
                            <?php echo !empty($country_data[0]->travel_tips) ? $country_data[0]->travel_tips : '' ?>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<?php if(!empty($related_articals)) { ?>
<div class="shrilanka-articles-on-milan">

    <div class="articles-on-milan">
        <div class="explore-trip-inner">
            <div class="container">
                <div class="row">
                    <h2>Articles <span>on <?php echo !empty($country_data[0]->name) ? $country_data[0]->name : ''?></span></h2>
                    
                    <?php foreach ($related_articals as $artical) { ?>

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
</div>
<?php } ?>

<script type="text/javascript">
  $( document ).ready(function() {
      
        var countryId = "<?php echo !empty($country_data[0]->id) ? $country_data[0]->id : ''?>";
        
         $('.explore-trip-cont').on('click','.more_link',function(){
            $(this).hide();
            $(this).parent().find('.less_link').show();
            $(this).parent().find('.country-discover').css('max-height', 'none');
        });
             $('.explore-trip-cont').on('click','.less_link',function(){
             $(this).hide();
             $(this).parent().find('.more_link').show();
             $(this).parent().find('.country-discover').css('max-height', '625px');
     });  

        $('#attraction_category').change(function(){
           var baseUrl = '<?php echo base_url();?>';
           var categoryId = $(this).val();
           if(categoryId){
                $.ajax({
                    url: baseUrl+'ajaxController/getAttractionByCategory',
                     beforeSend: function () {
                        $("#loading-img").show();
                        },
                    data: {'id':categoryId,'commonId':countryId,'by':'country'},
                    type: 'POST',
                    success: function (resp) {
                        var data = jQuery.parseJSON(resp);
                        if(data.response === 'true'){
                            $('.carousel-inner').html(data.html);
                            $('.controls').show();
                            $("#loading-img").hide();
                        }else{
                            $('.carousel-inner').html(data.html);
                            $('.controls').hide();
                            $("#loading-img").hide();
                        }
                       
                    }
                });
           }
          
        });
        
        $("#accordion" ).accordion({
            collapsible: true
        });
  });
</script>
