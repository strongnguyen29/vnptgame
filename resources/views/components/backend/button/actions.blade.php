<div {{ $attributes->merge(['class' => 'd-flex align-items-center']) }}>

    {{ $slot }}

    <x-backend.button.edit btn-class="mr-1" route-name="admin.{{ $model }}.edit" :routeData="$routeData"/>
    <x-backend.button.del route-name="admin.{{ $model }}.destroy" :routeData="$routeData" />
</div>
