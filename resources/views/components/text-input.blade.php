@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'fur-input']) }}>
