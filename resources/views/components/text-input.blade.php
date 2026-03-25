@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg px-3 py-2 text-sm text-white placeholder-slate-500 focus:outline-none transition']) }}
       style="background: rgba(255,255,255,0.07); border: 1px solid rgba(255,255,255,0.15);"
       @if($disabled) style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); opacity: 0.6;" @endif>
