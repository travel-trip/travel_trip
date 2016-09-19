<?php 
$locations = headerMenu();
?>
<header class="header-outer">
    <logo class="logo cf">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/front/images/logo.png" alt="logo"></a>
    </logo>
    <nav class="menu cf">
        <ul class="cf">
            <?php
            if (!empty($locations)) {
                foreach ($locations as $location) {
                    ?>
                        <li><a href="<?php echo base_url('home/trip-country/'.$location->slug)?>" target="_blank"><?= $location->name ?></a></li>
                <?php
                }
            }
            ?>
            
        </ul>
    </nav>
    <div class="phone-no">
        <a href="#"><img src="<?php echo base_url(); ?>assets/front/images/phone-icone.png" alt="phone icone" class="display-none"><img src="<?php echo base_url(); ?>assets/front/images/phone-icone1.png" alt="phone icone" class="display">+44 203 287 3204</a>
    </div>
</header>