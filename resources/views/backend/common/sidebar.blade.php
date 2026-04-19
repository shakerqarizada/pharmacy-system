  <div class="app-sidebar-menu">
        <div class="h-100" data-simplebar>
          <!--- Sidemenu -->
          <div id="sidebar-menu">
            <div class="logo-box">
              <a href="index.html" class="logo logo-light">
                <span class="logo-sm">
                  <img src={{ asset('backend/assets/images/logo-sm.png') }} alt="" height="22" />
                </span>
                <span class="logo-lg">
                  <img src={{ asset('backend/assets/images/logo-light.png') }} alt="" height="24" />
                </span>
              </a>
              <a href="index.html" class="logo logo-dark">
                <span class="logo-sm">
                  <img src={{ asset('backend/assets/images/logo-sm.png') }} alt="" height="22" />
                </span>
                <span class="logo-lg">
                  <img src={{ asset('backend/assets/images/logo-dark.png') }} alt="" height="24" />
                </span>
              </a>
            </div>

            <ul id="side-menu">
              
              <li class="menu-title">Menu</li>

              <li>
                <a href="#sidebarDashboards" data-bs-toggle="collapse">
                  <i data-feather="home"></i>
                  <span> Users </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarDashboards">
                  <ul class="nav-second-level">
                    <li>
                      <a href={{ route('add-user') }} class="tp-link">Add New User</a>
                    </li>
                    <li>
                      <a href={{ route('view-users') }} class="tp-link">View Users</a>
                    </li>
                  </ul>
                </div>
              </li>
              

              <li>
                <a href="#sidebarCategories" data-bs-toggle="collapse">
                  <i data-feather="home"></i>
                  <span> Categories </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarCategories">
                  <ul class="nav-second-level">
                    <li>
                      <a href={{ route('add-category') }} class="tp-link">Add New Category</a>
                    </li>
                    <li>
                      <a href={{ route('view-categories') }} class="tp-link">View Categories</a>
                    </li>
                  </ul>
                </div>
              </li>

              <li>
                <a href="#sidebarSuppliers" data-bs-toggle="collapse">
                  <i data-feather="home"></i>
                  <span> Suppliers </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse" id="sidebarSuppliers">
                  <ul class="nav-second-level">
                    <li>
                      <a href={{ route('add-supplier') }} class="tp-link">Add New Supplier</a>
                    </li>
                    <li>
                      <a href={{ route('view-suppliers') }} class="tp-link">View Suppliers</a>
                    </li>
                  </ul>
                </div>
              </li>


            </ul>
          </div>
          <!-- End Sidebar -->

          <div class="clearfix"></div>
        </div>
      </div>