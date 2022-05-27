<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',\App\Models\Settings::get('SITE_NAME'))</title>
  
    <meta name="robots" content="noindex, nofollow">

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
 

</head>

<body class="sm:bg-slate-200">
 
    <div >
        <!-- This example requires Tailwind CSS v2.0+ -->
        <nav class="bg-gray-800">
            <div class="container mx-auto ">
                <div class="relative flex items-center justify-between h-16">
       
                     
                    <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
                        <div class="flex items-center flex-shrink-0">
                            <img class="block w-auto h-8"
                            src="{{url('/storage/defaults/app_logo.svg')}}" alt="{{\App\Models\Settings::get('SITE_NAME')}}"> 
                        </div>
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                                <a href="#" class="px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-md"
                                    aria-current="page">Dashboard</a>

                                @foreach (\App\Helpers\MenuHelper::getAdminMenuItems() as $item)
                                    <a href="{{$item['url']}}"
                                    class="@if ($item['is_active'])
                                    bg-gray-900
                                    @endif text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">{{$item['title']}}</a>
                                    
                                @endforeach

                           
                            </div>
                        </div>
                    </div>
                    <div
                        class="absolute inset-y-0 right-0 items-center hidden pr-2 text-white lg:flex sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                         
                        <x-my-account platform="desktop" /> 
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state. -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
    
                    <div class="grid grid-cols-2 gap-3">

                        @foreach (\App\Helpers\MenuHelper::getAdminMenuItems() as $item)
                            <a href="{{$item['url']}}"
                            class="@if ($item['is_active'])
                            text-white bg-gray-900
                            @else
                            text-gray-300 bg-slate-700 bg-opacity-25
                            @endif block px-3 py-2 text-sm font-medium  rounded-md hover:bg-gray-700 hover:text-white">{{$item['title']}}</a>
                            
                        @endforeach
                        <a href="{{route('profile')}}"
                        class="block px-3 py-2 text-sm font-medium text-gray-300 bg-opacity-25 rounded-md bg-slate-700 hover:bg-gray-700 hover:text-white">{{__('app.my_profile')}}</a>
                </div>

                </div>
            </div>
        </nav>



        <x-admin-alerts />

        <div class="container mx-auto mb-10 bg-white sm:mt-4 sm:rounded sm:shadow sm:overflow-hidden">
            @yield('content', 'Default content')
        </div>
        


    </div>





</body>


{{-- <script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/balloon-block/ckeditor.js"></script> --}}
<script src="{{ asset('js/admin.js') }}"></script>

</html>
