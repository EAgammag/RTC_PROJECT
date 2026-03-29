<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-xs uppercase tracking-widest transition hover:opacity-90 focus:outline-none']) }}
        style="background: linear-gradient(135deg, #FFD700 0%, #C7A600 100%); color: #200608;">
    {{ $slot }}
</button>
