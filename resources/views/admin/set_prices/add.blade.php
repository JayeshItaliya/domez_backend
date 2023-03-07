@extends('admin.layout.default')
@section('title')
    {{ trans('labels.set_prices') }}
@endsection
@section('contents')
    <div class="card mb-3">
        <div class="card-body py-2">
            <div class="d-flex align-items-center justify-content-between">
                <p class="text-secondary fw-semibold">{{ trans('labels.set_prices') }}</p>
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{ URL::to('admin/dashboard') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-home"
                                    width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                    stroke="var(--bs-secondary)" fill="none" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <polyline points="5 12 3 12 12 3 21 12 19 12" />
                                    <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                    <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ trans('labels.set_prices') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="card">
        <form id="storesetprices" action="{{ URL::to('admin/set-prices/store') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h4>{{ trans('labels.add_new_price') }}</h4>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('labels.dome') }}</label>
                                    <select class="form-select" name="dome" id="dome"
                                        data-next="{{ URL::to('/admin/leagues/sports-fields') }}">
                                        <option value="" disabled selected>{{ trans('labels.select') }}</option>
                                        @foreach ($getdomeslist as $dome)
                                            <option value="{{ $dome->id }}"
                                                {{ $dome->id == old('dome') ? 'selected' : '' }}>{{ $dome->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('dome')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">{{ trans('labels.select_sports') }}</label>
                                    <select class="form-select" name="sport" id="sport">
                                        <option value="" disabled selected>{{ trans('labels.select') }}</option>
                                    </select>
                                    @error('sport')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">{{ trans('labels.start_date') }}</label>
                                    <input type="date" class="form-control" name="start_date" id="start_date"
                                        min="{{ date('Y-m-d') }}" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">{{ trans('labels.end_date') }}</label>
                                    <input type="date" class="form-control" name="end_date" id="end_date" disabled>
                                    @error('end_date')
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-3">
                            <p>{{ trans('labels.select_day_wise_price') }}</p>
                        </div>
                        @php
                            $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                        @endphp
                        <div class="row mb-3">
                            @foreach ($days as $dayname)
                                <div class="col-md-6">
                                    <input type="hidden" name="daynames[]" value="{{ $dayname }}">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h6>{{ ucfirst($dayname) }}</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="row my-2">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control time_picker border-end-0"
                                                                name="start_time[{{ $dayname }}][]"
                                                                placeholder="{{ trans('labels.start_time') }}" />
                                                            <span class="input-group-text bg-transparent border-start-0"><i
                                                                    class="fa-regular fa-clock"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="text"
                                                                class="form-control time_picker border-end-0"
                                                                name="end_time[{{ $dayname }}][]"
                                                                placeholder="{{ trans('labels.end_time') }}" />
                                                            <span class="input-group-text bg-transparent border-start-0"><i
                                                                    class="fa-regular fa-clock"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="number" value="0"
                                                                class="form-control border-end-0"
                                                                name="price[{{ $dayname }}][]"
                                                                placeholder="{{ trans('labels.price') }}">
                                                            <span class="input-group-text bg-transparent border-start-0">
                                                                <i class="fa-solid fa-dollar-sign"></i> </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <a class="btn-custom-primary cursor-pointer appendbtn"
                                                            data-day-name="{{ $dayname }}">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="{{ $dayname }} extra_fields"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-outline-danger me-3">{{ trans('labels.cancel') }}</button>
                    <button type="submit" class="btn btn-primary">{{ trans('labels.submit') }}</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        let start_time = {{ Js::from(trans('labels.start_time')) }};
        let end_time = {{ Js::from(trans('labels.end_time')) }};
        let price = {{ Js::from(trans('labels.price')) }};
        $('#start_date').on('change', function() {
            if ($.trim($(this).val()) != "") {
                $('#end_date').attr('disabled', false);
                $('#end_date').attr('min', $(this).val());
            }
        }).change();
        $('body').on('focus', ".time_picker", function() {
            $(this).timepicker({
                interval: 60,
            });
        });
        $(function() {
            $(".time_picker").timepicker({
                interval: 60,
            });
            var counter = 1;
            $(".appendbtn").on('click', function() {
                counter++;
                var dayname = $(this).attr('data-day-name');
                var html =
                    '<div class="row my-2" id="remove' + counter +
                    '"><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="start_time[' +
                    dayname + '][]" placeholder="' + start_time +
                    '" required /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-4"><div class="form-group"><div class="input-group"><input type="text" class="form-control time_picker border-end-0" name="end_time[' +
                    dayname + '][]" placeholder="' + end_time +
                    '" required /> <span class="input-group-text bg-transparent border-start-0"><i class="fa-regular fa-clock"></i> </span> </div></div></div><div class="col-md-3"><div class="form-group"><div class="input-group"><input type="number" value="0" class="form-control border-end-0" name="price[' +
                    dayname + '][]" placeholder="' + price +
                    '"> <span class="input-group-text bg-transparent border-start-0"> <i class="fa-solid fa-dollar-sign"></i> </span> </div></div></div><div class="col-md-1"><div class="form-group"><a class="btn-custom-danger cursor-pointer" onclick="removeslot(' +
                    counter + ')"><i class="fa fa-close"></i></a></div></div></div>'
                $('.' + dayname + '.extra_fields').append(html);
            });
        });

        function removeslot(id) {
            $('#remove' + id).remove();
        }
        $('#dome').on('change', function() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                },
                url: $(this).attr('data-next'),
                data: {
                    id: $(this).val(),
                },
                method: 'GET',
                success: function(response) {
                    if (response.status == 1) {
                        $('#sport option:not(:first)').remove();
                        if (response.sportsdata.length > 0) {
                            $.each(response.sportsdata, function(arrayIndex, elementValue) {
                                $('#sport').append('<option value="' + elementValue.id + '">' +
                                    elementValue.name + '</option>');
                            });
                        } else {
                            $('#sport').append('<option value="" selected disabled>' + no_data +
                                '</option>');
                        }
                    } else {
                        toastr.error(response.message);
                        return false;
                    }
                },
                error: function(e) {
                    toastr.error(wrong);
                    return false;
                }
            });
        });
        $('#storesetprices').on('submit', function() {
            var check = 1;
            $.each($('#storesetprices select, #storesetprices input'), function(indexInArray, valueOfElement) {
                if ($.trim(valueOfElement.value) == '') {
                    $(this).addClass('is-invalid').focus();
                    if ($(this).parent().hasClass('input-group')) {
                        $(this).next().addClass('border-danger')
                    }
                    check = 0;
                } else {
                    $(this).removeClass('is-invalid');
                    if ($(this).parent().hasClass('input-group')) {
                        $(this).next().removeClass('border-danger')
                    }
                }
                if (check == 0) {
                    return false;
                }
            });
            if (check == 0) {
                return false;
            }
        });
    </script>
@endsection
