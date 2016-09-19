

<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb'); 
    
// dump($city_list)
    ?>
    <div id="content">
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
                                                        <td class=" expand"><span class="responsiveExpander"></span><?php echo !empty($city->city_name) ? $city->city_name : '' ?></td>
                                                        <td><?php echo !empty($city->slug) ? $city->slug : '' ?></td>
                                                        <td><a href="">View</a></td>
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
