<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- vendor css -->
    <link href="{{ asset("/lib/jquery-toggles/toggles-full.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/jt.timepicker/jquery.timepicker.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/spectrum/spectrum.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/bootstrap-tagsinput/bootstrap-tagsinput.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/ion.rangeSlider/css/ion.rangeSlider.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/highlightjs/github.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/font-awesome/css/font-awesome.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/Ionicons/css/ionicons.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/perfect-scrollbar/css/perfect-scrollbar.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/jquery-switchbutton/jquery.switchButton.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/rickshaw/rickshaw.min.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/datatables/jquery.dataTables.css") }}" rel="stylesheet">
    <link href="{{ asset("/lib/select2/css/select2.min.css") }}" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{ asset("/css/bracket.css") }}">

    <!-- Vendor css refactor -->
    <link rel="stylesheet" href="{{ asset('css/refactor.css') }}">

    <!-- CSS File Herited -->
    @yield('css-script')
</head>

<body class="collapsed-menu">
<div class="br-logo"><a href="#"><span>[</span>Stock<i>Gestion</i><span>]</span></a></div>
<div class="br-sideleft overflow-y-auto" id="navigation">
    <label class="sidebar-label pd-x-10 mg-t-20 op-3">Navigation</label>
    <ul class="br-sideleft-menu">
        <li class="br-menu-item">
            <a
                @hasrole('seller')
                    href="{{ route('selling.index') }}"
                    class="br-menu-link {{ request()->getRequestUri() === '/selling' ? 'active' : '' }}"
                @endhasrole
            >
                <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                <span class="menu-item-label">
                    @hasrole('seller')
                        Tableau de vente
                    @endhasrole
                    @hasrole('admin|manager')
                        Dashboard
                    @endhasrole
                </span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        @hasrole('admin|manager')
        <li class="br-menu-item">
            <a href="{{ route('notify') }}" class="br-menu-link {{ request()->getRequestUri() === '/notification' ? 'active' : '' }}">
                <i class="menu-item-icon icon ion-ios-bell-outline tx-24"></i>
                <!-- start: if statement -->
                <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
                <!-- end: if statement -->
                <span class="menu-item-label">Notification</span>
            </a><!-- br-menu-link -->
        </li><!-- br-menu-item -->
        @endhasrole
        @hasrole('admin')
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'warehouse')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon ion-ios-filing-outline tx-24"></i>
                <span class="menu-item-label">Entrepot</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('warehouse.index') }}" class="sub-link {{ request()->getRequestUri() === '/warehouse' ? 'active' : '' }}">Consulter</a></li>
                <li class="sub-item"><a href="{{ route('warehouse.create') }}" class="sub-link {{ request()->getRequestUri() === '/warehouse/create' ? 'active' : '' }}">Creer un entrepot</a></li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'article')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon ion-android-clipboard tx-24"></i>
                <span class="menu-item-label">Article</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('article.index') }}" class="sub-link {{ request()->getRequestUri() === '/article' ? 'active' : '' }}">Consulter</a></li>
                <li class="sub-item"><a href="{{ route('article.create') }}" class="sub-link {{ request()->getRequestUri() === '/article/create' ? 'active' : '' }}">Creer des articles</a></li>
            </ul>
        </li>
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'sellpoint')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon icon ion-bag tx-20"></i>
                <span class="menu-item-label">Point de vente</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('sellpoint.index') }}" class="sub-link {{ request()->getRequestUri() === '/sellpoint' ? 'active' : '' }}">Consulter</a></li>
                <li class="sub-item"><a href="{{ route('sellpoint.create') }}" class="sub-link {{ request()->getRequestUri() === '/sellpoint/create' ? 'active' : '' }}">Creer un point de vente</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'supply/')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon fa fa-shopping-cart tx-20"></i>
                <span class="menu-item-label">Alimentation</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('warehouse.supply.index') }}" class="sub-link {{ request()->getRequestUri() === '/supply/ware' ? 'active' : '' }}">Alimenter un entrepot</a></li>
                <li class="sub-item"><a href="{{ route('sellpoint.supply.index') }}" class="sub-link {{ request()->getRequestUri() === '/suplly/sell' ? 'active' : '' }}">Alimenter un point de vente</a></li>
                <li class="sub-item"><a href="" class="sub-link">Bilan</a></li>
            </ul>
        </li><!-- br-menu-item -->
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'employe')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon ion-ios-person-outline tx-24"></i>
                <span class="menu-item-label">Employe</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('employe.index') }}" class="sub-link {{ request()->getRequestUri() === '/employe' ? 'active' : '' }}">Consulter la liste</a></li>
                <li class="sub-item"><a href="{{ route('employe.create') }}" class="sub-link {{ request()->getRequestUri() === '/employe/create' ? 'active' : '' }}">Creer un employe</a></li>
            </ul>
        </li><!-- br-menu-item -->
        @endhasrole
        @hasrole('seller')
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ $show ?? ''  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon ion-cash tx-20"></i>
                <span class="menu-item-label">Ma vente</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="{{ route('selling.show', Auth::id()) }}" class="sub-link {{ $show ?? ''  ? 'active' : '' }}">Bilan de vente</a></li>
            </ul>
        </li><!-- br-menu-item -->
        @endhasrole
        @hasrole('manager')
        <li class="br-menu-item">
            <a href="#" class="br-menu-link {{ strpos(request()->getRequestUri(), 'storage')  ? 'active show-sub' : '' }} with-sub">
                <i class="menu-item-icon icon ion-ios-pie-outline tx-20"></i>
                <span class="menu-item-label">Stock</span>
            </a><!-- br-menu-link -->
            <ul class="br-menu-sub">
                <li class="sub-item"><a href="" class="sub-link">Mes entrepots</a></li>
                <li class="sub-item"><a href="" class="sub-link">Mes points de vente</a></li>
                <li class="sub-item"><a href="" class="sub-link">Mon point de vente</a></li>
                <li class="sub-item"><a href="" class="sub-link">Passer des commandes</a></li>
                <li class="sub-item"><a href="" class="sub-link">Bilan</a></li>
            </ul>
        </li><!-- br-menu-item -->
        @endhasrole
    </ul><!-- br-sideleft-menu -->

    <label class="sidebar-label pd-x-10 mg-t-25 mg-b-20 tx-info">Information Stockage</label>

    <div class="info-list">
        <div class="info-list-item">
            <div>
                <p class="info-list-label">Usage Entrepot</p>
                <h5 class="info-list-amount">32.3%</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#336490"], "height": 35, "width": 60 }'>8,6,5,9,8,4,9,3,5,9</span>
        </div><!-- info-list-item -->

        <div class="info-list-item">
            <div>
                <p class="info-list-label">Usage Stock</p>
                <h5 class="info-list-amount">140.05</h5>
            </div>
            <span class="peity-bar" data-peity='{ "fill": ["#1C7973"], "height": 35, "width": 60 }'>4,3,5,7,12,10,4,5,11,7</span>
        </div><!-- info-list-item -->
    </div><!-- info-list -->

    <br>
