<!DOCTYPE html>
<html>

<head>
    <style>
        * {
            font-family: 'Nunito', sans-serif;

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
    </style>
</head>

<body style="">


    <table id="customers">
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
    </table>

</body>

</html>
