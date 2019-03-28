<?php
$attr=array(
    'name'=>'category',
    'class'=>'form-control m-top-10'
);
$drop=array(''=>'Select a Category');
foreach($categories as $cat):
    $drop[$cat['id']]=$cat['category_name'];
endforeach;

    echo form_dropdown($attr,$drop);
?>
