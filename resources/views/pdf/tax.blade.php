<!DOCTYPE html>
<html>

<head>

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
            border: 1px solid #818181;
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
    <h1 class="text-2xl font-bold text-center mb-6">Tax Report</h1>
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 ">Invoice #</th>
                <th scope="col" class="px-6 py-3 ">Total Amount</th>
                <th scope="col" class="px-6 py-3 ">Taxes Applied</th>
                <th scope="col" class="px-6 py-3 ">Total Tax Amount</th>
                @foreach ($selectedTaxes as $tax)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tax->name }}
                    </th>
                @endforeach

            </tr>
        </thead>
        <tbody style="color:rgb(121, 121, 121)">
            @php
                $tax_total = 0;
                $tax_break = [];
            @endphp
            @foreach ($data as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $item->id }}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $item->total }}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $item->taxes->pluck('name') }}
                    </td>
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                        {{ $item->getParticularTaxAmount($item->taxes) }}
                        @php
                            $tax_total += $item->getParticularTaxAmount($item->taxes);
                        @endphp
                    </td>
                    @foreach ($selectedTaxes as $tax)
                        <th scope="col" class="px-6 py-3 ">
                            {{ $item->sub_total * ($tax->value / 100) }}
                            @php
                                if (isset($tax_break[$tax->id])) {
                                    $tax_break[$tax->id] += $item->sub_total * ($tax->value / 100);
                                } else {
                                    $tax_break[$tax->id] = $item->sub_total * ($tax->value / 100);
                                }
                            @endphp
                        </th>
                    @endforeach


                </tr>
            @endforeach

        </tbody>
        <tfoot class=" text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 font-bold"></th>
                <th scope="col" class="px-6 py-3 font-bold">{{ $data->sum('total') }}</th>
                <th scope="col" class="px-6 py-3 "></th>
                <th scope="col" class="px-6 py-3 ">{{ $tax_total }}</th>

                @foreach ($selectedTaxes as $tax)
                    <th scope="col" class="px-6 py-3 ">
                        {{ $tax_break[$tax->id] }}</th>
                @endforeach

            </tr>
        </tfoot>
    </table>

</body>

</html>
