
<div id="main" role="main">
    <?php $this->load->view('header/breadcrumb'); 
    
// dump($country_list)
    ?>
    
   <div id="content">
       <div class="m-b-10">
           <div class="pull-left">
               <h3 class="pull-left">
                   <strong>Countries</strong>
               </h3>
           </div>
           <div class="pull-right">
               <a href="<?php echo base_url('country/add');?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add Country</a>
           </div>
       </div>
        <section class="" id="widget-grid">
            
            <!-- row -->
            <div class="row">

                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sortable-grid ui-sortable">

                    <div data-widget-editbutton="false" id="wid-id-0" class="jarviswidget jarviswidget-color-darken" role="widget">
                        <header role="heading">
                            <h2><?=$list_heading?></h2>
                        </header>
                        <div role="content">
                            <div class="widget-body no-padding">
                                <div id="dt_basic_wrapper" class="dataTables_wrapper form-inline no-footer">
                                    <table width="100%" class="table table-striped table-bordered table-hover dataTable no-footer" id="" role="grid">
                                        <thead>			                
                                            <tr role="row">
                                                <th>Name</th>
                                                <th>City</th>
                                                <th>Package</th>
                                                <th>Attraction</th>
                                                <th>Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($country_list)) {
                                                foreach ($country_list as $country) {
                                                    
                                                    ?>
                                                    <tr role="row" class="even">
                                                        <td class=""><?php echo !empty($country->name) ? $country->name : '' ?></td>
                                                        <td class=""><?php echo !empty($country->cities) ? $country->cities[0]->counted_rows : '0' ?></td>
                                                        <td class=""><?php echo !empty($country->packages) ? $country->packages[0]->counted_rows : '0' ?></td>
                                                        <td class=""><?php echo !empty($country->attractions) ? $country->attractions[0]->counted_rows : '0' ?></td>
                                                        <td><?php echo !empty($country->abbreviation) ? $country->abbreviation : '' ?></td>
                                                        <td>
                                                            <a class="btn btn-primary" href="<?php echo base_url('country/add/'.$country->id)?>">Edit</a>
                                                            <a class="btn btn-primary" href="<?php echo base_url('country/countryView/'.$country->id)?>">View</a>
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
