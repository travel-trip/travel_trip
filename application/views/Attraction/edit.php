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
        <?php // dump($EDIT_DATA);?>
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
                        <form class="smart-form" id="category-form"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('attraction/edit/' . $EDIT_DATA->id) ?>">
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
                                                            <select name="country_id" id="country_id">
                                                                <option value="">Select County</option>
                                                                <?php
                                                                if (!empty($countries)) {
                                                                    foreach ($countries as $key => $country) {
                                                                        $sel = (isset($EDIT_DATA->country_id) && $EDIT_DATA->country_id == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?= $key; ?>" <?= $sel ?>><?= !empty($country) ? $country : NULL; ?></option>
                                                                    <?php }
                                                                }
                                                                ?>
                                                            </select>
                                                        </label>
                                                    </section>
                                                    
                                                    <?php 
                                                    
                                                    $parent_loction = loction_list(); ?>
                                                
                                                    <section>
                                                        <label class="label">Location</label>
                                                        <label class="select">
                                                            <select name="loction_id">
                                                                <option value="">Select Location</option>
                                                                <?php foreach ($parent_loction as $loction) { ?>

                                                                    <option value='<?= $loction->id; ?>'<?php
                                                                    if (isset($EDIT_DATA->loction_id) && $EDIT_DATA->loction_id == $loction->id) {
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
                                                        <label class="label">Category</label>
                                                        <label class="select">
                                                            <select name="attraction_cat_id" required="">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($attraction_category as $value) {
                                                                    $sel = (isset($EDIT_DATA->attraction_cat_id) && $EDIT_DATA->attraction_cat_id == $value->id) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?php echo $value->id ?>" <?php echo $sel; ?>><?php echo $value->name; ?></option>
                                                                <?php } ?>  
                                                            </select>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Name</label>
                                                        <label class="input"> 
                                                            <i class="icon-append fa fa-gift"></i>
                                                            <input type="text" placeholder="Name" name="name" required="" value="<?php echo!empty($EDIT_DATA->name) ? $EDIT_DATA->name : '' ?>">
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Short description</label>
                                                        <label class="textarea"> 										
                                                            <textarea class="custom-scroll" name="short_desc" rows="3"><?php echo!empty($EDIT_DATA->short_desc) ? $EDIT_DATA->short_desc : '' ?></textarea> 
                                                        </label>
                                                    </section>
                                                    <section>
                                                        <label class="label">Country Weightage</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Country Weightage"value="<?php echo!empty($EDIT_DATA->counry_weightage) ? $EDIT_DATA->counry_weightage : '' ?>" name="counry_weightage" required=""  data-parsley-type = "number"> 
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">City Weightage</label>
                                                        <label class="input"> 
                                                            <i class="icon-append fa fa-gift"></i>
                                                            <input type="text" placeholder="City Weightage" value="<?php echo!empty($EDIT_DATA->city_weightage) ? $EDIT_DATA->city_weightage : '' ?>" name="city_weightage" data-parsley-type = "number">
                                                        </label>
                                                    </section>
                                                    
                                                    <section>
                                                        <label class="label"><strong>Show Home</strong></label>
                                                        <div class="inline-group">
                                                            <label class="checkbox ">
                                                                <input type="checkbox" value = 1 <?php echo!empty($EDIT_DATA->show_home) ? 'checked' : '' ?> name="show_home"><i></i>
                                                            </label>
                                                        </div>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                            <fieldset>
                                                <section>
                                                    <label class="label">Description</label>
                                                    <label class="textarea"> 										
                                                        <textarea class="custom-scroll" name="discription" rows="5"><?php echo !empty($EDIT_DATA->description) ? $EDIT_DATA->description : '' ?></textarea> 
                                                    </label>
                                                </section>
                                                <section>
                                                    <label class="label"><strong>History</strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea name="history">
                                                            <?php echo!empty($EDIT_DATA->history) ? $EDIT_DATA->history : '' ?>
                                                        </textarea>
                                                    </label>
                                                </section>

                                                    <section>
                                                        <label class="label">State Weightage</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="State Weightage" value="<?php echo!empty($EDIT_DATA->state_weighage) ? $EDIT_DATA->state_weighage : '' ?>" name="state_weighage" required=""  data-parsley-type = "number"> 
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
                                                                <?php foreach ($currencies as $key => $currency) {
                                                                    $sel = (isset($EDIT_DATA->currency) && $EDIT_DATA->currency == $key) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?= $key; ?>" <?= $sel; ?>><?= !empty($currency) ? $currency : NULL; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Cost(National)</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Cost(National)" name="nationl_fee_charge" value="<?php echo!empty($EDIT_DATA->nationl_fee_charge) ? $EDIT_DATA->nationl_fee_charge : '' ?>" required="" data-parsley-type = 'number'> 
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Cost(International)</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Cost(International)" name="international_fee_charge" required="" value="<?php echo!empty($EDIT_DATA->international_fee_charge) ? $EDIT_DATA->international_fee_charge : '' ?>" data-parsley-type = 'number'> 
                                                        </label>
                                                    </section>


                                                    <hr>
                                                    <?php $weekdays = $this->config->item('weekdays'); ?>
                                                    <div class="clearfix">
                                                        <div class="col-sm-4 col-lg-4 padding-10">
                                                            <section>
                                                                <label class="label">Day From</label>
                                                                <label class="select">
                                                                    <select name="day_from">
                                                                        <?php
                                                                        foreach ($weekdays as $key => $value) {
                                                                            $sel = (isset($EDIT_DATA->day_from) && $EDIT_DATA->day_from == $key) ? "selected" : "";
                                                                            ?>
                                                                            <option value="<?php echo $key ?>" <?= $sel; ?>><?php echo $value; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </label>
                                                            </section>

                                                        </div>
                                                        <div class="col-sm-4 col-lg-4 padding-10">
                                                            <section>
                                                                <label class="label">Day To</label>
                                                                <label class="select">
                                                                    <select name="day_to">
                                                                        <?php
                                                                        foreach ($weekdays as $key => $value) {
                                                                            $sel = (isset($EDIT_DATA->day_to) && $EDIT_DATA->day_to == $key) ? "selected" : "";
                                                                            ?>
                                                                            <option value="<?php echo $key ?>" <?= $sel; ?>><?php echo $value; ?></option>
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
                                                                <label>Time From:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_winter_from" type="text" placeholder="Select time" name="time_winter_from" value="<?php echo!empty($EDIT_DATA->time_winter_from) ? $EDIT_DATA->time_winter_from : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label>Time To:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_winter_to" type="text" placeholder="Select time" name="time_winter_to" value="<?php echo!empty($EDIT_DATA->time_winter_to) ? $EDIT_DATA->time_winter_to : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                        </div>

                                                    </section>

                                                    <h3>Summer Timings</h3>

                                                    <section>

                                                        <div class="clearfix">
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label>Time From:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_to" type="text" placeholder="Select time" name="time_summer_from" value="<?php echo!empty($EDIT_DATA->time_summer_from) ? $EDIT_DATA->time_summer_from : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label>Time To:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_from" type="text" placeholder="Select time" name="time_summer_to" value="<?php echo!empty($EDIT_DATA->time_summer_to) ? $EDIT_DATA->time_summer_to : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                        </div>

                                                    </section> 

                                                    <div class="col-sm-4 col-lg-4">
                                                        <section>
                                                            <label class="label">Closed On</label>
                                                            <label class="select">
                                                                <select name="closed_day">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    foreach ($weekdays as $key => $value) {
                                                                        $sel = (isset($EDIT_DATA->closed_day) && $EDIT_DATA->closed_day == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?php echo $key ?>" <?= $sel; ?>><?php echo $value; ?></option>
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

                                        <?php
                                        if (!empty($EDIT_DATA->images) && is_array($EDIT_DATA->images)) {
                                            $imagesArray = $EDIT_DATA->images;
                                            for ($i = 0; $i < count($imagesArray); $i++) {
                                                $image_full_src = FCPATH . 'images/attraction/' . $imagesArray[$i]->image;

                                                if (!empty($imagesArray[$i]->image) && file_exists($image_full_src)) {
                                                    $relative_path = base_url() . 'images/attraction/' . $imagesArray[$i]->image;
                                                    $imageSrc = $relative_path;
                                                } else {
                                                    $default_image = base_url() . 'tour_image/no-preview.png';
                                                    $imageSrc = $default_image;
                                                }
                                                ?>

                                                <div class="imgae-container">
                                                    <div class="col-lg-8 add_more_content">
                                                        <section>
                                                           
                                                            <div class="attract-img">
                                                                <img src="<?php echo $imageSrc; ?>" alt="image" width="50px;" height="50px;"/>
                                                            </div>
                                                        </section>
                                                        <a title="Remove fields row" class="remove_link" href="javascript:void(0);"><img src="http://192.168.1.22/travel_trip/assets/admin/img/remove.png"></a>
                                                    </div>
                                                </div>

                                                <?php
                                            }
                                        }
                                        ?>


                                        <div class="city_wrapper">
                                            <div class="col-lg-8 add_more_content">
                                                <section>
                                                    <label class="label">Attraction Image</label>
                                                    <div class="input input-file">
                                                        <span class="button">
                                                            <input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files">
                                                        <p>Image Size 300x300 type-|JPEG|JPG|PNG</p>
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
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

            var baseUrl = "<?php echo base_url(); ?>";
            $(document).ready(function () {
                
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

                $('.remov_img').on('click', function (e) { //Once add more contact button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove();
                });

                $('.city_wrapper').on('click', '.remove_link', function (e) {
                    e.preventDefault();
                    var ParentDiv = $(this).parent().parent().parent();
                    ParentDiv.remove();

                });

                $('.imgae-container').on('click', '.remove_link', function (e) {
                    e.preventDefault();
                    var ParentDiv = $(this).parent().parent();
                    ParentDiv.remove();

                });

                $('.add_more_image').on('click', function (e) { //Once add more contact button is clicked
                    e.preventDefault();
                    var fieldHTML = getNextimageRow(baseUrl);
                    $('.city_wrapper').append(fieldHTML);
                });


                function getNextimageRow(baseUrl)
                {
                    var fieldHTML = '<div class="add_more_content"><div class="col-lg-8"><section><label class="label">Attraction Image</label><div class="input input-file"><span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files"></div><a href="javascript:void(0);" class="remove_link" title="Remove fields row"><img src="' + baseUrl + 'assets/admin/img/remove.png"/></a></div></div></section>';
                    return fieldHTML;
                }


                $('#time_to').timepicker();
                $('#time_from').timepicker();
                $('#time_winter_from').timepicker();
                $('#time_winter_to').timepicker();

            });

</script>




