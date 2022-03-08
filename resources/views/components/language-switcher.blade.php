@foreach(config('app.available_locales') as $locale_name => $available_locale)
    @if($available_locale != app()->getLocale())
        <x-dropdown-link :href="route('language', $available_locale)">
            {{ __($locale_name) }}
        </x-dropdown-link>
    @endif
@endforeach