</div><!-- br-sideleft -->
<div class="br-header">
    <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>
        <div class="input-group hidden-xs-down wd-170 transition">
            <input name="query" id="searchbox" type="text" class="form-control" placeholder="Search">
            <span class="input-group-btn">
                <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
            </span>
        </div><!-- input-group -->
    </div><!-- br-header-left -->
    <div class="br-header-right">
        <nav class="nav">
            <div class="dropdown">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <span class="logged-name hidden-md-down">{{ Auth::user()->lastname }}</span>
                    <img src="{{ asset('img/undraw_profile_pic_ic5t.svg') }}" class="wd-32 rounded-circle" alt="">
                    <span class="square-10 bg-success"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-header wd-250">
                    <div class="tx-center">
                        <a href="#"><img src="{{ asset('img/undraw_profile_pic_ic5t.svg') }}" class="wd-80 rounded-circle" alt=""></a>
                        <h6 class="logged-fullname">{{ Auth::user()->lastname }} {{ Auth::user()->name }}</h6>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                    <hr>
                    <ul class="list-unstyled user-profile-nav">
                        <li><a href="{{ route('profil', 'meledjearmel') }}"><i class="icon ion-ios-person"></i> Editer le profil</a></li>
                        <li><a href="{{ route('setting', 'meledjearmel') }}"><i class="icon ion-ios-gear"></i> Paramètres</a></li>
                        <li onclick="document.querySelector('#logout-form').submit()"><a href="#"><i class="icon ion-power"></i> Déconnexion</a></li>
                    </ul>
                </div><!-- dropdown-menu -->
            </div><!-- dropdown -->
        </nav>
        <form id="logout-form" method="POST" action="{{ route('logout') }}">@csrf</form>
        <div class="navicon-right">
            <a id="btnRightMenu" href="#" class="pos-relative">
                <i class="icon ion-grid"></i>
            </a>
        </div><!-- navicon-right -->
    </div><!-- br-header-right -->
