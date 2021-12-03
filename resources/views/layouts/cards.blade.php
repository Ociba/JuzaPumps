<div class="row">
    <!-- Column -->
        <div class="col-lg-3 col-md-6">
            <a href="adminmodule/todays-registered-riders">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="card-subtitle" style="color:green;"><font size="3">Registered Riders Today</font></h4></div>
                            <h3><span style="color:black">{{auth()->user()->countTodaysRiders()}}</span></h3>
                        <div class="col-12">
                            <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-subtitle" style="color:blue;"><font size="3">Normal Debts (0 -1 Day)</font></h4></div>
                        <h3>{{auth()->user()->countTodaysDebtors()}}</h3>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                    <h4 class="card-subtitle" style="color:red;">Defaulters (2 -10 Days)</h4></div>
                        <h3><span style="color:black">{{auth()->user()->countDefaultersTwoToTenDays()}}</span></h3>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-3 col-md-6">
        <a href="/adminmodule/">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h4 class="card-subtitle" style="color:black;">Total No. of Riders</h4></div>
                        <h3><span style="color:black">{{auth()->user()->countUserNumberOfRiders()}}</span></h3>
                    <div class="col-12">
                        <div class="progress">
                            <div class="progress-bar bg-inverse" role="progressbar" style="width: 100%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </a>
    </div>
    <!-- Column -->
</div>
<!-- Row -->
  <!-- Row -->
<div class="row">
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-header bg-info">
                <h4 class="m-b-0 text-white text-wrap"><font size="3">Enforcement (11 &amp; Above)</font></h4></div>
            <div class="card-body">
                <h3 class="card-title">{{auth()->user()->getEnforcement()}}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <a href="/adminmodule/all-revenue">
        <div class="card border-success">
            <div class="card-header bg-success">
                <h4 class="m-b-0 text-white">This Weeks' Revenue</h4></div>
            <div class="card-body">
                <h3 class="card-title"><span style="color:black">{{ number_format(auth()->user()->getThisCurrentWeekRevenue())}} /=</span></h3>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="/adminmodule/all-revenue">
        <div class="card border-dark">
            <div class="card-header bg-dark">
                <h4 class="m-b-0 text-white">This Months' Revenue</h4></div>
            <div class="card-body">
                <h3 class="card-title"><span style="color:black">{{ number_format(auth()->user()->getThisCurrentMonthRevenue())}} /=</span></h3>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-3">
        <a href="/adminmodule/all-revenue">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="m-b-0 text-white">This Years' Revenue</h4></div>
            <div class="card-body">
                <h3 class="card-title"><span style="color:black">{{ number_format(auth()->user()->getThisYearsRevenue())}} /=</span></h3>
            </div>
        </div>
        </a>
    </div>
</div>
<!-- End Row -->