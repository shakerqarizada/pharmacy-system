  @php
    $usersOpen = request()->routeIs('add-user') || request()->routeIs('view-users') || request()->routeIs('user.*');
    $categoriesOpen = request()->routeIs('add-category') || request()->routeIs('view-categories') || request()->routeIs('categories.*');
    $suppliersOpen = request()->routeIs('add-supplier') || request()->routeIs('view-suppliers') || request()->routeIs('suppliers.*');
    $medicinesOpen = request()->routeIs('add-medicine') || request()->routeIs('view-medicines') || request()->routeIs('medicines.*');
    $customersOpen = request()->routeIs('add-customer') || request()->routeIs('view-customers') || request()->routeIs('customer.*') || request()->routeIs('customers.*');
    $salesOpen = request()->routeIs('add-sales') || request()->routeIs('view-sales') || request()->routeIs('sales.*');
  @endphp

  <div class="app-sidebar-menu">
          <div class="h-100" data-simplebar>
          <div id="sidebar-menu">
       

            <ul id="side-menu">

              <li class="menu-title">Menu</li>

              <li class="{{ request()->routeIs('dashboard') ? 'menuitem-active' : '' }}">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                  <i data-feather="home"></i>
                  <span> Dashboard </span>
                </a>
              </li>

              <li class="{{ $usersOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarUsers" data-bs-toggle="collapse" aria-expanded="{{ $usersOpen ? 'true' : 'false' }}">
                  <i data-feather="users"></i>
                  <span> Users </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $usersOpen ? 'show' : '' }}" id="sidebarUsers">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-user') }}" class="tp-link {{ request()->routeIs('add-user') ? 'active' : '' }}">Add New User</a>
                    </li>
                    <li>
                      <a href="{{ route('view-users') }}" class="tp-link {{ request()->routeIs('view-users') ? 'active' : '' }}">View Users</a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="{{ $categoriesOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarCategories" data-bs-toggle="collapse" aria-expanded="{{ $categoriesOpen ? 'true' : 'false' }}">
                  <i data-feather="grid"></i>
                  <span> Categories </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $categoriesOpen ? 'show' : '' }}" id="sidebarCategories">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-category') }}" class="tp-link {{ request()->routeIs('add-category') ? 'active' : '' }}">Add New Category</a>
                    </li>
                    <li>
                      <a href="{{ route('view-categories') }}" class="tp-link {{ request()->routeIs('view-categories') ? 'active' : '' }}">View Categories</a>
                    </li>
                  </ul>
                </div>
              </li>

              <li class="{{ $suppliersOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarSuppliers" data-bs-toggle="collapse" aria-expanded="{{ $suppliersOpen ? 'true' : 'false' }}">
                  <i data-feather="truck"></i>
                  <span> Suppliers </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $suppliersOpen ? 'show' : '' }}" id="sidebarSuppliers">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-supplier') }}" class="tp-link {{ request()->routeIs('add-supplier') ? 'active' : '' }}">Add New Supplier</a>
                    </li>
                    <li>
                      <a href="{{ route('view-suppliers') }}" class="tp-link {{ request()->routeIs('view-suppliers') ? 'active' : '' }}">View Suppliers</a>
                    </li>
                  </ul>
                </div>
              </li>

              {{-- Medicine Start --}}
              <li class="{{ $medicinesOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarMedicines" data-bs-toggle="collapse" aria-expanded="{{ $medicinesOpen ? 'true' : 'false' }}">
                  <i data-feather="package"></i>
                  <span> Medicines </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $medicinesOpen ? 'show' : '' }}" id="sidebarMedicines">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-medicine') }}" class="tp-link {{ request()->routeIs('add-medicine') ? 'active' : '' }}">Add New Medicine</a>
                    </li>
                    <li>
                      <a href="{{ route('view-medicines') }}" class="tp-link {{ request()->routeIs('view-medicines') ? 'active' : '' }}">View Medicines</a>
                    </li>
                  </ul>
                </div>
              </li>
              {{-- Customers Start --}}
              <li class="{{ $customersOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarCustomers" data-bs-toggle="collapse" aria-expanded="{{ $customersOpen ? 'true' : 'false' }}">
                  <i data-feather="user"></i>
                  <span> Customers </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $customersOpen ? 'show' : '' }}" id="sidebarCustomers">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-customer') }}" class="tp-link {{ request()->routeIs('add-customer') ? 'active' : '' }}">Add New Customer</a>
                    </li>
                    <li>
                      <a href="{{ route('view-customers') }}" class="tp-link {{ request()->routeIs('view-customers') ? 'active' : '' }}">View Customers</a>
                    </li>
                  </ul>
                </div>
              </li>
              {{-- Customers End --}}
              {{-- Sales Start --}}
              <li class="{{ $salesOpen ? 'menuitem-active' : '' }}">
                <a href="#sidebarSales" data-bs-toggle="collapse" aria-expanded="{{ $salesOpen ? 'true' : 'false' }}">
                  <i data-feather="shopping-cart"></i>
                  <span> Sales </span>
                  <span class="menu-arrow"></span>
                </a>
                <div class="collapse {{ $salesOpen ? 'show' : '' }}" id="sidebarSales">
                  <ul class="nav-second-level">
                    <li>
                      <a href="{{ route('add-sales') }}" class="tp-link {{ request()->routeIs('add-sales') ? 'active' : '' }}">Add New Sale</a>
                    </li>
                    <li>
                      <a href="{{ route('view-sales') }}" class="tp-link {{ request()->routeIs('view-sales') ? 'active' : '' }}">View Sales</a>
                    </li>
                  </ul>
                </div>
              </li>

{{-- Sales End --}}

              <li class="menu-title">Account</li>
              <li class="{{ request()->routeIs('profile.edit') ? 'menuitem-active' : '' }}">
                <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                  <i data-feather="settings"></i>
                  <span> Profile </span>
                </a>
              </li>
              <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i data-feather="log-out"></i>
                  <span> Logout </span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </li>
            </ul>
          </div>

          <div class="clearfix"></div>
        </div>
      </div>