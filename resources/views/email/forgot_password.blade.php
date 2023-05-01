<style>
    /* Button */
    .btn {
        display: inline-block;
        background-color: #000000;
        color: #ffffff !important;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        margin-top: 20px;
    }

    /* Button Hover */
    .btn:hover {
        background-color: #000000;
        color: #ffffff;
    }
</style>
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="display: flex; justify-content:center;">
            <!-- Company Logo -->
            <img class="logo" src="{{ $logo }}" style="text-align:center" alt="Company Logo">
        </div>
        <p style="font-size:1.1em">Hi {{ $name }},</p>
        <p>Thank you for choosing Domez. Use the following Password login.</p>
        <h2 style="background: #000;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">
            {{ $password }}</h2>
        <a class="btn" href="{{ URL::to('login') }}">Login</a>
        <p style="font-size:0.9em;">Regards,<br />Domez Team</p>
        <hr style="border:none;border-top:1px solid #eee" />
    </div>
</div>
