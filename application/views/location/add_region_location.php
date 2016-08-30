<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Region Loction</title>
        
        
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
</head>
<body>

<div id="container">
    <?php
    $countries = getCountries();
    $region_levels = $this->config->item('region_level');
    $attributes = array('class' => 'state', 'id' => 'state');
    echo form_open(base_url('region/addRegionLocations'), $attributes);?>
    
    <label>Region Type</label>
    <select name="type" class="" id="region-type">
        <option value="">Select Type</option>
        <?php foreach ($region_levels as $key => $value) { ?>
            <option value="<?= $key; ?>"><?= !empty($value) ? $value : NULL; ?></option>
        <?php } ?>
    </select>
    
    
    <?php $regions = getRegions();?>
    
    <select name="region_id" class="">
        <option value="">Select Region</option>
        <?php foreach ($regions as $key => $region) { ?>
            <option value="<?= $key; ?>"><?= !empty($region) ? $region : NULL; ?></option>
        <?php } ?>
    </select>
   
    
    
    <input type="text" name = "cover_loction" id="search-item"/>
    
    <select name="country_id" class="" id="country-list" style="display: none">
        <option value=''>Select County</option>
        <?php foreach ($countries as $key => $country) { ?>
            <option value="<?= $key; ?>"><?= !empty($country) ? $country : NULL; ?></option>
        <?php } ?>
    </select>
    
    <input type="submit" value="Submit"/>
     <?phpecho form_close();?>

</div>

</body>
</html>

<script type="text/javascript">
    
    var baseUrl = '<?php echo base_url();?>';
    $(document).ready(function () {
        $('#region-type').on('change', function (e) {
            e.preventDefault();
            var type = $(this).val();
            if(type == 2){
                $('#country-list').show();
            }
        });
    });
    
    $("#search-item").autocomplete({
        source: baseUrl+"ajaxController/get_location_point",
        minLength: 1
});
</script>