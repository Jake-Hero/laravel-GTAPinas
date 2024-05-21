@if($business)
    <h5 class="text-center border-bottom">Inventory</h5>

    <table class="table table-hover">
        <tbody>
            <tr>
                <td class="text-left"><b>Products</b></td>
                <td class="text-right">{{ number_format($business->products) }}</td>
            </tr>
        </tbody>
    </table>

    <h5 class="text-center border-bottom">Products</h5>

    @if(!empty($products))
        <table class="table table-hover">
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td class="text-left align-middle">
                            @if($business->type == 3)
                                <img src="{{ getVehicleImage($product['name']) }}" alt="{{ $product['name'] }}" />
                            @else
                                {{ $product['name'] }}
                            @endif
                        </td>
                        @if($business->type == 3)
                            <td class="align-middle">{{ getVehicleName($product['name']) }}</td>
                        @endif
                        <td class="text-right align-middle"><b>$</b>{{ number_format($product['price']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <center>No products are being sold to this business.</center>
    @endif
@else
    <center>Data not available, contact the Web Developer or the Server Developer.</center>
@endif