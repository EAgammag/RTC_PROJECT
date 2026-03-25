@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg px-3 py-2 text-sm text-slate-900 placeholder-slate-400 focus:outline-none transition']) }}
       style="background: #f8fafc; border: 1px solid rgba(4,9,15,0.14); @if($disabled) opacity: 0.6; @endif"
       @if($disabled) style="background: #f1f5f9; border: 1px solid rgba(4,9,15,0.08); opacity: 0.6;" @endif>
