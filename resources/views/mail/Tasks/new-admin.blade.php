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
                            <h3 style="font-family:Arial, Helvetica, sans-serif; text-align: center;">Er is een nieuwe taak aangemaakt</h3>
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <p style="font-family:Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 0;">Gemaakt door: {{$task->user->name}}</p>
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        @if($task->deadline != null)
                            <td>
                                <p style="font-family:Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 0;">Deadline: {{$task->deadline}}</p>
                            </td>
                        @endif
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <p style="font-family:Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 0;">Toegewezen aan: 
                                @foreach(json_decode($task->assigned_to) as $assignedUser)
                                    @php
                                        $assignedUser = App\Models\User::find($assignedUser);
                                    @endphp
                                    {{$assignedUser->name}},
                                @endforeach
                            </p>
                        </td>
                    </tr>
                </table>

                <table width="100%" cellspacing="0" cellpadding="0" border="0">
                    <tr>
                        <td>
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; margin-top: 20px;">
                                <a style="font-family:Arial, Helvetica, sans-serif; text-align: center; margin-bottom: 0;" href="{{route('admin.tasks.show', $task)}}"><button style="padding: 12px 24px;">Klik hier</button></a>
                            </div>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>