</div><!-- br-header -->
<div class="br-sideright">
    <ul class="nav nav-tabs sidebar-tabs col-12" role="tablist">
        <li class="nav-item col-6 text-center">
            <a class="nav-link active" data-toggle="tab" role="tab" href="#calendar" aria-expanded="false"><i class="icon ion-ios-calendar-outline tx-24"></i></a>
        </li>
        <li class="nav-item col-6 text-center">
            <a class="nav-link" data-toggle="tab" role="tab" href="#settings" aria-expanded="false"><i class="icon ion-ios-gear-outline tx-24"></i></a>
        </li>
    </ul><!-- sidebar-tabs -->

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto ps ps--theme_default ps--active-y active" id="calendar" role="tabpanel" data-ps-id="0e3fe42d-00a8-ed4f-a18e-77480fd5448b" aria-expanded="false">
            <label class="sidebar-label pd-x-25 mg-t-25">Time &amp; Date</label>
            <div class="pd-x-25">
                <h2 id="brTime" class="br-time">05:01:00 PM</h2>
                <h6 id="brDate" class="br-date">June 21, 2020 SUN</h6>
            </div>

            <label class="sidebar-label pd-x-25 mg-t-25">Calendrier</label>
            <div class="datepicker sidebar-datepicker hasDatepicker" id="dp1592757857619"><div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all" data-handler="prev" data-event="click" title="Prev"><span class="ui-icon ui-icon-circle-triangle-w">Prev</span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title="Next"><span class="ui-icon ui-icon-circle-triangle-e">Next</span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">June</span>&nbsp;<span class="ui-datepicker-year">2020</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">Su</span></th><th scope="col"><span title="Monday">Mo</span></th><th scope="col"><span title="Tuesday">Tu</span></th><th scope="col"><span title="Wednesday">We</span></th><th scope="col"><span title="Thursday">Th</span></th><th scope="col"><span title="Friday">Fr</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">Sa</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">1</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">2</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">3</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">4</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">5</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">6</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">7</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">8</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">9</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">10</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">11</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">12</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">13</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">14</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">15</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">16</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">17</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">18</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">19</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">20</a></td></tr><tr><td class=" ui-datepicker-week-end ui-datepicker-days-cell-over  ui-datepicker-current-day ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default ui-state-highlight ui-state-active ui-state-hover" href="#">21</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">22</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">23</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">24</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">25</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">26</a></td><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">27</a></td></tr><tr><td class=" ui-datepicker-week-end " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">28</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">29</a></td><td class=" " data-handler="selectDay" data-event="click" data-month="5" data-year="2020"><a class="ui-state-default" href="#">30</a></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled">&nbsp;</td></tr></tbody></table></div></div>


            <label class="sidebar-label pd-x-25 mg-t-25">Event Today</label>
            <div class="pd-x-25">
                <div class="list-group sidebar-event-list mg-b-20">
                    <div class="list-group-item">
                        <div>
                            <h6>Roven's 32th Birthday</h6>
                            <p>2:30PM</p>
                        </div>
                        <a href="#" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
                    </div><!-- list-group-item -->
                    <div class="list-group-item">
                        <div>
                            <h6>Regular Workout Schedule</h6>
                            <p>7:30PM</p>
                        </div>
                        <a href="#" class="more"><i class="icon ion-android-more-vertical tx-18"></i></a>
                    </div><!-- list-group-item -->
                </div><!-- list-group -->

                <a href="#" class="btn btn-block btn-outline-secondary tx-uppercase tx-12 tx-spacing-2">+ Add Event</a>
                <br>
            </div>

            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto ps ps--theme_default" id="settings" role="tabpanel" data-ps-id="be891272-5142-028b-69ce-bc12f0661b83" aria-expanded="false">
            <label class="sidebar-label pd-x-25 mg-t-25">Quick Settings</label>

            <div class="sidebar-settings-item">
                <h6 class="tx-13 tx-normal">Sound Notification</h6>
                <p class="op-5 tx-13">Play an alert sound everytime there is a new notification.</p>
                <div class="pos-relative">
                    <input type="checkbox" name="checkbox" class="switch-button" checked="" style="display: none;"><span class="switch-button-label off">OFF</span><div class="switch-button-background checked" style="width: 25px; height: 11px;"><div class="switch-button-button" style="width: 12px; height: 11px; left: 27px;"></div></div><span class="switch-button-label on">ON</span><div style="clear: left;"></div>
                </div>
            </div>

            <div class="sidebar-settings-item">
                <h6 class="tx-13 tx-normal">2 Steps Verification</h6>
                <p class="op-5 tx-13">Sign in using a two step verification by sending a verification code to your phone.</p>
                <div class="pos-relative">
                    <input type="checkbox" name="checkbox2" class="switch-button" style="display: none;"><span class="switch-button-label on">OFF</span><div class="switch-button-background" style="width: 25px; height: 11px;"><div class="switch-button-button" style="width: 12px; height: 11px; left: -1px;"></div></div><span class="switch-button-label off">ON</span><div style="clear: left;"></div>
                </div>
            </div>

            <div class="sidebar-settings-item">
                <h6 class="tx-13 tx-normal">Location Services</h6>
                <p class="op-5 tx-13">Allowing us to access your location</p>
                <div class="pos-relative">
                    <input type="checkbox" name="checkbox3" class="switch-button" style="display: none;"><span class="switch-button-label on">OFF</span><div class="switch-button-background" style="width: 25px; height: 11px;"><div class="switch-button-button" style="width: 12px; height: 11px; left: -1px;"></div></div><span class="switch-button-label off">ON</span><div style="clear: left;"></div>
                </div>
            </div>

            <div class="sidebar-settings-item">
                <h6 class="tx-13 tx-normal">Newsletter Subscription</h6>
                <p class="op-5 tx-13">Enables you to send us news and updates send straight to your email.</p>
                <div class="pos-relative">
                    <input type="checkbox" name="checkbox4" class="switch-button" checked="" style="display: none;"><span class="switch-button-label off">OFF</span><div class="switch-button-background checked" style="width: 25px; height: 11px;"><div class="switch-button-button" style="width: 12px; height: 11px; left: 27px;"></div></div><span class="switch-button-label on">ON</span><div style="clear: left;"></div>
                </div>
            </div>

            <div class="sidebar-settings-item">
                <h6 class="tx-13 tx-normal">Your email</h6>
                <div class="pos-relative">
                    <input type="email" name="email" class="form-control" value="janedoe@domain.com">
                </div>
            </div>

            <div class="pd-y-20 pd-x-25">
                <h6 class="tx-13 tx-normal tx-white mg-b-20">More Settings</h6>
                <a href="#" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Account Settings</a>
                <a href="#" class="btn btn-block btn-outline-secondary tx-uppercase tx-11 tx-spacing-2">Privacy Settings</a>
            </div>

            <div class="ps__scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps__scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__scrollbar-y-rail" style="top: 0px; right: 0px;"><div class="ps__scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
    </div><!-- tab-content -->
