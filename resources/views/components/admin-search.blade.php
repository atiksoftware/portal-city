@props([
    'name' => '',
])

<div class="m-4 md:flex">
    <div class="flex-1">
        <form action="" method="GET"> 
            <input type="text" name="search" id="search" value="{{request()->get('search')}}" 
            placeholder="Aramak için buraya yazın"
            
            class="block w-full px-0 py-2 text-sm font-semibold text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 " placeholder=" " required="">
            
        </form>
    </div>
    <div class="mt-4 md:ml-4 md:mt-0">
        <a href="{{route('admin.'.$name.'.create')}}" class="block px-3 py-2 text-white rounded bg-slate-700 hover:bg-slate-900">
            + Yeni Ekle
        </a>
    </div>
</div>