<div id="main" role="main">
    <?php
    $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-lg-8">
                <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data" action="<?php echo base_url('activities/addAcitivity/') ?><?php echo!empty($activity_data->id) ? '/' . $activity_data->id : null; ?>">
                    <div class="widget-body no-padding">
                        <fieldset>
                            <section>
                                <label class="label">Category</label>
                                <label class="select">
                                    <select name="activity_category_id" required="">
                                        <option value="">Select</option>
                                        <?php
                                        foreach ($activity_cat as $value) {
                                            $sel = (isset($activity_data->activity_category_id) && $activity_data->activity_category_id == $value->id) ? "selected" : "";
                                            ?>
                                            <option value="<?php echo $value->id ?>" <?= $sel ?>><?php echo $value->name; ?></option>
                                        <?php } ?>  
                                    </select>
                                </label>
                            </section>
                            
                            <section>
                                <label class="label">Name</label>
                                <label class="input"> 
                                    <input type="text" placeholder="Name" name="name" required="" value="<?php echo !empty($activity_data->name) ? $activity_data->name : null; ?>">
                                </label>
                            </section>
                            <label class="label">Icon</label>
                            <label class="input input-file"><span class="button">
                                    <input type="file" value=""  onchange="this.parentNode.nextSibling.value = this.value" name="activity_icon">Browse</span><input type="text" value="" placeholder="Include some files" readonly="">
                                <p>Image Size should be 200*200</p>
                            </label>

                            <section>
                                <label class="label">Description</label>
                                <label class="textarea"> 										
                                    <textarea class="custom-scroll" rows="3" name="description"><?php echo !empty($activity_data->description) ? $activity_data->description : null; ?></textarea> 
                                </label>
                            </section>
                        </fieldset>
                        <footer>
                            <button class="btn btn-primary" type="submit">
                                <?php echo !empty($activity_data->id) ? 'Update' : 'Submit'; ?>
                            </button>
                        </footer>
                </form>						
        </div>
        </article>
    </div>
</div>
</div>


