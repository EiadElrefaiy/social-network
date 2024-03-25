<div class="iq-top-navbar">
          <div class="iq-navbar-custom">
              <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-navbar-logo d-flex justify-content-between">
                  </div>
                  <div class="iq-search-bar device-search">
                      <form action="{{route('user.search')}}" method="POST" class="searchbox">
                        @csrf
                          <label style="cursor: pointer;" for="searchInput" class="search-link"><i class="ri-search-line"></i></label>
                          <input name="value" type="text" class="text search-input" placeholder="Search here...">
                      </form>
                  </div>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                      aria-label="Toggle navigation">
                      <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <ul class="navbar-nav  ms-auto navbar-list">
                          <li>
                              <a href="{{route('home')}}" class="  d-flex align-items-center">
                                  <i class="ri-home-line"></i>
                              </a>
                          </li>

                          <li class="nav-item dropdown">
                            <a href="#" class="search-toggle dropdown-toggle" id="notification-drop" data-bs-toggle="dropdown">
                                <i class="ri-notification-4-line"></i>
                            </a>
                            <div class="sub-drop dropdown-menu" aria-labelledby="notification-drop">
                                <div class="card shadow-none m-0">
                                    <div class="card-header d-flex justify-content-between bg-primary">
                                        <div class="header-title bg-primary">
                                            <h5 class="mb-0 text-white">All Notifications</h5>
                                        </div>
                                        <small class="badge bg-light text-dark">4</small>
                                    </div>
                                    <div class="card-body p-0" id="notification-list">
                                        <!-- Notifications will be dynamically inserted here -->
                                    </div>
                                </div>
                            </div>
                        </li>
                           <li class="nav-item dropdown">
                              <a href="#" class="   d-flex align-items-center dropdown-toggle" id="drop-down-arrow" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              @if (auth()->user()->image)
                              <img src="{{ asset('storage/images/users/' . auth()->user()->image) }}" class="img-fluid rounded-circle me-3" alt="user">
                              @else
                              <img src="{{URL::asset('assets/images/user/default.jpg')}}" class="img-fluid rounded-circle me-3" alt="user">
                              @endif
                                  <div class="caption">
                                      <h6 class="mb-0 line-height">{{auth()->user()->name}}</h6>
                                  </div>
                              </a>
                              <div class="sub-drop dropdown-menu caption-menu" aria-labelledby="drop-down-arrow">
                                  <div class="card shadow-none m-0">
                                       <div class="card-header  bg-primary">
                                          <div class="header-title">
                                              <h5 class="mb-0 text-white">Hello {{auth()->user()->name}}</h5>
                                              <span class="text-white font-size-12">Available</span>
                                          </div>
                                      </div>
                                      <div class="card-body p-0 ">
                                          <a href="{{ route('user.profile', ['user' => auth()->user()->id]) }}" class="iq-sub-card iq-bg-primary-hover">
                                              <div class="d-flex align-items-center">
                                                  <div class="rounded card-icon bg-soft-primary">
                                                      <i class="ri-file-user-line"></i>
                                                  </div>
                                                  <div class="ms-3">
                                                      <h6 class="mb-0 ">My Profile</h6>
                                                      <p class="mb-0 font-size-12">View personal profile details.</p>
                                                  </div>
                                              </div>
                                          </a>
                                          <a href="{{ route('edit.profile')}}" class="iq-sub-card iq-bg-primary-hover">
                                              <div class="d-flex align-items-center">
                                                  <div class="rounded card-icon bg-soft-warning">
                                                      <i class="ri-profile-line"></i>
                                                  </div>
                                                  <div class="ms-3">
                                                      <h6 class="mb-0 ">Edit Profile</h6>
                                                      <p class="mb-0 font-size-12">Modify your personal details.</p>
                                                  </div>
                                              </div>
                                          </a>
                                          <div class="d-inline-block w-100 text-center p-3">
                                            <form action="{{route('logout')}}" method="POST">
                                             @csrf
                                             <button class="btn btn-primary iq-sign-btn" href="../dashboard/sign-in.html" role="button">Signout<i class="ri-login-box-line ms-2"></i></button>
                                            </form>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </li>
                      </ul>               
                  </div>
              </nav>
          </div>
      </div>       
