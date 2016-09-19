<link href="<?php echo base_url()?>assets/front/css/bxslider.css" type="text/css" rel="stylesheet">
<?php
$this->load->view('frontend/home/include/header');
$imageArray = array();
$country_name = '';
if(!empty($attraction_details)){
    $country_name = getCountryNameById(!empty($attraction_details->country_id) ? $attraction_details->country_id : null);

$attractionImage = preg_replace('/[^A-Za-z0-9\,\.\-\\_\']/', '', $attraction_details->image);
$imageArray = explode(',',$attractionImage);
//dump($imageArray);
}

?>
<div class="main-attraction">
    <div class="container">
        <h1><?php echo !empty($attraction_details->attraction_name) ? $attraction_details->attraction_name : '' ?> IN <?php echo !empty($country_name->name) ? $country_name->name : ''?></h1>
        <div class="main-attraction-left">
            <div class="attraction-detail" style="max-height: 450px; overflow: hidden;"><p><?php echo !empty($attraction_details->discription) ? $attraction_details->discription : '' ?></p></div>
            <?php
            $string_length = strlen($attraction_details->discription);
            if ($string_length > 1000) {
                ?>
                <a class="more_link" href="javascript:;" style="display: inline;">Show More</a>
                <a class="less_link" href="javascript:;" style="display: none;">Less</a>
            <?php } ?>
                
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
                    <?php 
                    if(!empty($attraction_details->nationl_fee_charge_kid) && (!empty($attraction_details->nationl_fee_charge))){ ?>
                        <p> Adult- <span><?php echo !empty($attraction_details->nationl_fee_charge) ? $attraction_details->currency.'&nbsp'.$attraction_details->nationl_fee_charge : 'Free' ?></span></p>
                        <p style="margin-left: 20%;">Kid - <span><?php echo !empty($attraction_details->nationl_fee_charge_kid) ? $attraction_details->currency.'&nbsp'.$attraction_details->nationl_fee_charge_kid : 'Free' ?></span></p>
                    <?php } else{ ?>
                        <p><span><?php echo !empty($attraction_details->nationl_fee_charge) ? $attraction_details->currency.'&nbsp'.$attraction_details->nationl_fee_charge : 'Free' ?></span></p>
                    <?php } ?>
                        
                    
                </div>
                <div class="tickets-box">
                    <figure><img src="<?php echo base_url(); ?>assets/front/images/closed.png" /></figure>
                    <h2>Closed</h2>
                    <p><?php echo !empty($attraction_details->closed_day) ? $attraction_details->closed_day : 'Open Every Day' ?></p>
                </div>
                <div class="tickets-box">
                    <figure><img src="<?php echo base_url(); ?>assets/front/images/clock.png" /></figure>
                    <h2>best time</h2>
                    <?php 
                    if(!empty($attraction_best_time)){
                        foreach($attraction_best_time as $peak_time){ ?>
                    <p><?php echo !empty($peak_time->best_time_from) ? $peak_time->best_time_from : ''?>&ndash;<?php echo !empty($peak_time->best_time_to) ? $peak_time->best_time_to : ''?>
                                </p>
                      <?php  }
                    }
                    ?>
                    
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
        <h2>Explore in <?php echo !empty($attraction_details->attraction_name) ? $attraction_details->attraction_name : null ?></h2>
        <div class="mytab">
            <ul class="nav nav-tabs responsive" id="myTab">
                <li role="presentation" class="active"><a href="#history" aria-controls="home" role="tab" data-toggle="tab">history</a></li>
                <li role="presentation"><a href="#Getting_There" aria-controls="profile" role="tab" data-toggle="tab">Getting There</a></li>
                <li role="presentation"><a href="#Things" aria-controls="messages" role="tab" data-toggle="tab">Things to Do</a></li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="history">
                    <div class="explore-content clearfix">
                        <?php
                        if (!empty($attraction_history)) {
                            foreach ($attraction_history as $history) {
                                ?>

                                <div class="attraction-history">
                                    <div class="explore-content-left">
                                        <img src="<?php echo base_url('images/attraction/' . $history->history_image); ?>">
                                    </div>
                                    <div class="explore-content-right">
                                        <ul>
                                            <li>
                                                <h2><?php echo!empty($history->history_title) ? $history->history_title : '' ?></h2>
                                                <p><?php echo!empty($history->history_desc) ? $history->history_desc : '' ?></p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <?php }
                            } ?>
                    </div>
                </div>


                <div role="tabpanel" class="tab-pane" id="Getting_There">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="paxkges-area">
                                <div class="explore-content">
                                    <div class="explore-content-right">
                                        <ul>
                                            <?php
                                                if(!empty($attraction_details->getting_by_air)){ ?>
                                                <li>
                                                    <h2>By Air</h2>
                                                    <p><?php echo $attraction_details->getting_by_air ?></p>
                                                </li>
                                                <?php }
                                                if(!empty($attraction_details->getting_by_rail)){ ?>
                                                <li>
                                                    <h2>By Rail</h2>
                                                    <p><?php echo $attraction_details->getting_by_rail ?></p>
                                                </li>
                                                    
                                                <?php }
                                                if(!empty($attraction_details->getting_by_rail)){ ?>
                                                <li>
                                                    <h2>By Road</h2>
                                                    <p><?php echo $attraction_details->getting_by_rail ?></p>
                                                </li>
                                                    
                                                <?php }
                                                if(!empty($attraction_details->local_transportation)){?>
                                                <li>
                                                    <h2>Local Transportation</h2>
                                                    <p><?php echo $attraction_details->local_transportation ?></p>
                                                </li>
                                                    
                                                <?php } ?>
                                            
                                        </ul>
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
                                <p><?php echo !empty($attraction_details->things_to_do) ? $attraction_details->things_to_do : '' ?></p>    
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
    
       $('.main-attraction-left').on('click','.more_link',function(){
            $(this).hide();
            $(this).parent().find('.less_link').show();
            $(this).parent().find('.attraction-detail').css('max-height', 'none');
        });
             $('.main-attraction-left').on('click','.less_link',function(){
             $(this).hide();
             $(this).parent().find('.more_link').show();
             $(this).parent().find('.attraction-detail').css('max-height', '200px');
     });  
    
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
