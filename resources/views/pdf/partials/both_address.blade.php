<div class="relative">
    <div>
        <p class="font-bold text-xl">
            {{ App\Models\Setting::getSetting('company_name') }}
        </p>
        <p class="" style="max-width: 300px;">
            {{ App\Models\Setting::getSetting('company_address') }}
        </p>
        <p class="">
            {{ App\Models\Setting::getSetting('company_phone') }}
        </p>
        <p class="">
            {{ App\Models\Setting::getSetting('company_email') }}
        </p>
    </div>
    <div class="float-right absolute" style="top: 00px">
        <h2 class="font-bold">To,</h2>
        <h2 class="font-bold">Customer Details</h2>
        <p class="text-sm "><b>Name:</b> {{ $customer->name }} </p>
        <p class="text-sm "><b>Phone:</b> {{ $customer->phone }} </p>
        <p class="text-sm "><b>Email:</b> {{ $customer->email }} </p>
        <p class="text-sm w-72"><b>Address:</b> <br />{{ $customer->address }} </p>
    </div>
</div>
