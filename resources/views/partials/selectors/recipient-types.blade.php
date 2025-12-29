@foreach($recipientTypesOptions as $recipientTypeOptionId => $recipientTypeOptionName)
    <option value="{{ $recipientTypeOptionId }}"
    @if(isset($selection))
        @if(is_array($selection))
            {{ in_array($recipientTypeOptionId, $selection) ? 'selected' : '' }}
            @else
            {{ $selection == $recipientTypeOptionId ? 'selected' : '' }}
            @endif
        @endif
    >{{ $recipientTypeOptionName }}</option>
@endforeach
