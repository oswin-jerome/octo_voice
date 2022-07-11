<div class="">
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
    <div class="float-right absolute" style="top: 60px"></div>
</div>
