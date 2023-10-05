<div class="row">
    @forelse ($getslotslist as $key => $slot)
        @php
            $slot_ = date('h:i A', strtotime($slot->start_time)) . ' - ' . date('h:i A', strtotime($slot->end_time));
            $inputattr = '';
            $labelcolor = 'border border-primary text-primary';
            if ($slot->status == 0 || (\Carbon\Carbon::parse($slot->date.' '.$slot->end_time) < \Carbon\Carbon::now()) ) {
                $inputattr = 'disabled';
                $labelcolor = 'bg-dark text-white';
            }
        @endphp
        <div class="col-xl-2 col-lg-3 col-6 d-flex justify-content-center align-items-center my-2 ">
            <input class="form-check-input d-none main-slots" type="checkbox" name="flexRadioDefault" id="check{{ $key }}" {{ $inputattr }}
            data-slot-id="{{ $slot->id }}"
            data-slot-price="{{ $slot->price }}"
            data-slot="{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}"
            >
            <label class="form-check-label d-grid p-2 rounded text-center cursor-pointer {{ $labelcolor }}" for="check{{ $key }}">
                <h4>{{ date('j ',strtotime($slot->date)) }} <small class="fs-7">{{ date('F, Y',strtotime($slot->date)) }}</small> </h4>
                <span>{{ date('h:i A', strtotime($slot->start_time)) }} - {{ date('h:i A', strtotime($slot->end_time)) }}</span>
                <b>{{ Helper::currency_format($slot->price) }}</b>
            </label>
        </div>
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
