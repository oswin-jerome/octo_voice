<!DOCTYPE html>
<html>

<head>
    <title>Sales Report</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;

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

        th {
            text-align: left;
        }

        table,
        td,
        th {
            /* border: 1px solid #818181; */
            border-collapse: collapse;
        }

        .text-left {
            text-align: left !important;
        }

        .mb-6 {
            margin-bottom: 1.5rem;
        }

        .table {
            display: table;
        }

        .w-full {
            width: 100%;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .border {
            border-width: 1px;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .bg-gray-50 {
            --tw-bg-opacity: 1;
            background-color: rgb(249 250 251 / var(--tw-bg-opacity));
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity));
        }

        .p-10 {
            padding: 2.5rem;
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .text-2xl {
            font-size: 1.5rem;
            line-height: 2rem;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .font-medium {
            font-weight: 500;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .text-gray-500 {
            --tw-text-opacity: 1;
            color: rgb(107 114 128 / var(--tw-text-opacity));
        }

        .text-gray-700 {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity));
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity));
        }

        @media (prefers-color-scheme: dark) {
            .dark\:border-gray-700 {
                --tw-border-opacity: 1;
                border-color: rgb(55 65 81 / var(--tw-border-opacity));
            }

            .dark\:bg-gray-700 {
                --tw-bg-opacity: 1;
                background-color: rgb(55 65 81 / var(--tw-bg-opacity));
            }

            .dark\:bg-gray-800 {
                --tw-bg-opacity: 1;
                background-color: rgb(31 41 55 / var(--tw-bg-opacity));
            }

            .dark\:text-gray-400 {
                --tw-text-opacity: 1;
                color: rgb(156 163 175 / var(--tw-text-opacity));
            }

            .dark\:text-white {
                --tw-text-opacity: 1;
                color: rgb(255 255 255 / var(--tw-text-opacity));
            }
        }
    </style>
    {{-- <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css" /> --}}
</head>

<body style="" class="p-10">
    @php
        $total = 0;
    @endphp
    <h1 class="text-2xl font-bold text-center mb-6">Sales Report</h1>
    <p class="text-center pb-10">{{ $from . ' - ' . $to }}</p>

    @foreach ($deliverables as $key => $item)
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mt-4">
            {{-- <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th width="400px">{{ $item->name }}</th>
                    <th></th>
                </tr>
            </thead> --}}
            <tbody>
                {{-- @foreach ($item->invoices as $key => $val) --}}
                <tr style="color:#656565">
                    <td width="400px" class="px-4 py-3" style="border-bottom: 1px solid #DEDEDE;">{{ $item->name }}</td>
                    <td class="px-4 py-3" style="border-bottom: 1px solid #DEDEDE;">
                        @php
                            $t = 0;
                            $item->invoices->each(function ($invoice) use (&$t, $item) {
                                if ($invoice->pivot->deliverable_id == $item->id) {
                                    $t += $invoice->pivot->quantity * $invoice->pivot->amount_per_unit;
                                }
                            });
                        @endphp
                        Rs.{{ $t }} </td>
                    @php
                        $total += $t;
                    @endphp
                </tr>
                {{-- @endforeach --}}
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th class="px-4 py-3"></th>
                    <th class="px-4 py-3">Rs. </th>
                </tr>
            </tfoot> --}}
        </table>
        <br>
        <br>
    @endforeach

    <div style="background: rgba(0, 68, 255, 0.288);height: 50px;padding:10px">
        <div class="px-4 py-3 text-xl" style="float: left;"> Total Sales</div>
        <div class="px-4 py-3 text-xl font-bold" style="float: right;top: 0;left: 0;">
            Rs. {{ $total }}</div>
    </div>

</body>

</html>
