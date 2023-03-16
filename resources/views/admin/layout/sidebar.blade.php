<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="navbar-wrapper">
        <ul class="navbar-nav d-block">
            <a href="{{ URL::to('admin/dashboard') }}"
                class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-dashboard" width="25"
                    height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <circle cx="12" cy="13" r="2" />
                    <line x1="13.45" y1="11.55" x2="15.5" y2="9.5" />
                    <path d="M6.4 20a9 9 0 1 1 11.2 0z" />
                </svg>
                <span class="mx-3">{{ trans('labels.dashboard') }}</span>
            </a>
            @if (Auth::user()->type == 1)
                <a href="{{ URL::to('admin/vendors') }}"
                    class="nav-item {{ request()->is('admin/vendors*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle"
                        width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="12" r="9" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                    </svg>
                    <span class="mx-3">{{ trans('labels.dome_owners') }}</span>
                </a>
                <a href="{{ URL::to('admin/users') }}"
                    class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="25"
                        height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                    </svg>
                    <span class="mx-3">{{ trans('labels.users') }}</span>
                </a>
                <a href="{{ URL::to('admin/sports') }}"
                    class="nav-item {{ request()->is('admin/sports*') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-check"
                        width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M3.5 5.5l1.5 1.5l2.5 -2.5"></path>
                        <path d="M3.5 11.5l1.5 1.5l2.5 -2.5"></path>
                        <path d="M3.5 17.5l1.5 1.5l2.5 -2.5"></path>
                        <path d="M11 6l9 0"></path>
                        <path d="M11 12l9 0"></path>
                        <path d="M11 18l9 0"></path>
                    </svg>
                    <span class="mx-3">{{ trans('labels.sports') }}</span>
                </a>
            @endif
            <a href="#domesmanagement"
                class="nav-item {{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button"
                aria-expanded="{{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'true' : 'false' }}"
                aria-controls="domesmanagement">
                <i class="fa-regular fa-list-tree"></i>
                <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                    <span> {{ trans('labels.domes_management') }} </span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </a>
            <div class="collapse {{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'show' : '' }}"
                id="domesmanagement">
                <ul class="nav d-grid">
                    <a href="{{ URL::to('admin/domes') }}" class="nav-item">
                        <span
                            class="nav-link {{ request()->is('admin/domes*') ? 'active' : '' }}">{{ trans('labels.domes') }}</span>
                    </a>
                    @if (Auth::user()->type == 2)
                        <a href="{{ URL::to('admin/fields') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/field*') ? 'active' : '' }}">{{ trans('labels.fields') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/set-prices') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/set-prices*') ? 'active' : '' }}">{{ trans('labels.set_prices') }}</span>
                        </a>
                    @endif
                </ul>
            </div>


            <a href="{{ URL::to('admin/leagues') }}"
                class="nav-item {{ request()->is('admin/leagues*') ? 'active' : '' }}">
                <i class="fa-light fa-list-dropdown"></i>
                <span class="mx-3">{{ trans('labels.leagues') }}</span>
            </a>
            <a href="{{ URL::to('admin/bookings') }}"
                class="nav-item {{ request()->is('admin/bookings*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-event"
                    width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="5" width="16" height="16" rx="2" />
                    <line x1="16" y1="3" x2="16" y2="7" />
                    <line x1="8" y1="3" x2="8" y2="7" />
                    <line x1="4" y1="11" x2="20" y2="11" />
                    <rect x="8" y="15" width="2" height="2" />
                </svg>
                {{-- <i class="fa-light fa-calendar-day"></i> --}}
                <span class="mx-3">{{ trans('labels.bookings') }}</span>
            </a>
            <a href="{{ URL::to('admin/transactions') }}"
                class="nav-item {{ request()->is('admin/transactions*') ? 'active' : '' }}">
                <i class="fa-light fa-file-invoice-dollar"></i>
                <span class="mx-3">{{ trans('labels.transactions') }}</span>
            </a>
            <a href="{{ URL::to('admin/calendar') }}"
                class="nav-item {{ request()->is('admin/calendar*') ? 'active' : '' }}">
                <i class="fa-light fa-calendar-range"></i>
                <span class="mx-3">{{ trans('labels.calendar') }}</span>
            </a>
            @if (Auth::user()->type == 2)
                <a href="{{ URL::to('admin/reviews') }}"
                    class="nav-item {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                    <i class="fa-light fa-message-smile"></i>
                    <span class="mx-3">{{ trans('labels.reviews') }}</span>
                </a>
            @endif
            @if (Auth::user()->type == 1)
                <a href="#enquiry" class="nav-item {{ request()->is('admin/enquiries*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->is('admin/enquiries*') ? 'true' : 'false' }}"
                    aria-controls="enquiry">
                    <i class="fa-light fa-message-smile"></i>
                    <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                        <span>{{ trans('labels.enquiry') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/enquiries*') ? 'show' : '' }}" id="enquiry">
                    <ul class="nav d-grid">
                        <a href="{{ URL::to('admin/enquiries/dome-requests') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/enquiries/dome-requests') ? 'active' : '' }}">{{ trans('labels.domes_requests') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/enquiries/general-enquiry') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/enquiries/general-enquiry') ? 'active' : '' }}">{{ trans('labels.general_enquiry') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/enquiries/help-support') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/enquiries/help-support') ? 'active' : '' }}">{{ trans('labels.help_support') }}</span>
                        </a>
                    </ul>
                </div>
                <a href="#generalsettings" class="nav-item {{ request()->is('admin/settings*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->is('admin/settings*') ? 'true' : 'false' }}"
                    aria-controls="generalsettings">
                    <i class="fa-light fa-wrench"></i>
                    <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                        <span>{{ trans('labels.general_settings') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/settings*') ? 'show' : '' }}" id="generalsettings">
                    <ul class="nav d-grid">
                        <a href="{{ URL::to('admin/settings/privacy-policy') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/privacy-policy') ? 'active' : '' }}">{{ trans('labels.privacy_policy') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/settings/terms-conditions') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/terms-conditions') ? 'active' : '' }}">{{ trans('labels.terms_conditions') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/settings/edit-profile') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/edit-profile') ? 'active' : '' }}">{{ trans('labels.edit_profile') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/settings/email-setting') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/email-setting') ? 'active' : '' }}">{{ trans('labels.email_settings') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/settings/twilio-setting') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/twilio-setting') ? 'active' : '' }}">{{ trans('labels.twilio_settings') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/settings/stripe-setting') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/stripe-setting') ? 'active' : '' }}">{{ trans('labels.stripe_settings') }}</span>
                        </a>
                    </ul>
                </div>
            @endif
            <a href="{{ URL::to('admin/supports') }}"
                class="nav-item {{ request()->is('admin/supports*') ? 'active' : '' }}">
                <i class="fa-light fa-circle-question"></i>
                <span class="mx-3">{{ trans('labels.supports') }}</span>
            </a>
        </ul>
    </div>
</nav>
