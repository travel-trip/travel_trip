<?php
$urlSegment = $this->uri->segment_array();
if (!empty($urlSegment)) {
    $uriString = end($urlSegment);
}
?>
<aside id="left-panel">
    <div class="login-info">
        <span>
            <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                <img src="<?php echo base_url(); ?>assets/admin/img/avatars/sunny.png" alt="me" class="online" /> 
                <span>
                    <?php
                    $user_info = $this->ion_auth->user()->row();
                    echo!empty($user_info->first_name) ? $user_info->first_name : '';
                    ?>
                </span>
                <i class="fa fa-angle-down"></i>
            </a> 
        </span>
    </div>
    <nav>
        <ul>
            <li class="">
                <a title="Dashboard" href="#">
                    <i class="fa fa-lg fa-fw fa-home"></i><span class="menu-item-parent">Dashboard </span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>

            </li>

        </ul>
        <ul>
            <li class="">
                <a title="Location" href="#">
                    <i class="fa fa-lg fa-fw fa-location-arrow"></i><span class="menu-item-parent">Location </span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="display: none;">
                    <li class="<?php echo ($uriString == 'country') ? 'active' : '' ?>"><a title="Country" href="<?php echo base_url('admin/country') ?>">
                            Country
                        </a>
                    </li>
                    <li class="<?php echo ($uriString == 'loction') ? 'active' : '' ?>">
                        <a title="Loction" href="<?php echo base_url('admin/loction') ?>">
                            Locations
                        </a>
                    </li>
                    <li class="<?php echo ($uriString == 'loction_tour_types') ? 'active' : '' ?>">
                        <a title="Loction Tour Type" href="<?php echo base_url('loction/loction_tour_types') ?>">
                            Location Tour Types
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <ul>
            <li class="">
                <a title="Tour" href="#">
                    <i class="fa fa-lg fa-fw fa-random"></i><span class="menu-item-parent">Tour & Package </span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="display: none;">
                    <li class="<?php echo ($uriString == 'tour_type_group') ? 'active' : '' ?>">
                        <a title="Tour type" href="<?php echo base_url('tours/tour_type_group') ?>">
                            Tour Type Group
                        </a>
                    </li>
                    <li class="<?php echo ($uriString == 'type') ? 'active' : '' ?>">
                        <a title="Tour type" href="<?php echo base_url('tours/type') ?>">
                            Tour Type
                        </a>
                    </li>

                    <li class="<?php echo ($uriString == 'package') ? 'active' : '' ?>">
                        <a title="Packages" href="<?php echo base_url('admin/package') ?>">
                            Packages
                        </a>
                    </li>

                </ul>
            </li>

        </ul>

        <ul>
            <li class="">
                <a title="Miscellaneous" href="#">
                    <i class="fa fa-lg fa-fw fa-location-arrow"></i>
                    <span class="menu-item-parent">Miscellaneous</span>
                    <b class="collapse-sign"><em class="fa fa-minus-square-o"></em></b>
                </a>
                <ul style="">
                    <li class="<?php echo ($uriString == 'category') ? 'active' : '' ?>">
                        <a title="Activities" href="<?php echo base_url() . 'activities/category' ?>">
                            Activities Category
                        </a>
                    </li>
                    <li class="<?php echo ($uriString == 'activities') ? 'active' : '' ?>">
                        <a title="Activities" href="<?php echo base_url() . 'activities' ?>">
                            Activities
                        </a>
                    </li>
                    <li class="<?php echo ($uriString == 'attraction') ? 'active' : '' ?>">
                        <a title="Attraction" href="<?php echo base_url() . 'attraction' ?>">
                            Attraction
                        </a>
                    </li>

                    <li class="<?php echo ($uriString == 'attractionCategory') ? 'active' : '' ?>">
                        <a title="Attraction Category" href="<?php echo base_url() . 'attraction/attractionCategory' ?>">
                            Attraction Category
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
</aside>
<!-- END NAVIGATION -->