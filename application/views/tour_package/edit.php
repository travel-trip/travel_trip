<script src="<?php echo base_url(); ?>assets/admin/js/plugin/clockpicker/clockpicker.min.js"></script> 
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script> 
<?php
//dump($edit_data);die;
?>
<div id="main" role="main">

    <?php
    $count = '';
    $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <div class="m-b-10">
            <div class="pull-left">
                <h3 class="pull-left">
                    <strong>Update Package</strong>
                </h3>
            </div>
        </div>
        <?php // dump($edit_data);?>
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
                                        Other Info
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab4" data-original-title="" title="" aria-expanded="false">
                                        Tour Itinerary
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                        Images
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <form class="smart-form" id="package-form"  method="post" data-parsley-validate="" enctype="multipart/form-data" action="<?php echo base_url('package/edit_package') ?>/<?php echo!empty($edit_data->id) ? $edit_data->id : NULL ?>">
                            <div class="tab-content padding-10">

                                <div id="tab1" class="tab-pane active">
                                    <div class="row">

                                        <div class="col-lg-6 col-sm-6">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <fieldset>
                                                    <?php // dump($attraction_category);?>

                                                    <section>
                                                        <label class="label">Tour Types(Theme)</label>
                                                        <label class="select">
                                                            <select name="tour_type_id" class="input-sm">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($tour_types as $value) {
                                                                    $sel = (isset($edit_data->tour_type_id) && $edit_data->tour_type_id == $value->id) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?php echo $value->id ?>" <?= $sel ?>><?php echo $value->name; ?></option>
                                                                <?php } ?>  
                                                            </select>																	
                                                            <i></i> 
                                                        </label>
                                                    </section>



                                                    <section>
                                                        <label class="label">Name</label>
                                                        <label class="input"> 
                                                            <i class="icon-append fa fa-gift"></i>
                                                            <input type="text" placeholder="Name" name="name" required="" value="<?php echo!empty($edit_data->name) ? $edit_data->name : null; ?>">
                                                        </label>
                                                    </section>

                                                    <label class="label">Banner Image</label>
                                                    <label class="input input-file"><span class="button">
                                                            <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="banner_image">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                                        <p>Image Size should be 800*800</p>
                                                    </label>

                                                    <label class="label">Primary Image</label>
                                                    <label class="input input-file"><span class="button">
                                                            <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="primary_image">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                                        <p>Image Size should be 800*800</p>
                                                    </label>


                                                    <?php $countries = getCountries(); ?>

                                                    <section>
                                                        <label class="label">Country</label>
                                                        <label class="select">
                                                            <select name="country_id" id="country_id">
                                                                <option value="">Select County</option>
                                                                <?php
                                                                foreach ($countries as $key => $country) {
                                                                    $sel = (isset($edit_data->country_id) && $edit_data->country_id == $key) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?= $key; ?>" <?= $sel ?>><?= !empty($country) ? $country : NULL; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </label>
                                                    </section>

                                                    <?php $loction = getLoction(); ?>

                                                    <section>
                                                        <label class="label">Covered Location/City</label>
                                                        <select name="covered_loction[]" class="form-control select2-select" multiple data-placeholder="Select Location" id="covered_loction">
                                                            <?php
                                                            if (!empty($loction)) {
                                                                foreach ($loction as $value) {
                                                                    $locArray = $edit_data->covered_loction;
//                                                                    dump($locArray);die;
                                                                    ?>
                                                                    <option value="<?php echo $value->id ?>" <?php
                                                                    for ($i = 0; $i < count($locArray); $i++) {
                                                                        echo ($locArray[$i]->id == $value->id) ? 'selected' : '';
                                                                    }
                                                                    ?> ><?php echo $value->loction; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>

                                                    </section>


                                                    <div class="row">

                                                        <div class="col-lg-4 padding-10">
                                                            <section>
                                                                <label class="label">Price</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Price" name="package_price" value="<?php echo!empty($edit_data->package_price) ? $edit_data->package_price : null; ?>" required=""  data-parsley-type = "number"> 
                                                                </label>
                                                            </section>
                                                        </div>

                                                        <?php $currencies = $this->config->item('currency'); ?>
                                                        <div class="col-lg-4 padding-10">
                                                            <section>
                                                                <label class="label">Currency</label>
                                                                <label class="select">
                                                                    <select name="currency">
                                                                        <option value="">Select County</option>
                                                                        <?php
                                                                        foreach ($currencies as $key => $currency) {
                                                                            $sel = (isset($edit_data->currency) && $edit_data->currency == $key) ? "selected" : "";
                                                                            ?>
                                                                            <option value="<?= $key; ?>" <?= $sel ?>><?= !empty($currency) ? $currency : NULL; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </label>
                                                            </section>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <h5>Pricing With Hotels</h5>
                                                        <?php $hotel_type = $this->config->item('hotel_type'); ?>
                                                        <div class="price_wrapper">
                                                            <?php
                                                            if (!empty($edit_data->hotel_pricing)) {
                                                                $price_count = 0;
                                                                $len = count($edit_data->hotel_pricing);
                                                                foreach ($edit_data->hotel_pricing as $hotel_pricing) {
                                                                    ?>
                                                                    <div class="add-hotel-price">
                                                                        <div class="col-lg-4 padding-10">
                                                                            <section>
                                                                                <label class="label">Hotel</label>
                                                                                <label class="select">
                                                                                    <select name="hotel_type[]">
                                                                                        <option value="">Select Hotel Type</option>
                                                                                        <?php
                                                                                        foreach ($hotel_type as $key => $val) {
                                                                                            $sel = (isset($hotel_pricing->hotel_type) && $hotel_pricing->hotel_type == $key) ? "selected" : "";
                                                                                            ?>
                                                                                            <option value="<?= $key; ?>" <?= $sel ?>><?= !empty($val) ? $val : NULL; ?></option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </label>
                                                                            </section>
                                                                        </div>

                                                                        <div class="col-lg-4 padding-10">
                                                                            <section>
                                                                                <label class="label">Price</label>
                                                                                <label class="input">
                                                                                    <input type="text" placeholder="Price" name="hotel_price[]" required="" value="<?php echo $hotel_pricing->price; ?>"  data-parsley-type = "number"> 
                                                                                </label>
                                                                            </section>
                                                                        </div>
                                                                        <?php if (!($price_count == $len - 1)) { ?>
                                                                            <a class="remove_hotel_price" href="javascript:void(0)"><img src = "<?php echo base_url('assets/admin/img/minus.png'); ?>" alt = "remove"/></a>
                                                                        <?php } ?>
                                                                    </div>


                                                                    <?php
                                                                    $price_count++;
                                                                }
                                                            }
                                                            ?>
                                                            <a href="javascript:void(0)" class="add_more_price"><img src="<?php echo base_url('assets/admin/img/plus.png'); ?>"/></a>
                                                        </div>

                                                    </div>

                                                    <section>
                                                        <label class="label">Short description</label>
                                                        <label class="textarea"> 										
                                                            <textarea class="custom-scroll" name="short_desc" rows="3"><?php echo!empty($edit_data->short_desc) ? $edit_data->short_desc : null; ?></textarea> 
                                                        </label>
                                                    </section>


                                                </fieldset>
                                            </article>
                                        </div>


                                        <div class="col-sm-6 col-lg-6">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <fieldset>
                                                    <section>
                                                        <label class="label">Description</label>
                                                        <label class="textarea"> 										
                                                            <textarea name="desc">
                                                                <?php echo!empty($edit_data->desc) ? $edit_data->desc : null; ?>
                                                            </textarea>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Weightage</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Weightage" name="weightage" required=""  data-parsley-type = "number" value="<?php echo!empty($edit_data->weightage) ? $edit_data->weightage : null; ?>"> 
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Country Weightage</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Country Weightage" name="counry_weightage" required=""  data-parsley-type = "number" value="<?php echo!empty($edit_data->counry_weightage) ? $edit_data->counry_weightage : null; ?>"> 
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="checkbox">
                                                            <input type="checkbox"  name="show_home" value="1" <?php echo!empty($edit_data->show_home) ? 'checked' : '' ?>>
                                                            <i></i>Show Home
                                                        </label>
                                                    </section>



                                                </fieldset>
                                            </article>
                                        </div>

                                    </div>

                                </div>

                                <div id="tab2" class="tab-pane">
                                    <div class="row">
                                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                            <div class="col-lg-6 col-sm-6">
                                                <fieldset>
                                                    <?php
                                                    $travelling_rating = $this->config->item('travelling_rating');
                                                    $rating = $this->config->item('rating');
                                                    ?>

                                                    <section>
                                                        <label class="label">Traveling Rating</label>
                                                        <label class="select">
                                                            <select name="traveller_rating" class="input-sm">
                                                                <option value="">Select</option>
                                                                <?php
                                                                foreach ($travelling_rating as $key => $value) {
                                                                    $sel = (isset($edit_data->traveller_rating) && $edit_data->traveller_rating == $key) ? "selected" : "";
                                                                    ?>
                                                                    <option value="<?php echo $key ?>" <?= $sel ?>><?php echo $value ?></option>
                                                                <?php } ?>  
                                                            </select>																	
                                                            <i></i> 
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Tour Highlights</label>
                                                        <label class="textarea"> 										
                                                            <textarea name ="tour_highlightes">
                                                                <?php echo!empty($edit_data->tour_highlightes) ? $edit_data->tour_highlightes : null; ?>
                                                            </textarea>
                                                        </label>
                                                    </section>

                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-sm-6">
                                                <fieldset>
                                                    <?php
                                                    $activities = getActivities();
                                                    ?>

                                                    <section>
                                                        <label class="label">Tour Activities</label>
                                                        <select name="activity_id[]" class="form-control select2-select" multiple data-placeholder="Select Activities" id="activity">
                                                            <?php
                                                            if (!empty($activities)) {

                                                                foreach ($activities as $value) {
                                                                    $activityArray = $edit_data->tour_activities;
                                                                    ?>
                                                                    <option value="<?php echo $value->id ?>" <?php
                                                                    for ($i = 0; $i < count($activityArray); $i++) {
                                                                        echo ($activityArray[$i]->id == $value->id) ? 'selected' : '';
                                                                    }
                                                                    ?> ><?php echo $value->name; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>

                                                    </section>

                                                    <section>
                                                        <label class="label">Included</label>
                                                        <label class="textarea"> 										
                                                            <textarea name ="included">
                                                                <?php echo!empty($edit_data->included) ? $edit_data->included : null; ?>
                                                            </textarea>
                                                        </label>
                                                    </section>

                                                    <section>
                                                        <label class="label">Excluded</label>
                                                        <label class="textarea"> 										
                                                            <textarea name ="exluded">
                                                                <?php echo!empty($edit_data->exluded) ? $edit_data->exluded : null; ?>
                                                            </textarea>
                                                        </label>
                                                    </section>


                                                    <section>
                                                        <label class="label">Tag Line</label>
                                                        <label class="input">
                                                            <input type="text" placeholder="Tag Line" name="tour_punch_line" value="<?php echo!empty($edit_data->tour_punch_line) ? $edit_data->tour_punch_line : null; ?>"> 
                                                        </label>
                                                    </section>


                                                </fieldset>
                                            </div>
                                        </article>
                                    </div>
                                </div>

                                <div id="tab3" class="tab-pane">
                                    <div class="row">
                                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                            <div class="dropzone" id="package-image"></div>

                                        </article>
                                    </div>
                                </div>

                                <div id="tab4" class="tab-pane">

                                    <div class="row itinery_field_wrapper">
                                        <a href="javascript:void(0)" class="add_more_itinery">Add</a>
                                        <div class="col-lg-3 padding-10">
                                            <section>
                                                <label class="label">Day</label>
                                                <label class="input"> 
                                                    <input type="text" placeholder="Name" name="day" required="" value="<?php echo!empty($edit_data->day) ? $edit_data->day : null; ?>">
                                                </label>
                                            </section>
                                        </div>

                                        <div class="col-lg-3 padding-10">
                                            <section>
                                                <label class="label">Night</label>
                                                <label class="input"> 
                                                    <input type="text" placeholder="Name" name="night" required="" value="<?php echo!empty($edit_data->night) ? $edit_data->night : null; ?>">
                                                </label>
                                            </section>
                                        </div>

                                    </div>
                                    <div class="itinery_wrapper">

                                        <?php
                                        if (!empty($edit_data->tour_itinerary) && count($edit_data->tour_itinerary) > 0) {
                                            $count = 0;
                                            foreach ($edit_data->tour_itinerary as $tour_itinerary) {
                                                ?>
                                                <div class="add_iteinary">
                                                    <a href="javascript:void(0)" class="remove_itinerary"><img src="<?php echo base_url() ?>assets/admin/img/remove.png"></a>
                                                    <div class="row">
                                                        <div class="col-lg-2 padding-10">
                                                            <section>
                                                                <label class="label">Day Title</label>
                                                                <label class="input"> 
                                                                    <input type="text" placeholder="Name" name="day_title[<?php echo $count ?>]" required="" value="<?php echo!empty($tour_itinerary->day_title) ? $tour_itinerary->day_title : '' ?>">
                                                                </label>
                                                            </section> 
                                                        </div>
                                                        <div class="col-lg-2 padding-10">
                                                            <section>
                                                                <label class="input"> 
                                                                    <label class="label">Location</label>
                                                                    <input type="text" placeholder="Loction" name="loction[<?php echo $count ?>]" required="" value="<?php echo!empty($tour_itinerary->loction) ? $tour_itinerary->loction : '' ?>">
                                                                </label>
                                                            </section> 
                                                        </div>

                                                        <div class="col-lg-2 padding-10">
                                                            <section>
                                                                <label class="label">Activities</label>
                                                                <select name="itinery_activities[<?php echo $count; ?>][]" class="form-control select2-select iteinary_activiy" multiple data-placeholder="Select Activities">
                                                                    <option value="">Select</option>
                                                                    <?php
                                                                    foreach ($activities as $value) {
                                                                        ?>
                                                                        <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                                                                    <?php } ?>  
                                                                </select>

                                                            </section>
                                                        </div>

                                                        <?php $meal = $this->config->item('meal'); ?> 
                                                        <div class="col-sm-3">
                                                            <section>
                                                                <div class="inline-group">
                                                                    <?php
                                                                    if (!empty($meal)) {
                                                                        foreach ($meal as $key => $value) {
                                                                            ?>
                                                                            <label class="checkbox ">
                                                                                <input type="checkbox" value="<?= $key ?>" name="food[<?php echo $count; ?>][]"><i></i><?= $value ?>	
                                                                            </label>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </section>
                                                        </div>

                                                        <div class="col-sm-2 padding-10">
                                                            <section>
                                                                <label class="label">Transport</label>
                                                                <label class="select">
                                                                    <select name="transport[<?php echo $count ?>]">
                                                                        <option value="">Select</option>
                                                                        <option value="Provided" <?php echo $tour_itinerary->transport == 'Provided' ? 'selected' : ''; ?> >Provided</option>
                                                                        <option value="Not Provided" <?php echo $tour_itinerary->transport == 'Not Provided' ? 'selected' : ''; ?>>Not Provided</option>
                                                                    </select>
                                                                </label>    
                                                            </section>
                                                        </div>
                                                    </div>

                                                    <div class="row">

                                                        <div class="col-lg-3">
                                                            <section>
                                                                <label>Description</label>
                                                                <label class="textarea"> 										
                                                                    <textarea name ="itinery_desc[<?php echo $count ?>]" id=""><?php echo!empty($tour_itinerary->itinery_desc) ? $tour_itinerary->itinery_desc : '' ?></textarea>
                                                                </label>
                                                            </section>
                                                        </div>

                                                        <div class="col-sm-6 padding-10">
                                                            <section>
                                                                <div class="inline-group">
                                                                    <label class="radio ">
                                                                        <input type="radio" value="StayHotel" data-check-id="transport<?= $count; ?>"  name="night_plan_same_day[<?php echo $count; ?>]" <?php echo!empty($tour_itinerary->night_plan_same_day && $tour_itinerary->night_plan_same_day == 'StayHotel') ? 'checked' : '' ?> class ="<?php echo ($count == 0) ? 'night_plan' : 'inner_night_plan2' ?>"><i></i>Stay Hotel(Same Place)
                                                                    </label>
                                                                    <label class="radio ">
                                                                        <input type="radio" value="Travelling" data-check-id="transport<?= $count; ?>" name="night_plan_same_day[<?php echo $count; ?>]" <?php echo!empty($tour_itinerary->night_plan_same_day && $tour_itinerary->night_plan_same_day == 'Travelling') ? 'checked' : '' ?> class ="<?php echo ($count == 0) ? 'night_plan' : 'inner_night_plan2' ?>"><i></i>Travelling(Transfer Next City)
                                                                    </label>	

                                                                </div>
                                                            </section>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <section style="display: <?php echo!empty($tour_itinerary->next_day_stay_hotel) ? 'block' : 'none' ?>" id="<?php echo ($count == 0 ) ? 'transport' : 'transport' . $count ?>">
                                                                <div class="">
                                                                    <label class="checkbox ">
                                                                        <input type="checkbox" id="check<?= $count ?>" value="1" <?php echo!empty($tour_itinerary->next_day_stay_hotel) ? 'checked' : 'none' ?> name="next_day_stay_hotel[<?php echo $count; ?>]"><i></i>Stay Hotel	
                                                                    </label>
                                                                </div>
                                                            </section>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <label class="label">Image</label>
                                                            <label class="input input-file"><span class="button">
                                                                    <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="iteniry_image[<?php echo $count ?>]">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                                                <p>Image Size should be 400*400</p>
                                                            </label>
                                                        </div>

                                                        <div class="col-lg-3">
                                                            <section>
                                                                <div class="inline-group">
                                                                    <label class="checkbox ">
                                                                        <input type="checkbox" value = 1 name="sightseeing[<?php echo $count ?>]" <?php echo!empty($tour_itinerary->sightseeing) ? 'checked' : 'none' ?>><i></i>Sightseeing	
                                                                    </label>
                                                                </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                $count++;
                                            }
                                        }
                                        ?>

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
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/dropzone/dropzone.min.js"></script> 

<script type="text/javascript">

var image_url = "<?php echo base_url('package/add_multiple_image'); ?>";

var baseUrl = "<?php echo base_url(); ?>";

$(document).ready(function () {

    Dropzone.autoDiscover = false;

    $("#package-image").dropzone({
        url: image_url,
        addRemoveLinks: true,
        removedfile: function (file) {
            var name = file.name;
            var imgArr = name.split('.');
            var imagName = imgArr[0]

            $.ajax({
                type: 'POST',
                url: baseUrl + 'AjaxController/delete_tour_images',
                data: {'name': name},
                dataType: 'html',
                success: function (res) {
                    console.log(res);
                    if (res) {
                        $('#' + imagName).remove();

                    } else {
                        return '';
                    }
                }
            });

            //remove image div element

            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
        },
        maxFilesize: 1.0,
        dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
        dictResponseError: 'Error uploading file!',
        uploadMultiple: true,
        init: function () {
            this.on('success', function (file) {
                var fileName = file.name;
                var arr = fileName.split('.');
                var img = arr[0]
                $("#package-form").append($('<input type="hidden" ' +
                        'name="package_image[]"' + 'id = "' + img + '"' +
                        'value="' + fileName + '">'));
            }),
                    this.on('queuecomplete', function () {

                    });
        }
    });


    /***********CK Editor Initilization******/


    CKEDITOR.replace('desc',
            {
                toolbar:
                        [
                            {name: 'basicstyles', items: ['Bold', 'Italic']},
                            {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                            {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
                            '/',
                            {name: 'styles', items: ['Styles', 'Format']}
                        ]
            });

    CKEDITOR.replace('tour_highlightes',
            {
                toolbar:
                        [
                            {name: 'basicstyles', items: ['Bold', 'Italic']},
                            {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                            {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
                            '/',
                            {name: 'styles', items: ['Styles', 'Format']}
                        ]
            });

    CKEDITOR.replace('included',
            {
                toolbar:
                        [
                            {name: 'basicstyles', items: ['Bold', 'Italic']},
                            {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                            {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
                            '/',
                            {name: 'styles', items: ['Styles', 'Format']}
                        ]
            });

    CKEDITOR.replace('exluded',
            {
                toolbar:
                        [
                            {name: 'basicstyles', items: ['Bold', 'Italic']},
                            {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                            {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', '-', 'Undo', 'Redo']},
                            {name: 'insert', items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']},
                            '/',
                            {name: 'styles', items: ['Styles', 'Format']}
                        ]
            });

    $("#activity").select2();

    $(".iteinary_activiy").select2();


    $("#covered_loction").select2();

    $("#departure-date").datepicker();


    $('.itinery_wrapper').on('change', '.night_plan', function () {

        if (this.value == 'Travelling') {
            $('#transport').show();
        } else {
            $('#transport').hide();
        }

    });

    var ccn = <?php echo $count; ?> //Initial field counter
//        var day_night_count = 0 //Initial field counter

    $('.itinery_field_wrapper').on('click', '.add_more_itinery', function (e) { //Once add more contact button is clicked            
        e.preventDefault();
        getNextItinery(ccn, baseUrl); // add using ajax  
        ccn++; //Increment field counter
    });

    $('.itinery_wrapper').on('click', '.remove_itinerary', function (e) { //Once add more contact button is clicked            
        e.preventDefault();
        $(this).parent().remove();
        ccn--;
    });

    $('.price_wrapper').on('click', '.add_more_price', function (e) { //Once add more contact button is clicked            
        e.preventDefault();
        ccn++; //Increment field counter
        getNextPrice(baseUrl); // add using ajax  
    });


    $('.price_wrapper').on('click', '.remove_hotel_price', function (e) { //Once add more contact button is clicked            
        e.preventDefault();
        $(this).parent('div').remove();
    });

    $('.itinery_wrapper').on('click', '.inner_night_plan2', function () {

        var value = $(this).val();
        var id = $(this).attr('data-check-id');
        if (value === 'Travelling') {
            $('#' + id).show();
        } else {
            $('#' + id).hide();
        }
    });
});


function getNextItinery(n, baseUrl)
{
    /* get new contact row using ajax */
    jQuery.ajax({
        type: "POST",
        url: baseUrl + "AjaxController/getTourItineryRow",
        data: {row_num: n},
        success: function (res) {
//                    console.log(res);
            if (res) {
                $('.itinery_wrapper').append(res);
                $('#abc' + n).select2();
            } else {
                return '';
            }
        }

    });
}


//        function showNightPlan(row_number,value){
//             if (value == 'Travelling') {
//                    $('#transport'+row_number).show();
//                }else{
//                    $('#transport'+row_number).hide();
//                }
//            
//        }

function getNextPrice(baseUrl) {
    {
        /* get new contact row using ajax */
        jQuery.ajax({
            type: "POST",
            data: {base_url: baseUrl},
            url: baseUrl + "AjaxController/getHotePriceRow",
            success: function (res) {
                if (res) {
                    $('.price_wrapper').append(res);
                } else {
                    return '';
                }
            }

        });
    }
}

</script>




