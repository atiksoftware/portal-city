@if (App\Models\Weather::Today()) 
<div class="flex items-center ml-8 justify-items-endflex-1 md:flex-none" id="weather">
    <div class="text-xs">
        <div class="text-right">{{Illuminate\Support\Str::upper(App\Models\Settings::get('CITY_NAME'))}}</div>
        <div class="text-right" data-property="description">{{Illuminate\Support\Str::upper(App\Models\Weather::Today()->description)}}</div>
    </div>
    <div class="flex items-start ml-2">
        <span class="text-4xl font-bold" data-property="degree">{{(int)App\Models\Weather::Today()->degree}}</span>
        <span class="text-xs font-bold">°C</span> 
    </div> 
    <div class="ml-2 ">
        <img class="w-8 h-8" src="{{App\Models\Weather::Today()->icon}}" alt="{{Illuminate\Support\Str::upper(App\Models\Weather::Today()->description)}}" data-property="icon">
    </div>
</div>
@endif