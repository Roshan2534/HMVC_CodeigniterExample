<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      
      <li class="nav-item">
       <?=anchor('latest_posts','Latest Post',array('class'=>'nav-link'));?>
      </li>
      
      <li class="nav-item">
       <?=anchor('add_posts','Add Post',array('class'=>'nav-link'));?>
      </li>
    </ul>
    <ul>
      <ul class="nav navbar-nav navbar-right">
      
      <?php
        if($this->session->userdata('is_logged_in')==FALSE)
        { 
      ?>
        <li class="nav-item">
       <?=anchor('register','Register',array('class'=>'nav-link'));?>
      </li>
      
      <li class="nav-item">
       <?=anchor('login','Login',array('class'=>'nav-link'));?>
      </li>

      <?php
        }
        else
        {
      ?>
        <li class="nav-item">
       <?=anchor('profile',$this->session->userdata('firstname'). '&nbsp;'.$this->session->userdata('lastname'),array('class'=>'nav-link'));?>
      </li>

        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Settings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?=anchor('my_post','My Posts',array('class'=>'dropdown-item'));?>
          <?=anchor('profile','Profile',array('class'=>'dropdown-item'));?>
          <?=anchor('dashboard','Dashboard',array('class'=>'dropdown-item'));?>
          <div class="dropdown-divider"></div>
          <?=anchor('logout','Logout',array('class'=>'dropdown-item'));?>
        </div>
      </li>
      <?php
        }
      ?>
    </ul>
  </div>
  </div>
</nav>