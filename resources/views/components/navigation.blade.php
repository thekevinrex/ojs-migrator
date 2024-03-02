@php

$navigation = [
0 => [ 'label' => 'Inicio', 'href' => '/'],
1 => ['label' => 'Issues', 'href' => '/issues'],
2 => ['label' => 'Articulos', 'href' => '/publications'],
3 => ['label' => 'Autores', 'href' => '/authors'],
4 => ['label' => 'Usuarios', 'href' => '/users'],
5 => ['label' => 'Busquedas', 'href' => '/searchs'],
];

@endphp

@props(['current'])

<div class="flex gap-5 items-center">
    @if ($current > 0)
    @php $backButton = $navigation[$current-1] @endphp
    <x-link :back="true" :href="$backButton['href']">{{ $backButton['label'] }}</x-link>
    @endif

    {{ $slot }}


    @if ($current < count($navigation)-1 && $current> 0) @php $nextButton=$navigation[$current+1] @endphp <x-link
            :href="$nextButton['href']">{{
            $nextButton['label'] }}</x-link>
        @endif

</div>