<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Update state</title>

	
</head>
<body>

<div id="container">
    <?php
    echo validation_errors();
    $countries = getCountries();
    $attributes = array('class' => 'state', 'id' => 'state');
    echo form_open(base_url('state/editState'.$EDIT_DATA->id), $attributes);?>
    <select name="country_id" class="">
        <option value="">Select County</option>
        <?php foreach ($countries as $key => $country) {
            $sel = (isset($EDIT_DATA->country_id) && $EDIT_DATA->country_id == $key) ? "selected" : "";
            ?>
            <option value="<?= $key; ?>" <?=$sel;?>><?= !empty($country) ? $country : NULL; ?></option>
        <?php } ?>
    </select>
    <input type="text" name = "name" class="" value="<?php echo !empty($EDIT_DATA->name) ? $EDIT_DATA->name : '' ?>"/>
    <input type="submit" value="Submit"/>
     <?phpecho form_close();?>

</div>

</body>
</html>