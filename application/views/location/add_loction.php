
<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb');
    ?>
    <div id="content">

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
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="true">
                                        Visit Best time
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab3" data-original-title="" title="" aria-expanded="true">
                                        Gallery
                                    </a>
                                </li>
                            </ul>
                            <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data" action="<?php echo current_url() ?>">
                                <div class="tab-content padding-10">
                                    <div id="tab1" class="tab-pane active">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                                                <div class="col-lg-6 col-sm-6">
                                                    <?php
                                                    $parent_loction = loction_list();
                                                    ?>
                                                    <fieldset>

                                                        <section>
                                                            <label class="label">Country</label>
                                                            <label class="select">
                                                                <select name="country_id">
                                                                    <?php
                                                                    if (!empty($countries)) {
                                                                        foreach ($countries as $country) {
                                                                            ?>
                                                                            <option value="<?php echo $country->id ?>"><?php echo $country->name; ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>

                                                                </select>
                                                            </label>
                                                        </section>

                                                        <section>
                                                            <label class="label">Parent Loction</label>
                                                            <label class="select">
                                                                <select name="parent_id">
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
                                                            <label class="label">Name</label>
                                                            <label class="input"> 
                                                                <input type="text" placeholder="Loction name" name="loction" required="" value="">
                                                            </label>
                                                        </section>

                                                        <section>
                                                            <label class="label">Description</label>
                                                            <label class="textarea"> 										
                                                                <textarea name="long_desc"></textarea> 
                                                            </label>
                                                        </section>

                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <fieldset>
                                                        <section>
                                                            <label class="label">Short Description</label>
                                                            <label class="textarea"> 										
                                                                <textarea class="custom-scroll" rows="3" name="short_description"></textarea> 
                                                            </label>
                                                        </section>


                                                        <section>
                                                            <label class="label">Tag Line</label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Enter Tag line" name="tag_line" value="">
                                                            </label>
                                                        </section>

                                                        <section>
                                                            <label class="label">Weightage</label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Enter Weightage" name="weightage" value="">
                                                            </label>
                                                        </section>
                                                        <section>
                                                            <label class="label"></label>
                                                            <div class="inline-group">
                                                                <label class="checkbox">
                                                                    <input type="checkbox"  name="show_home" value="1" >
                                                                    <i></i>
                                                                    Show Home
                                                                </label>
                                                                <label class="checkbox">
                                                                    <input type="checkbox"  name="is_capital" value="1">
                                                                    <i></i>
                                                                    Is Capital
                                                                </label>
                                                            </div>
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
                                                                    <select name="best_time_from[]">
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

                                        <hr style="border-color: black; margin-top: 30px;">
                                        <h2 style="margin-top: 10px;">Gallery</h2>
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div class="col-lg-12 col-sm-12">
                                                    <fieldset>
                                                        <section>
                                                            <div class="input input-file uploadImaagebutton">
                                                                <input type="button" name="" id="inputfile" value=" Upload Images"/>
                                                                <input type="file" multiple="" name="location_images[]" id="loctionImages"  style="display:none;" >

                                                                <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                <span id="loctionImagesMsg"></span>
                                                            </div>
                                                            <div id="image_view"></div>
                                                        </section>
                                                    </fieldset>
                                                </div>
                                            </article>
                                        </div>
                                    </div>

                                    <footer>
                                        <hr class="simple">
                                        <button class="btn btn-primary pull-right" type="submit">
                                            Submit
                                        </button>
                                    </footer>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script> 

<script type="text/javascript">

    var base_url = "<?php echo base_url(); ?>";

    $(document).ready(function () {

        var instance = $('#addProductForm').parsley();
        $('.frm-submit').click(function () {
            if (instance.isValid() === false) {
                /*****************display a messge to show users there is some more errors in form**********/
                bootstrap_alert.danger('Please check all tab');
            }
        });

        $("#loctionImages").change(function () {
            var FileUploadPath = jQuery('#loctionImages')[0].files;
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#image_view").show();
                $("#loctionImagesMsg").html('');
                dvPreview.html("");
                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                var k = 0;
                var fname = '';
                $($(this)[0].files).each(function () {
                    fname = fname + FileUploadPath[0].name + ',';
                    var str = str + FileUploadPath[0].size;
                    str = str / (4 * 1024 * 1024);
                    if (str >= 10)
                    {
                        $("#loctionImagesMsg").html("Please select images less then 10 MB.");
                        dvPreview.html("");
                        return false;
                    }
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        
                        var reader = new FileReader();
                      reader.onload = function (e) {
								var check = "";
								if(k==0){
									check = 'checked="checked"';
								}
                                var img = $("<img style='height:100px;width: 100px'/><p><input type='checkbox'  class='makePrimary' id='primary"+k+"' "+check+" name='primary' value='"+k+"'/><label for='primary"+k+"' id='aprimary"+k+"' title='Checked for make primary image' ></label></p>");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                                k++;
                            }
                        reader.readAsDataURL(file[0]);
                    } else {
                        $("#loctionImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                        $(this).val('');
                        $("#image_view").html("").hide();
                        return false;
                    }

                });
            } else {
                $("#loctionImagesMsg").html("This browser does not support HTML5 FileReader.");
            }
        });

        $("#inputfile").click(function () {
            $("#loctionImages").click();
        });

        $('#image_view').on('click', '.makePrimary', function () {
            $(".makePrimary").prop('checked', false);
            $(this).prop('checked', true);
        });


        $('#image_view').on('click', '.remove_image', function (e) {
            e.preventDefault();
            $(this).prev('img').remove();
            $(this).hide();

        });

        $('.city_wrapper').on('click', '.add_more_month', function (e) {
            e.preventDefault();
            getNextBestTimeVisitRow(base_url);
        });

        $('.city_wrapper').on('click', '#remove_row', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent('div').parent('div');
            ParentDiv.remove();

        });

        CKEDITOR.replace('long_desc',
                {
                    toolbar:
                            [
                                {name: 'basicstyles', items: ['Bold', 'Italic']},
                                {name: 'paragraph', items: ['NumberedList', 'BulletedList']},
                                {name: 'tools', items: ['Maximize', '-', 'About']},
                                {name: 'document', items: ['NewPage', 'Preview']},
                                {name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']},
                                {name: 'editing', items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']},
                                {name: 'insert', items: ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak'
                                                , 'Iframe']},
                                '/',
                                {name: 'styles', items: ['Styles', 'Format']}
                            ]
                });

    });


    function getNextBestTimeVisitRow(baseUrl)
    {
        /**********************get new contact row using ajax****************/
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


</script>
