<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    
    <table width="100%" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td>
                {{-- Header --}}
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr style="border: 1px solid red;">
                        <td>
                            <img width="100%" height="100" src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" class="attachment-full size-full entered lazyloaded" alt="" decoding="async" data-lazy-src="https://thesequel.nl/wp-content/uploads/2022/09/logo.svg" style="display: block; margin: 0; padding: 0;">
                        </td>
                    </tr>
                </table>

                {{-- Content --}}
                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            @if($mail->subject == 0)
                                <h3 style="font-family: 'Open Sans', sans-serif; text-align: center;">{{$mail->user}} heeft een vraag</h3>
                            @elseif($mail->subject == 1)
                                <h3 style="font-family: 'Open Sans', sans-serif; text-align: center;">{{$mail->user}} heeft een technisch probleem</h3>
                            @elseif($mail->subject == 2)
                                <h3 style="font-family: 'Open Sans', sans-serif; text-align: center;">{{$mail->user}} wil een nieuwe gebruiker aanvragen</h3>
                            @elseif($mail->subject == 3)
                                <h3 style="font-family: 'Open Sans', sans-serif; text-align: center;">{{$mail->user}} wil zijn gegevens aanpassen</h3>
                            @endif
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <p style="font-family: 'Open Sans', sans-serif; text-align: center;"><span style="font-weight: bold;">Bericht:</span> {{$mail->message}}</p>
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <p style="font-family: 'Open Sans', sans-serif; text-align: center;"><span style="font-weight: bold;">Klant:</span> {{$mail->customer}}</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>

{{-- @extends('layouts.mail')

@section('content')
    @if($mail->subject == 0)
        <h2>{{$mail->user}} heeft een vraag</h2>
    @elseif($mail->subject == 1)
        <h2>{{$mail->user}} heeft een technisch probleem</h2>
    @elseif($mail->subject == 2)
        <h2>{{$mail->user}} wil een nieuwe gebruiker aanvragen</h2>
    @elseif($mail->subject == 3)
        <h2>{{$mail->user}} wil zijn gegevens aanpassen</h2>
    @endif

    <p>{{$mail->message}}</p>

    <p>Klant: {{$mail->customer}}</p>
@endsection --}}