</div>

@yield('content')

<script src="{{ asset("/lib/jquery/jquery.js") }}"></script>
<script src="{{ asset("/lib/popper.js/popper.js") }}"></script>
<script src="{{ asset("/lib/bootstrap/bootstrap.js") }}"></script>
<script src="{{ asset("/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js") }}"></script>
<script src="{{ asset("/lib/moment/moment.js") }}"></script>
<script src="{{ asset("/lib/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset("/lib/jquery-switchbutton/jquery.switchButton.js") }}"></script>
<script src="{{ asset("/lib/peity/jquery.peity.js") }}"></script>
<script src="{{ asset("/lib/highlightjs/highlight.pack.js") }}"></script>
<script src="{{ asset("/lib/select2/js/select2.min.js") }}"></script>
<script src="{{ asset("/lib/jquery-toggles/toggles.min.js") }}"></script>
<script src="{{ asset("/lib/jt.timepicker/jquery.timepicker.js") }}"></script>
<script src="{{ asset("/lib/spectrum/spectrum.js") }}"></script>
<script src="{{ asset("/lib/jquery.maskedinput/jquery.maskedinput.js") }}"></script>
<script src="{{ asset("/lib/bootstrap-tagsinput/bootstrap-tagsinput.js") }}"></script>
<script src="{{ asset("/lib/ion.rangeSlider/js/ion.rangeSlider.min.js") }}"></script>
<script src="{{ asset("/lib/d3/d3.js") }}"></script>
<script src="{{ asset("/lib/rickshaw/rickshaw.min.js") }}"></script>
<script src="{{ asset("/lib/Flot/jquery.flot.js") }}"></script>
<script src="{{ asset("/lib/Flot/jquery.flot.resize.js") }}"></script>
<script src="{{ asset("/lib/jquery.sparkline.bower/jquery.sparkline.min.js") }}"></script>
<script src="{{ asset("/lib/echarts/echarts.min.js") }}"></script>
<script src="{{ asset("/lib/select2/js/select2.full.min.js") }}"></script>
<script src="{{ asset("/js/bracket.js") }}"></script>
<script src="{{ asset("/js/ResizeSensor.js") }}"></script>
<script src="{{ asset("/js/dashboard.js") }}"></script>
<script src="{{ asset("/lib/datatables/jquery.dataTables.js") }}"></script>
<script src="{{ asset("/lib/datatables-responsive/dataTables.responsive.js") }}"></script>
<script src="{{ asset('/lib/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset("/lib/Flot/jquery.flot.pie.js") }}"></script>
<script src="{{ asset("/lib/flot-spline/jquery.flot.spline.js") }}"></script>
<script src="{{ asset("/lib/echarts/echarts.min.js") }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset("/js/ResizeSensor.js") }}"></script>
@yield('js-script')
    <script>
        $(function(){
            'use strict'

            // FOR DEMO ONLY
            // menu collapsed by default during first page load or refresh with screen
            // having a size between 992px and 1299px. This is intended on this page only
            // for better viewing of widgets demo.
            $(window).resize(function(){
                minimizeMenu();
            });

            minimizeMenu();

            function minimizeMenu() {
                if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
                    // show only the icons and hide left menu label by default
                    $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
                    $('body').addClass('collapsed-menu');
                    $('.show-sub + .br-menu-sub').slideUp();
                } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
                    $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
                    $('body').removeClass('collapsed-menu');
                    $('.show-sub + .br-menu-sub').slideDown();
                }
            }
        });
        $(function () {

        });
    </script>
    </body>

</html>
