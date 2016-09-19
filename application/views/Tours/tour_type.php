<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/js/custome.js"></script>


<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Tour Type</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('tours/add_tour_type');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Tour Type</a>
           </div>
       </div>
        <section class="" id="widget-grid">

            <div class="row">

                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                    <div data-widget-editbutton="false" id="wid-id-0" class="jarviswidget jarviswidget-color-darken jarviswidget-sortable" role="widget">
                        <header role="heading">
                            <h2><?= $list_heading ?></h2>
                        </header>
                        <div role="content">

                            <div class="widget-body no-padding">
                                <div id="dt_basic_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                        <thead>			                
                                        <th>Name</th>
                                        <th>Group</th>
                                        <th>Image</th>
                                        <th class="sorting">Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $imageSrc = '';
                                            if (!empty($tour_type_list)) {
                                                foreach ($tour_type_list as $tour_type) {
                                                    if (!empty($tour_type->icon)) {
                                                        $image_full_src = FCPATH.'tour_image/' . $tour_type->icon;
//                                                        echo $image_full_src;

                                                        if (!file_exists($image_full_src)) {
                                                            $relative_path = base_url().'tour_image/'.$tour_type->icon;
                                                            $imageSrc = $relative_path;
                                                        }
                                                    } else {
                                                        $default_image = base_url() . 'tour_image/no-preview.png';
                                                        $imageSrc = $default_image;
                                                    }

//                                                    echo $imageSrc;
                                                    ?>
                                                    <tr role="row" class="even">
                                                        <td class=" expand"><span class="responsiveExpander"></span>
                                                            <?php echo!empty($tour_type->name) ? $tour_type->name : '' ?>
                                                        </td>
                                                        <td class=" expand"><span class="responsiveExpander"></span>
                                                            <?php echo !empty($tour_type->group) ? $tour_type->group->group_name : '' ?>
                                                        </td>
                                                        <td class=" expand"><span class="responsiveExpander"></span>
                                                            <img src="<?php echo $imageSrc;?>" alt="" height="50px;" width="80px;">
                                                            <?php //echo!empty($tour_type->image) ? $tour_type->image : '-' ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?php echo base_url('tours/edit_tour_type/'.$tour_type->id); ?>" class="btn btn-primary">Edit</a>
                                                            <a href="" class="delete btn btn-sm btn-default" data-record-id="<?php echo $tour_type->id ?>" data-record-title="<?php echo $tour_type->name ?>" data-toggle="modal" data-target="#confirm-delete">
                                                                Delete
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
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

        $('#confirm-delete').on('click', '.btn-ok', function (e) {
            var $modalDiv = $(e.delegateTarget);
            
            var id = $(this).data('recordId');
            var model = 'Tour_Type_Model';
            var msg = 'Selected Tour type successfully deleted!';
            
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