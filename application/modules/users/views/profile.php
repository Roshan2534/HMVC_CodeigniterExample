<div class="profile-holder">
<div class="row grey-bg">
<div class="col-4 text-center">
<img src="<?= base_url();?>assets/images/users/<?=$user_profile['profile_pic'];?>" class="img-fluid" alt=""/>
<?= anchor('edit_profile_pic','Edit Profile Pic '); ?>
</div>
<div class="col-8 m-top-15">
<p><strong>Name</strong>:- <?= $user_profile['firstname'].'&nbsp;'.$user_profile['lastname']?></p>
<p><strong>Email</strong>:- <?=$user_profile['email']; ?></p>
<p><strong>Gender</strong>:- <?=$user_profile['gender']; ?></p>
<p><strong>About</strong>:- <?=$user_profile['about']; ?></p>
<?= anchor('edit_profile','Edit Profile',array('class'=>'btn btn-primary')); ?>
</div>


</div>
</div>