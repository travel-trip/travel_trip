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
        <div data-widget-editbutton="false" id="" class="jarviswidget jarviswidget-sortable" role="widget">
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
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab4" data-original-title="" title="" aria-expanded="false">
                                    Other Information
                                </a>
                            </li>
                            <li class="">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                    Images
                                </a>
                            </li>
                            <li class="">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab5" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                    History
                                </a>
                            </li>
                            <li class="">
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab6" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                    Visit Best Time
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
                                                        <label class="label">Country</label>
                                                        <label class="select">
                                                            <select name="country_id" id="country_id" type = 'country'>
                                                                <option value="">Select County</option>
                                                                <?php foreach ($countries as $key => $country) { ?>
                                                                    <option value="<?= $key; ?>"><?= !empty($country) ? $country : NULL; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </label>
                                                    </section>
                                                
                                                <div id="country_location"></div>
                                                
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
                                                    <label class="label"><strong>Thing To Do</strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea name="things_to_do" rows="5"></textarea> 
                                                    </label>
                                                </section>
                                                
                                                <section class="clearfix">
                                                    <label class="label"><strong>Primary</strong></label>
                                                    <div class="input input-file">
                                                    <span class="button">
                                                        <input type="file" id="file" name="primary_image" onchange="this.parentNode.nextSibling.value = this.value">Browse</span>
                                                    <input type="text" placeholder="Include some files" readonly="">
                                                    <p>Image Size 260x273 type-|JPEG|JPG|PNG</p>
                                                </div>
                                                </section>
                                                
                                                <section>
                                                    <div class="">
                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 name="show_home"><i></i><strong>Show Home</strong>
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
                                                    <label class="label"><strong>Country Weightage</strong></label>
                                                    <label class="input">
                                                        <input type="text" placeholder="Country Weightage" name="counry_weightage" required=""  data-parsley-type = "number"> 
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label"><strong>City Weightage</strong></label>
                                                    <label class="input"> 
                                                        <input type="text" placeholder="City Weightage" name="city_weightage" data-parsley-type = "number">
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
                                        <div class="col-lg-6 col-sm-6">
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
                                                <div class="row">
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(National-Adult)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(National)" name="nationl_fee_charge"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(Kid)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(International)" name="nationl_fee_charge_kid"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(International-Adult)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(International-Adult)" name="international_fee_charge"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                    
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(Kid)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(International -Kid)" name="international_fee_charge_kid"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                    
                                                </div>
                                                <section>
                                                    <div class="">
                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 name="cost_varying"><i></i><strong>Staring Cost</strong>
                                                        </label>
                                                    </div>
                                                </section>
                                                
                                            </fieldset>
                                            
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <fieldset>
                                                <?php $weekdays = $this->config->item('weekdays');?>
                                                <div class="row">
                                                    <div class="col-sm-5 col-lg-5 padding-10">
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
                                                    <div class="col-sm-5 col-lg-5 padding-10">
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
                                                <div class="clearfix"></div>
                                                
                                                <h3>Winter Timings</h3>
                                                    <section>

                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 name="winter_open_time" id="winter_open_time" flag = "winter" ><i></i><strong>24*7 Open</strong>
                                                        </label>
                                                    </section>

                                                    <div class="row">
                                                        <section>

                                                            <div class="col-sm-5 col-lg-5 padding-10">
                                                                <label><strong>Time From:</strong></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_winter_from" type="text" placeholder="Select time" name="time_winter_from">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                            <div class="col-sm-5 col-lg-5 padding-10">
                                                                <label><strong>Time To:</strong></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_winter_to" type="text" placeholder="Select time" name="time_winter_to">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                        </section> 
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="row">
                                                        <h3>Summer Timings</h3>
                                                        <section>
                                                            <label class="checkbox ">
                                                                <input type="checkbox" value = 1 name="summer_open_time" id="summer_open_time" flag = "summer" ><i></i><strong>24*7 Open</strong>
                                                            </label>
                                                        </section>
                                                        <section>

                                                            <div class="col-sm-5 col-lg-5 padding-10">
                                                                <label><strong>Time From:</strong></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_to" type="text" placeholder="Select time" name="time_summer_from">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                            <div class="col-sm-5 col-lg-5 padding-10">
                                                                <label><strong>Time To:</strong></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_from" type="text" placeholder="Select time" name="time_summer_to">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>
                                                        </section> 

                                                    </div>
                                                
                                                <div class="clearfix"></div>
                                                
                                                <div class="col-sm-3 col-lg-3 padding-10">
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
                                                        <p>Image Size 570x360 type-|JPEG|JPG|PNG</p>
                                                    </div>
                                                    
                                                </section>
                                                
                                            </div>
                                        <a href="" class="add_more_image">Add more</a>

                                    </div>
                                    
                                </article>
                            </div>
                            
                            
                            <div id="tab4" class="tab-pane">
                                <h3>Getting There(How To Reach)</h3>
                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                    <?php
                                    $gettingThere = $this->config->item('getting_by_there');
                                    if (!empty($gettingThere)) {
                                        foreach ($gettingThere as $key => $value) {
                                            ?>
                                            <section>
                                                <label class="label"><strong><?= $value; ?></strong></label>
                                                <label class="textarea"> 										
                                                    <textarea rows="3" name="<?= $key ?>"></textarea> 
                                                </label>
                                            </section>
                                        <?php
                                        }
                                    }
                                    ?>
                                </article>
                            </div>
                            
                            <div id="tab5" class="tab-pane">
                                <h3>Attraction History</h3>
                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                    <a href="" class="add_more_history_row pull-right">Add More
                                    </a>
                                    <div class="row">
                                        <div class="history-wrapper">
                                            <div class="add_more_history">
                                                <div class="col-lg-3 padding-10">
                                                    <section>
                                                        <label class="label"><strong>Title</strong></label>
                                                        <label class="input"> 
                                                            <input type="text" name="history_title[]" placeholder="Title">
                                                        </label>
                                                    </section>
                                                </div>
                                                <div class="col-lg-4 padding-10">
                                                    <section>
                                                        <label class="label"><strong>Image</strong></label>

                                                        <div class="input input-file">
                                                            <span class="button">
                                                                <input type="file" id="file" name="history_image[]" onchange="this.parentNode.nextSibling.value = this.value">Browse</span>
                                                            <input type="text" placeholder="Include some files" readonly="">
                                                            <p>Image Size 275x410 type-|JPEG|JPG|PNG</p>
                                                        </div>
                                                    </section>
                                                </div>
                                                <div class="col-lg-4 ">
                                                    <section>
                                                        <label class="label"><strong>Description</strong></label>
                                                        <label class="textarea"> 										
                                                            <textarea rows="3" name="history_desc[]"></textarea> 
                                                        </label>
                                                    </section>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            
                            <div id="tab6" class="tab-pane">
                                <h3>Visit  Best Time</h3>
                                <?php $month = $this->config->item('month_list'); ?>
                                <div class="visit_best_time_wrapper">
                                    <div class="best_time_row clearfix">
                                        <div class="col-lg-2 padding-10">
                                            <section>
                                                <label class="label">Month from</label>
                                                <label class="select">
                                                    <select name="best_time_from[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($month as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </label>
                                            </section>
                                        </div>

                                        <div class="col-lg-2 padding-10">
                                            <section>
                                                <label class="label">Month To</label>
                                                <label class="select">
                                                    <select name="best_time_to[]">
                                                        <option value="">Select</option>
                                                        <?php
                                                        foreach ($month as $key => $value) {
                                                            ?>
                                                            <option value="<?php echo $key ?>"><?php echo $value; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </label>
                                            </section>
                                        </div>

                                        <div class="col-lg-4 padding-10">
                                            <section>
                                                <label class="label">Short Description</label>
                                                <label class="textarea"> 										
                                                    <textarea name="description[]" rows="2"></textarea>
                                                </label>
                                            </section>
                                        </div>
                                        <a href="" class="add_more_month best-time"><img src="<?php echo base_url() . 'assets/admin/img/plus.png' ?>" alt="add"></a>
                                    </div>
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
        </div>
        <script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	
        var baseUrl = "<?php echo base_url();?>";
        $(document).ready(function() {
            
            $('#country_id').on('change', function (e) {
            e.preventDefault();
            var id = $(this).val();
            var type = $(this).attr('type');
            $.ajax({
                type: "POST",
                url: baseUrl + "ajaxController/getAssociatedCoveredLocations",
                data: {id: id,type:type},
                beforeSend: function () {
                },
            }).done(function (res) {
                var data = $.parseJSON(res);
                $("#country_location").html(data.html2);
            });
        });
        
        $('#winter_open_time').on('change',function(){
                if($(this).is(":checked")){
                    $('#time_winter_from').attr('disabled',true);
                    $('#time_winter_to').attr('disabled',true);
                    $('#time_winter_from').val('');
                    $('#time_winter_to').val('');
                }else{
                    $('#time_winter_from').attr('disabled',false);
                    $('#time_winter_to').attr('disabled',false);
                }
        });
        
        $('#summer_open_time').on('change',function(){
                if($(this).is(":checked")){
                    $('#time_to').attr('disabled',true);
                    $('#time_from').attr('disabled',true);
                    $('#time_to').val('');
                    $('#time_from').val('');
                }else{
                    $('#time_to').attr('disabled',false);
                    $('#time_from').attr('disabled',false);
                }
        });
                
             CKEDITOR.replace('discription',
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
            
            CKEDITOR.replace('things_to_do');

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
            
             $('.best_time_row').on('click', '.add_more_month', function (e) {
                 e.preventDefault();
                getNextBestTimeVisitRow(baseUrl);
            });
        
            $('.visit_best_time_wrapper').on('click', '#remove_row', function (e) {
                e.preventDefault();
                var ParentDiv = $(this).parent('div').parent('div');
                ParentDiv.remove();

            });
            
             $('.add_more_history_row').on('click', function(e) { 
                e.preventDefault();
                var fieldHTML= getNextHitoryRow(baseUrl);
                $('.history-wrapper').append(fieldHTML); 
            });
            
            $('.history-wrapper').on('click', '.remove_history', function(e) {
                e.preventDefault();
                var ParentDiv = $(this).parent();
                ParentDiv.remove();
               
            });
            
            function getNextimageRow(baseUrl)
            {
            var fieldHTML = '<div class="add_more_content"><div class="col-lg-8"><section><label class="label">Banner Image</label><div class="input input-file"><span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files"></div><a href="javascript:void(0);" class="remove_link" title="Remove fields row"><img src="'+ baseUrl +'assets/admin/img/remove.png"/></a></div></div></section>';	
            return fieldHTML;	
            }
            
            function getNextHitoryRow(baseUrl){
                
                var fieldHTML = '<div class="add_more_history">';
                    fieldHTML += '<div class="col-lg-3 padding-10"><section><label class="label"><strong>Title</strong></label><label class="input"><input type="text" name="history_title[]" placeholder="Title"></label></section></div>';
                    fieldHTML += '<div class="col-lg-4 padding-10"><section><label class="label"><strong>Image</strong></label><div class="input input-file"><span class="button"><input type="file" id="file" name="history_image[]" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly=""><p>Image Size 275x410 type-|JPEG|JPG|PNG</p></div></section></div>';
                    fieldHTML += '<div class="col-lg-4 "><section><label class="label"><strong>Description</strong></label><label class="textarea"><textarea rows="3" name="history_desc[]" class=""></textarea></label></section></div>';
                    fieldHTML += '<a href="javascript:void(0);" class="remove_history" title="Remove fields row"><img src="'+ baseUrl +'assets/admin/img/remove.png"/></a></div>';
                
                return fieldHTML;
            }  
            
                function getNextBestTimeVisitRow(baseUrl)
                    {
                        /* get new contact row using ajax */
                        $.ajax({
                            type: "POST",
                            data: {base_url: baseUrl},
                            url: baseUrl + 'AjaxController/GetNextMonthRangeRow',
                            success: function (res) {
                                if (res)
                                {
                                    $('.visit_best_time_wrapper').append(res);
                                }
                                else {
                                    return '';
                                }
                            }
                        });
                    }
                        
            $('#time_to').timepicker();
            $('#time_from').timepicker();
            $('#time_winter_to').timepicker();
            $('#time_winter_from').timepicker();
		
});

</script>

