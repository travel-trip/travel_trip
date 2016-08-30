<?php
//dump($package_details);
$image_src = '';
$path = !empty($package_details) ? FCPATH.'uploads/tour_itinerary/'.trim($package_details->banner_image) : NULL;
if(file_exists($path)){
    $image_src = base_url().'uploads/tour_itinerary/'.trim($package_details->banner_image);
}else{
    $image_src = base_url().'uploads/loction/no-preview2.png';
}

?>

<div class="baner-outer">
    
    <img src= "<?= $image_src; ?>" alt="baner">
</div>

<div class="book-my-trip-outer">
    <div class="container">
        <div class="book-my-trip-main">
            <div class="book-my-trip cf">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 book-width">
                            <ul class="book-my-trip">
                                <li>
                                    <div class="bangkok-book-my-trip">
                                        <h3><?php echo !empty($package_details->day) ? $package_details->day : '-'?><span>Days</span></h3>
                                    </div>
                                </li>
                                <li>
                                    <div class="bangkok-book-my-trip">
                                        <h4><?php echo !empty($package_details->tour_type) ? $package_details->tour_type : '-'?> <span>style</span></h4>	
                                    </div>
                                </li>
                                <li>
                                    <div class="bangkok-book-my-trip">
                                        <figure>
                                            <img src="<?php echo base_url(); ?>assets/front/images/star.png" alt="destination">
                                        </figure>
                                        <h3><span> Travellers rating</span></h3>							
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 book-width">
                            <ol class="book-my-trip_btn">
                                <li>
                                    <div class="bangkok-book-my-trip">
                                        <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price.png" align="price icone"><?php echo !empty($package_details->package_price) ? $package_details->package_price : '-'?></h6>	
                                    </div>
                                </li>
                                <li><button type="submit" class="trip_btn active">Book my trip</button></li>
                                <li><button type="submit" class="trip_btn">Enquery</button></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="classic-tour-outer">

    <div class="container">
        <div class="classic-tour-main">
            <h1>Classic tour  in <span><?php echo !empty($package_details->country_name) ? $package_details->country_name : '-'?></span></h1>
            <div class="classic-tour-area cf">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 tour-width">
                            <div class="classic-tour-cont">
                                <p><?php echo!empty($package_details->desc) ? $package_details->desc : '-' ?></p>

                                <?php if (!empty($tour_higlights)) { ?>
                                    <h4 id="highlights">High lights</h4>
                                    <ul class="highlights">
                                        <?php
                                        $tour_higlights_count = 1;
                                        $img = '';
                                        foreach ($tour_higlights as $highlights) {
                                              $highlightsImages = preg_replace('/[^A-Za-z0-9\,\.\-\']/', '', $highlights->image);
                                              $imageArray = explode(',', $highlightsImages);
                                              if (!empty($imageArray)) {
                                                  $img = current($imageArray);
                                              }
                                            ?>
                                            <li>
                                                <figure>
                                                    <a href="<?php echo base_url('home/attraction/'.$highlights->slug)?>" target="_blank"><img src="<?php echo base_url('images/attraction/'.$img) ?>" alt="" /></a>
                                                    <div class="classic-tour-deatils">
                                                        <div class="diamond"><h2><?= $tour_higlights_count; ?></h2></div>
                                                        <a href="<?php echo base_url('home/attraction/'.$highlights->slug)?>" target="_blank"><h3><?php echo !empty($highlights->name) ? $highlights->name : null ?></h3></a>
                                                    </div>
                                                </figure>
                                            </li>
                                        <?php $tour_higlights_count++;
                                    }
                                    
                                }
                                ?>
                                </ul>
                            </div> 
                        </div> 

                          <?php 
                          $start_to = '';
                          $seprater = '';
                          $start_from = '';
                          $covered_cities =  !empty($package_details->covered_loction) ? $package_details->covered_loction : '-';
                          
                          $locationData = getCoveredLocations($package_details->package_id);
                          $first_loctions = current($locationData);
                          $second_loctions = end($locationData);
                          
                          if(!empty($locationData)){
                              $start_to = getLoctionNameById($first_loctions->locations);
                              $start_from = getLoctionNameById($second_loctions->locations);
                          }
                          
                          ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 tour-width">
                            <div class="classic-tour-cont first">
                                <div class="start_finish">
                                    <ul>
                                        <li><h5>start from <span><?php echo !empty($start_to->loction) ? $start_to->loction : null?></span></h5></li>
                                        <li><h5>finish <span><?php echo !empty($start_from->loction) ? $start_from->loction : null?></span></h5></li>
                                    </ul>
                                </div>

                                <ol>
                                    <li><figure><img src="<?php echo base_url(); ?>assets/front/images/icon5.png" alt="" /></figure></li>
                                    <li><h6>Cites <span>
                                                <?php
                                                $i = 1;
                                                foreach ($locationData as $location) {
                                                    if ($i == 2) {
                                                        $seprater = ' - ';
                                                    }
                                                    $city_name = getLoctionNameById($location->locations);
                                                    echo $seprater . $city_name->loction;
                                                    $i++;
                                                }
                                                ?>
                                            </span>
                                        </h6>
                                    </li>
                                    <li><figure><img src="<?php echo base_url(); ?>assets/front/images/icon6.png" alt="" /></figure></li>
                                    <li><h6>Best Time <span>
                                            <?php 
                                            if(!empty($best_time)){
                                                foreach($best_time as $visit){
                                                    echo $visit->best_time_from.'&nbsp'.$visit->best_time_to.'&nbsp';
                                                }
                                            }
                                            ?></span>
                                        </h6>
                                    </li>
                                </ol>
                            </div>

                            <div class="classic-tour-cont1">
                                <figure>
                                    <img src="<?php echo base_url(); ?>assets/front/images/map.png" alt="" />
                                </figure>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="itnerary-trip-outer" id="itnerary">
    <div class="container">
        <div class="itnerary-trip-main">
            <h2>Itinerary</h2>
            <div class="itnerary-trip-area cf">
                <div class="col-lg-12">
                    <div class="row">

                        <?php
                        $transport = '';
                        $icon_food = '';
                        $meal_icon = '';
                        $sightseen = '';

                        $activit_icon_rafting = '';
                        $activit_icon_tracking = '';
                        $activit_icon_biking = '';

                        $lunch_counter = 0;
                        $dinner_counter = 0;
                        $transport_counter = 0;
                        $breakfase_counter = 0;
                        $stay_hotel = 0;

                        if (!empty($package_itneraries)) {
                            $counter = 1;
                            foreach ($package_itneraries as $itnarary) {
                                $itnararyAcitiivties = itnararyActivities($itnarary->itinery_activities);

                                if (trim($itnarary->transport) == 'Provided') {
                                    $transport = 'Provided';
                                    $transport_counter++;
                                }

                                if (trim($itnarary->night_plan_same_day) == 'Travelling') {
                                    $icon_transport = base_url() . 'assets/front/images/icon10.png';
                                    $transport_img = '<li><img src="' . $icon_transport . '" alt="" /></li>';
                                } else {
                                    $transport_img = '';
                                }
                                
                                if(trim($itnarary->sightseeing)){
                                    $sight_seen_img = base_url() . 'assets/front/images/icon9.png';
                                    $sightseen = '<li><img src="' . $sight_seen_img . '" alt="" /></li>';
                                }else{
                                    $sightseen = '';
                                }
                                
                                if (trim($itnarary->night_plan_same_day) == 'StayHotel') {
                                    $stay_hotel++;
                                } 

                                $itnararyMeals = itnararyMealCounter($itnarary->food);
                                if (!empty($itnararyMeals)) {
                                    foreach ($itnararyMeals as $key => $food) {
                                            switch ($food) {
                                                case 'Lunch':
                                                    $lunch_counter++;
                                                    $icon_food = base_url() . 'assets/front/images/icon8.png';
                                                    $meal_icon = '<li><img src="' . $icon_food . '" alt="" /></li>';
                                                    break;
                                                case 'Dinner':
                                                    $dinner_counter++;
                                                    $icon_food = base_url() . 'assets/front/images/icon8.png';
                                                    $meal_icon = '<li><img src="' . $icon_food . '" alt="" /></li>';
                                                    break;
                                                case 'Breakfast':
                                                    $breakfase_counter++;
                                                    $icon_food = base_url() . 'assets/front/images/icon8.png';
                                                    $meal_icon = '<li><img src="' . $icon_food . '" alt="" /></li>';
                                                    break;
                                                default:
                                                    exit();
                                                    break;
                                            }
                                    }
                                }

                                if (!empty($itnarary->stay)) {
                                    $stay_hotel++;
                                }
                                

                                if (!empty($itnarary->next_day_stay_hotel)) {
                                    $stay_hotel++;
                                }
                                ?>
                                <div class="itnerary-trip-area-box">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <figure>
                                            <img src="<?php echo base_url('uploads/tour_itinerary/' . $itnarary->image); ?>" alt="" />
                                        </figure>
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 seperator">
                                        <div class="itnerary-circle">
                                            <p>Day<span><?= $counter; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                        <div class="itnerary-trip-cont new-trip">
                                            <h4><?php echo!empty($itnarary->loction) ? $itnarary->loction : '' ?> </h4>
                                            <p><?php echo!empty($itnarary->itinery_desc) ? $itnarary->itinery_desc : '' ?> </p>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nospace">
                                                <ul>
                                                    <?php
                                                    echo $meal_icon;
                                                    echo $sightseen;
                                                    echo $transport_img;
                                                    ?>
                                                </ul>
                                            </div>

                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right nospace">
                                                <ol>
                                                    <?php 
                                                        foreach($itnararyAcitiivties as $activityIcon){ ?>
                                                            <li><img src="<?php echo base_url().'uploads/tour_activity/'.$activityIcon->icon ?>" alt="" /></li>
                                                    <?php }
                                                    ?>
                                                </ol>
                                            </div>
                                        </div>
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
        </div>
    </div>
</div>

<div class="bangkok-trip-outer" id="activities">
    <div class="container">
        <div class="bangkok-trip-main">
            <h2>What's Included</h2>
            
            <div class="bangkok-trip-area cf">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                            <div class="bangkok-trip-cont">
                                <?php echo !empty($package_details->included) ? $package_details->included : '-'?>

                                <p>What's Excluded</p>
                                <?php echo !empty($package_details->exluded) ? $package_details->exluded : '-'?>
                                
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                            <div class="bangkok-trip-cont-detils">
                                <ul>
                                    <li>
                                        <h3>Meals</h3>
                                        <p>
                                            <?php
                                            if(isset($lunch_counter) || isset($dinner_counter) || $breakfase_counter){
                                                echo ($lunch_counter!= 0) ? $lunch_counter.' Lunch ' : '';
                                                echo ($dinner_counter != 0) ? $dinner_counter.' Dinner ' : '';
                                                echo ($breakfase_counter != 0) ? $breakfase_counter.' Breakfast' : '';
                                            }
                                            ?>
                                        </p>
                                    </li>
                                    <li>
                                        <h3>Transport</h3>
                                        <p><?php echo $transport; ?>(<?= $transport_counter; ?>)</p>
                                    </li>
                                    <li>
                                        <h3>Accommodation</h3>
                                        <p>Hotel (<?php echo isset($stay_hotel) ? $stay_hotel : '';?> nights) </p>
                                    </li>
                                    <li>
                                        <h3>Included activities</h3>
                                        <?php
                                        if (!empty($included_activities)) {
                                            foreach ($included_activities as $activities) {
                                                ?>
                                                <p><?php echo!empty($activities->name) ? $activities->name : '' ?></p>
                                                <?php
                                            }
                                        }
                                        ?>
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="trip-notes-outer" id="includes">
    <div class="container">


        <div class="travel-trip-main">			
            <div class="travel-trip-area cf">
                <div class="col-lg-12">
                    <?php echo !empty($package_details->tour_trip_notes) ? $package_details->tour_trip_notes : '-'?>
                </div>
            </div>
        </div>

        
    </div>
</div>

<div class="main-reviews">
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
            <img src="<?php echo base_url('assets/front/images/star.png')?>" alt="" />
          <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
		  <h3>Mike rozar</h3>
        </div><!-- post #1 -->
        
        <div class="crsl-item">
          <img src="<?php echo base_url('assets/front/images/star.png')?>" alt="" />
          <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
		  <h3>Mike rozar</h3>
        </div><!-- post #2 -->
        
        <div class="crsl-item">
          <img src="images/star.png" alt="" />
          <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
		  <h3>Mike rozar</h3>
        </div><!-- post #3 -->
        
        <div class="crsl-item">
       <img src="images/star.png" alt="" />
          <p>Drive along the road in Sri Lanka and you can pass Hindu temples, Buddhist shrines, churches and mosques all on the same stretch. This fusion found in the history, the culture, the Arabian, Indian and European-inspired food makes Sri Lanka a delicious melting pot to explore. </p>
		  <h3>Mike rozar</h3>
        </div><!-- post #4 -->
        
	<div class="crsl-item">
	<img src="images/star.png" alt="" />
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
                            <?php 
                            $condition_array = array();
                            if(!empty($package_details->country_id)){
                                $condition_array = array('term'=>'country','id'=>$package_details->country_id);
                            }else{
                                $condition_array = array('term'=>'location','id'=>$package_details->location_id);
                            }
                            $getRelatedTrips = GetRelatedTrips($condition_array);
//                            dump($getRelatedTrips);
                            if(!empty($getRelatedTrips)){
                                foreach($getRelatedTrips as $relatedPackage){ ?>
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                                <div class="packges-destination-box">
                                                    <figure>
                                                        <img src="<?php echo base_url('uploads/tour_itinerary/'.$relatedPackage->primary_image); ?>" alt="pakckges">
                                                        <figcaption>
                                                            <h3><?php echo !empty($relatedPackage->package_name) ? $relatedPackage->package_name : null;?></h3>
                                                        </figcaption>
                                                        <div class="packges-details cf">
                                                            <ul>
                                                                <li>
                                                                    <h4><?php echo !empty($relatedPackage->day) ? $relatedPackage->day : null;?></h4>
                                                                    <h5>Day</h5>
                                                                </li>
                                                                <li>
                                                                    <span>form</span>
                                                                    <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone"><?php echo !empty($relatedPackage->package_price) ? $relatedPackage->package_price : null;?></h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </figure>
                                                </div>
                                            </div>
                               <?php }
                            }
                            
                            ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 $(function(){
  $('.crsl-items').carousel({
    visible: 2,
    itemMinWidth: 455,
    itemEqualHeight: false,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
    
  });
});

</script>

<script src="<?php echo base_url(); ?>assets/front/js/responsiveCarousel.min.js"></script>

