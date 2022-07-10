@php
global $path;
global $currentPath;

$path = Route::getFacadeRoot()->current()->uri();
$currentPathTemp = Request::fullUrl();
$currentPathTemp = explode(url('/').'/', $currentPathTemp);

$currentPath = '';
if( isset($currentPathTemp[1]) ) {
$currentPath = $currentPathTemp[1];
$currentPath = trim($currentPath);
}

function getActiveRoute( $arrayLinks ) {

$selected = false;

if( in_array($GLOBALS['path'], $arrayLinks) ) {
$selected = true;
}
elseif ( in_array($GLOBALS['currentPath'], $arrayLinks) ) {
$selected = true;
}

return $selected;
}
@endphp
<ul class="navbar-nav">
    @php
        $links_array = [
            'dashboard',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{ url('dashboard') }}">
            <i class="fa-fw fas fa-tachometer-alt"></i> 
            <text> Dashboard </text>
        </a>
    </li>

    @php
        $links_array = [
            'cms',
            'cms/add',
            'cms/edit/{slug}'
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{url('cms')}}">
        <i class="fa-fw fal fa-sort-alt"></i> 
            <text> CMS </text>
        </a>
    </li>

    @php
        $links_array = [
            'users',
            'users/add',
            'users/view/{id}',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{url('users')}}">
        <i class="fa-fw fas fa-user-cog"></i> 
            <text> Users </text>
        </a>
    </li>

    @php
        $links_array = [
            'books',
            'books/add',
            'books/view/{id}',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{url('books')}}">
        <i class="fa-fw fas fa-book"></i> 
            <text> Books </text>
        </a>
    </li>

    @php
        $links_array = [
            'categories',
            'categories/add',
            'categories/edit/{id}',
            'sub-categories',
            'sub-categories/add',
            'sub-categories/edit/{id}'
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item dropdown @if( $selected ) show @endif">
        <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" data-bs-display="static" >
            <i class="fa-fw fas fa-boxes"></i> 
            <text> Manage Category </text>
        </a>
        <ul class="dropdown-menu dropdown-menu-left @if( $selected ) show @endif">
            @php
                $links_array = [
                    'categories',
                    'categories/add',
                    'categories/edit/{id}',
                ];
                $selected = getActiveRoute($links_array);
            @endphp
            <li class="nav-item @if( $selected ) active @endif">
                <a class="nav-link" href="{{url('categories')}}">
                    <i class="fa-fw fas fa-circle"></i>
                    <text>Category</text>
                </a>
            </li>
            @php
                $links_array = [
                    'sub-categories',
                    'sub-categories/add',
                    'sub-categories/edit/{id}'
                ];
                $selected = getActiveRoute($links_array);
            @endphp
            <li class="nav-item @if( $selected ) active @endif">
                <a class="nav-link" href="{{url('sub-categories')}}">
                    <i class="fa-fw fas fa-circle"></i>
                    <text>Sub Category</text>
                </a>
            </li>
        </ul>
    </li>

    @php
        $links_array = [
            'faqs',
            'faqs/add',
            'faqs/edit/{id}',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{url('faqs')}}">
        <i class="fa-fw fas fa-file-alt"></i> 
            <text> FAQs </text>
        </a>
    </li>
   
    @php
        $links_array = [
            'email-headers',
            'email-headers/add',
            'email-headers/edit/{id}',
            'email-templates',
            'email-templates/add',
            'email-templates/edit/{id}',
            'email-footers',
            'email-footers/add',
            'email-footers/edit/{id}',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item dropdown @if( $selected ) show @endif">
        <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" data-bs-display="static" >
            <i class="fa-fw fas fa-envelope"></i> 
            <text> Email Template </text>
        </a>
        <ul class="dropdown-menu dropdown-menu-left @if( $selected ) show @endif">
            @php
                $links_array = [
                    'email-templates',
                    'email-templates/add',
                    'email-templates/edit/{id}'
                ];
                $selected = getActiveRoute($links_array);
            @endphp
            <li class="nav-item @if( $selected ) active @endif">
                <a class="nav-link" href="{{url('email-templates')}}">
                    <i class="fa-fw fas fa-circle"></i>
                    <text>Email Templates</text>
                </a>
            </li>
            @php
                $links_array = [
                    'email-headers',
                    'email-headers/add',
                    'email-headers/edit/{id}',
                ];
                $selected = getActiveRoute($links_array);
            @endphp
            <li class="nav-item @if( $selected ) active @endif">
                <a class="nav-link" href="{{url('email-headers')}}">
                    <i class="fa-fw fas fa-circle"></i>
                    <text>Email Headers</text>
                </a>
            </li>
            @php
                $links_array = [
                    'email-footers',
                    'email-footers/add',
                    'email-footers/edit/{id}'
                ];
                $selected = getActiveRoute($links_array);
            @endphp
            <li class="nav-item @if( $selected ) active @endif">
                <a class="nav-link" href="{{url('email-footers')}}">
                    <i class="fa-fw fas fa-circle"></i>
                    <text>Email Footers</text>
                </a>
            </li>
        </ul>
    </li>

    @php
        $links_array = [
            'settings',
        ];
        $selected = getActiveRoute($links_array);
    @endphp
    <li class="nav-item @if( $selected ) active @endif">
        <a class="nav-link" href="{{ url('settings') }}">
            <i class="fa-fw fas fas fa-cog"></i> 
            <text> Settings </text>
        </a>
    </li>
</ul>