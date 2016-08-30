

<div id="main" role="main">
    <?php
    $this->load->view('header/breadcrumb');
    ?>

    <div id="content">
        <div class="row">
            <div class="widget-body">
                <div class="tabbable">
                    <ul class="nav nav-tabs bordered">
                        <li class="active">
                            <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab1" data-original-title="" title="" aria-expanded="false">
                                Basic Information
                            </a>
                        </li>
                        <li class="">
                            <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                Images
                            </a>
                        </li>
                    </ul>
                </div>
                <?php 
//                dump($tour_group_data);
                ?>
                <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" enctype="multipart/form-data" method="post"   action="<?php echo base_url('tours/edit_tour_type_group/'.$tour_group_data->group_name) ?>">
                    <div class="tab-content">
                        <div id="tab1" class="tab-pane active">  
                            <div class="row">
                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                    <div class="col-lg-6 col-sm-6">
                                        <fieldset>
                                            <section>
                                                <label class="label">Name</label>
                                                <label class="input"> 
                                                    <input type="text" placeholder="Enter Name" name="group_name" required="" value="<?php echo !empty($tour_group_data->group_name) ? $tour_group_data->group_name : ''?>">
                                                </label>
                                            </section>
                                            
                                            <section>
                                                <label class="label">Description</label>
                                                <label class="textarea"> 										
                                                    <textarea name="descriptions">
                                                        <?php echo !empty($tour_group_data->descriptions) ? $tour_group_data->descriptions : ''?>
                                                    </textarea>
                                                </label>
                                            </section>

                                        </fieldset>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <fieldset>
                                            
                                            <section>
                                                    <label class="label">Short Description</label>
                                                    <label class="textarea"> 										
                                                        <textarea name="short_desc">
                                                                <?php echo !empty($tour_group_data->short_desc) ? $tour_group_data->short_desc : ''?>
		                			</textarea>
                                                    </label>
                                                </section>
                                            <section>
                                                <label class="label">Weightage</label>
                                                <label class="input"> 
                                                    <input type="text" placeholder="Enter Name" name="weightage"  value="<?php echo !empty($tour_group_data->weightage) ? $tour_group_data->weightage : ''?>">
                                                </label>
                                            </section>

                                            <label class="label">Icon</label>
                                            <label class="input input-file"><span class="button">
                                                    <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="icon">Browse</span><input type="text" value="<?php echo !empty($tour_group_data->icon) ? $tour_group_data->icon : ''?>" placeholder="Include some files" readonly="">
                                                    <p>Image Size should be 100*100</p>
                                            </label>
                                        </fieldset>
                                    </div>
                                </article>
                            </div>

                        </div>
                        <div id="tab2" class="tab-pane">
                            <div class="row">
                                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                    <div class="col-lg-12 col-sm-12">
                                        <fieldset>
                                            <section>
                                                <div class="input input-file uploadImaagebutton">
                                                    <input type="button" name="" id="inputfile" value=" Upload Images"/>
                                                    <input type="file" multiple="" name="images[]" id="productImages" style="display:none;" >

                                                    <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                    <span id="productImagesMsg"></span>
                                                </div>
                                                <div id="image_view">
                                                    <?php
                                                            if (!empty($tour_group_data->images) && is_array($tour_group_data->images)) {
                                                                    $k = 0;
                                                                    for ($i = 0; $i < count($tour_group_data->images); $i++) {
                                                                        $imggPath = FCPATH.'uploads/tours_group/'.trim($tour_group_data->images[$i]->image);
                                                                        $imggSrc = base_url('uploads/tours_group/'.$tour_group_data->images[$i]->image);
                                                                        if (file_exists($imggPath)) {
                                                                            echo '<img src="' . $imggSrc . '" style="height:100px;width: 100px"/><a title="Remove fields row" class="remove_image" href=javascript:void(0);>X</a>';
                                                                            $k++;
                                                                        }
                                                                    }
                                                            }
                                                            ?>
                                                </div>
                                            </section>
                                        </fieldset>
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
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">

    $(document).ready(function () {
//        $("#group").select2();
        $("#productImages").change(function () {
            var FileUploadPath = jQuery('#productImages')[0].files;
            if (typeof (FileReader) != "undefined") {
                var dvPreview = $("#image_view").show();
                $("#productImagesMsg").html('');
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
                        $("#productImagesMsg").html("Please select images less then 10 MB.");
                        dvPreview.html("");
                        return false;
                    }
                    var file = $(this);
                    if (regex.test(file[0].name.toLowerCase())) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var check = "";
                            if (k == 0) {
                                check = 'checked="checked"';
                            }
                           var img = $("<img style='height:100px;width: 100px'/><p><input type='checkbox'  class='makePrimary' id='primary"+k+"' "+check+" name='primary' value='"+k+"'/><label for='primary"+k+"' id='aprimary"+k+"' title='Checked for make primary image' ></label></p>");
                                img.attr("src", e.target.result);
                                dvPreview.append(img);
                                k++;
                        }
                        reader.readAsDataURL(file[0]);
                    } else {
                        $("#productImagesMsg").html(file[0].name + " is not a valid image file.Please select only JPG,PNG,JPEG,GIF,BMP type files.");
                        $(this).val('');
                        $("#image_view").html("").hide();
                        return false;
                    }

                });
            } else {
                $("#productImagesMsg").html("This browser does not support HTML5 FileReader.");
            }
        });

        $("#inputfile").click(function () {
            $("#productImages").click();
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
        
          CKEDITOR.replace('descriptions',{ height: '150px', startupFocus : true} ); 

    });

</script>


