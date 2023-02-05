<div {!! $attributes->merge(['class' => 'p-4 sm:p-4 shadow sm:rounded-lg']) !!}>
    <div class="max-w-full text-white">
        {{ $slot }}
    </div>
</div>