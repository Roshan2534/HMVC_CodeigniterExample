<div class="grey-bg add-post m-top-10">
<?php
  if ($this->session->userdata('is_logged_in') == FALSE)
  {
    echo 'You need to Login to ' .anchor('login', 'Add comment', array('class'=>'btn btn-primary'));
  }
  else
  {
  ?>


<h2>Add comment</h2>
<?php
$hidden=array(
    'commenter_id'=>$this->session->userdata('user_id'),
    'post_id'=>$this->uri->segment(2)
);

$comment_body=array(
    'name'=>'comment_body',
    'class'=>'form-control m-top-10',
    'rows'=> '5',
    'cols'=> '10',
    'id'=>'comment_body',
    'placeholder'=>'Enter you comment',
    'value'=>set_value('comment_body')
);
$comment_submit = array(
    'name' => 'comment_submit',
    'class' => 'btn btn-primary m-top-10',
    'value' => 'Comment'
  );
  echo form_open('save_comment', array('class'=>'form-horizontal m-top-50'), $hidden);

  

  echo form_textarea($comment_body);
  echo '<div class="error">'.form_error('comment_body').'</div>';

 

  echo form_submit($comment_submit);


  echo form_close();
  }
?>
</div>