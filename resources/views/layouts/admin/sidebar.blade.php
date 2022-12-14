<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{route('dashboard')}}" class="waves-effect">
                        <i class="mdi mdi-speedometer"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Admin</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('user.index')}}" aria-expanded="false"><i class="fas fa-user"></i></i> Users</a></li>
                        <li><a href="{{ route('role.index')}}" aria-expanded="false"><i class="fa fa-tasks"></i> Roles</a></li>
                        <li><a href="{{ route('permission.index')}}" aria-expanded="false"><i class="fa fa-lock"></i> Permissions</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('vendors.index')}}" class="waves-effect">
                        <i class="fa fa-industry"></i>
                        <span>Vendor</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('seller.index')}}" class="waves-effect">
                        <i class="fa fa-store"></i>
                        <span>Seller</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('product-category.index')}}" class="waves-effect">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Product Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('product.index')}}" class="waves-effect">
                        <i class="fa fa-store"></i>
                        <span>Product</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('service-category.index')}}" class="waves-effect">
                        <i class="fa fa-list-alt" aria-hidden="true"></i>
                        <span>Service Category</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('service.index')}}" class="waves-effect">
                        <i class="fa fa-wrench" aria-hidden="true"></i>
                        <span>Service</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('company.index')}}" class="waves-effect">
                        <i class="fa fa-building" aria-hidden="true"></i>
                        <span>Company</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('customer.index')}}" class="waves-effect">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <span>Clients/Customer</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Transactions Sales</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('joborder.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i> Job Orders</a></li>
                        <li><a href="{{ route('billingadvice.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i> Billing Advice</a></li>
                        <li><a href="{{ route('draftbill.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i> Draft Bill</a></li>
                        <li><a href="{{ route('issuebill.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i> Issue Bill</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow" aria-expanded="false">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Transactions Purchase</span>
                    </a>
                    <ul class="sub-menu mm-collapse" aria-expanded="true">
                        <li><a href="{{ route('purchase.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i>Create P.O.</a></li>
                        <li><a href="{{ route('receivebill.index')}}" aria-expanded="false"><i class="fas fa-hand-point-right"></i> Receive Bills</a></li>
                    
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
