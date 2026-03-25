<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-2.5 rounded-lg font-semibold text-xs uppercase tracking-widest transition hover:opacity-90 focus:outline-none']) }}
        style="background: linear-gradient(135deg, #c8a951 0%, #a08030 100%); color: #061020;">
    {{ $slot }}
</button>
