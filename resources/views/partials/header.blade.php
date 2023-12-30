<div id="page-header" class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-plus-circle2 mr-2"></i> <span class="font-weight-semibold">@yield('page_title')</span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

            <div class="page-title d-flex">
                <a href="{{ route('logout') }}" class="btn btn-primary ">
                <i class="icon-switch2"></i>
                <span>{{ __('Logout') }}</span>
                </a>
            </div>

           
        </div>
    </div>
</div>