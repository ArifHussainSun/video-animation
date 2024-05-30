<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>

                <li>
                    <a href="{{ route('admin.dashboard')}}" class="waves-effect">
                        <i class="bx bx-home-circle"></i><span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">Dashboard</span>
                    </a>

                </li>
                <li>
                    <a href="{{ route('admin-notification.main')}}" class="waves-effect">

                        <?php
                        // $notify=  App\Models\Notification::where('active', 1)->count();
                        ?>
                        <i class="bx bx-bell"></i>
                        <span class="badge bg-danger rounded-pill float-end"></span>
                        <span key="t-dashboards">Notifications</span>
                        <span class="badge bg-danger rounded-pill float-end"></span>

                    </a>

                </li>
                <!-- <li><a href="{{ url('invoice')}}">Invoice</a></li> -->
                @can('Customer-View')
                <li>
                    <a href="#" class="waves-effect">
                        <i class="fa fa-user"></i><span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">Customers</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a href="{{ route('customer.list')}}">Customers List</a></li>

                    </ul>
                </li>
                @endcan

                @can('Payment-View')
                <li>
                    <a href="#" class="waves-effect">
                        <i class="fa fa-credit-card"></i><span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">Payment</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a href="{{ route('payment.list')}}">Payment List</a></li>
                        @can('PaymentLinkGenerator-View')
                        <li><a href="{{ route('payment-link-generator.list') }}">Link Generator</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('User-View','Role-View','Permission-Create')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-group"></i>
                        <span key="t-tasks">User Management</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        @can('User-View')
                        <li><a href="{{ route('user.list')}}">User List</a></li>
                        @endcan
                        @can('Role-View')
                        <li><a href="{{ route('role.list')}}">Roles</a></li>
                        @endcan
                        @can('Permission-View')
                        <li><a href="{{ route('permission.list')}}">Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan

                @can('ContactQueries-View')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-chat"></i><span class="badge rounded-pill bg-info float-end"></span>
                        <span key="t-dashboards">Lead</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li><a href="{{ route('contact-queries.list')}}">Contact Query</a></li>
                        @can('Subscriber-View')
                        <li><a href="{{ route('subscriber.list')}}">Subscribers</a></li>
                        @endcan
                        @can('Brief-View')
                        <li><a href="{{ route('brief.list')}}">Brief</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                @hasanyrole('Admin|Brand Manager|Developer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fab fa-product-hunt"></i>
                        <span key="t-tasks">Pricing</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        @can('Product-View')
                        <li><a href="{{ route('product.list')}}">Single Package</a></li>
                        @endcan

                        @can('Product-View')
                        <li><a href="{{ route('product-bundle.list')}}">Package Bundle</a></li>
                        @endcan

                        @can('Categories-View')
                        <li><a href="{{ route('categories.list') }}">Category</a></li>
                        @endcan

                        @can('SubCategories-View')
                        <li><a href="{{ route('sub-category.list')}}">Sub Category</a></li>
                        @endcan
                    </ul>
                </li>
                @endhasanyrole
                @hasanyrole('Admin|Brand Manager|Developer|Customer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="far fa-address-card"></i>
                        <span key="t-tasks">Portfolio</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        @can('Portfolio-View')
                        <li><a href="{{ route('portfolio.list')}}">Portfolio</a></li>
                        @endcan
                        @can('Service-View')
                        <li><a href="{{ route('service.list')}}">Service</a></li>
                        @endcan
                    </ul>
                </li>
                @endhasanyrole
                
                @hasanyrole('Admin|Brand Manager|Developer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-slider-alt"></i>
                        <span key="t-tasks">CMS</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        @can('EmailTemplate-View')
                        <li><a href="{{ route('emailtemplate.list') }}">Email Template</a></li>
                        @endcan

                        @can('Page-View')
                        <li><a href="{{ route('page.list')}}">Web Page</a></li>
                        @endcan

                        @can('Testimonial-View')
                        <li><a href="{{ route('testimonial.list')}}">Testimonial</a></li>
                        @endcan

                        @can('Faq-View')
                        <li><a href="{{ route('faq.list')}}">FAQ's</a></li>
                        @endcan

                        @can('Partner-View')
                        <li><a href="{{ route('partner.list')}}">Partner</a></li>
                        @endcan

                        @can('Gallery-View')
                        <li><a href="{{ route('gallery.list')}}">Galleries</a></li>
                        @endcan

                        @can('Partner-View')
                        <li><a href="{{ route('banner.list')}}">Banners</a></li>
                        @endcan
                    </ul>
                </li>
                @endhasanyrole
                @hasanyrole('Admin|Brand Manager|Developer')
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-globe"></i>
                        <span key="t-tasks">Brand Setting</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="false">
                        <li>
                        <li><a href="{{ route('admin-brand-settings-general-setting')}}">General Setting</a></li>
                        <!-- <li><a href="{{ route('admin-brand-settings-contact-information-form')}}">Contact Infomation</a></li>
                        <li><a href="{{ route('admin-brand-settings-social-link-form')}}">Social Links</a></li>
                        <li><a href="{{ route('admin-brand-settings.logos')}}">Logo & Favicon</a></li> -->
                        <li><a href="{{ route('admin-brand-settings-custom-header-footer-form')}}">Custom Header & Footer</a></li>
                        <li><a href="{{ route('admin-brand-settings-mail-setting-form')}}">Mail Setting</a></li>
                        <li><a href="{{ route('coupon.list')}}">Coupon</a></li>
                        <li><a href="{{ route('admin-brand-settings.payment-setting-form')}}">Payment Setting</a></li>
                    </ul>
                </li>
                @endhasanyrole

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
