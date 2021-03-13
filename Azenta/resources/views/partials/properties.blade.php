<h4 class="property-title">Property</h4>
<div class="property-list" id="propertiesData">
    @foreach($properties as $p)
        @if($p->dateExpired > $currentDate)
            @component("components.properties.properties",["p" => $p])
            @endcomponent
        @endif
    @endforeach
</div>
<div class="property-pagination" id="propertyPagination">
    {{ $properties->links() }}
</div>
