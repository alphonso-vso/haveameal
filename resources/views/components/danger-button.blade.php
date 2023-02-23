<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center text-red-500 tracking-widest hover:text-red-600 active:text-red-700 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
