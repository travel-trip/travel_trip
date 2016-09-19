<div id="main" role="main">
    <?php
//    echo "check";die;
    $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-lg-8">
                <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post"  action="<?php echo base_url('attraction/add_category/') ?><?php echo!empty($category_data->id) ? '/' . $category_data->id : null; ?>">
                    <div class="widget-body no-padding">
                        <fieldset>

                            <section>
                                <label class="label">Name</label>
                                <label class="input"> 
                                    <i class="icon-append fa fa-gift"></i>
                                    <input type="text" placeholder="Name" name="name" value="<?php echo!empty($category_data->name) ? $category_data->name : null; ?>">
                                </label>
                            </section>
                            
                            <section>
                                <label class="label">Description</label>
                                <label class="textarea"> 										
                                    <textarea name="descriptions">
                                        <?php echo!empty($category_data->descriptions) ? $category_data->descriptions : null; ?>
                                    </textarea>
                                </label>
                            </section>
                            
                        </fieldset>
                        <footer>
                            <button class="btn btn-primary" type="submit">
                                <?php echo!empty($category_data->id) ? 'Update' : 'Submit'; ?>
                            </button>
                        </footer>
                </form>						
        </div>
        </article>
    </div>
</div>
</div>
<script src="<?php echo base_url(); ?>assets/admin/js/plugin/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
    CKEDITOR.replace('descriptions',{ height: '200px', startupFocus : true} );
</script>


