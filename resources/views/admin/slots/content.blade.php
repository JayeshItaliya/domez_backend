<div class="row">
    @forelse ($getslotslist as $key => $slot)
        @php
            $slot_ = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
            $inputattr = '';
            $blocked_due_to_working_hours = $blocked_due_to_league = '';
            $labelcolor = 'border border-primary text-primary';
            if (in_array($slot->status, [1, 2]) && \Carbon\Carbon::parse($slot->date . ' ' . $slot->end_time) <= \Carbon\Carbon::now()) {
                $inputattr = 'disabled';
                $labelcolor = 'bg-dark text-white';
            }
            if ($slot->status == 2 && \Carbon\Carbon::parse($slot->date . ' ' . $slot->end_time) > \Carbon\Carbon::now()) {
                $inputattr = '';
                $labelcolor = 'bg-secondary text-white';
            }
            if (in_array(strtolower(date('l', strtotime($slot->date))), $closedays)) {
                $blocked_due_to_working_hours = 1;
                $inputattr = 'disabled';
                $labelcolor = 'bg-dark text-white';
            }
            $req_date = \Carbon\Carbon::parse($slot->date);
            $getdata = App\Models\League::select('name', 'start_date', 'end_date', 'start_time', 'end_time', 'field_id')->where('dome_id', $slot->dome_id)->where('sport_id', $slot->sport_id)->where('is_deleted', 2)->whereRaw('? BETWEEN start_date AND end_date', [date('Y-m-d', strtotime($slot->date))])->whereRaw("FIND_IN_SET(?, REPLACE(days, ' | ', ','))", [$req_date->format('D')])->get();
            foreach ($getdata as $key => $league) {
                $league_start_time = \Carbon\Carbon::parse(date('H:i', strtotime($league->start_time)));
                $league_end_time = \Carbon\Carbon::parse(date('H:i', strtotime($league->end_time)));
                $slot_start_time = \Carbon\Carbon::parse($slot->start_time);
                $slot_end_time = \Carbon\Carbon::parse($slot->end_time);
                if ($slot_start_time->between($league_start_time, $league_end_time) || $slot_end_time->between($league_start_time, $league_end_time)) {
                    if (($slot_start_time->gt($league_start_time) && $slot_start_time->lt($league_end_time)) || ($slot_end_time->gt($league_start_time) && $slot_end_time->lt($league_end_time))) {
                        $blocked_due_to_league = 1;
                        $inputattr = 'disabled';
                        $labelcolor = 'bg-dark text-white';
                        break;
                    }
                }
            }
        @endphp
        {{-- @dump($slot) --}}
        @if ($requestdata['slot_type'] == 'available')
            @if (
                ($inputattr != 'disabled' && $slot->status == 1) ||
                    $blocked_due_to_working_hours == 1 ||
                    $blocked_due_to_league == 1)
                <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2">
                    <input
                        class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} "
                        type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                        data-slot-id="{{ $slot->id }}" data-slot-price="{{ $slot->price }}"
                        data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}">
                    <label
                        class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}"
                        for="check{{ $key }}">
                        <h4>{{ date('j ', strtotime($slot->date)) }} <small
                                class="fs-7">{{ date('F, Y', strtotime($slot->date)) }}</small> </h4>
                        <span>{{ date('h:i A', strtotime($slot->start_time)) }} -
                            {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                        <b>{{ Helper::currency_format($slot->price) }}</b>
                    </label>
                </div>
            @endif
        @elseif($requestdata['slot_type'] == 'blocked')
            @if ($slot->status == 2)
                <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2">
                    <input
                        class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} "
                        type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                        data-slot-id="{{ $slot->id }}" data-slot-price="{{ $slot->price }}"
                        data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}">
                    <label
                        class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}"
                        for="check{{ $key }}">
                        <h4>{{ date('j ', strtotime($slot->date)) }} <small
                                class="fs-7">{{ date('F, Y', strtotime($slot->date)) }}</small> </h4>
                        <span>{{ date('h:i A', strtotime($slot->start_time)) }} -
                            {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                        <b>{{ Helper::currency_format($slot->price) }}</b>
                    </label>
                </div>
            @endif
        @else
            <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2">
                <input
                    class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} "
                    type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                    data-slot-id="{{ $slot->id }}" data-slot-price="{{ $slot->price }}"
                    data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}">
                <label class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}"
                    for="check{{ $key }}">
                    <h4>{{ date('j ', strtotime($slot->date)) }} <small
                            class="fs-7">{{ date('F, Y', strtotime($slot->date)) }}</small> </h4>
                    <span>{{ date('h:i A', strtotime($slot->start_time)) }} -
                        {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                    <b>{{ Helper::currency_format($slot->price) }}</b>
                </label>
            </div>
        @endif
    @empty
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <p class="text-muted fw-bold">
                        {{ trans('messages.no_data') }}
                    </p>
                </div>
            </div>
        </div>
    @endforelse
</div>
