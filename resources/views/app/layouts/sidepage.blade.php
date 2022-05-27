@extends('app.layouts.app')
 

@section('content')

 
@yield('structured_data')

<div 
    class="md:gap-4 md:grid md:grid-cols-12" 
    @yield('itemscopes')
>

    <div class="col-span-8">
        @yield('content_side')
    </div>

    <div class="col-span-4 p-4 md:p-0 ">
        <div class="top-0 md:sticky">
            <div class="grid grid-cols-1 gap-4">
                <div>
                    @include('app.widgets.business_list')
                </div>
                
                <div>
                    <x-adword :adword="\App\Models\Adword::getByTypeId('RIGHT_SIDE_BAR_1')" />
                </div>

                <div>
                    @include('app.widgets.business_category_list')
                </div>

                <div>
                    <x-adword :adword="\App\Models\Adword::getByTypeId('RIGHT_SIDE_BAR_2')" />
                </div>
            </div>
        </div>
    </div>

</div>


@endsection
