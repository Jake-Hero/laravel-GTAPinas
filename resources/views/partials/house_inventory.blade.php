@if(!empty($houseData))
    <h5 class="text-center border-bottom">House Safe</h5>

    <table class="table table-hover">
        <tr>
            <td><b>Money</b></td>
            <td class="text-center">${{ number_format($houseData->money) }}</td>
        </tr>
    </table>

    <h5 class="text-center border-bottom">Weapons</h5>

    @if(!empty($weapons))
        <table class="table table-hover">
            @foreach($weapons as $w)
                <tr>
                    <td>{{ getWeaponName($w['weapon']) }}</td>
                    <td class="text-center"><b>Ammo:</b> {{ $w['ammo'] }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <center>No weapon is stored in this house.</center>
    @endif
@else
    <center>Data not available, contact the Web Developer or the Server Developer.</center>
@endif
