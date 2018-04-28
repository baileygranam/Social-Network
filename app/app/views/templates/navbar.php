<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php if($this->uri->segment(1) == 'dashboard') echo 'active'; ?>">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'messages') echo 'active'; ?>">
                <a class="nav-link" href="/messages">Messages</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'teams') echo 'active'; ?>">
                <a class="nav-link" href="/teams">Teams</a>
            </li>
            <li class="nav-item <?php if($this->uri->segment(1) == 'colleagues') echo 'active'; ?>">
                <a class="nav-link" href="/colleagues">Colleagues</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class="navbar-brand mx-auto" href="/dashboard"><img src="https://image.flaticon.com/icons/svg/222/222545.svg" width="40" height="40" class="d-inline-block align-top" alt="">
            Iluminous</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <div class="dropdown show">
                <span class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">
                    <img src="https://media.licdn.com/dms/image/C5103AQE6vXK_Uptc9A/profile-displayphoto-shrink_200_200/0?e=1530111600&v=beta&t=jAQ-47DgFBCPdl2aaGVsB5ABcjwknMuhEJ9IGnPL-uA" class="profile-img" aria-haspopup="true" aria-expanded="false"> Bailey Granam
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