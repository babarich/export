<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary text-white p-3 bg-red-500 hover:bg-red-600 active:bg-red-700 w-full']) }}>
    {{ $slot }}
</button>
