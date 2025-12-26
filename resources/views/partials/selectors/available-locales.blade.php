<option value="" selected></option>

@foreach(trans('settings.locales') as $localeKey => $locale)
    <option value="{{ $localeKey }}"
            @if(($selection ?? null) == $localeKey) selected @endif
    >{{ $locale }}</option>
@endforeach
