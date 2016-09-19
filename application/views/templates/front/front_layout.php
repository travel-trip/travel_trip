<!DOCTYPE html>
<html lang="en" class="no-js sidebar-large">
    <head>
        <title><?php echo $title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="" name="description" />
        <meta content="themes-lab" name="author" />
        <?php $this->load->view('header/front_header'); ?>
        
        <script src="<?php echo base_url(); ?>assets/front/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/front/js/responsive-tabs.js"></script>
        <script src="<?php echo base_url(); ?>assets/front/js/jquery.slicknav.js"></script>
        <script src="<?php echo base_url(); ?>assets/front/js/select.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/front/js/jquery-ui.js"></script>
        

    </head>
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
    </script>

    <body>
        <div class="main-page">
                <?php echo $body; ?>
        </div>
        
        <?php $this->load->view('footer/front_footer'); ?>
        
        
        <script type="text/javascript">
                $( document ).ready(function() {
                    fakewaffle.responsiveTabs(['xs', 'sm']);
                });
                
                /********************8Header scroll js script**********************/
                
                $(window).on('scroll', function() {

                    var h = $('header').height();
                    var y = $(window).scrollTop();
                        var header = $('.header-outer');

                      if ((y > h + 30 ) && ($(window).outerWidth() > 768 ) ) {
                         header.addClass('opaque');       
                      }
                        else {
                           if (y < h + 30) {
                              header.removeClass('opaque');
                           }
                           else {
                              header.addClass('opaque');
                           }
                        }

                });
                
                /********************Slick Navigation js**********************/
                $('.menu ul').slicknav();
    </script>
        
    </body>
</html>
