<?php
  if($this->session->flashdata('PostAdded')){
   ?>
  <div class="col-10 m-top-50">
    <div class="alert alert-dismissible alert-success">
      <div class="flash-data">
        <button type="button" class="close" data-dismiss="alert">X</button>
        <strong>Well Done !</strong><?= $this->session->flashdata('PostAdded');?>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
   <?php
  }
    ?>

    <div class="post-page">
    <?php
    if(empty($view_post))
    {
        echo'<h3>You have not made any Posts yet</h3> ';
    }
    else{
        
        ?>
        <div class="post-holder grey-bg m-top-40">
        <h3><?=$view_post['title']; ?></h3>
        <div class="post_details">
        <small><?=anchor('view_author_profile/'.$view_post['poster_id'],$view_post['firstname'].'&nbsp;'.$view_post['lastname']) ?></small>
        <small><?= ucfirst($view_post['category_name']) ?></small>
        </div>
            <p><?=$view_post['body']?></p>


        </div>
    <?php
      echo Modules::run('comments/postcomments/add_comment'); 
    }
    ?>
    </div>