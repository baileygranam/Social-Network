<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($this->uri->segment(1) == 'timeline' || $this->uri->segment(1) == '') echo 'active'; ?>">
                <a class="nav-link" href="/timeline">Timeline</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'groups') echo 'active'; ?>">
                <a class="nav-link" href="/groups">Groups</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'friends') echo 'active'; ?>">
                <a class="nav-link" href="/friends">Friends</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'search') echo 'active'; ?>">
                <a class="nav-link" href="/search">Search</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="/dashboard"><img src="https://png.icons8.com/color/96/8A8A8A/facebook.png" width="40" height="40" class="d-inline-block align-top" alt="">
            Facebook</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <div class="dropdown show">
                <span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                    <img src="/uploads/<?php echo (empty($this->session->avatar)) ? 'default.jpg' : $this->session->avatar; ?>" class="profile-img" aria-haspopup="true" aria-expanded="false"> 
                    <?php echo ucfirst($this->session->first_name) . ' ' . ucfirst($this->session->last_name); ?>
                  </span>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/"><img src="https://image.flaticon.com/icons/svg/134/134105.svg" width="20"> Profile</a>
                    <a class="dropdown-item" href="/settings"><img src="https://image.flaticon.com/icons/svg/149/149294.svg" width="20"> Settings</a>
                    <a class="dropdown-item" href="/logout"><img src="https://image.flaticon.com/icons/svg/633/633671.svg" width="20"> Logout</a>
                  </div>
            </div>
        </ul>
    </div>
</nav>