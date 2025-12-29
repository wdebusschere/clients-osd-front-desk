@foreach($usersOptions as $userOptionId => $userOptionName)
    <option value="{{ $userOptionId }}"
    @if(isset($selection))
        @if(is_array($selection))
            {{ in_array($userOptionId, $selection) ? 'selected' : '' }}
            @else
            {{ $selection == $userOptionId ? 'selected' : '' }}
            @endif
        @endif
    >{{ $userOptionName }}</option>
@endforeach
