
<?php 

$this->load->view('frontend/home/include/header');
$destination_name = !empty($package_destination) ? $package_destination[0]->country_name : null;
$country_id = !empty($package_destination) ? $package_destination[0]->country_id : null;

?>

<div class="baner-outer">
    <img src="<?php echo base_url(); ?>assets/front/images/baner-images.jpg" alt="baner">
</div>

<!--PACKGEGS-BY-DESTINATION-->
<div class="packges-by-destination-outer">
    <div class="container">
        <div class="packges-by-destination-main">
            <h1>Packages By <span>Destination</span></h1>
            <p>Select from thousands of trip plans</p>
        </div>
        <div class="mytab">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs responsive" id="myTab">
                <?php 
                if(!empty($locations)){
                    $counter = 1;
                    $active = '';
                    foreach($locations as $location){
                        if($counter == 1){
                            $active = 'active';
                        }else{
                            $active = '';
                        }
                        ?>
                        <li role="presentation" class="<?= $active; ?>"><a href="#<?php echo $location->name ?>" country-id ="<?php echo $location->id ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo $location->name ?></a></li>
                    <?php $counter++; }
                    
                }
                ?>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content" id="tab-area">
                <div role="tabpanel" class="tab-pane active" id="<?= $destination_name; ?>">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="paxkges-area">
                                
                                <?php if(!empty($package_destination)){
                                    $image_path = '';
                                    $imageSrc = '';
                                    foreach($package_destination as $packages){

                                        $imageSrc = FCPATH . 'uploads/tour_itinerary/'.trim($packages->primary_image);
                                        if (file_exists($imageSrc)) {
                                            $image_path = base_url() . 'uploads/tour_itinerary/'.$packages->primary_image;
                                        } else {
                                            $image_path = base_url() . 'uploads/loction/no-preview1.png';
                                        }
                                        
                                        if (empty($packages->banner_image)) {
                                            $image_path = base_url() . 'uploads/loction/no-preview1.png';
                                        }
                                        ?>
                                
                                
                                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 box-pkg-man">
                                            <div class="packges-destination-box">
                                                <figure>
                                                    <a href="<?php echo base_url('home/package/'.$packages->slug);?>" target="_blank"><img src="<?php echo $image_path; ?>" alt="pakckges"></a>
                                                    <figcaption>
                                                        <h3><a href="<?php echo base_url('home/package/'.$packages->slug);?>" target="_blank"><?php echo !empty($packages->package_name) ? $packages->package_name : null?></a></h3>
                                                    </figcaption>
                                                    <div class="packges-details cf">
                                                        <ul>
                                                            <li>
                                                                <h4><?php echo !empty($packages->day) ? $packages->day : null?></h4>
                                                                <h5>Day</h5>
                                                            </li>
                                                            <li>
                                                                <span>From</span>
                                                                <h6><img src="<?php echo base_url(); ?>assets/front/images/packges-price-icone.png" align="price icone"><?php echo !empty($packages->package_price) ? $packages->package_price : null?></h6>
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
                
                <div role="tabpanel" class="tab-pane packages-destination" id="">
                    
                </div>
            </div>
        </div>
        <div class="view-all">
            <a href="#">view all</a>
        </div>
    </div>
</div>

<!--DESCOVER-INTREST-->
<?php $this->load->view('frontend/home/discover_interest'); ?>

<!--EXPLORE TRIP-->
<?php $this->load->view('frontend/home/explore_trip'); ?>

<!--BLOG AREA-->
<?php $this->load->view('frontend/home/blogs'); ?>

<script type="text/javascript">
    
    $( document ).ready(function() {
     var baseUrl = '<?php echo base_url();?>';
     $('ul.nav-tabs li a').click(function(){
           var id = $(this).attr('country-id');
           var name = $(this).text();
           var firstChild = $("ul.nav-tabs li a" ).first().attr('href');
           $(''+firstChild+'').removeClass('active');
           if(id){
                $.ajax({
                    url: baseUrl+'ajaxController/getPackagesByDestination',
                    data: {'country-id':id},
                    type: 'POST',
                    success: function (data) {
                        $('.packages-destination').removeClass('active');
                        if(data){
                            $('.packages-destination').attr('id',name);
                            $('#'+name).addClass('active');
                            $('.packages-destination').html(data);
                        }
                       
                    }
                });
           }
          
        });
    });

</script>

