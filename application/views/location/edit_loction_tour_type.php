<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <?php // dump($edit_data); ?>
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
                            <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data" action="<?php echo base_url('loction/editTourTypeLoction/'.$edit_data->id) ?>">
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
                                                                    <?php foreach ($countries as $key => $country) {
                                                                        $sel = (isset($edit_data->country_id) && $edit_data->country_id == $key) ? "selected" : "";
                                                                        ?>
                                                                        <option value="<?= $key; ?>" <?=$sel;?>><?= !empty($country) ? $country : NULL; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </label>
                                                        </section>
                                                        

                                                        <section>
                                                            <label class="label">Loction</label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Loction name" name="loction" id="loction" required="" value="<?php echo !empty($edit_data->loction) ? $edit_data->loction->loction : ''?>">
                                                            </label>
                                                        </section>
                                                        

                                                        <section>
                                                            <label class="label">Type</label>
                                                            <label class="select">
                                                                <select name="type" id="type">
                                                                    <option value="">Select</option>
                                                                    <option value="1">Tour type</option>
                                                                    <option value="2">Activities</option>
                                                                </select>
                                                            </label>
                                                        </section>
                                                        
                                                        
                                                        <section id="tour-grp">
                                                            <label class="label">Tour Group</label>
                                                            <label class="select">
                                                                <select name="tour_type_group_id" id="tour_group">
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </label>
                                                        </section>
                                                        
                                                        <section id="tour-act">
                                                            <label class="label">Activity</label>
                                                            <label class="select">
                                                                <select name="activity_id" id="tour-activity">
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </label>
                                                        </section>
                                                        
                                                        
                                                        <section id="tour-type">
                                                            <label class="label">Tour Type </label>
                                                            <label class="select">
                                                                <select name="tour_type_id" id="tour_type">
?>
                                                                    <option value="">Select</option>
                                                                </select>
                                                            </label>
                                                        </section>
                                                        
                                                        
                                                        <section>
                                                            <label class="label">Decription</label>
                                                            <label class="textarea"> 										
                                                                <textarea name="long_desc"><?php echo !empty($edit_data->long_desc) ? $edit_data->long_desc : ''?></textarea> 
                                                            </label>
                                                        </section>

                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-6 col-sm-6">
                                                    <fieldset>
                                                        <section>
                                                            <label class="label">Shor Decription</label>
                                                            <label class="textarea"> 										
                                                                <textarea class="custom-scroll" rows="3" name="short_description"><?php echo !empty($edit_data->short_description) ? $edit_data->short_description : ''?></textarea> 
                                                            </label>
                                                        </section>
                                                        
                                                        
                                                        <section>
                                                            <label class="label">Weightage</label>
                                                            <label class="input">
                                                                <input type="text" placeholder="Enter Weightage" name="weightage" value="<?php echo !empty($edit_data->weightage) ? $edit_data->weightage : ''?>">
                                                            </label>
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
                                                                        <textarea name="description[]" rows="2"><?php echo $best_time_visit[$i]->description; ?></textarea>
                                                                    </label>
                                                                </section>
                                                            </div>
                                                          <a id="remove_row" href="javascript:void(0)">remove</a>  
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
                                                        
                                                    </div>

                                                </div>
                                                <a href="" class="add_more_month">Add more</a>
                                            </fieldset>

                                        </div>

                                    </div>

                                    <div id="tab3" class="tab-pane">
                                        <div class="row">
                                            
                                            <fieldset>
                                                
                                            </fieldset>
                                        </div>
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div class="col-lg-12 col-sm-12">
                                                    <fieldset>
                                                        <section>
                                                            <div class="input input-file uploadImaagebutton">
                                                                <input type="button" name="" id="inputfile" value=" Upload Images"/>
                                                                <input type="file" multiple="" name="loction_tour_type_images[]" id="loctionImages"  style="display:none;" >

                                                                <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                                <span id="loctionImagesMsg"></span>
                                                            </div>
                                                            <div id="image_view">
                                                            <?php
                                                            if (!empty($gallery_images) && is_array($gallery_images)) {
                                                                    $k = 0;
                                                                    for ($i = 0; $i < count($gallery_images); $i++) {
                                                                        $imggPath = FCPATH.'uploads/tour_type_loction/'.trim($gallery_images[$i]->image);
                                                                        $imggSrc = base_url('uploads/tour_type_loction/'.$gallery_images[$i]->image);
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

    var baseUrl = "<?php echo base_url(); ?>";

    $(document).ready(function () {
        
        $("#loction" ).autocomplete({
            autoFocus: true,
            source: function(request, response) {
            $.ajax({
                url: baseUrl+'loction/location_search',
                dataType: "json",
                data: {
                    term : request.term,
                    country_id : $("#country_id").val()
                },
                success: function(data) {
                    response(data);
                }
            });
        },
            
        });
        
         $("#tour-act").hide();
        
        $('#type').on('change', function (e) {
            e.preventDefault();
            var type = $(this).val();
//            alert(type);return false;
            $.ajax({
                type: "POST",
                url: baseUrl + "ajaxController/getDropDownType",
                data: {type: type},
                beforeSend: function () {
                    $("#tour_group").prop('disabled', true);
                },
            }).done(function (res) {
                if(type == 2){
                   $("#tour-act").show();
                   $("#tour-grp").hide();
                   $("#tour-type").hide();
                   $("#tour-activity").html(res); 
                }else{
                     $("#tour_group").html(res);
                     $("#tour-grp").show();
                     $("#tour-act").hide();
                     $("#tour-type").show();
                    $("#tour_group").prop('disabled', false);
                }
               
            });
        });
        
         $('#tour_group').on('change', function (e) {
            e.preventDefault();
            var id = $(this).val();
//            alert(type);return false;
            $.ajax({
                type: "POST",
                url: baseUrl + "ajaxController/getAssociatedTourTypes",
                data: {groupId: id},
                beforeSend: function () {
                    $("#tour_type").prop('disabled', true);
                },
            }).done(function (res) {
                $("#tour_type").html(res);
                $("#tour_type").prop('disabled', false);
            });
        });
        
        
      var instance = $('#addProductForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
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
                    var k=0;
                    var fname='';
                    $($(this)[0].files).each(function () {
						fname=fname+FileUploadPath[0].name+',';
                    var str=str+FileUploadPath[0].size;
                     str=str/(4*1024*1024);
                     if(str>=10)
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
                                var img = $("<img style='height:100px;width: 100px'/><a title='Remove fields row' class= 'remove_image' href='javascript:void(0);'><img src=http://192.168.1.22/travel_trip/assets/admin/img/clear.png></a>");
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
            
            $("#inputfile").click(function(){
			$("#loctionImages").click();
		});
		
		$('#image_view').on('click','.makePrimary',function(){
			$(".makePrimary").prop('checked', false);
			$(this).prop('checked', true);
		});

            
            $('#image_view').on('click', '.remove_image', function(e) {
                e.preventDefault();
                $(this).prev('img').remove();
                $(this).hide();
               
            });  

        $('.add_more_month').on('click', function (e) { //Once add more contact button is clicked
            e.preventDefault();
            getNextBestTimeVisitRow(baseUrl);
        });

        $('.city_wrapper').on('click', '#remove_row', function (e) {
            e.preventDefault();
            var ParentDiv = $(this).parent('div').parent('div');
            ParentDiv.remove();

        });
        
         $('.best_time_wrapper').on('click', '#remove_row', function (e) {
                    e.preventDefault();
                    var ParentDiv = $(this).parent().parent();
                    ParentDiv.remove();

                });
        
        CKEDITOR.replace( 'long_desc',
	{
		toolbar :
		[
			{ name: 'basicstyles', items : [ 'Bold','Italic' ] },
			{ name: 'paragraph', items : [ 'NumberedList','BulletedList' ] },
			{ name: 'tools', items : [ 'Maximize','-','About' ] },
                        { name: 'document', items : [ 'NewPage','Preview' ] },
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
                 ,'Iframe' ] },
                '/',
                { name: 'styles', items : [ 'Styles','Format' ] }
		]
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
