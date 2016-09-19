<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custom.js"></script>

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
                                        Cities
                                    </a>
                                </li>
                                <li class="">
                                    <a data-placement="top" rel="tooltip" data-toggle="tab" href="#tab2" data-original-title="" title="" aria-expanded="true">
                                        Package
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content padding-10">
                                <div id="tab1" class="tab-pane active">
                                    <div class="row">
                                        <div class="col-lg-1 pull-right">
                                            <!--<a href="" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" class="btn btn-primary btn-xs">Add City</a>-->
                                            <a href="<?php echo base_url('city/addCaptialCity');?>" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i>Add City</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="row">
                                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">
                                                <div data-widget-editbutton="false" id="wid-id-0" class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" role="widget">
                                                    <div role="content">

                                                        <div class="widget-body no-padding">
                                                            <div id="dt_basic_wrapper" class="dataTables_wrapper form-inline no-footer">
                                                                <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer" id="dt_basic" role="grid" aria-describedby="dt_basic_info" style="width: 100%;">
                                                                    <thead>			                
                                                                        <tr role="row">
                                                                            <th data-class="expand" class="expand sorting" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" style="width: 79px;" aria-label=" Name: activate to sort column ascending"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Name</th>
                                                                            <th data-hide="phone" class="sorting" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" style="width: 115px;" aria-label=" Phone: activate to sort column ascending"><i class="fa fa-fw fa-phone text-muted hidden-md hidden-sm hidden-xs"></i> Code</th>
                                                                            <th data-hide="phone,tablet" class="sorting" tabindex="0" aria-controls="dt_basic" rowspan="1" colspan="1" style="width: 170px;" aria-label="City: activate to sort column ascending">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (!empty($city_list)) {
                                                                            foreach ($city_list as $city) {
                                                                                ?>
                                                                                <tr role="row" class="even">
                                                                                    <td class=" expand"><span class="responsiveExpander"></span><?php echo!empty($city->city_name) ? $city->city_name : '' ?></td>
                                                                                    <td><?php echo!empty($city->slug) ? $city->slug : '' ?></td>
                                                                                    <td><a href="">View</a></td>
                                                                                </tr>
                                                                            <?php }
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div id="tab2" class="tab-pane">
                                    Package
                                </div>

                            </div>
                        </div>
                        <hr class="simple">
                    </div>
                </div>
            </div>
        </section>
        
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        <?php
//            $countries = getCountries();
//            $attributes = array('class' => 'smart-form', 'id' => 'city-form','meathod' =>'city/addCity','data-parsley-validate');
//            echo form_open(base_url('city/addCity'), $attributes);
            ?>
          <form action="<?php echo base_url('city/addCity')?>" method="post" data-parsley-validate="" novalidate="" id="city-form" class="smart-form">
          <section>
              <label class="label">City Name</label>
              <label class="input"> 
                  <input type="text" placeholder="City name" name="city_name"  value="<?php echo!empty($country_data->name) ? $country_data->name : null; ?>">
              </label>
          </section>
          
          <input type="hidden" name="country_id" value="<?php echo !empty($country_id) ? $country_id : NULL;?>">
          
          <section>
              <label class="label">Description</label>
              <label class="input"> 
                  <textarea class="form-control" id="message-text" name="description"></textarea>
              </label>
          </section>
          
          
          <section>
              <label class="label">Latitude</label>
              <label class="input"> 
                  <input type="text" placeholder="Latitude" name="latitude"  value="<?php echo!empty($country_data->name) ? $country_data->name : null; ?>">
              </label>
          </section>
          
          
          <section>
              <label class="label">Longtitude</label>
              <label class="input"> 
                  <input type="text" placeholder="Latitude" name="longtitude">
              </label>
          </section>
          
          <section>
              <label class="checkbox">
                  <input type="checkbox"  name="is_capital" value="1">
                  <i></i>Is Capital
              </label>
          </section>
          </form>
          
          <?php //echo form_close();?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="submit-city-from" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

$("#submit-city-from" ).click(function(event) {
//    event.preventDefault();
//    $('#city-form').parsley("validate");
//        if ('#city-form'.parsley("isValid")) {
//            alert('valid');
//        }
        
   
  $("#city-form" ).submit();
});
  $(document).ready(function () {
        /* TABLETOOLS */
        $('#datatable_tabletools').dataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                    "t" +
                    "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
            "oTableTools": {
                "aButtons": [
                    "copy",
                    "csv",
                    "xls",
                    {
                        "sExtends": "pdf",
                        "sTitle": "SmartAdmin_PDF",
                        "sPdfMessage": "SmartAdmin PDF Export",
                        "sPdfSize": "letter"
                    },
                    {
                        "sExtends": "print",
                        "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                    }
                ],
                "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
            },
            "autoWidth": true,
            "preDrawCallback": function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                }
            },
            "rowCallback": function (nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback": function (oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

    })
});

</script>
