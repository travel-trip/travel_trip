
<div id="main" role="main">
    <?php
    $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
                <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data" action="<?php echo base_url('country/add/') ?><?php echo!empty($country_data->id) ? '/' . $country_data->id : null; ?>">
                    <div class="widget-body no-padding">
                        <div class="tabbable">
                            <ul class="nav nav-tabs bordered">
                                <li class="active">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="" aria-expanded="false">
                                        Basic Information
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="true">
                                        Visit Best time
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="" aria-expanded="true">
                                        FAQ
                                    </a>
                                </li>

                            </ul>
                            <div class="tab-content">
                            <div id="tab1" class="tab-pane active">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <fieldset>
                                            <section>
                                                <label class="label">Name</label>
                                                <label class="input"> 
                                                    <input type="text" placeholder="Country name" name="name" required="" value="<?php echo!empty($country_data->name) ? $country_data->name : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Code</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter country code" name="abbreviation" value="<?php echo!empty($country_data->abbreviation) ? $country_data->abbreviation : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">TimeZone</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter TimeZone" name="time_zone" value="<?php echo!empty($country_data->time_zone) ? $country_data->time_zone : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Tag Line</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Tag line" name="tag_line" value="<?php echo!empty($country_data->tag_line) ? $country_data->tag_line : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Banner Image</label>
                                                <div class="input input-file">
                                                    <span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="banner_image" id="file"/>Browse</span>
                                                    <input type="text" readonly="" placeholder="Include some files"/>
                                                    <p>Image size should be 1700*544</p>
                                                </div>
                                            </section>


                                            <section style="clear: both;">
                                                <label class="label">Travel Tips</label>
                                                <label class="textarea"> 										
                                                    <textarea name="travel_tips"><?php echo !empty($country_data->travel_tips) ? htmlentities($country_data->travel_tips) : null; ?></textarea> 
                                                </label>
                                            </section>
                                            
                                            <section>
                                                <label class="label">Electricity</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Electricity" name="electcity" value="<?php echo!empty($country_data->electcity) ? $country_data->electcity : null; ?>">
                                                    <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> 
                                                </label>
                                            </section>
                                            
                                            <section>
                                                <label class="label"></label>
                                            <label class="checkbox">
                                                <input type="checkbox"  name="is_featured" value="1" <?php echo!empty($country_data->is_featured) ? 'checked' : ''; ?>><i></i>Is featured
                                            </label>
                                        </section>

                                            
                                        </fieldset>
                                    </div>
                                    <fieldset>
                                    <div class="col-lg-12">
                                        
                                        <section>
                                                <label class="label">Description</label>
                                                <label class="textarea"> 										
                                                    <textarea name="country_desc"><?php echo!empty($country_data->description) ? $country_data->description : null; ?></textarea> 
                                                </label>
                                            </section>
                                            
                                        <section>
                                            <label class="label">Short Description</label>
                                            <label class="textarea"> 										
                                                <textarea class="" rows="2" name="short desc"><?php echo!empty($country_data->short_desc) ? $country_data->short_desc : null; ?></textarea> 
                                            </label>
                                        </section>
                                       
                                            <section>
                                                <label class="label">Language</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Language" name="language" required="" value="<?php echo!empty($country_data->language) ? $country_data->language : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Weightage</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Weightage" name="weightage" required="" data-parsley-type="number" value="<?php echo!empty($country_data->weightage) ? $country_data->weightage : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Population</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Population" name="population" required="" value="<?php echo!empty($country_data->population) ? $country_data->population : null; ?>">
                                                </label>
                                            </section>

                                            <section>
                                                <label class="label">Currency</label>
                                                <label class="input">
                                                    <input type="text" placeholder="Enter Currency" name="currency" required="" value="<?php echo!empty($country_data->currency) ? $country_data->currency : null; ?>">
                                                </label>
                                            </section>


                                        <section>
                                            <label class="label"></label>
                                            <label class="checkbox">
                                                <input type="checkbox"  name="show_home" value="1" <?php echo!empty($country_data->show_home) ? 'checked' : ''; ?>>
                                                <i></i>Show Home
                                            </label>

                                        </section>
                                        <section>
                                            <label class="label">Std Code</label>
                                            <label class="input">
                                                <input type="text" placeholder="Enter Std code" name="stdcode" required="" value="<?php echo!empty($country_data->stdcode) ? $country_data->stdcode : null; ?>">
                                            </label>
                                        </section>

                                    </div>
                                    </fieldset>
                                </div>
                            </div>
                            
                            <div id="tab2" class="tab-pane">
                                        <div class="row">
                                            <?php $month = $this->config->item('month_list'); ?>
                                            <h3>Best time to visit</h3>
                                            <fieldset>
                                                
                                                <?php
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
                                                          <a class="country-best-time" id="remove_row" href=""><img alt="remove" src="<?php echo base_url();?>/assets/admin/img/minus.png"></a>
                                                        </div>
                                                        
                                                </div>
                                                        <?php
                                                    }
                                                }
                                                ?>

                                                <div class="city_wrapper">
                                                    <div class="add_more_content clearfix">
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

                                            </fieldset>

                                        </div>

                                    </div>
                                
                                <div id="tab3" class="tab-pane">
                                    <div class="row">
                                        <div class="col-lg-12 faq-wrapper">
                                            <fieldset>
                                                <?php
                                                if (!empty($country_faq) && is_array($country_faq)) {
                                                    for ($i = 0; $i < count($country_faq); $i++) {
                                                        ?>
                                                        <div class="faq-section">
                                                            <fieldset>
                                                                <div class="col-lg-5 padding-10">
                                                                    <section>
                                                                        <label class="label">Question</label>
                                                                        <label class="textarea"> 
                                                                            <textarea name="question[]"><?php echo $country_faq[$i]->question; ?></textarea>
                                                                        </label>
                                                                    </section>
                                                                </div>
                                                                <div class="col-lg-5 padding-10">
                                                                    <section>
                                                                        <label class="label">Answer</label>
                                                                        <label class="textarea"> 
                                                                            <textarea name="answer[]"><?php echo $country_faq[$i]->answer; ?></textarea>
                                                                        </label>
                                                                    </section>
                                                                </div>
                                                            </fieldset>
                                                            <a class="remove_faq" href="javascript:void(0)"><img src="<?php echo base_url('assets/admin/img/minus.png');?>"/></a>
                                                        </div>
                                                    </fieldset>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            <a href="javascript:void(0)" class="add_more_faq"><img src="<?php echo base_url('assets/admin/img/plus.png')?>"/></a>
                                            <div class="faq-section">
                                                <fieldset>
                                                    <div class="col-lg-5 padding-10">
                                                        <section>
                                                            <label class="label">Question</label>
                                                            <label class="textarea"> 
                                                                <textarea name="question[]"></textarea>
                                                            </label>
                                                        </section>
                                                    </div>
                                                    <div class="col-lg-5 padding-10">
                                                        <section>
                                                            <label class="label">Answer</label>
                                                            <label class="textarea"> 
                                                                <textarea name="answer[]"></textarea>
                                                            </label>
                                                        </section>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <footer>
                                <button class="btn btn-primary" type="submit">
                                    Submit
                                </button>
                            </footer>
                            </div>
                            
                        </div>
                    </div>
                </form>	
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script> 

<script type="text/javascript">
$(document).ready(function () {
    var base_url = "<?php echo base_url(); ?>";

    CKEDITOR.replace('travel_tips');
    CKEDITOR.replace('country_desc');
            
             $('#image_view').on('click', '.remove_image', function (e) {
            e.preventDefault();
            $(this).prev('img').remove();
            $(this).hide();

        });

        $('.city_wrapper').on('click', '.add_more_month', function (e) {
            e.preventDefault();
            getNextBestTimeVisitRow(base_url);
        });
        
        $('.best_time_wrapper').on('click', '#remove_row', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent('div').parent('div');
            ParentDiv.remove();

        });
        
        $('.city_wrapper').on('click', '#remove_row', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent('div').parent('div');
            ParentDiv.remove();

        });
        
        $('.faq-wrapper').on('click', '.add_more_faq', function (e) {
            e.preventDefault();
            var faqHtml = getNextFaq();
            $('.faq-wrapper').append(faqHtml);
        });
        
        $('.faq-wrapper').on('click', '.remove_faq', function (e) {
            e.preventDefault();
            alert('sfas');
            $(this).parent('div').remove();
        });
        
        function getNextBestTimeVisitRow(baseUrl){
                /* get new contact row using ajax */
                $.ajax({
                    type: "POST",
                    data: {base_url: baseUrl},
                    url: baseUrl + 'AjaxController/GetNextMonthRangeRow',
                    success: function (res) {
                        if (res)
                        {
                            $('.city_wrapper').append(res);
                        }
                        else {
                            return '';
                        }
                    }
                });
            }
            
        function getNextFaq(){
            var faqHtml = '';
            faqHtml += '<div class="faq-section"><fieldset><div class="col-lg-5 padding-10"><section><label class="label">Question</label><label class="textarea"><textarea name="question[]"></textarea></label></section></div>';
            faqHtml+= '<div class="col-lg-5 padding-10"><section><label class="label">Answer</label><label class="textarea"> <textarea name="answer[]"></textarea></label></section></div></fieldset><a href = "javascript:void(0)" class = "remove_faq">Remove</a></div>';
            return faqHtml;
        }
});
</script>


