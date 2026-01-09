@foreach($locationsOptions as $locationOptionId => $locationOptionName)
    <option value="{{ $locationOptionId }}"
    @if(isset($selection))
        @if(is_array($selection))
            {{ in_array($locationOptionId, $selection) ? 'selected' : '' }}
            @else
            {{ $selection == $locationOptionId ? 'selected' : '' }}
            @endif
        @endif
    >{{ $locationOptionName }}</option>
@endforeach
