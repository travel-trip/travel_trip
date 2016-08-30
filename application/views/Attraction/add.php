<script src="<?php echo base_url(); ?>assets/admin/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script> 

<div id="main" role="main">

<?php
$this->load->view('header/breadcrumb');
?>
<div id="content">
    <div class="m-b-10">
        <div class="pull-left">
            <h3 class="pull-left">
                <strong>Add Attraction</strong>
            </h3>
        </div>
    </div>
    <section id="widget-grid" class="">
        <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
            <div role="content">
                <div class="widget-body ">
                    <div class="tabbable">
                        <ul class="nav nav-tabs bordered">
                            <li class="active">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="" aria-expanded="false">
                                    Basic Information
                                </a>
                            </li>
                            <li class="">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="false">
                                    Cost & Timings
                                </a>
                            </li>
                            <li class="">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                    Images
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form class="smart-form" id="category-form"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('attraction/addAttraction/') ?>">
                        <div class="tab-content padding-10">
                            <div id="tab1" class="tab-pane active">
                                <div class="row">
                                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                        <div class="col-lg-6 col-sm-6">
                                            <fieldset>
                                                <?php $countries = getCountries(); ?>
                                                
                                                <section>
                                                    <label class="label"><strong>Country</strong></label>
                                                    <label class="select">
                                                        <select name="country_id" id="country_id">
                                                            <option value="">Select County</option>
                                                            <?php if(!empty($countries)){
                                                                            foreach ($countries as $key => $country) { ?>
                                                                            <option value="<?= $key; ?>"><?= !empty($country) ? $country : NULL; ?></option>
                                                            <?php } }?>
                                                        </select>
                                                    </label>
                                                </section>
                                                
                                                <?php
                                                
                                                $parent_loction = loction_list(); ?>
                                                
                                                <section>
                                                    <label class="label"><strong>Location</strong></label>
                                                    <label class="select">
                                                        <select name="loction_id">
                                                            <option value="">Select Location</option>
                                                            <?php foreach ($parent_loction as $loction) { ?>

                                                                <option value='<?= $loction->id; ?>'<?php
                                                                if (isset($editData[0]->parent_id) && $editData[0]->parent_id == $loction->id) {
                                                                    echo "selected";
                                                                }
                                                                ?> > <?= $loction->loction; ?></option>
                                                                        <?php
                                                                        echo buildLoctionMenu($loction->id, '', $loction->parent_id);
                                                                        ?>
                                                                    <?php } ?>
                                                        </select>
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Category</strong></label>
                                                    <label class="select">
                                                        <select name="attraction_cat_id" required="">
                                                            <option value="">Select</option>
                                                            <?php
                                                            foreach ($attraction_category as $value) {
                                                                ?>
                                                                <option value="<?php echo $value->id ?>"><?php echo $value->name; ?></option>
                                                            <?php } ?>  
                                                        </select>
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Name</strong></label>
                                                    <label class="input"> 
                                                        <i class="icon-append fa fa-gift"></i>
                                                        <input type="text" placeholder="Name" name="name" required="">
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Short description</strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea class="custom-scroll" name="short_desc" rows="3"></textarea> 
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>City Weightage</strong></label>
                                                    <label class="input"> 
                                                        <input type="text" placeholder="City Weightage" name="city_weightage" data-parsley-type = "number">
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Country Weightage</strong></label>
                                                    <label class="input">
                                                        <input type="text" placeholder="Country Weightage" name="counry_weightage" required=""  data-parsley-type = "number"> 
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Show Home</strong></label>
                                                    <div class="inline-group">
                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 name="show_home"><i></i>
                                                        </label>
                                                    </div>
                                                </section>

                                            </fieldset>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <fieldset>
                                                <section>
                                                    <label class="label"><strong>Description</strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea class="custom-scroll" name="discription" rows="5"></textarea> 
                                                    </label>
                                                </section>
                                                <section>
                                                    <label class="label"><strong>History</strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea name="history">
                                                        </textarea>
                                                    </label>
                                                </section>
                                                <section>
                                                    <label class="label"><strong>State Weightage</strong></label>
                                                    <label class="input">
                                                        <input type="text" placeholder="State Weightage" name="state_weighage" required=""  data-parsley-type = "number"> 
                                                    </label>
                                                </section>
                                            </fieldset>
                                        </div>
                                    </article>
                                        
                                </div>
                            </div>
                            <div id="tab2" class="tab-pane">
                                <div class="row">
                                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                        <div class="col-lg-8 col-sm-8">
                                            <fieldset>
                                                
                                                <?php $currencies = $this->config->item('currency'); ?>
                                                <section>
                                                    <label>Currency</label>
                                                    <label class="select">
                                                        <select name="currency">
                                                            <option value="">Select Currency</option>
                                                            <?php foreach ($currencies as $key => $currency) { ?>
                                                                <option value="<?= $key; ?>"><?= !empty($currency) ? $currency : NULL; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Cost(National)</strong></label>
                                                    <label class="input">
                                                        <input type="text" placeholder="Cost(National)" name="nationl_fee_charge" required="" data-parsley-type = 'number'> 
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>Cost(International)</strong></label>
                                                    <label class="input">
                                                        <input type="text" placeholder="Cost(International)" name="international_fee_charge" required="" data-parsley-type = 'number'> 
                                                    </label>
                                                </section>
                                                
                                                
                                                
                                                <h3>Timings</h3>
                                                <hr>
                                                <?php $weekdays = $this->config->item('weekdays');?>
                                                <div class="clearfix">
                                                    <div class="col-sm-4 col-lg-4 padding-10">
                                                        <section>
                                                            <label class="label"><strong>Day From</strong></label>
                                                            <label class="select">
                                                                <select name="day_from">
                                                                    <?php
                                                                    foreach ($weekdays as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </label>
                                                        </section>

                                                    </div>
                                                    <div class="col-sm-4 col-lg-4 padding-10">
                                                        <section>
                                                            <label class="label"><strong>Day To</strong></label>
                                                            <label class="select">
                                                                <select name="day_to">
                                                                    <?php
                                                                    foreach ($weekdays as $key => $value) {
                                                                        ?>
                                                                        <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </label>
                                                        </section>
                                                    </div>
                                                </div>
                                                <hr>
                                                
                                                <h3>Winter Timings</h3>
                                               <section>

                                                        <div class="clearfix">
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label><strong>Time From:</strong></label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="time_winter_from" type="text" placeholder="Select time" name="time_winter_from">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>  
                                                            </div>
                                                            
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label><strong>Time To:</strong></label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="time_winter_to" type="text" placeholder="Select time" name="time_winter_to">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>  
                                                            </div>
                                                            
                                                        </div>

                                                </section> 
                                                
                                                <h3>Summer Timings</h3>
                                                
                                                <section>

                                                        <div class="clearfix">
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label><strong>Time From:</strong></label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="time_to" type="text" placeholder="Select time" name="time_summer_from">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>  
                                                            </div>
                                                            
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                              <label><strong>Time To:</strong></label>
                                                            <div class="input-group">
                                                                <input class="form-control" id="time_from" type="text" placeholder="Select time" name="time_summer_to">
                                                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                            </div>  
                                                            </div>
                                                            
                                                        </div>

                                                </section> 
                                                
                                                <div class="col-sm-4 col-lg-4">
                                                    <section>
                                                        <label class="label"><strong>Closed On</strong></label>
                                                    <label class="select">
                                                        <select name="closed_day">
                                                            <option value="">Select</option>
                                                            <?php
                                                            foreach ($weekdays as $key => $value) {
                                                                ?>
                                                                <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </label>
                                                </section>
                                                </div>

                                            </fieldset>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            
                            <div id="tab3" class="tab-pane">
                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                    <div class="city_wrapper">
                                            <div class="col-lg-8 add_more_content">
                                                <section>
                                                    <label class="label"><strong>Image</strong></label>
                                                    
                                                    <div class="input input-file">
                                                        <span class="button">
                                                            <input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span>
                                                        <input type="text" readonly="" placeholder="Include some files">
                                                        <p>Image Size 400x400 type-|JPEG|JPG|PNG</p>
                                                    </div>
                                                    
                                                </section>
                                                
                                            </div>
                                        <a href="" class="add_more_image">Add more</a>

                                    </div>
                                    
                                </article>
                            </div>
                            </div>
                            
                        </div>
                        <footer>
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
 <script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
        var baseUrl = "<?php echo base_url();?>";
        $(document).ready(function() {
            
             CKEDITOR.replace('history',
            {
                    toolbar :
                    [
                            { name: 'basicstyles', items : [ 'Bold','Italic','Source' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
                    { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
                    { name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar'] },
                    '/',
                    { name: 'styles', items : [ 'Styles','Format' ] }
                    ]
            });

            $('.add_more_image').on('click', function(e) { //Once add more contact button is clicked
                e.preventDefault();
                var fieldHTML= getNextimageRow(baseUrl);
                $('.city_wrapper').append(fieldHTML); 
            });
            
            $('.city_wrapper').on('click', '.remove_link', function(e) {
                e.preventDefault();
                var ParentDiv = $(this).parent().parent().parent();
                ParentDiv.remove();
               
            });
            
            function getNextimageRow(baseUrl)
            {
            var fieldHTML = '<div class="add_more_content"><div class="col-lg-8"><section><label class="label">Banner Image</label><div class="input input-file"><span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files"></div><a href="javascript:void(0);" class="remove_link" title="Remove fields row"><img src="'+ baseUrl +'assets/admin/img/remove.png"/></a></div></div></section>';	
            return fieldHTML;	
            }
          
                        
            $('#time_to').timepicker();
            $('#time_from').timepicker();
            $('#time_winter_to').timepicker();
            $('#time_winter_from').timepicker();
		
});

</script>

