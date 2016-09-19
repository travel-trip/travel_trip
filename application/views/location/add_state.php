<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Add state</title>

	
</head>
<body>

<div id="container">
    <?php
    echo validation_errors();
    $countries = getCountries();
    $attributes = array('class' => 'state', 'id' => 'state');
    echo form_open(base_url('state/addState'), $attributes);?>
    <select name="country_id" class="">
        <option value="">Select County</option>
        <?php foreach ($countries as $key => $country) { ?>
            <option value="<?= $key; ?>"><?= !empty($country) ? $country : NULL; ?></option>
        <?php } ?>
    </select>
    <input type="text" name = "name" class=""/>
    <input type="submit" value="Submit"/>
     <?phpecho form_close();?>

</div>

</body>
</html>