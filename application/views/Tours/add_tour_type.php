<script src="<?php echo base_url(); ?>assets/admin/js/plugin/bootstrap-timepicker/bootstrap-timepicker.min.js"></script> 

<div id="main" role="main">

<?php
$this->load->view('header/breadcrumb');
?>
<div id="content">
    <div class="m-b-10">
        <div class="pull-left">
            <h3 class="pull-left">
                <strong>Add Tour Type</strong>
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
                                <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="false" id="image-dropzone">
                                    Images
                                </a>
                            </li>
                        </ul>
                    </div>
                    <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data"  action="<?php echo base_url('tours/add_tour_type/') ?><?php echo!empty($category_data->id) ? '/' . $category_data->id : null; ?>">
                        <div class="tab-content padding-10">
                            <div id="tab1" class="tab-pane active">
                                <div class="row">
                                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                        <div class="col-lg-6 col-sm-6">
                                            <fieldset>
                                                <?php 
                                                $group = GetTourTypeGroup();
                                                ?>
                                                <section>
                                                    <label class="label">Group</label>
                                                    <label class="select">
                                                        <select name="group_id" required="">
                                                            <option value="">Select</option>
                                                            <?php
                                                            if(!empty($group)){
                                                            foreach ($group as $value) {
                                                                $sel = (isset($category_data->group_id) && $category_data->group_id == $value->id) ? "selected" : "";
                                                                ?>
                                                                <option value="<?php echo $value->id ?>" <?= $sel ?>><?php echo $value->group_name; ?></option>
                                                            <?php } } ?>  
                                                        </select>
                                                    </label>
                                                </section>

                                                <section>
                                                    <label class="label">Name</label>
                                                    <label class="input"> 
                                                        <input type="text" placeholder="Enter Name" name="name" required="" value="<?php echo!empty($category_data->name) ? $category_data->name : null; ?>">
                                                    </label>
                                                </section>
                                                
                                                <section>
                                                    <label class="label">Description</label>
                                                    <label class="textarea"> 										
                                                        <textarea name="tour_desc">
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
		                			</textarea>
                                                    </label>
                                                </section>

                                                <label class="label">Icon</label>
                                                <label class="input input-file"><span class="button">
                                                        <input type="file" value="" onchange="this.parentNode.nextSibling.value = this.value" name="image">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                                    <p>Image Size should be 100*100</p>
                                                </label>
                                                

                                                <section>
                                                    <label class="label">Weightage</label>
                                                    <label class="input"> 
                                                        <input type="text" placeholder="Enter Weightage" name="weightage" required="" value="<?php echo!empty($category_data->name) ? $category_data->name : null; ?>">
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
                                        <div class="col-lg-12 col-sm-12">
                                            <fieldset>
                                                <section>
                                                    <div class="input input-file uploadImaagebutton">
                                                        <input type="button" name="" id="inputfile" value=" Upload Images"/>
                                                        <input type="file" multiple="" name="tour_images[]" id="productImages" style="display:none;" >

                                                        <p class="img-info">Image type-JPEG|JPG|PNG</p>
                                                        <span id="productImagesMsg"></span>
                                                    </div>
                                                    <div id="image_view"></div>
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
                        
                  
                    </section>
                </div>
            </div>
    <script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script> 

<script type="text/javascript">
	
        var baseUrl = "<?php echo base_url();?>";
        $(document).ready(function() {
            
            var instance = $('#addProductForm').parsley();
			$('.frm-submit').click(function(){
				if(instance.isValid() === false){
				/*   display a messge to show users there is some more errors in form  */
					bootstrap_alert.danger('Please check all tab');
				}
			});
            
             $("#productImages").change(function () {
				var FileUploadPath = jQuery('#productImages')[0].files;
                if (typeof (FileReader) != "undefined") {
                    var dvPreview = $("#image_view").show();
                    $("#productImagesMsg").html('');
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
						$("#productImagesMsg").html("Please select images less then 10 MB.");
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
            
            $("#inputfile").click(function(){
			$("#productImages").click();
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
            
            CKEDITOR.replace('tour_desc',{ height: '150px', startupFocus : true} ); 
          
});

</script>



