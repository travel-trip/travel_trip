<div id="main" role="main">
    <?php
    $this->load->view('header/breadcrumb');
    ?>
    <div id="content">
        <div class="row">
            <article class="col-xs-12 col-sm-12 col-lg-8">
                <form class="smart-form" id="country-form" novalidate="novalidate" data-parsley-validate="" novalidate="" method="post"  action="<?php echo base_url('activities/add/') ?><?php echo!empty($category_data->id) ? '/' . $category_data->id : null; ?>">
                    <div class="widget-body no-padding">
                        <fieldset>
                            <section>
                                <label class="label">Name</label>
                                <label class="input"> 
                                    <input type="text" placeholder="Category" name="name" required="" value="<?php echo!empty($category_data->name) ? $category_data->name : null; ?>">
                                </label>
                            </section>

                            <section>
                                <label class="label">Description</label>
                                <label class="textarea"> 										
                                    <textarea class="custom-scroll" rows="3" name="description"></textarea> 
                                </label>
                            </section>
                        </fieldset>
                        <footer>
                            <button class="btn btn-primary" type="submit">
                                Submit
                            </button>
                        </footer>
                </form>						
        </div>
        </article>
    </div>
</div>
</div>


