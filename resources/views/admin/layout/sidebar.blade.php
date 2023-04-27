<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <div class="navbar-wrapper">
        <ul class="navbar-nav d-block">
            @if (Auth::user()->type != 5)
                <a href="{{ URL::to('admin/dashboard') }}"
                    class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-table-columns {{ request()->is('admin/dashboard') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.dashboard') }}</span>
                </a>
            @endif
            @if (Auth::user()->type == 2)
                <a href="{{ URL::to('admin/workers') }}"
                    class="nav-item {{ request()->is('admin/workers*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-chalkboard-user {{ request()->is('admin/workers*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.workers') }}</span>
                </a>
                <a href="{{ URL::to('admin/providers') }}"
                    class="nav-item {{ request()->is('admin/providers*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-square-user {{ request()->is('admin/providers*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.providers') }}</span>
                </a>
            @endif
            @if (Auth::user()->type == 1)
                <a href="{{ URL::to('admin/vendors') }}"
                    class="nav-item {{ request()->is('admin/vendors*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-circle-user {{ request()->is('admin/vendors*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.dome_owners') }}</span>
                </a>
                <a href="{{ URL::to('admin/users') }}"
                    class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-user-check {{ request()->is('admin/users*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.users') }}</span>
                </a>
                <a href="{{ URL::to('admin/sports') }}"
                    class="nav-item {{ request()->is('admin/sports*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-basketball {{ request()->is('admin/sports*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.sports') }}</span>
                </a>
            @endif
            @if (Auth::user()->type != 5)
                <a href="#domesmanagement"
                    class="nav-item {{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'true' : 'false' }}"
                    aria-controls="domesmanagement">
                    <i
                        class="fa-regular fa-igloo {{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'text-secondary' : '' }}"></i>
                    <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                        <span> {{ trans('labels.domes_management') }} </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="{{ request()->is('admin/domes*') || request()->is('admin/field*') || request()->is('admin/set-prices*') ? 'var(--bs-secondary)' : '#2c3e50' }}"
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
                        @endif
                        @if (in_array(Auth::user()->type, [2, 4]))
                            <a href="{{ URL::to('admin/set-prices') }}" class="nav-item">
                                <span
                                    class="nav-link {{ request()->is('admin/set-prices*') ? 'active' : '' }}">{{ trans('labels.set_prices') }}</span>
                            </a>
                        @endif
                    </ul>
                </div>
            @endif
            <a href="{{ URL::to('admin/leagues') }}"
                class="nav-item {{ request()->is('admin/leagues*') ? 'active' : '' }}">
                <i
                    class="fa-regular fa-ranking-star {{ request()->is('admin/leagues*') ? 'text-secondary' : '' }}"></i>
                <span class="mx-3">{{ trans('labels.leagues') }}</span>
            </a>
            <a href="{{ URL::to('admin/bookings') }}"
                class="nav-item {{ request()->is('admin/bookings*') ? 'active' : '' }}">
                <i
                    class="fa-regular fa-calendar-circle-plus {{ request()->is('admin/bookings*') ? 'text-secondary' : '' }}"></i>
                <span class="mx-3">{{ trans('labels.bookings') }}</span>
            </a>
            @if (in_array(Auth::user()->type, [1, 2]))
                <a href="{{ URL::to('admin/transactions') }}"
                    class="nav-item {{ request()->is('admin/transactions*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-money-from-bracket {{ request()->is('admin/transactions*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.transactions') }}</span>
                </a>
            @endif
            @if (Auth::user()->type != 5)
                <a href="{{ URL::to('admin/calendar') }}"
                    class="nav-item {{ request()->is('admin/calendar*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-calendar-lines {{ request()->is('admin/calendar*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.calendar') }}</span>
                </a>
            @endif
            @if (in_array(Auth::user()->type, [2, 4]))
                <a href="{{ URL::to('admin/reviews') }}"
                    class="nav-item {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                    <i
                        class="fa-regular fa-star-exclamation {{ request()->is('admin/reviews*') ? 'text-secondary' : '' }}"></i>
                    <span class="mx-3">{{ trans('labels.reviews') }}</span>
                </a>
                @if (Auth::user()->type == 2)
                    <a href="{{ URL::to('admin/enquiries/dome-requests') }}"
                        class="nav-item {{ request()->is('admin/enquiries/dome-requests*') ? 'active' : '' }}">
                        <i class="fa-regular fa-comments-question {{ request()->is('admin/enquiries*') ? 'text-secondary' : '' }}"></i>
                        <span class="mx-3">{{ trans('labels.dome_requests') }}</span>
                    </a>
                @endif
            @endif
            @if (Auth::user()->type == 1)
                <a href="#enquiry" class="nav-item {{ request()->is('admin/enquiries*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->is('admin/enquiries*') ? 'true' : 'false' }}" aria-controls="enquiry">
                    <i class="fa-regular fa-comments-question {{ request()->is('admin/enquiries*') ? 'text-secondary' : '' }}"></i>
                    <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                        <span class="position-relative">{{ trans('labels.enquiry') }}
                            @if (Helper::get_noti_count(1) > 0 || Helper::get_noti_count(2) > 0 || Helper::get_noti_count(3) > 0)
                                <small
                                    class="position-absolute translate-middle border border-light rounded-circle badge bg-primary p-1"
                                    style="top: 20%; left:115%; background-color:#FE3B30 !important;">
                                </small>
                            @endif
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="{{ request()->is('admin/enquiries*') ? 'var(--bs-secondary)' : '#2c3e50' }}"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/enquiries*') ? 'show' : '' }}" id="enquiry">
                    <ul class="nav d-grid">
                        <a href="{{ URL::to('admin/enquiries/dome-requests') }}"
                            class="nav-item d-flex justify-contewnt-between">
                            <span
                                class="nav-link w-100 {{ request()->is('admin/enquiries/dome-requests') ? 'active' : '' }}">{{ trans('labels.dome_requests') }}</span>
                            @if (Helper::get_noti_count(3) > 0)
                                <small class="badge bg-danger rounded-pill"
                                    style="font-size: 10px;height:fit-content;background-color:#FE3B30 !important;">{{ Helper::get_noti_count(3) }}</small>
                            @endif
                        </a>
                        <a href="{{ URL::to('admin/enquiries/general-enquiry') }}"
                            class="nav-item d-flex justify-contewnt-between">
                            <span
                                class="nav-link w-100 {{ request()->is('admin/enquiries/general-enquiry') ? 'active' : '' }}">{{ trans('labels.general_enquiry') }}</span>
                            @if (Helper::get_noti_count(2) > 0)
                                <small class="badge bg-danger rounded-pill"
                                    style="font-size: 10px;height:fit-content;background-color:#FE3B30 !important;">{{ Helper::get_noti_count(2) }}</small>
                            @endif
                        </a>
                        <a href="{{ URL::to('admin/enquiries/help-support') }}"
                            class="nav-item d-flex justify-contewnt-between">
                            <span
                                class="nav-link w-100 {{ request()->is('admin/enquiries/help-support') ? 'active' : '' }}">{{ trans('labels.help_support') }}</span>
                            @if (Helper::get_noti_count(1) > 0)
                                <small class="badge bg-danger rounded-pill"
                                    style="font-size: 10px;height:fit-content;background-color:#FE3B30 !important;">{{ Helper::get_noti_count(1) }}</small>
                            @endif
                        </a>
                    </ul>
                </div>
                <a href="#cms" class="nav-item {{ request()->is('admin/cms*') ? 'active' : '' }}"
                    data-bs-toggle="collapse" role="button"
                    aria-expanded="{{ request()->is('admin/cms*') ? 'true' : 'false' }}" aria-controls="cms">
                    <i
                        class="fa-regular fa-shield-check {{ request()->is('admin/cms*') ? 'text-secondary' : '' }}"></i>
                    <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                        <span>{{ trans('labels.cms') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="{{ request()->is('admin/cms*') ? 'var(--bs-secondary)' : '#2c3e50' }}"
                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </div>
                </a>
                <div class="collapse {{ request()->is('admin/cms*') ? 'show' : '' }}" id="cms">
                    <ul class="nav d-grid">
                        <a href="{{ URL::to('admin/cms/terms-conditions') }}" class="nav-item"> <span
                                class="nav-link {{ request()->is('admin/cms/terms-conditions') ? 'active' : '' }}">{{ trans('labels.terms_conditions') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/cms/privacy-policy') }}" class="nav-item"> <span
                                class="nav-link {{ request()->is('admin/cms/privacy-policy') ? 'active' : '' }}">{{ trans('labels.privacy_policy') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/cms/cancellation-policies') }}" class="nav-item"> <span
                                class="nav-link {{ request()->is('admin/cms/cancellation-policies') ? 'active' : '' }}">{{ trans('labels.cancellation_policy') }}</span>
                        </a>
                        <a href="{{ URL::to('admin/cms/refund-policies') }}" class="nav-item"> <span
                                class="nav-link {{ request()->is('admin/cms/refund-policies') ? 'active' : '' }}">{{ trans('labels.refund_policy') }}</span>
                        </a>
                    </ul>
                </div>
            @endif
            <a href="#generalsettings" class="nav-item {{ request()->is('admin/settings*') ? 'active' : '' }}"
                data-bs-toggle="collapse" role="button"
                aria-expanded="{{ request()->is('admin/settings*') ? 'true' : 'false' }}"
                aria-controls="generalsettings">
                <i class="fa-regular fa-wrench {{ request()->is('admin/settings*') ? 'text-secondary' : '' }}"></i>
                <div class="ms-3 d-flex align-items-center justify-content-between w-100">
                    <span>{{ trans('labels.general_settings') }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-down"
                        width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="{{ request()->is('admin/settings*') ? 'var(--bs-secondary)' : '#2c3e50' }}"
                        fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </div>
            </a>
            <div class="collapse {{ request()->is('admin/settings*') ? 'show' : '' }}" id="generalsettings">
                <ul class="nav d-grid">
                    <a href="{{ URL::to('admin/settings/edit-profile') }}" class="nav-item">
                        <span
                            class="nav-link {{ request()->is('admin/settings/edit-profile') ? 'active' : '' }}">{{ trans('labels.edit_profile') }}</span>
                    </a>
                    @if (in_array(Auth::user()->type, [1, 2]))
                        <a href="{{ URL::to('admin/settings/stripe-setting') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/stripe-setting') ? 'active' : '' }}">{{ trans('labels.stripe_settings') }}</span>
                        </a>
                    @endif
                    @if (Auth::user()->type == 1)
                        <a href="{{ URL::to('admin/settings/email-setting') }}" class="nav-item">
                            <span
                                class="nav-link {{ request()->is('admin/settings/email-setting') ? 'active' : '' }}">{{ trans('labels.email_settings') }}</span>
                        </a>
                    @endif
                </ul>
            </div>
            @if (Auth::user()->type != 5)
                <a href="{{ URL::to('admin/supports') }}"
                    class="nav-item {{ request()->is('admin/supports*') ? 'active' : '' }}">
                    <i class="fa-regular fa-circle-question"
                        {{ request()->is('admin/supports*') ? 'text-secondary' : '' }}></i>
                    <div class="d-flex justify-content-between w-100 aling-items-center">
                        <span class="mx-3">{{ trans('labels.supports') }}</span>
                        @if (Helper::get_noti_count(5) > 0)
                            <small class="badge bg-danger rounded-pill"
                                style="font-size: 10px;height:fit-content;background-color:#FE3B30 !important;">{{ Helper::get_noti_count(5) }}</small>
                        @endif
                    </div>
                </a>
            @endif
        </ul>
    </div>
</nav>
