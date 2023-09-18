<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('staff.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15 col-md-4">
            @isset($SiteOption)
            <img src="{{ asset($SiteOption[1]->value) }}" alt="" srcset="" width="100%">
            @endisset
        </div>
        <div class="sidebar-brand-text mx-2 col-md-8">Staff Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/staff">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    <hr class="sidebar-divider">
    <!-- Heading -->
    
    <div class="sidebar-heading">
        Language Management
    </div>
    <!-- Nav Languages Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/language*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-language"></i>
            <span>Languages</span>
        </a>
        <div id="collapseOne" class="collapse @if(request()->is('staff/language*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Language Management</h6>
                <a class="collapse-item" href="{{ route('staff.language.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.language.create') }}">Add new</a>
            </div>
        </div>
    </li>

    <div class="sidebar-heading">
        Subject Management
    </div>
    <!-- Nav Subject Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/subject*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-table"></i>
            <span>Subjects</span>
        </a>
        <div id="collapseTwo" class="collapse @if(request()->is('staff/subject*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Subject Management</h6>
                <a class="collapse-item" href="{{ route('staff.subject.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.subject.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        Subject Management
    </div>
    <!-- Nav Books Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/book*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-book"></i>
            <span>Books</span>
        </a>
        <div id="collapseThree" class="collapse @if(request()->is('staff/book*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Book Management</h6>
                <a class="collapse-item" href="{{ route('staff.book.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.book.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Question Management
    </div>
    <!-- Nav Question Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/question*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-question-circle"></i>
            <span>Questions</span>
        </a>
        <div id="collapseFour" class="collapse @if(request()->is('staff/question*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Question Management</h6>
                <a class="collapse-item" href="{{ route('staff.question.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.question.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <div class="sidebar-heading">
        Question Set Management
    </div>
    <!-- Nav Question Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/qset*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseFive"
            aria-expanded="true" aria-controls="collapseFive">
            <i class="fas fa-question-circle"></i>
            <span>Question Set</span>
        </a>
        <div id="collapseFive" class="collapse @if(request()->is('staff/qset*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Question Management</h6>
                <a class="collapse-item" href="{{ route('staff.qset.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.qset.create') }}">Add new</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <!-- Heading -->
    
    <div class="sidebar-heading">
         Email System
    </div>
    <!-- Nav Email Services - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link @if (!request()->is('staff/email*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseTen"
            aria-expanded="true" aria-controls="collapseTen">
            <i class="fas fa-table"></i>
            <span>Email Service</span>
        </a>
        <div id="collapseTen" class="collapse @if(request()->is('staff/email*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Email Management</h6>
                <a class="collapse-item" href="{{ route('staff.email.index') }}">View All</a>
                <a class="collapse-item" href="{{ route('staff.email.create') }}">Add new</a>
            </div>
        </div>
    </li>
     <!-- Nav Item Support - Utilities Collapse Menu -->
     <li class="nav-item">
        <a class="nav-link @if (!request()->is('student/support*'))
            collapsed
        @endif" href="#" data-toggle="collapse" data-target="#collapseEleven"
            aria-expanded="true" aria-controls="collapseEleven">
            <i class="fas fa-ticket-alt"></i>
            <span>Support</span>
        </a>
        <div id="collapseEleven" class="collapse @if(request()->is('student/support*')) show @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Support Ticket Management</h6>
                <a class="collapse-item" href="{{ route('staff.support.index') }}">View Support Tickets</a>
            </div>
        </div>
    </li>
   

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    <li class="nav-item active">
            
        <a class="nav-link" href="{{ route('staff.logout') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout</span></a>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Sidebar Toggler (Sidebar - Logout - CopyRight) -->
    @include('../layouts/sidebar_toggle')
    <!-- End Sidebar Toggler (Sidebar - Logout - CopyRight) -->

    

</ul>