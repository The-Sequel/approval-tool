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
                            <h3 style="font-family: 'Open Sans', sans-serif; text-align: center;">Er is een taak geweigerd</h3>
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <p style="font-family: 'Open Sans', sans-serif; text-align: center;">Geweigerd door: 
                                @php
                                    $user = \App\Models\User::find($task->denied_by);
                                @endphp
                                {{$user->name}}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>