<div class="row">
    @forelse ($getslotslist as $key => $slot)
        @php
            $slot_ = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
            $inputattr = '';
            $labelcolor = 'border border-primary text-primary';

            if (in_array($slot->status,[1,2]) && (\Carbon\Carbon::parse($slot->date.' '.$slot->end_time) <= \Carbon\Carbon::now()) ) {
                $inputattr = 'disabled';
                $labelcolor = 'bg-dark text-white';
            }else if ($slot->status == 2 && (\Carbon\Carbon::parse($slot->date.' '.$slot->end_time) > \Carbon\Carbon::now()) ) {
                $inputattr = '';
                $labelcolor = 'bg-secondary text-white';
            }
        @endphp
        @if ($requestdata['slot_type'] == "available")
            @if ($inputattr != "disabled" && $slot->status == 1)
            <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2 ">
                <input class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} " type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                data-slot-id="{{ $slot->id }}"
                data-slot-price="{{ $slot->price }}"
                data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}"
                >
                <label class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}" for="check{{ $key }}">
                    <h4>{{ date('j ',strtotime($slot->date)) }} <small class="fs-7">{{ date('F, Y',strtotime($slot->date)) }}</small> </h4>
                    <span>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                    <b>{{ Helper::currency_format($slot->price) }}</b>
                </label>
            </div>
            @endif
        @elseif($requestdata['slot_type'] == "blocked")
            @if ($slot->status == 2)
            <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2 ">
                <input class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} " type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                data-slot-id="{{ $slot->id }}"
                data-slot-price="{{ $slot->price }}"
                data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}"
                >
                <label class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}" for="check{{ $key }}">
                    <h4>{{ date('j ',strtotime($slot->date)) }} <small class="fs-7">{{ date('F, Y',strtotime($slot->date)) }}</small> </h4>
                    <span>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                    <b>{{ Helper::currency_format($slot->price) }}</b>
                </label>
            </div>
            @endif
        @else
            <div class="col-xl-2 col-lg-3 col-6 d-flex align-items-center my-2 ">
                <input class="form-check-input d-none main-slots {{ $slot->status == 1 ? 'blockable-slots' : 'unblockable-slots' }} " type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
                data-slot-id="{{ $slot->id }}"
                data-slot-price="{{ $slot->price }}"
                data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}"
                >
                <label class="form-check-label d-grid p-2 rounded text-center cursor-pointer w-100 {{ $labelcolor }}" for="check{{ $key }}">
                    <h4>{{ date('j ',strtotime($slot->date)) }} <small class="fs-7">{{ date('F, Y',strtotime($slot->date)) }}</small> </h4>
                    <span>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</span>
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
