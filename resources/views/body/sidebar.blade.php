<div class="left-side-menu">

    <div class="h-100" data-simplebar>



        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pos.index') }}">
                        <i class="mdi mdi-cash-register"></i>
                        <span> POS </span>
                    </a>
                </li>


                <li class="menu-title mt-2">Apps</li>

                <li>
                    <a href="#employee" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-tie-outline"></i>
                        <span>Employee Manage</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="employee">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.employees.index') }}">
                                    <i class="mdi mdi-account-multiple-outline"></i> All Employee
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.employees.create') }}">
                                    <i class="mdi mdi-account-plus-outline"></i> Add Employee
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#coustomer" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-cog-outline"></i>
                        <span>Customer Manage</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="coustomer">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.coustomer.index') }}">
                                    <i class="mdi mdi-account-multiple-outline"></i> All Customer
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.coustomer.create') }}">
                                    <i class="mdi mdi-account-plus-outline"></i> Add Customer
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#supplier" data-bs-toggle="collapse">
                        <i class="mdi mdi-truck-outline"></i>
                        <span>Supplier Manage</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="supplier">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.supplier.index') }}">
                                    <i class="mdi mdi-account-multiple-outline"></i> All Supplier
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.supplier.create') }}">
                                    <i class="mdi mdi-account-plus-outline"></i> Add Supplier
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#advancesalary" data-bs-toggle="collapse">
                        <i class="mdi mdi-cash-multiple"></i>
                        <span>Employee Salary</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="advancesalary">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.advance-salary.index') }}">
                                    <i class="mdi mdi-file-document-outline"></i> All Advance Salary
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.pay-salary.index') }}">
                                    <i class="mdi mdi-cash"></i> Pay Salary
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('admin.advance-salary.create') }}">
                                    <i class="mdi mdi-cash-plus"></i> Add Advance Salary
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.last-month-pay') }}">
                                    <i class="mdi mdi-calendar"></i> Last Month Salary
                                </a>
                            </li>


                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#employeeattendance" data-bs-toggle="collapse">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Employee Attendance</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="employeeattendance">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.employee-attendance.index') }}">
                                    <i class="mdi mdi-view-list"></i>
                                    Add Attendance
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.employee-attendance-list') }}">
                                    <i class="mdi mdi-calendar-plus"></i>
                                    All Attendance
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#category" data-bs-toggle="collapse">
                        <i class="mdi mdi-folder-outline"></i> <!-- Updated icon class here -->
                        <span>Category</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.category.index') }}">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    All Category
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#productMenu" data-bs-toggle="collapse">
                        <i class="mdi mdi-tag-multiple"></i> <!-- Icon for Product -->
                        <span>Product</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="productMenu">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.product.index') }}">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                    All Product
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product.create') }}">
                                    <i class="mdi mdi-plus-box"></i>
                                    Add Product
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.product-imported') }}">
                                    <i class="mdi mdi-database-import"></i>
                                    Import Product
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#order" data-bs-toggle="collapse">
                        <i class="mdi mdi-cart-outline"></i>
                        <span>Order</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="order">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.orderPending') }}">
                                    <i class="mdi mdi-clock-outline"></i>
                                    Pending Order
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.orderComplete') }}">
                                    <i class="mdi mdi-check-circle-outline"></i>
                                    Complete Orders
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#stock" data-bs-toggle="collapse">
                        <i class="mdi mdi-warehouse"></i>
                        <span>Stock Manage</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="stock">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.stock-index') }}">
                                    <i class="mdi mdi-clock-outline"></i>
                                    Stock
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#roleandpermisssion" data-bs-toggle="collapse">
                        <i class="mdi mdi-shield-account-outline"></i>
                        <span>Roles And Permission</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="roleandpermisssion">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.all-permission') }}">
                                    <i class="mdi mdi-shield-key-outline"></i>
                                    All Permissions
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.all-role') }}">
                                    <i class="mdi mdi-lock"></i>
                                    All Role
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.add-permission-to-role') }}">
                                    <i class="mdi mdi-account-key"></i>
                                    Role in Permission
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>









                <li>
                    <a href="#sidebarCrm" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> CRM </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCrm">
                        <ul class="nav-second-level">
                            <li>
                                <a href="crm-dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="crm-contacts.html">Contacts</a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarEmail" data-bs-toggle="collapse">
                        <i class="mdi mdi-email-multiple-outline"></i>
                        <span> Email </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEmail">
                        <ul class="nav-second-level">
                            <li>
                                <a href="email-inbox.html">Inbox</a>
                            </li>
                            <li>
                                <a href="email-read.html">Read Email</a>
                            </li>
                            <li>
                                <a href="email-compose.html">Compose Email</a>
                            </li>
                            <li>
                                <a href="email-templates.html">Email Templates</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Custom</li>

                <li>
                    <a href="#sidebarAuth" data-bs-toggle="collapse">
                        <i class="mdi mdi-account-circle-outline"></i>
                        <span>Expense </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarAuth">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.expense.create') }}">
                                    <i class="fas fa-plus-circle"></i>
                                    Add Expense
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.expense.index') }}">
                                    <i class="fas fa-calendar-day"></i>
                                    Today Expense
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.month-expense') }}">
                                    <i class="fas fa-calendar-alt"></i>
                                    Monthly Expense
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.year-expense') }}">
                                    <i class="fas fa-calendar"></i>
                                    Yearly Expense
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li>
                    <a href="#sidebarExpages" data-bs-toggle="collapse">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarExpages">
                        <ul class="nav-second-level">
                            <li>
                                <a href="pages-starter.html">Starter</a>
                            </li>
                            <li>
                                <a href="pages-timeline.html">Timeline</a>
                            </li>
                            <li>
                                <a href="pages-sitemap.html">Sitemap</a>
                            </li>
                            <li>
                                <a href="pages-invoice.html">Invoice</a>
                            </li>
                            <li>
                                <a href="pages-faqs.html">FAQs</a>
                            </li>
                            <li>
                                <a href="pages-search-results.html">Search Results</a>
                            </li>
                            <li>
                                <a href="pages-pricing.html">Pricing</a>
                            </li>
                            <li>
                                <a href="pages-maintenance.html">Maintenance</a>
                            </li>
                            <li>
                                <a href="pages-coming-soon.html">Coming Soon</a>
                            </li>
                            <li>
                                <a href="pages-gallery.html">Gallery</a>
                            </li>
                            <li>
                                <a href="pages-404.html">Error 404</a>
                            </li>
                            <li>
                                <a href="pages-404-two.html">Error 404 Two</a>
                            </li>
                            <li>
                                <a href="pages-404-alt.html">Error 404-alt</a>
                            </li>
                            <li>
                                <a href="pages-500.html">Error 500</a>
                            </li>
                            <li>
                                <a href="pages-500-two.html">Error 500 Two</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
