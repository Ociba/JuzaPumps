<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img style="border-radius:50%; width:40px; height:40px;" src="{{asset('user_photos/'.auth()->user()->getLoggedInUserLogo())}}"  alt="user-img" class="img-circle"><span class="hide-menu">{{auth()->user()->name}}</span></a>
                </li>
                @if(in_array('Can view Dashboard', auth()->user()->getUserPermisions()))
                <li> <a class="waves-effect waves-dark" href="/dashboard" aria-expanded="false"><i class="ti-home"></i><span class="hide-menu">Dashboard</span></a></li>
                @endif
                @if(in_array('Can view Client', auth()->user()->getUserPermisions()))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Clients</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(in_array('Can view All Client', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/"><span class="hide-menu"> All Clients</span></a>
                        </li>
                        @endif
                        @if(in_array('Can Register Client', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/get-riders-reg-form"><span class="hide-menu"> Register Client</span></a>
                        </li>
                        @endif
                        @if(in_array('Can view Today Registered Clients', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/todays-registered-riders"><span class="hide-menu"> Registered Today</span></a>
                        </li>
                        @endif
                        @if(in_array('Can View Trashed Clients', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/clientmodule/trashed-riders"><span class="hide-menu"> Trashed Clients</span></a>
                        </li>
                        @endif
                     </ul>
                 </li>
                 @endif
                 @if(in_array('Can view Transactions', auth()->user()->getUserPermisions()))
                 <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-book"></i><span class="hide-menu"> Transactions</span></a>
                    <ul aria-expanded="false" class="collapse">
                         @if(in_array('Can view Pay Debt', auth()->user()->getUserPermisions()))
                         <li> <a class="waves-effect waves-dark" href="/transactionmodule/pay-debt"><span class="hide-menu"> Pay Debt</span></a>
                        </li>
                        @endif
                        @if(in_array('Can view Todays Transactions', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/transactionmodule/todays-transaction"><span class="hide-menu"> Todays Transactions</span></a>
                        </li>
                        @endif
                     </ul>
                </li>
                @endif
                @if(in_array('Can View Reports', auth()->user()->getUserPermisions()))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-move"></i><span class="hide-menu"> Reports</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(in_array('Can View Todays Revenvue', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/reportmodule/"><span class="hide-menu"> Todays Revenue</span></a>
                        </li>
                        @endif
                        @if(in_array('Can view All Revenue', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/reportmodule/all-revenue"><span class="hide-menu"> All Revenue</span></a>
                        </li>
                        @endif
                        @if(in_array('Can view Pending Revenue', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/reportmodule/pending-debts"><span class="hide-menu"> Pending Revenue</span></a>
                        </li>
                        @endif
                        @if(in_array('Can View Overdue Debts', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/reportmodule/overdue"><span class="hide-menu"> Overdue Debts</span></a>
                        </li>
                        @endif
                        @if(in_array('Can view Cleared Debts', auth()->user()->getUserPermisions()))
                        <li> <a class="waves-effect waves-dark" href="/reportmodule/cleared-debts"><span class="hide-menu"> Cleared Debts</span></a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                @if(in_array('Can View Permissions', auth()->user()->getUserPermisions()))
                <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu"> Account Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                       @if(in_array('Can Add User Permission', auth()->user()->getUserPermisions()))
                       <li> <a class="waves-effect waves-dark" href="/get-users" aria-expanded="false"><span class="hide-menu"> Permissions</span></a></li>
                       @endif
                       @if(in_array('Can Register User', auth()->user()->getUserPermisions()))
                       <li> <a class="waves-effect waves-dark" href="/register-user" aria-expanded="false"><span class="hide-menu"> Register User</span></a></li>
                       @endif
                       @if(in_array('Can View Users', auth()->user()->getUserPermisions()))
                       <li> <a class="waves-effect waves-dark" href="/registered-users" aria-expanded="false"><span class="hide-menu"> Users</span></a></li>
                       @endif
                    </ul>
                </li>
                @endif 
                @if(in_array('Can View Field Staff', auth()->user()->getUserPermisions()))
                <li> <a class="waves-effect waves-dark" href="/reportmodule/field-staff" aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">Field Staff</span></a></li>
                @endif
                <li> <a class="waves-effect waves-dark" href="/adminmodule/fuel-stations" aria-expanded="false"><i class="ti-spray"></i><span class="hide-menu">Fuel Stations</span></a></li>
                
                <li> <a class="waves-effect waves-dark" href="/adminmodule/get-towns" aria-expanded="false"><i class="ti-view-grid"></i><span class="hide-menu">Towns</span></a></li>
                
                <li> <a class="waves-effect waves-dark" href="/fuelstation/search-client" aria-expanded="false"><i class="ti-search"></i><span class="hide-menu">Search Client</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Side_bar scroll-->
</aside>
