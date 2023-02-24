<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
    <div style="margin:50px auto;width:70%;padding:20px 0">
        <div style="border-bottom:1px solid #eee">
            <a href="" style="font-size:1.4em;color: #00bac7;text-decoration:none;font-weight:600">
                <img src="{{ $logo }}" alt="Logo">
            </a>
        </div>
        <p style="font-size:1.1em">Hello, Admin</p>
        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
            style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
            <tr>
                <td style="height:40px;">&nbsp;</td>
            </tr>
            <tr>
                <td style="padding:0 35px; text-align:left;">
                    <h5 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:'Rubik',sans-serif;">
                        {{ $title }}</h5>
                    <span
                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                    <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                    <h3><b> Venue Name : {{ $venue_name }}</b></h3>
                    <h3><b> Venue Address : {{ $venue_address }}</b></h3>
                    <h3><b> Name : {{ $name }}</b></h3>
                    <h3><b> Email : {{ $email }}</b></h3>
                    <h3><b> Phone : {{ $phone }}</b></h3>
                    <h3><b> Message : {{ $comment }}</b></h3>
                    </p>
                </td>
            </tr>
            <tr>
                <td style="height:40px;">&nbsp;</td>
            </tr>
        </table>
        <hr style="border:none;border-top:1px solid #eee" />
    </div>
</div>
