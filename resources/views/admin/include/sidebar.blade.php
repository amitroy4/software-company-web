<!-- Sidebar -->
<div class="sidebar sidebar-style-2">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="blue">
            <a href="{{route('dashboard')}}" class="logo">
             <img src="{{ asset('storage/' . ($setting->logo_light ?? 'Qbit_Logo_Main.png')) }}" alt="navbar brand" class="navbar-brand" height="35">


            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <!--HRM Portion-->
            <ul class="nav nav-secondary">
                <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <a href="javascript:void(0);" class=" bg-dark-100">
                        <p class="text-muted text-uppercase text-small">Website Management</p>
                    </a>
                </li>

                <li class="nav-item submenu {{ Route::currentRouteName() == 'slider.index' || Route::currentRouteName() == 'action.index' || Route::currentRouteName() == 'application.index' || Route::currentRouteName() == 'counter.index' || Route::currentRouteName() == 'why-work.index' || Route::currentRouteName() == 'testimonial' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#home-page-elements">
                        <i class='bx bx-layout'></i>
                        <p>Home Page Elements</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::currentRouteName() == 'slider.index' || Route::currentRouteName() == 'action.index' || Route::currentRouteName() == 'application.index' || Route::currentRouteName() == 'counter.index' || Route::currentRouteName() == 'why-work.index' || Route::currentRouteName() == 'testimonial' ? 'show' : '' }}" id="home-page-elements">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'slider.index' ? 'active' : '' }}">
                                <a href="{{ route('slider.index') }}">
                                    <span class="sub-item">Slider</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'action.index' ? 'active' : '' }}">
                                <a href="{{ route('action.index') }}">
                                    <span class="sub-item">Call To Action</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'application.index' ? 'active' : '' }}">
                                <a href="{{ route('application.index') }}">
                                    <span class="sub-item">Application</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'counter.index' ? 'active' : '' }}">
                                <a href="{{ route('counter.index') }}">
                                    <span class="sub-item">Main Counter</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'why-work.index' ? 'active' : '' }}">
                                <a href="{{ route('why-work.index') }}">
                                    <span class="sub-item">Why Work With Us</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'testimonial' ? 'active' : '' }}">
                                <a href="{{ route('testimonial') }}">
                                    <span class="sub-item">Testimonial</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item submenu {{ Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'service.index' || Route::currentRouteName() == 'product.index' || Route::currentRouteName() == 'client' || Route::currentRouteName() == 'cover-image' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#page-content">
                        <i class='bx bx-file'></i>
                        <p>Page Content</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::currentRouteName() == 'about-us' || Route::currentRouteName() == 'service.index' || Route::currentRouteName() == 'product.index' || Route::currentRouteName() == 'client' || Route::currentRouteName() == 'cover-image' ? 'show' : '' }}" id="page-content">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'about-us' ? 'active' : '' }}">
                                <a href="{{ route('about-us') }}">
                                    <span class="sub-item">About Us</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'service.index' ? 'active' : '' }}">
                                <a href="{{ route('service.index') }}">
                                    <span class="sub-item">Service</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'product.index' ? 'active' : '' }}">
                                <a href="{{ route('product.index') }}">
                                    <span class="sub-item">Products</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'client' ? 'active' : '' }}">
                                <a href="{{ route('client') }}">
                                    <span class="sub-item">Client</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'cover-image' ? 'active' : '' }}">
                                <a href="{{ route('cover-image') }}">
                                    <span class="sub-item">Cover Images</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item mt-3">
                    <a href="javascript:void(0);" class=" bg-dark-100">
                        <p class="text-muted text-uppercase text-small"> Management and Career</p>
                    </a>
                </li>

                <li class="nav-item {{ Request::routeIs('management.body.index', 'member.index') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#power_house_team">
                        <i class='bx bxs-user-account' ></i>
                        <span class="sub-item">Power House Team</span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('management.body.index', 'member.index') ? 'show' : '' }}" id="power_house_team">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'management.body.index' ? 'active' : '' }}">
                                <a href="{{ route('management.body.index') }}">
                                    <i class='bx bxs-user-detail' ></i>
                                    <span class="sub-item">Management Body</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'member.index' ? 'active' : '' }}">
                                <a href="{{ route('member.index') }}">
                                    <i class='bx bxs-user'></i>
                                    <span class="sub-item">Powerful Team</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                {{-- <li class="nav-item {{ Route::currentRouteName() == 'client' ? 'active' : '' }}">
                    <a href="{{ route('client') }}">
                        <i class='bx bxs-carousel'></i>
                        <span class="sub-item">Clients</span>
                    </a>
                </li> --}}

                {{--
                <li class="nav-item {{ Route::currentRouteName() == 'contact.messages' ? 'active' : '' }}">
                    <a href="{{ route('contact.messages') }}">
                        <i class='bx bx-message-square'></i>
                        <span class="sub-item">Messages</span>
                    </a>
                </li>
                --}}

                <li class="nav-item {{ Route::currentRouteName() == 'career.index' ? 'active' : '' }}">
                    <a href="{{ route('career.index') }}">
                        <i class='bx bxs-briefcase'></i>
                        <p>Career Opprotunity</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a href="javascript:void(0);" class=" bg-dark-100">
                        <p class="text-muted text-uppercase text-small">Media & Communication</p>
                    </a>
                </li>

                <li class="nav-item submenu {{ Route::is('album.index') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#gallery">
                        <i class='bx bx-images' ></i>
                        <p>Gallery</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Route::is('album.index') ? 'show' : '' }}" id="gallery">
                        <ul class="nav nav-collapse ">
                            <li class="{{ Route::is('album.index') ? 'active' : '' }}"><a href="{{ route('album.index') }}"><span class="sub-item">Album</span></a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Request::routeIs('contact.messages.unread', 'contact.messages.read') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#messagesMenu">
                        <i class='bx bx-message-square'></i>
                        <span class="sub-item">Messages</span>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('contact.messages.unread', 'contact.messages.read') ? 'show' : '' }}" id="messagesMenu">
                        <ul class="nav nav-collapse">
                            <li class="{{ Route::currentRouteName() == 'contact.messages.unread' ? 'active' : '' }}">
                                <a href="{{ route('contact.messages.unread') }}">
                                    <i class='bx bx-envelope'></i>
                                    <span class="sub-item">Unread Messages</span>
                                </a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'contact.messages.read' ? 'active' : '' }}">
                                <a href="{{ route('contact.messages.read') }}">
                                    <i class='bx bx-envelope-open'></i>
                                    <span class="sub-item">Read Messages</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>






                {{-- <li class="nav-item {{ Route::currentRouteName() == 'faq' ? 'active' : '' }}">
                    <a href="{{ route('faq') }}">
                        <i class='bx bx-question-mark'></i>
                        <span class="sub-item">FAQs</span>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}">
                    <a href="{{ route('contact') }}">
                        <i class='bx bxs-phone-call'></i>
                        <span class="sub-item">Contact Us</span>
                    </a>
                </li> --}}
                <li class="nav-item {{ Route::currentRouteName() == 'blog.index' ? 'active' : '' }}">
                    <a href="{{ route('blog.index') }}">
                        <i class='bx bxl-blogger'></i>
                        <p>Blog</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <a href="javascript:void(0);" class=" bg-dark-100">
                        <p class="text-muted text-uppercase text-small">System</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'setting.index' ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}">

                        <i class='bx bxs-cog'></i>
                        <span class="sub-item">Settings</span>
                    </a>
                </li>
                {{-- @canany(['ShowSideBar User', 'ShowSideBar Role','ShowSideBar Permission'])
                <li
                    class="nav-item {{ Request::routeIs('manageuser.*', 'manageuserrole.*', 'permission.*') ? 'active submenu' : '' }}">
                    <a data-bs-toggle="collapse" href="#manageusers">
                        <i class="fas fa-user-shield"></i>
                        <p>User Management</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ Request::routeIs('manageuser.*', 'manageuserrole.*', 'permission.*') ? 'show' : '' }}"
                        id="manageusers">
                        <ul class="nav nav-collapse">
                            @can("ShowSideBar User")
                            <li class="{{ Route::currentRouteName() == 'manageuser.index' ? 'active' : '' }}">
                                <a href="{{route('manageuser.index')}}">
                                    <i class="fas fa-users"></i>
                                    <span class="sub-item">Users</span>
                                </a>
                            </li>
                            @endcan
                            @can("ShowSideBar Role")
                            <li class="{{ Route::currentRouteName() == 'manageuserrole.index' ? 'active' : '' }}">
                                <a href="{{route('manageuserrole.index')}}">
                                    <i class="fas fa-users-cog"></i>
                                    <span class="sub-item">Role</span>
                                </a>
                            </li>
                            @endcan
                            @can("ShowSideBar Permission")
                            <li class="{{ Route::currentRouteName() == 'permission.index' ? 'active' : '' }}">
                                <a href="{{route('permission.index')}}">
                                    <i class="fas fa-key"></i>
                                    <span class="sub-item">Permission</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany --}}

                @can('ShowSideBar Maintenance')
                <li class="nav-item {{ Route::currentRouteName() == 'maintenance' ? 'active' : '' }}">
                    <a href="{{ route('maintenance') }}">
                        <i class="fas fa-wrench"></i>
                        <p>Maintenance</p>
                    </a>
                </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
