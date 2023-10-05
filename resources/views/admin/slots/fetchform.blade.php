<div class="card">
    <div class="card-body">
        <form id="fetchslotsform" action="{{ route('fetch.blocked.slots') }}" method="post">
            <div class="row g-3">
                <div class="input-group gap-2">
                    <select class="form-control rounded" name="dome" id="dome"
                        data-next="{{ URL::to('/admin/dome-sports') }}">
                        <option value="" selected> {{ trans('labels.select_dome') }} </option>
                        @foreach ($domelist as $dome)
                            <option value="{{ $dome->id }}" data-dome-name="{{ $dome->name }}">
                                {{ $dome->name }} </option>
                        @endforeach
                    </select>
                    <select class="form-control rounded" name="sport" id="sport">
                        <option value="" selected> {{ trans('labels.select_sport') }} </option>
                    </select>
                    <input type="text" class="form-control rounded date-range-picker-slots" name="date_range"
                    placeholder="{{ trans('labels.select_date') }}">
                    <select class="form-control rounded" name="slot_type" id="sport">
                        <option value="" selected> {{ trans('labels.all_slots') }} </option>
                        <option value="available"> {{ trans('labels.available') }} </option>
                        <option value="blocked"> {{ trans('labels.blocked') }} </option>
                    </select>
                    <button type="submit" class="btn btn-primary rounded"> {{ trans('labels.fetch') }} </button>
                </div>
            </div>
        </form>
        <div class="slot-content mt-3"></div>
        <button type="button" class="btn btn-primary btn-block-slots" data-action="{{ route('block.slots') }}">
            {{ trans('labels.block_selected_slots') }} </button>
    </div>
</div>
