<link rel="stylesheet" href="{{ url('storage/app/public/admin/css/bootstrap/bootstrap.min.css') }}">
<style>
    body {
        background-color: white;
        font-family: "Yanone Kaffeesatz", sans-serif;
        font-weight: 600;
    }

    img {
        max-width: 100%;
        height: auto;
    }

    .ticket {
        width: 600px;
        height: -webkit-fit-content;
        height: -moz-fit-content;
        height: fit-content;
        background-color: rgba(70, 143, 114, 0.1);
        margin: 25px auto;
        position: relative;
        border-radius: 10px;
    }

    .holes-top {
        /* height: 50px;
        width: 50px;
        background-color: white;
        border-radius: 50%; */
        position: absolute;
        left: 50%;
        margin-left: -25px;
        top: -25px;
    }

    .holes-top:before,
    .holes-top:after {
        content: "";
        height: 50px;
        width: 50px;
        background-color: white;
        position: absolute;
        border-radius: 50%;
    }

    .holes-top:before {
        left: -175px;
    }

    .holes-top:after {
        left: 175px;
    }

    .holes-lower {
        position: relative;
        margin: 25px;
        border: 1.5px dashed #fff;
    }

    .holes-lower:before,
    .holes-lower:after {
        content: "";
        height: 50px;
        width: 50px;
        background-color: white;
        position: absolute;
        border-radius: 50%;
    }

    .holes-lower:before {
        top: -25px;
        left: -50px;
    }

    .holes-lower:after {
        top: -25px;
        right: -50px;
    }

    .title {
        padding: 50px 25px 10px;
    }

    .cinema {
        color: #aaa;
        font-size: 22px;
        text-align: center;
    }

    .movie-title {
        text-align: center;
        font-size: 12px;
    }

    .info {
        padding: 15px 25px;
    }

    table {
        width: 100%;
        font-size: 18px;
        margin-bottom: 15px;
    }

    table tr {
        margin-bottom: 10px;
    }

    table th {
        text-align: left;
    }

    table th:nth-of-type(1) {
        width: 38%;
    }

    table th:nth-of-type(2) {
        width: 40%;
    }

    table th:nth-of-type(3) {
        width: 15%;
    }

    table td {
        width: 33%;
        font-size: 32px;
    }

    .bigger {
        font-size: 48px;
    }

    .serial {
        padding: 25px;
    }

    .serial table {
        border-collapse: collapse;
        margin: 0 auto;
    }

    .serial td {
        width: 3px;
        height: 50px;
    }

    .numbers td {
        font-size: 16px;
        text-align: center;
    }
</style>

<div class="ticket">
    {{-- <div class="holes-top"></div> --}}
    <div class="title">
        <div style="display: flex; justify-content:center; margin-top: 0px; margin-bottom: 20px">
            <!-- Company Logo -->
            <img class="logo" src="{{ Helper::image_path('logo.png') }}" style="text-align:center"
                alt="{{ env('APP_NAME') }}">
        </div>
        <p class="cinema">Booking Receipt</p>
        <p class="movie-title">Thank you for booking with us. Here are the details of your reservation.</p>
    </div>
    <div class="info">
        <div class="row justify-content-between align-items-start mb-3">
            <div class="col-10">
                <h5 class="fw-bold text-wrap mb-0">Dome Name</h5>
            </div>
            <div class="col-2">
                <span class="badge rounded-pill cursor-pointer text-bg-success">{{ trans('labels.confirmed') }}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="" class="form-label text-muted">Booking Reference</label>
                <p class="text-muted">#5676346823</p>
            </div>
        </div>
    </div>
    <div class="holes-lower"></div>
    <div class="serial">

    </div>
</div>
