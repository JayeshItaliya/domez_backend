<div class="accordion" id="accordionExample">
    <div class="row mb-5">
        @foreach ($dome as $key => $time)
            <div class="col-md-6 my-2">
                <input type="hidden" name="daynames[]" value="{{ $time->day }}">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $key + 1 }}"
                        data-start-time="{{ date('H:i', strtotime($time->open_time)) }}" data-end-time="{{ date('H:i', strtotime($time->close_time)) }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapse{{ $key }}" aria-expanded="false"
                            aria-controls="collapse{{ $key }}">
                            <span class="d-flex justify-content-between align-items-center w-100">
                                <b>{{ ucfirst($time->day) }}</b>
                                <span class="mx-3">
                                    {{ date('H:i', strtotime($time->open_time)) . ' - ' . date('H:i', strtotime($time->close_time)) }}
                                </span>
                            </span>
                        </button>
                    </h2>
                    <div id="collapse{{ $key }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $key + 1 }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="card-body card-body-{{ $time->day }}">
                                <div class="row my-2 {{ $time->day }}-row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text"
                                                    class="form-control start time_picker border-end-0"
                                                    name="start_time[{{ $time->day }}][]"
                                                    data-day-name="{{ $time->day }}"
                                                    placeholder="{{ trans('labels.start_time') }}" />
                                                <span class="input-group-text bg-transparent border-start-0"><i
                                                        class="fa-regular fa-clock"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control end time_picker border-end-0"
                                                    name="end_time[{{ $time->day }}][]"
                                                    data-day-name="{{ $time->day }}"
                                                    placeholder="{{ trans('labels.end_time') }}" />
                                                <span class="input-group-text bg-transparent border-start-0"><i
                                                        class="fa-regular fa-clock"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="number" class="form-control border-end-0"
                                                    name="price[{{ $time->day }}][]"
                                                    placeholder="{{ trans('labels.price') }}">
                                                <span class="input-group-text bg-transparent border-start-0">
                                                    <i class="fa-solid fa-dollar-sign"></i> </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-sm btn-outline-primary appendbtn" data-day-name="{{ $time->day }}" data-day-max-time="{{ date('H:i', strtotime($time->close_time)) }}"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="{{ $time->day }} extra_fields"></div>
                                <div class="col-12 text-center">
                                    <button type="button" class="btn btn-outline-dark btn-reset-slots d-none" onclick="reset_slots(this)" data-days-name="{{ $time->day }}"><b><i class="fa-light fa-arrow-rotate-right fa-spin"></i></b> {{ trans('labels.reset_slots') }} </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
