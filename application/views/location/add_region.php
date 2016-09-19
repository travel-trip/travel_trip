<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add Region</title>

	
</head>
<body>

<div id="container">
    <?php
    $region_levels = $this->config->item('region_level');
    $attributes = array('class' => 'state', 'id' => 'state');
    echo form_open(base_url('region/addRegion'), $attributes);?>
    <label>Region Location</label>
    <input type="text" name = "loctions" class=""/>
    
    <label>Region Type</label>
    <select name="type" class="">
        <option value="">Select Type</option>
        <?php foreach ($region_levels as $key => $value) { ?>
            <option value="<?= $key; ?>"><?= !empty($value) ? $value : NULL; ?></option>
        <?php } ?>
    </select>
    
    <input type="submit" value="Submit"/>
     <?phpecho form_close();?>

</div>

</body>
</html>