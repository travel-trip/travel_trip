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
                                                            <select name="country_id" id="country_id" type = "country">
                                                                <option value="">Select County</option>
                                                                <?php
                                                                if (!empty($countries)) {
                                                                    foreach ($countries as $key => $country) {
                                                                        $sel = (isset($EDIT_DATA->country_id) && $EDIT_DATA->country_id == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?= $key; ?>" <?= $sel ?>><?= !empty($country) ? $country : NULL; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </label>
                                                    </section>

                                                    <?php $parent_loction = getLoction($EDIT_DATA->country_id,'country'); ?>
                                                    <div id="country_location">
                                                        <section>
                                                            <label class="label">Location</label>
                                                            <label class="select">
                                                                <select name="location_id" class="" id="location_id" type = "location">
                                                                    <?php
                                                                    foreach ($parent_loction as $key => $value) {
                                                                        $sel = (isset($EDIT_DATA->loction_id) && $EDIT_DATA->loction_id == $value->id) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?php echo $value->id ?>" <?= $sel ?>><?php echo $value->loction ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </label>
                                                        </section>
                                                    </div>

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
                                                        <label class="label"><strong>Thing To Do</strong></label>
                                                        <label class="textarea"> 										
                                                            <textarea name="things_to_do" rows="5"><?php echo!empty($EDIT_DATA->things_to_do) ? $EDIT_DATA->things_to_do : '' ?></textarea> 
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
                                                        <div class="inline-group">
                                                            <label class="checkbox ">
                                                                <input type="checkbox" value = 1 <?php echo!empty($EDIT_DATA->show_home) ? 'checked' : '' ?> name="show_home"><i></i><strong>Show Home</strong>
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
                                                            <textarea class="custom-scroll" name="discription" rows="5"><?php echo !empty($EDIT_DATA->discription) ? $EDIT_DATA->discription : '' ?></textarea> 
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
                                                                <?php
                                                                foreach ($currencies as $key => $currency) {
                                                                    $sel = (isset($EDIT_DATA->currency) && $EDIT_DATA->currency == $key) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?= $key; ?>" <?= $sel; ?>><?= !empty($currency) ? $currency : NULL; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </label>
                                                    </section>
                                                    
                                                    <div class="row">
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                        <label class="label">Cost(National-Adult)</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Cost(National)" name="nationl_fee_charge" value="<?php echo !empty($EDIT_DATA->nationl_fee_charge) ? $EDIT_DATA->nationl_fee_charge : '' ?>"> 
                                                        </label>
                                                    </section>
                                                    </div>
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(Kid)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(International)" value="<?php echo!empty($EDIT_DATA->nationl_fee_charge_kid) ? $EDIT_DATA->nationl_fee_charge_kid : '' ?>" name="nationl_fee_charge_kid"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                </div>
                                                    
                                                    <div class="row">
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                        <label class="label">Cost(International-Adult)</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Cost(International-Adult)" name="international_fee_charge"  value="<?php echo !empty($EDIT_DATA->international_fee_charge) ? $EDIT_DATA->international_fee_charge : '' ?>"> 
                                                        </label>
                                                    </section>
                                                    </div>
                                                    <div class="col-lg-3 padding-10 custom-width">
                                                        <section>
                                                            <label class="label"><strong>Cost(Kid)</strong></label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Cost(International -Kid)" name="international_fee_charge_kid" value="<?php echo !empty($EDIT_DATA->international_fee_charge_kid) ? $EDIT_DATA->international_fee_charge_kid : '' ?>"> 
                                                            </label>
                                                        </section>
                                                    </div>
                                                    
                                                </div>
                                                    
                                                    <section>
                                                        <div class="">
                                                            <label class="checkbox ">
                                                                <input type="checkbox" value = 1 <?php echo!empty($EDIT_DATA->cost_varying) ? 'checked' : '' ?> name="cost_varying" ><i></i><strong>Staring Cost</strong>
                                                            </label>
                                                        </div>
                                                    </section>


                                            </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <fieldset>
                                                        <div class="row">
                                                    <?php $weekdays = $this->config->item('weekdays'); ?>
                                                    <div class="clearfix">
                                                        <div class="col-sm-5 col-lg-5 padding-10">
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
                                                        <div class="col-sm-5 col-lg-5 padding-10">
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
                                                    </div>

                                                    <h3>Winter Timings</h3>
                                                    
                                                    <section>

                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 <?php echo !empty($EDIT_DATA->winter_open_time) ? 'checked' : '' ?> name="winter_open_time" id="winter_open_time" flag = "winter" ><i></i><strong>24*7 Open</strong>
                                                        </label>
                                                    </section>
                                                    <div class="row">
                                                        <section>

                                                            <div class="clearfix">
                                                                <div class="col-sm-4 col-lg-4 padding-10">
                                                                    <label>Time From:</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control" id="time_winter_from" type="text" <?php echo !empty($EDIT_DATA->time_winter_from) ? '' : 'disabled' ?> placeholder="Select time" name="time_winter_from" value="<?php echo !empty($EDIT_DATA->time_winter_from) ? $EDIT_DATA->time_winter_from : '' ?>">
                                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>  
                                                                </div>

                                                                <div class="col-sm-4 col-lg-4 padding-10">
                                                                    <label>Time To:</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control" id="time_winter_to" type="text" placeholder="Select time" name="time_winter_to" <?php echo !empty($EDIT_DATA->time_winter_to) ? '' : 'disabled' ?> value="<?php echo !empty($EDIT_DATA->time_winter_to) ? $EDIT_DATA->time_winter_to : '' ?>">
                                                                        <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                    </div>  
                                                                </div>

                                                            </div>

                                                        </section>
                                                    </div>
                                                    <div class="row">
                                                    <h3>Summer Timings</h3>
                                                    
                                                    <section>
                                                        <label class="checkbox ">
                                                            <input type="checkbox" value = 1 <?php echo!empty($EDIT_DATA->summer_open_time) ? 'checked' : '' ?> name="summer_open_time" id="summer_open_time" flag = "summer" ><i></i><strong>24*7 Open</strong>
                                                        </label>
                                                    </section>

                                                    <section>

                                                        <div class="clearfix">
                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label>Time From:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_to" type="text" placeholder="Select time" name="time_summer_from" <?php echo !empty($EDIT_DATA->time_summer_from) ? '' : 'disabled' ?> value="<?php echo !empty($EDIT_DATA->time_summer_from) ? $EDIT_DATA->time_summer_from : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                            <div class="col-sm-4 col-lg-4 padding-10">
                                                                <label>Time To:</label>
                                                                <div class="input-group">
                                                                    <input class="form-control" id="time_from" type="text" placeholder="Select time" name="time_summer_to" <?php echo !empty($EDIT_DATA->time_summer_to) ? '' : 'disabled' ?> value="<?php echo!empty($EDIT_DATA->time_summer_to) ? $EDIT_DATA->time_summer_to : '' ?>">
                                                                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                                                                </div>  
                                                            </div>

                                                        </div>

                                                    </section> 
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="col-sm-3 col-lg-3 padding-10">
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
                                            $img_name = '';
                                            $imageSrc = '';
                                            $imagesArray = $EDIT_DATA->images;
                                            for ($i = 0; $i < count($imagesArray); $i++) {
                                                $image_full_src = FCPATH . 'images/attraction/' . $imagesArray[$i]->image;

                                                if (!empty($imagesArray[$i]->image) && file_exists($image_full_src)) {
                                                    $relative_path = base_url() . 'images/attraction/' . $imagesArray[$i]->image;
                                                    $imageSrc = $relative_path;
                                                    $img_name = $imagesArray[$i]->image;
                                                }else{
                                                    $imageSrc = null;
                                                }
                                                ?>

                                                <div class="imgae-container">
                                                    <?php if ($imageSrc) { ?>
                                                        <div class="col-lg-8 add_more_content">
                                                            <section>
                                                                <div class="attract-img">
                                                                    <img src="<?php echo $imageSrc; ?>" alt="image" width="50px;" height="50px;" id="attraction-img"/>
                                                                </div>
                                                            </section>
                                                            <a title="Remove fields row" class="remove_link" name = "<?php echo $img_name ?>" href="javascript:void(0);"><img src="http://192.168.1.22/travel_trip/assets/admin/img/remove.png"></a>
                                                        </div>
                                                    <?php } ?>
                                                    
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
                                        $text = '';
                                        $gettingThere = $this->config->item('getting_by_there');
                                        if (!empty($gettingThere)) {
                                            foreach ($gettingThere as $key => $value) {
                                                switch ($key) {
                                                    case 'getting_by_rail':
                                                        $text = $EDIT_DATA->getting_by_rail;
                                                        break;
                                                    case 'getting_by_air':
                                                        $text = $EDIT_DATA->getting_by_air;
                                                        break;
                                                    case 'getting_by_road':
                                                        $text = $EDIT_DATA->getting_by_road;
                                                        break;
                                                    case 'local_transportation':
                                                        $text = $EDIT_DATA->local_transportation;
                                                        break;

                                                    default:
                                                        $text = '';
                                                        break;
                                                }
                                                ?>
                                                <section>
                                                    <label class="label"><strong><?= $value; ?></strong></label>
                                                    <label class="textarea"> 										
                                                        <textarea rows="3" name="<?= $key ?>"><?php echo!empty($text) ? trim($text) : '' ?></textarea> 
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
                                        <a href="" class="add_more_history_row pull-right">Add</a>
                                        <div class="row">
                                            <div class="history-wrapper">
                                                <?php
                                                $count = 0;
                                                if (!empty($EDIT_DATA->history) && count($EDIT_DATA->history) > 0) {
                                                    foreach ($EDIT_DATA->history as $history) {
                                                        ?>
                                                        <div class="add_more_history">
                                                            <div class="col-lg-3 padding-10">
                                                                <section>
                                                                    <label class="label"><strong>Title</strong></label>
                                                                    <label class="input"> 
                                                                        <input type="text" name="history_title[<?php echo $count ?>]" placeholder="Title" value="<?php echo!empty($history->history_title) ? $history->history_title : null ?>">
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
                                                                        <textarea rows="3" name="history_desc[<?php echo $count ?>]"><?php echo!empty($history->history_desc) ? $history->history_desc : null ?></textarea> 
                                                                    </label>
                                                                </section>
                                                            </div>
                                                            <a title="Remove fields row" class="remove_history" href="javascript:void(0);"><img src="<?php echo base_url('assets/admin/img/remove.png'); ?>"></a>
                                                        </div>
                                                    <?php $count++; }
                                                } ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                
                                <div id="tab6" class="tab-pane">
                                    <?php
                                     $month = $this->config->item('month_list');
                                    if (!empty($best_time_visit) && is_array($best_time_visit)) {
                                        for ($i = 0; $i < count($best_time_visit); $i++) {
                                            ?>
                                            <div class="best_time_wrapper">
                                                <div class="add_more_content clearfix">
                                                    <div class="col-lg-2 padding-10">
                                                        <section>
                                                            <label class="label">Month from</label>
                                                            <label class="select">
                                                                <select name="best_time_from[]">
                                                                    <?php
                                                                    foreach ($month as $key => $value) {
                                                                        $from = (isset($best_time_visit[$i]->best_time_from) && $best_time_visit[$i]->best_time_from == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?php echo $key ?>" <?= $from; ?>><?php echo $value; ?></option>
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
                                                                    <?php
                                                                    foreach ($month as $key => $value) {
                                                                        $to = (isset($best_time_visit[$i]->best_time_to) && $best_time_visit[$i]->best_time_to == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?php echo $key ?>"<?= $to; ?>><?php echo $value; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </label>
                                                        </section>
                                                    </div>

                                                    <div class="col-lg-4 padding-10">
                                                        <section>
                                                            <label class="label">Short Description</label>
                                                            <label class="textarea"> 										
                                                                <textarea name="description[]" rows="2"><?php echo $best_time_visit[$i]->description; ?></textarea>
                                                            </label>
                                                        </section>
                                                    </div>
                                                    <a class="country-best-time" id="remove_row" href=""><img alt="remove" src="<?php echo base_url(); ?>/assets/admin/img/minus.png"></a>
                                                </div>

                                            </div>
                                            <?php
                                        }
                                    }
                                    ?>
                                    
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
            </section>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

    var baseUrl = "<?php echo base_url(); ?>";
    $(document).ready(function () {
        
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
                    toolbar:
                            [{name: 'basicstyles', items: ['Bold', 'Italic', 'Source']},{name: 'paragraph', items: ['NumberedList', 'BulletedList']},{name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},'/',{name: 'styles', items: ['Styles', 'Format']}]
                });
                
        CKEDITOR.replace('things_to_do');

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
            var name = $(this).attr('name');
            $.ajax({
                type: "POST",
                url: baseUrl+'AjaxController/delete_attraction_img',
                data: {name: name},
                beforeSend: function () {
                },
            }).done(function (res) {
                if(res){
                 ParentDiv.remove();    
                }
                
            });
            

        });

        var row_num = <?php echo $count;?>
        
        $('.add_more_history_row').on('click', function (e) {
            e.preventDefault();
            var fieldHTML = getNextHitoryRow(baseUrl,row_num);
            $('.history-wrapper').append(fieldHTML);
            row_num++;
        });

        $('.history-wrapper').on('click', '.remove_history', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent();
            ParentDiv.remove();

        });

        $('.add_more_image').on('click', function (e) { //Once add more contact button is clicked
            e.preventDefault();
            var fieldHTML = getNextimageRow(baseUrl);
            $('.city_wrapper').append(fieldHTML);
        });
        
        
        $('.best_time_wrapper').on('click', '#remove_row', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent('div').parent('div');
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
        
        


        function getNextimageRow(baseUrl)
        {
            var fieldHTML = '<div class="add_more_content"><div class="col-lg-8"><section><label class="label">Attraction Image</label><div class="input input-file"><span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="attraction_image[]" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files"></div><a href="javascript:void(0);" class="remove_link" title="Remove fields row"><img src="' + baseUrl + 'assets/admin/img/remove.png"/></a></div></div></section>';
            return fieldHTML;
        }
        
        function getNextHitoryRow(baseUrl,row_num){
            
               var fieldHTML = '<div class="add_more_history">';
                   fieldHTML += '<div class="col-lg-3 padding-10"><section><label class="label"><strong>Title</strong></label><label class="input"><input type="text" name="history_title['+row_num+']" placeholder="Title"></label></section></div>';
                   fieldHTML += '<div class="col-lg-4 padding-10"><section><label class="label"><strong>Image</strong></label><div class="input input-file"><span class="button"><input type="file" id="file" name="history_image[]" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly=""><p>Image Size 275x410 type-|JPEG|JPG|PNG</p></div></section></div>';
                   fieldHTML += '<div class="col-lg-4 "><section><label class="label"><strong>Description</strong></label><label class="textarea"><textarea rows="3" name="history_desc['+row_num+']" class=""></textarea></label></section></div>';
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


        $('#time_to').timepicker({
            defaultTime: false,
        });
        $('#time_from').timepicker({
            defaultTime: false,
        });
        $('#time_winter_from').timepicker({
            defaultTime: false,
        });
        $('#time_winter_to').timepicker({
            defaultTime: false,
        });
        

    });

</script>




