<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custome.js"></script>

<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb'); 
    
// dump($activity_list)
    ?>
    <div id="content">
        <div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Tour Type</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('activities/addAcitivity');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add</a>
           </div>
       </div>
        <section class="" id="widget-grid">
            
            <!-- row -->
            <div class="row">

                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                    <div data-widget-editbutton="false" id="wid-id-0" class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" role="widget">
                        <header role="heading"><div class="jarviswidget-ctrls" role="menu">   <a data-placement="bottom" title="" rel="tooltip" class="button-icon jarviswidget-toggle-btn" href="javascript:void(0);" data-original-title="Collapse"><i class="fa fa-minus "></i></a> <a data-placement="bottom" title="" rel="tooltip" class="button-icon jarviswidget-fullscreen-btn" href="javascript:void(0);" data-original-title="Fullscreen"><i class="fa fa-expand "></i></a> <a data-placement="bottom" title="" rel="tooltip" class="button-icon jarviswidget-delete-btn" href="javascript:void(0);" data-original-title="Delete"><i class="fa fa-times"></i></a></div><div class="widget-toolbar" role="menu"><a href="javascript:void(0);" class="dropdown-toggle color-box selector" data-toggle="dropdown"></a><ul class="dropdown-menu arrow-box-up-right color-select pull-right"><li><span data-original-title="Green Grass" data-placement="left" rel="tooltip" data-widget-setstyle="jarviswidget-color-green" class="bg-color-green"></span></li><li><span data-original-title="Dark Green" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-greenDark" class="bg-color-greenDark"></span></li><li><span data-original-title="Light Green" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-greenLight" class="bg-color-greenLight"></span></li><li><span data-original-title="Purple" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-purple" class="bg-color-purple"></span></li><li><span data-original-title="Magenta" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-magenta" class="bg-color-magenta"></span></li><li><span data-original-title="Pink" data-placement="right" rel="tooltip" data-widget-setstyle="jarviswidget-color-pink" class="bg-color-pink"></span></li><li><span data-original-title="Fade Pink" data-placement="left" rel="tooltip" data-widget-setstyle="jarviswidget-color-pinkDark" class="bg-color-pinkDark"></span></li><li><span data-original-title="Light Blue" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-blueLight" class="bg-color-blueLight"></span></li><li><span data-original-title="Teal" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-teal" class="bg-color-teal"></span></li><li><span data-original-title="Ocean Blue" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-blue" class="bg-color-blue"></span></li><li><span data-original-title="Night Sky" data-placement="top" rel="tooltip" data-widget-setstyle="jarviswidget-color-blueDark" class="bg-color-blueDark"></span></li><li><span data-original-title="Night" data-placement="right" rel="tooltip" data-widget-setstyle="jarviswidget-color-darken" class="bg-color-darken"></span></li><li><span data-original-title="Day Light" data-placement="left" rel="tooltip" data-widget-setstyle="jarviswidget-color-yellow" class="bg-color-yellow"></span></li><li><span data-original-title="Orange" data-placement="bottom" rel="tooltip" data-widget-setstyle="jarviswidget-color-orange" class="bg-color-orange"></span></li><li><span data-original-title="Dark Orange" data-placement="bottom" rel="tooltip" data-widget-setstyle="jarviswidget-color-orangeDark" class="bg-color-orangeDark"></span></li><li><span data-original-title="Red Rose" data-placement="bottom" rel="tooltip" data-widget-setstyle="jarviswidget-color-red" class="bg-color-red"></span></li><li><span data-original-title="Light Red" data-placement="bottom" rel="tooltip" data-widget-setstyle="jarviswidget-color-redLight" class="bg-color-redLight"></span></li><li><span data-original-title="Purity" data-placement="right" rel="tooltip" data-widget-setstyle="jarviswidget-color-white" class="bg-color-white"></span></li><li><a data-original-title="Reset widget color to default" data-placement="bottom" rel="tooltip" data-widget-setstyle="" class="jarviswidget-remove-colors" href="javascript:void(0);">Remove</a></li></ul></div>
                            <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                            <h2><?=$list_heading?></h2>
                            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
                        <div role="content">

                            <div class="widget-body no-padding">
                                <div id="dt_basic_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer" id="dt_basic" role="grid" aria-describedby="dt_basic_info" style="width: 100%;">
                                        <thead>			                
                                                <th>Name</th>
                                                <th>Icon</th>
                                                <th>Category</th>
                                                <th class="sorting">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($activity_list)) {
                                                foreach ($activity_list as $activity) {
                                                      if (!empty($activity->icon)) {
                                                        $image_full_src = FCPATH . 'uploads/tour_activity/'.trim($activity->icon);

                                                        if (file_exists($image_full_src)) {
                                                            $relative_path = base_url() . 'uploads/tour_activity/'.trim($activity->icon);
                                                            $imageSrc = $relative_path;
                                                        }
                                                    } else {
                                                        $default_image = base_url().'uploads/tour_activity/no-preview.png';
                                                        $imageSrc = $default_image;
                                                    }
                                                    ?>
                                                    <tr role="row" class="even">
                                                        <td class=" expand"><span class="responsiveExpander"></span>
                                                            <?php echo !empty($activity->name) ? $activity->name : '' ?>
                                                        </td>
                                                         <td class=" expand"><span class="responsiveExpander"></span>
                                                            <img src="<?php echo $imageSrc; ?>" alt="" height="50px;" width="80px;">
                                                        </td>
                                                        <td class=" expand"><span class="responsiveExpander"></span>
                                                            <?php echo !empty($activity->category) ? $activity->category->name : '' ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url('activities/addAcitivity/'.$activity->id);?>" class="btn btn-primary">Edit</a>
                                                            <a href="" class="delete btn btn-sm btn-default" data-record-id="<?php echo $activity->id ?>" data-record-title="<?php echo $activity->name ?>" data-toggle="modal" data-target="#confirm-delete">
                                                            Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </section>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">


    $(document).ready(function () {
        
        var base_url = "<?php echo base_url(); ?>";
        
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
        
        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            var model = 'Activity_Model';
            var msg = 'Selected activities successfully deleted!';
            
            $.ajax({
                url: base_url + 'AjaxController/deleteCommonAttribute',
                type: "POST",
                data: {id: id,deleteModel: model,successMsg: msg},
                success: function (res) {
                    var obj = $.parseJSON(res);
                    if (obj.response === 'true') {
                        location.reload();
                    }else{
                        alert('Tour Type Not Deleted! Something Went Wrong!')
                    }
                }

            })

        });
        
        $('#confirm-delete').on('show.bs.modal', function (e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
        });

    });

</script>