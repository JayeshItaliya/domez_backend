<header>
    <div class="right-side-wrapper">
        <div class="logo">
            <a href="{{ URL::to('admin/dashboard') }}">
                <img src="{{ Helper::image_path('logo_dark.png') }}" width="100" alt="" class="mx-3">
            </a>
        </div>
        {{-- <button class="toggle-icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-menu-2" width="20px"
                height="20px" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none"
                stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <line x1="4" y1="6" x2="20" y2="6"></line>
                <line x1="4" y1="12" x2="20" y2="12"></line>
                <line x1="4" y1="18" x2="20" y2="18"></line>
            </svg>
        </button> --}}
    </div>
    <div class="d-flex justify-content-end" style="width: inherit;">
        {{-- <div class="search-box">
            <form data-bs-toggle="search" data-bs-display="static" aria-expanded="true">
                <div class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="20px"
                        height="20px" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-secondary)"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <circle cx="10" cy="10" r="7"></circle>
                        <line x1="21" y1="21" x2="15" y2="15"></line>
                    </svg>
                </div>
                <input type="search" name="search" id="" class="form-control form-control-lg"
                    placeholder="Search Here...">
            </form>
        </div> --}}
        <ul class="nav-icons">
            {{-- Only use for development purpose --}}
            @if (in_array(Auth::user()->type, [1, 2, 4]) && env('APP_ENV') == 'local')
                <li class="dropdown">
                    <a href="{{ URL::to('admin/login-dev') }}"
                        class="btn btn-primary">{{ Auth::user()->type == 1 ? 'Login as Dome Owner' : 'Login as Admin' }}</a>
                </li>
            @endif
            @if (Auth::user()->type == 2)
                <li class="dropdown ms-3">
                    <a href="{{ URL::to('admin/login-emp') }}" class="btn btn-primary">Login as Employee</a>
                </li>
            @endif
            {{-- Only use for development purpose --}}
            {{-- <li class="dropdown">
                <a href="#" class="nav-item currency-icon" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-currency-dollar"
                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="var(--bs-secondary)" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M16.7 8a3 3 0 0 0 -2.7 -2h-4a3 3 0 0 0 0 6h4a3 3 0 0 1 0 6h-4a3 3 0 0 1 -2.7 -2" />
                        <path d="M12 3v3m0 12v3" />
                    </svg>
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li><a class="dropdown-item" href="#">{{ trans('labels.usd') }}</a></li>
                    <li><a class="dropdown-item" href="#">{{ trans('labels.cad') }}</a></li>
                </ul>
            </li> --}}
            <li class="dropdown">
                <a href="#" class="nav-item language-icon" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-language" width="20"
                        height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-primary)" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 5h7" />
                        <path d="M9 3v2c0 4.418 -2.239 8 -5 8" />
                        <path d="M5 9c-.003 2.144 2.952 3.908 6.7 4" />
                        <path d="M12 20l4 -9l4 9" />
                        <path d="M19.1 18h-6.2" />
                    </svg>
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li><a class="dropdown-item"
                            href="{{ URL::to('admin/change-lang-en') }}">{{ trans('labels.english') }}</a></li>
                    <li><a class="dropdown-item"
                            href="{{ URL::to('admin/change-lang-fr') }}">{{ trans('labels.french') }}</a></li>
                </ul>
            </li>
            <li class="dropdown">
                @if (
                    (auth()->user()->type == 1 &&
                        (Helper::get_noti_count(1) > 0 || Helper::get_noti_count(2) > 0 || Helper::get_noti_count(3) > 0)) ||
                        (in_array(auth()->user()->type, [2, 4]) && count(Helper::getTodayBookings()) > 0))
                    <a href="#" class="nav-item notification-icon position-relative" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell" width="20"
                            height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="var(--bs-secondary)"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path
                                d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
                            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
                        </svg>
                        <span
                            class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle"
                            style="background-color:#FE3B30 !important;"></span>
                    </a>
                @endif
                <ul class="dropdown-menu box-shadow border-0 my-3" style="width: 350px;">
                    @if (auth()->user()->type == 1 && Helper::get_noti_count(3) > 0)
                        <li class="dropwdown-item notifications d-flex justify-content-between align-items-center cursor-pointer py-1"
                            data-next="{{ URL::to('admin/enquiries/dome-requests') }}">
                            <span> <i class="me-2 fa-solid fa-code-pull-request"></i>
                                {{ trans('labels.domes_requests') }} </span>
                            <small class="badge bg-primary rounded-pill"
                                style="font-size: 10px;height:fit-content;">{{ Helper::get_noti_count(3) }}</small>
                        </li>
                    @endif
                    @if (auth()->user()->type == 1 && Helper::get_noti_count(2) > 0)
                        {!! Helper::get_noti_count(3) > 0 ? '<li> <hr class="dropdown-divider"> </li>' : '' !!}
                        <li class="dropwdown-item notifications d-flex justify-content-between align-items-center cursor-pointer py-1"
                            data-next="{{ URL::to('admin/enquiries/general-enquiry') }}">
                            <span>
                                <i class="me-2 fa-regular fa-question"></i>
                                {{ trans('labels.general_enquiry') }}
                            </span>
                            <small class="badge bg-primary rounded-pill"
                                style="font-size: 10px;height:fit-content;">{{ Helper::get_noti_count(2) }}</small>
                        </li>
                    @endif
                    @if (auth()->user()->type == 1 && Helper::get_noti_count(1) > 0)
                        {!! Helper::get_noti_count(2) > 0 || Helper::get_noti_count(3) > 0
                            ? '<li> <hr class="dropdown-divider"> </li>'
                            : '' !!}
                        <li class="dropwdown-item notifications d-flex justify-content-between align-items-center cursor-pointer py-1"
                            data-next="{{ URL::to('admin/enquiries/help-support') }}">
                            <span>
                                <i class="me-2 fa-light fa-envelope"></i>
                                {{ trans('labels.help_support') }}
                            </span>
                            <small class="badge bg-primary rounded-pill"
                                style="font-size: 10px;height:fit-content;">{{ Helper::get_noti_count(1) }}</small>
                        </li>
                    @endif
                    @if (in_array(auth()->user()->type, [2, 4]) && count(Helper::getTodayBookings()) > 0)
                        @foreach (Helper::getTodayBookings() as $key => $booking)
                            {!! $key > 0 ? '<li> <hr class="dropdown-divider"> </li>' : '' !!}
                            <li class="dropwdown-item notifications d-flex justify-content-between align-items-center cursor-pointer py-1"
                                data-next="{{ URL::to('admin/bookings/details-' . $booking->booking_id) }}">
                                <span>
                                    <span class="text-primary">#{{ $booking->booking_id }}</span>
                                    <p>
                                        <b class="text-muted"> Date : {{ Helper::date_format($booking->start_date) }}
                                        </b>
                                    </p>
                                </span>
                                @php
                                    $currentDateTime = \Carbon\Carbon::now();
                                    $createdAt = \Carbon\Carbon::parse($booking->created_at);
                                    $timeDifference = $currentDateTime->diff($createdAt);
                                    $hours = $timeDifference->h;
                                    $minutes = $timeDifference->i;
                                @endphp
                                <small class="badge bg-light text-dark rounded-pill"
                                    style="font-size: 10px;height:fit-content;">{{ $hours > 0 ? $hours . ' ' . trans('labels.hours_ago') : $minutes . ' ' . trans('labels.minutes_ago') }}</small>
                            </li>
                        @endforeach
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropwdown-item notifications d-flex justify-content-center align-items-center cursor-pointer py-1"
                            data-next="{{ URL::to('admin/bookings') }}"> View All </li>
                    @endif
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-item profile-icon py-2" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <img src="{{ Helper::image_path(Auth::user()->image) }}">
                </a>
                <ul class="dropdown-menu box-shadow border-0 my-3">
                    <li class="white-space-nowrap px-3">
                        @php
                            $now = \Carbon\Carbon::now();
                            $greeting = 'Good evening';
                            if ($now->hour >= 5 && $now->hour < 12) {
                                $greeting = 'Good morning';
                            } elseif ($now->hour >= 12 && $now->hour < 18) {
                                $greeting = 'Good afternoon';
                            }
                        @endphp
                        <p><strong>{{ trans('labels.good_morning') }}</strong> {{ Auth::user()->name }}</p>
                        <small class="text-muted">
                            @if (Auth::user()->type == 1)
                                {{ trans('labels.admin') }}
                            @elseif (Auth::user()->type == 2)
                                {{ trans('labels.dome_owner') }}
                            @elseif (Auth::user()->type == 4)
                                {{ trans('labels.employee') }}
                            @elseif (Auth::user()->type == 5)
                                {{ trans('labels.provider') }}
                            @endif
                        </small>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-item">
                        <a class="d-flex align-items-center px-0"
                            href="{{ URL::to('admin/settings/edit-profile') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-settings me-2"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <p class="text-dark">{{ trans('labels.account_settings') }}</p>
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a class="d-flex align-items-center px-0" onclick="logout('{{ URL::to('logout') }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-logout me-2"
                                width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                <path d="M7 12h14l-3 -3m0 6l3 -3" />
                            </svg>
                            <p class="text-dark">{{ trans('labels.log_out') }}</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</header>
