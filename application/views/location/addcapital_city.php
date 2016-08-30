<script src="<?php echo base_url(); ?>assets/admin/js/plugin/summernote/summernote.min.js"></script>

<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb');
    ?>
    <div id="content">

        <section id="widget-grid" class="">
            <div data-widget-editbutton="false" id="8521cbb7b77c1acb05ccf76f73014447" class="jarviswidget jarviswidget-sortable" role="widget">
                <div role="content">
                    <div class="jarviswidget-editbox"></div>
                    <div class="widget-body ">
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
                                        Top Attraction
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data" action="<?php echo base_url('country/add/') ?><?php echo!empty($country_data->id) ? '/' . $country_data->id : null; ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Name</label>
                                                                <label class="input"> 
                                                                    <i class="icon-append fa fa-user"></i>
                                                                    <input type="text" placeholder="City name" name="name" required="" value="<?php echo!empty($country_data->name) ? $country_data->name : null; ?>">
                                                                </label>
                                                            </section>

                                                            <section>
                                                                <div class="summernote"></div>

                                                            </section>


                                                            <section>
                                                                <label class="label">City Image</label>
                                                                <div class="input input-file">
                                                                    <span class="button"><input type="file" onchange="this.parentNode.nextSibling.value = this.value" name="banner_image" id="file">Browse</span><input type="text" readonly="" placeholder="Include some files">
                                                                </div>
                                                            </section>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6">
                                                        <fieldset>
                                                            <section>
                                                                <label class="label">Shor Decription</label>
                                                                <label class="textarea"> 										
                                                                    <textarea class="custom-scroll" rows="3" name="description"></textarea> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="label">Tag Line</label>
                                                                <label class="input">
                                                                    <input type="text" placeholder="Enter Tag line" name="tag_line" value="<?php echo!empty($country_data->tag_line) ? $country_data->tag_line : null; ?>">
                                                                    <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> 
                                                                </label>
                                                            </section>
                                                            <section>
                                                                <label class="checkbox">
                                                                    <input type="checkbox"  name="is_featured" value="1" <?php echo!empty($country_data->is_featured) ? 'checked' : ''; ?>>
                                                                    <i></i>Is featured</label>
                                                            </section>
                                                        </fieldset>

                                                    </div>

                                            </article>

                                        </div>


                                    </div>
                                    <div id="tab2" class="tab-pane">
                                        <div class="row">
                                            <?php $month = $this->config->item('month_list'); ?>
                                            <h3>Best time to visit</h3>
                                                <fieldset>
                                                    
                                                    <div class="city_wrapper">
                                                        <div class="add_more_content clearfix">
                                                            <div class="col-lg-2 padding-10">
                                                                <section>
                                                                    <label class="label">Month from</label>
                                                                    <label class="select">
                                                                        <select name="duration_from[]">
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
                                                                        <select name="duration_to[]">
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
                                                                    <label class="label">Short Decription</label>
                                                                    <label class="textarea"> 										
                                                                        <textarea name="description" rows="2"></textarea>
                                                                    </label>
                                                                </section>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <a href="" class="add_more_month">Add more</a>
                                                    </fieldset>

                                        </div>

                                    </div>
                                    
                                    <div id="tab3" class="tab-pane">
                                        <div class="row">
                                            <?php $attraction_category = attractionCategroy();
//                                                dump($attraction_category);
                                            ?>
                                            <fieldset>
                                                <div class="col-lg-12">
                                                    <?php
                                                    foreach ($attraction_category as $key => $value) {
                                                        ?>
                                                        <label class="checkbox">
                                                            <input type="checkbox"  name="attraction_category[]" value="<?= !empty($key) ? $key : null ?>">
                                                            <?php echo!empty($value) ? $value : null; ?><i></i></label>
                                                    <?php } ?>
                                                </div>
                                            </fieldset>
                                        </div>
                                    </div>
                                <footer>
                                    <hr class="simple">
                                    <button class="btn btn-primary pull-right" type="submit">
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


<script type="text/javascript">
    
    var base_url = "<?php echo base_url(); ?>";
    
    $(document).ready(function () {
        
        var edit = function() {
            $('.click2edit').summernote({
                    focus : true
            });
            };
            var save = function() {
            $('.click2edit').destroy();
            };

            $('.summernote').summernote({
                height : 180,
                focus : false,
                tabsize : 2
             });

         $('.add_more_month').on('click', function(e) { //Once add more contact button is clicked
                e.preventDefault();
                getNextBestTimeVisitRow(base_url);
            });
            
            $('.city_wrapper').on('click', '#remove_row', function(e) {
                e.preventDefault();
                var ParentDiv = $(this).parent('div').parent('div');
                ParentDiv.remove();
               
            });
    });
    
    
    
    
    
    function getNextBestTimeVisitRow(baseUrl)
{
    /* get new contact row using ajax */
    $.ajax({
        type: "POST",
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
                

</script>
