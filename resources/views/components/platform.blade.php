@props(['platforms'])

@foreach ($platforms as $platform)
    @if (array_key_exists('abbreviation', $platform))
        {{ $platform->abbreviation }},
    @endif
@endforeach
