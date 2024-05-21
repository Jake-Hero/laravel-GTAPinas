@if(!empty($vehdata))

    <h5 class="text-center border-bottom">Inventory</h5>

    <table class="table table-hover">   
        <tbody>
            <tr>
                <td><b>Ticket</b></td>
                <td class="text-center"><b>$</b>{{ number_format($vehdata->ticket) }}</td>
            </tr>
        </tbody>
    </table>

    <h5 class="text-center border-bottom">Weapons</h5>

    @if(!empty($weapons))
        <table class="table table-hover">
            <tbody>
                @foreach($weapons as $w)
                    <tr>
                        <td>{{ getWeaponName($w['weapon']) }}</td>
                        <td class="text-center"><b>Ammo:</b> {{ $w['ammo'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <center>No weapon is stored in this vehicle.</center>
    @endif
@else
    <center>Data not available, contact the Web Developer or the Server Developer.</center>
@endif