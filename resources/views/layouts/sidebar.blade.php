<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img style="border-radius:50%; width:40px; height:40px;" src="{{asset('user_photos/'.auth()->user()->getLoggedInUserLogo())}}"  alt="user-img" class="img-circle"><span class="hide-menu">{{auth()->user()->name}}</span></a>
                </li>
                @if(auth()->user()->category =='admin')
                <li> <a class="waves-effect waves-dark" href="/dashboard" aria-expanded="false"><i class="ti-home"></i><span class="hide-menu">Dashboard</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Clients</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/"><span class="hide-menu"> All Clients</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/get-riders-reg-form"><span class="hide-menu"> Register Client</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/todays-registered-riders"><span class="hide-menu"> Registered Today</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/trashed-riders"><span class="hide-menu"> Trashed Clients</span></a>
                        </li>
                        
                    </ul>
                    </li>
                    <li> <a class="waves-effect waves-dark" href="/adminmodule/fuel-stations"><i class="ti-spray"></i><span class="hide-menu"> Fuel Stations</span></a>
                    </li>
                    <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-book"></i><span class="hide-menu"> Transactions</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/get-todays-debt"><span class="hide-menu"> Todays Debts</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/get-todays-payments"><span class="hide-menu"> Todays Payments</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/all-debts"><span class="hide-menu"> All Debts</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/all-payments"><span class="hide-menu"> All Payments</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/specific-transaction"><span class="hide-menu"> specific Date</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/date-range-transaction"><span class="hide-menu"> Date Range</span></a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-move"></i><span class="hide-menu"> Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/todays-revenue"><span class="hide-menu"> Todays Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/all-revenue"><span class="hide-menu"> All Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/pending-debts"><span class="hide-menu"> Pending Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/overdue"><span class="hide-menu"> Overdue Debts</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/specific-transaction"><span class="hide-menu"> specific Date</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/adminmodule/date-range-transaction"><span class="hide-menu"> Date Range</span></a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-view-grid"></i><span class="hide-menu"> Towns</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/get-towns"><span class="hide-menu"> Towns</span></a>
                        </li>
                        <li> 
                        <a class="waves-effect waves-dark" href="/adminmodule/get-towns" aria-expanded="false"><span class="hide-menu">Town Clients</span></a>
                        </li>
                        <li> 
                        <a class="waves-effect waves-dark" href="/adminmodule/get-towns-with-revenue" aria-expanded="false"><span class="hide-menu">Town Revenue</span></a>
                        </li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu"> Account Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                       <li> <a class="waves-effect waves-dark" href="/get-users" aria-expanded="false"><span class="hide-menu"> Permissions</span></a></li>
                       <li> <a class="waves-effect waves-dark" href="/register-user" aria-expanded="false"><span class="hide-menu"> Register User</span></a></li>
                       <li> <a class="waves-effect waves-dark" href="/registered-users" aria-expanded="false"><span class="hide-menu"> Users</span></a></li>
                       
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="/reportmodule/field-staff" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Field Staff</span></a></li>
                <li> <a class="waves-effect waves-dark" href="/adminmodule/initial-deposit" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Initial Deposits</span></a></li>
                
                @elseif(auth()->user()->category =='staff')
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Clients</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/"><span class="hide-menu"> All Clients</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/get-riders-reg-form"><span class="hide-menu"> Register Client</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/todays-registered-riders"><span class="hide-menu"> Registered Today</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/trashed-riders"><span class="hide-menu"> Trashed Clients</span></a>
                        </li>
                     </ul>
                 </li>
                 <li> <a class="waves-effect waves-dark" href="/clientmodule/list_of_debtors"><i class=" ti-file"></i><span class="hide-menu"> Debtors</span></a>
                </li>
                 <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-book"></i><span class="hide-menu"> Transactions</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/get-todays-transactions"><span class="hide-menu"> Today</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/daily-transactions"><span class="hide-menu"> Daily</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/date-range-transactions"><span class="hide-menu"> Date Range</span></a></li>
                     </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-save-alt"></i><span class="hide-menu"> Report</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/todays-report"><span class="hide-menu"> Today</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/daily-report"><span class="hide-menu"> Daily</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/date-range-report"><span class="hide-menu"> Date Range</span></a></li>
                     </ul>
                </li>
                @else(auth()->user()->category =='fuel_station')
                <li> <a class="waves-effect waves-dark" href="/fuelstation/initial-deposit" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Initial Deposits</span></a></li>
                
                <li> <a class="waves-effect waves-dark" href="/fuelstation/search-client" aria-expanded="false"><i class="ti-search"></i><span class="hide-menu">Search Client</span></a></li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-book"></i><span class="hide-menu"> Transactions</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/get-todays-transactions"><span class="hide-menu"> Today</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/all-transactions"><span class="hide-menu"> Daily</span></a></li>
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/data-range-transactions"><span class="hide-menu"> Data Range</span></a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-move"></i><span class="hide-menu"> Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/todays-revenue"><span class="hide-menu"> Todays Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/all-revenue"><span class="hide-menu"> All Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/pending-debts"><span class="hide-menu"> Pending Revenue</span></a>
                        </li>
                        <li> <a class="waves-effect waves-dark" href="/fuelstation/overdue"><span class="hide-menu"> Overdue Debts</span></a>
                        </li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="/fuelstation/clients"><i class="ti-user"></i><span class="hide-menu"> Clients</span></a>
                </li>
                <li> <a class="waves-effect waves-dark" href="/adminmodule/get-riders-reg-form"><i class="ti-check"></i><span class="hide-menu"> Register Client</span></a>
                </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Side_bar scroll-->
</aside>
