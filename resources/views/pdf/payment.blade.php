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
    <h1 class="text-2xl font-bold text-center mb-6">Payment Recipt</h1>
    <div class="mb-10">
        <div class="float-right">
            <p class="text-sm"><b>Date:</b> {{ $payment->created_at }} </p>
        </div>
        <div class="float-">
            <h2 class="font-bold">Customer Details</h2>
            <p class="text-sm "><b>Name:</b> {{ $customer->name }} </p>
            <p class="text-sm "><b>Phone:</b> {{ $customer->phone }} </p>
            <p class="text-sm "><b>Email:</b> {{ $customer->email }} </p>
            <p class="text-sm w-72"><b>Address:</b> <br />{{ $customer->address }} </p>

        </div>
    </div>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-gray-50 border">
                <th class="px-4 py-3 text-left" style="background-color:rgb(209 213 219)">Payment Mode:</th>
                <td class="px-4 py-3 text-left">{{ $payment->payment_method }}</td>
            </tr>
            <tr class="bg-gray-50 border">
                <th class="px-4 py-3 text-left" style="background-color:rgb(209 213 219)">Payment #:</th>
                <td class="px-4 py-3 text-left">PAY - {{ str_pad($payment->id, 4, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr class="bg-gray-50 border">
                <th class="px-4 py-3 text-left" style="background-color:rgb(209 213 219)">Date :</th>
                <td class="px-4 py-3 text-left">{{ $payment->created_at->format('d M Y') }}</td>

            </tr>
        </thead>
    </table>

    <table class="float-right text-sm text-left text-gray-500 dark:text-gray-400 mt-10 w-52">
        <thead class="text-xs text-gray-700 uppercase bg-purple-500 dark:bg-gray-700 dark:text-gray-400">
            <tr class="bg-gray-50 border">
                <th class="px-4 py-3 text-left" width="100px"
                    style="background-color:rgb(243 232 255);color: rgb(168 85 247)">Amount Recieved
                </th>
                <td class="px-4 py-3 text-left" style="color: rgb(168 85 247)">Rs.{{ $payment->amount }}</td>
            </tr>
        </thead>
    </table>


    <p class="text-center text-sm text-gray-400 mt-32">Thanks for doing business with us.</p>


</body>

</html>
