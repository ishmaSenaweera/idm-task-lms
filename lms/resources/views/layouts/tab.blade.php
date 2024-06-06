<ul class="nav nav-tabs" id="courseTabs">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('courses/all') ? 'active' : '' }}" id="all-courses-tab"
            href="{{ route('courses.index') }}" role="tab" aria-controls="all-courses" aria-selected="true">All
            Courses</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('modules/all') ? 'active' : '' }}" id="all-modules-tab"
            href="{{ route('modules.index') }}" role="tab" aria-controls="all-modules" aria-selected="false">All
            Modules</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('syllabi/all') ? 'active' : '' }}" id="all-syllabi-tab"
            href="{{ route('syllabi.index') }}" role="tab" aria-controls="all-syllabi" aria-selected="false">All
            Syllabi</a>
    </li>
</ul>
<div class="tab-content" id="courseTabsContent">
    <div class="tab-pane fade {{ request()->is('courses/all') ? 'show active' : '' }}" id="all-courses"
        aria-labelledby="all-courses-tab">
        @yield('all-courses-content')
    </div>
    <div class="tab-pane fade {{ request()->is('modules/all') ? 'show active' : '' }}" id="all-modules"
        aria-labelledby="all-modules-tab">
        @yield('all-modules-content')
    </div>
    <div class="tab-pane fade {{ request()->is('syllabi/all') ? 'show active' : '' }}" id="all-syllabi"
        aria-labelledby="all-syllabi-tab">
        @yield('all-syllabi-content')
    </div>
</div>
