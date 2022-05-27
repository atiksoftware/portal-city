<div class="hidden max-w-full lg:block"> 
    <div class="relative h-0 max-w-screen-xl mx-auto"> 
        <div class="absolute w-32 -translate-x-full top-2 -left-2 lg:w-40">
            <x-adword :adword="\App\Models\Adword::getByTypeId('STICKER_LEFT')" />
        </div>
        <div class="absolute w-32 translate-x-full top-2 -right-2 lg:w-40">
            <x-adword :adword="\App\Models\Adword::getByTypeId('STICKER_RIGHT')" />
        </div>
    </div>
</div>