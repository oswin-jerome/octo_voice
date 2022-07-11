<!DOCTYPE html>
<html>

<head>

    <style>
        * {
            font-family: 'Nunito', sans-serif;

        }

        @page {
            margin: 0;
        }

        body {
            /* background: rgb(243, 243, 243); */
        }

        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #656565;
            color: white;
        }

        .text-left {
            text-align: left !important;
        }
    </style>
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css" />
</head>

<body style="" class="p-10">
    <h1 class="text-2xl font-bold text-center mb-0">Estimation</h1>
    <div class="mb-10">
        <div class="text-center">
            <p class="text-xs"><b>Valid till:</b> {{ $estimate->valid_till }} </p>
        </div>

    </div>
    @include('pdf.partials.both_address', ['customer' => $estimate->customer])


    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-gray-50" style="background-color:rgb(209 213 219)">
                <th class="px-4 py-3 text-left">Deliverable</th>
                <th class="px-4 py-3 text-left">Price</th>
                <th class="px-4 py-3 text-left">Quantity</th>
                <th class="px-4 py-3 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimate->deliverables as $key => $item)
                <tr @if ($key % 2 == 0) style="background-color:rgb(249 250 251)" @endif>
                    <td class="px-4 py-3">{{ $item->name }}</td>
                    <td class="px-4 py-3">Rs. {{ $item->pivot->amount_per_unit }}</td>
                    <td class="px-4 py-3">{{ $item->pivot->quantity }}</td>
                    <td class="px-4 py-3">Rs. {{ $item->pivot->amount_per_unit * $item->pivot->quantity }}</td>
                    <td></td>
                </tr>
            @endforeach

        </tbody>
        <tfoot style="background-color:rgb(209 213 219)">
            <tr>
                <td class="px-4 py-3" colspan="3" style="text-align:right;">Sub Total </td>
                <td style="background-color:rgb(249 250 251)" class="px-4 py-3">Rs. {{ $estimate->sub_total }}</td>
            </tr>
            <tr>
                <td class="px-4 py-3" colspan="3" style="text-align:right;">Discount</td>
                <td style="background-color:rgb(249 250 251)" class="px-4 py-3">Rs. {{ $estimate->discount_amount }}
                </td>
            </tr>
            @foreach ($estimate->taxes as $item)
                <tr>
                    <td class="px-4 py-3" colspan="3" style="text-align:right;">{{ $item->name }}</td>
                    <td style="background-color:rgb(249 250 251)" class="px-4 py-3">
                        <p>+ Rs. {{ $estimate->sub_total * ($item->value / 100) }}
                        <p class="text-xs">({{ $item->value }} %)</p>
                        </p>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td class="px-4 py-3" colspan="3" style="text-align:right;">Sub Total - Discount </td>
                <td style="background-color:rgb(249 250 251)" class="px-4 py-3">Rs. {{ $estimate->total }}</td>
            </tr>
        </tfoot>
    </table>

    <p class="text-center text-sm text-gray-400 mt-10">Thanks for doing business with us.</p>
    {{-- <table id="customers">
        <thead>
            <tr>
                <th>Particulars</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimate->deliverables as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>1</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align:right;">Rs. Sub Total </td>
                <td>{{ $estimate->sub_total }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">Rs. Discount</td>
                <td>{{ $estimate->discount_amount }}</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">Rs. Sub Total - Discount </td>
                <td>{{ $estimate->total }}</td>
            </tr>
        </tfoot>
    </table> --}}

</body>

</html>
