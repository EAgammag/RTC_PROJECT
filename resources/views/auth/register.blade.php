<x-guest-layout>
<style>
    /* Widen card for registration form */
    .auth-card { max-width: 500px !important; }

    /* Horizontal form rows */
    .hrow { display:flex; align-items:flex-start; gap:.5rem; margin-bottom:.55rem; }
    .hl   { width:90px; min-width:90px; font-size:.76rem; font-weight:600; color:#4b5563;
            padding-top:.6rem; text-align:right; line-height:1.3; flex-shrink:0; }
    .hl small { display:block; font-size:.66rem; font-weight:400; color:#9ca3af; margin-top:.1rem; }
    .hf   { flex:1; min-width:0; }
    .hf .auth-input { width:100%; font-size:.83rem; padding:.5rem .7rem; }

    /* Suffix select */
    .sfx-select {
        width:72px; min-width:72px; padding:.5rem .4rem; font-size:.82rem;
        color:#111827; background:#fff; border:1px solid #d1d5db;
        border-radius:8px; outline:none; cursor:pointer;
        transition:border-color .15s, box-shadow .15s;
    }
    .sfx-select:focus { border-color:#800000; box-shadow:0 0 0 3px rgba(128,0,0,.1); }

    /* Section separator */
    .hsep { display:flex; align-items:center; gap:.4rem; margin:.75rem 0 .65rem; }
    .hsep span { font-size:.63rem; font-weight:700; letter-spacing:.1em;
                 text-transform:uppercase; color:#800000; white-space:nowrap; }
    .hsep::before,.hsep::after { content:''; flex:1; height:1px; background:#e5e7eb; }
</style>

    {{-- Validation errors --}}
    @if ($errors->any())
        <div class="auth-alert auth-alert-error" role="alert">{{ $errors->first() }}</div>
    @endif

    {{-- Header divider --}}
    <div class="hsep"><span>Cadet Self-Registration</span></div>

    <form method="POST" action="{{ route('register') }}" id="registerForm" novalidate>
        @csrf

        {{-- ── Name ── --}}
        {{-- Last Name + Suffix --}}
        <div class="hrow">
            <span class="hl">Last Name</span>
            <div class="hf">
                <input class="auth-input @error('last_name') is-error @enderror"
                       type="text" id="last_name" name="last_name"
                       value="{{ old('last_name') }}" placeholder="Surname"
                       autocomplete="family-name" autofocus required>
                @error('last_name')<div class="auth-field-error">{{ $message }}</div>@enderror
                <div class="auth-field-error" id="last-err" style="display:none;"></div>
            </div>
            <select class="sfx-select" name="suffix" id="suffix" title="Suffix">
                <option value="">Sfx</option>
                <option value="Jr." {{ old('suffix')=='Jr.' ? 'selected' : '' }}>Jr.</option>
                <option value="Sr." {{ old('suffix')=='Sr.' ? 'selected' : '' }}>Sr.</option>
                <option value="II"  {{ old('suffix')=='II'  ? 'selected' : '' }}>II</option>
                <option value="III" {{ old('suffix')=='III' ? 'selected' : '' }}>III</option>
                <option value="IV"  {{ old('suffix')=='IV'  ? 'selected' : '' }}>IV</option>
                <option value="V"   {{ old('suffix')=='V'   ? 'selected' : '' }}>V</option>
            </select>
        </div>

        {{-- First Name --}}
        <div class="hrow">
            <span class="hl">First Name</span>
            <div class="hf">
                <input class="auth-input @error('first_name') is-error @enderror"
                       type="text" id="first_name" name="first_name"
                       value="{{ old('first_name') }}" placeholder="Given name"
                       autocomplete="given-name" required>
                @error('first_name')<div class="auth-field-error">{{ $message }}</div>@enderror
                <div class="auth-field-error" id="first-err" style="display:none;"></div>
            </div>
        </div>

        {{-- Middle Name --}}
        <div class="hrow">
            <span class="hl">Middle Name <small>optional</small></span>
            <div class="hf">
                <input class="auth-input @error('middle_name') is-error @enderror"
                       type="text" id="middle_name" name="middle_name"
                       value="{{ old('middle_name') }}" placeholder="Middle name"
                       autocomplete="additional-name">
                @error('middle_name')<div class="auth-field-error">{{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ── Credentials ── --}}
        <div class="hsep"><span>Login Credentials</span></div>

        {{-- Student ID --}}
        <div class="hrow">
            <span class="hl">Student ID <small>used to sign in</small></span>
            <div class="hf">
                <input class="auth-input @error('student_id') is-error @enderror"
                       type="text" id="student_id" name="student_id"
                       value="{{ old('student_id') }}" placeholder="e.g. 2024-00001"
                       autocomplete="off" required
                       style="font-family:ui-monospace,monospace;letter-spacing:.03em;">
                @error('student_id')<div class="auth-field-error">{{ $message }}</div>@enderror
                <div class="auth-field-error" id="sid-err" style="display:none;"></div>
            </div>
        </div>

        {{-- Email --}}
        <div class="hrow">
            <span class="hl">Email <small>password reset</small></span>
            <div class="hf">
                <input class="auth-input @error('email') is-error @enderror"
                       type="email" id="email" name="email"
                       value="{{ old('email') }}" placeholder="you@csu.edu.ph"
                       autocomplete="email" required>
                @error('email')<div class="auth-field-error">{{ $message }}</div>@enderror
                <div class="auth-field-error" id="email-err" style="display:none;"></div>
            </div>
        </div>

        {{-- ── Security ── --}}
        <div class="hsep"><span>Password</span></div>

        {{-- Password + Confirm (side-by-side) --}}
        <div class="hrow" style="align-items:flex-start;">
            <span class="hl" style="padding-top:.6rem;">Password</span>
            <div style="flex:1;display:grid;grid-template-columns:1fr 1fr;gap:.5rem;min-width:0;">
                <div>
                    <div style="position:relative;">
                        <input class="auth-input @error('password') is-error @enderror"
                               type="password" id="password" name="password"
                               placeholder="Create" autocomplete="new-password" required
                               style="padding-right:2.1rem;font-size:.83rem;padding-top:.5rem;padding-bottom:.5rem;">
                        <button type="button" class="auth-pw-toggle" onclick="togglePw('password',this)" aria-label="Toggle">
                            <svg class="eye-open" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg class="eye-closed" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    @error('password')<div class="auth-field-error" style="font-size:.7rem;">{{ $message }}</div>@enderror
                    <div class="auth-field-error" id="pw-err" style="display:none;font-size:.7rem;"></div>
                </div>
                <div>
                    <div style="position:relative;">
                        <input class="auth-input"
                               type="password" id="password_confirmation" name="password_confirmation"
                               placeholder="Confirm" autocomplete="new-password" required
                               style="padding-right:2.1rem;font-size:.83rem;padding-top:.5rem;padding-bottom:.5rem;">
                        <button type="button" class="auth-pw-toggle" onclick="togglePw('password_confirmation',this)" aria-label="Toggle">
                            <svg class="eye-open" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg class="eye-closed" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none;"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                        </button>
                    </div>
                    <div class="auth-field-error" id="confirm-err" style="display:none;font-size:.7rem;"></div>
                </div>
            </div>
        </div>

        {{-- Password requirements (live) --}}
        <div style="margin-left:98px;margin-bottom:.75rem;">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:.15rem .6rem;padding:.4rem .6rem;background:#f9fafb;border:1px solid #e5e7eb;border-radius:6px;">
                <span class="pw-req" data-rule="length" style="font-size:.67rem;color:#9ca3af;display:flex;align-items:center;gap:.25rem;transition:color .2s;">
                    <span class="req-dot"><svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" stroke="currentColor" stroke-width="1.3"/></svg></span>Min. 8 characters
                </span>
                <span class="pw-req" data-rule="upper" style="font-size:.67rem;color:#9ca3af;display:flex;align-items:center;gap:.25rem;transition:color .2s;">
                    <span class="req-dot"><svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" stroke="currentColor" stroke-width="1.3"/></svg></span>Uppercase letter
                </span>
                <span class="pw-req" data-rule="lower" style="font-size:.67rem;color:#9ca3af;display:flex;align-items:center;gap:.25rem;transition:color .2s;">
                    <span class="req-dot"><svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" stroke="currentColor" stroke-width="1.3"/></svg></span>Lowercase letter
                </span>
                <span class="pw-req" data-rule="number" style="font-size:.67rem;color:#9ca3af;display:flex;align-items:center;gap:.25rem;transition:color .2s;">
                    <span class="req-dot"><svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" stroke="currentColor" stroke-width="1.3"/></svg></span>One number
                </span>
            </div>
        </div>

        {{-- Inactive notice --}}
        <p style="font-size:.7rem;color:#6b7280;margin-bottom:.875rem;line-height:1.5;padding:.4rem .65rem;background:#f9fafb;border-left:3px solid #800000;border-radius:0 4px 4px 0;">
            Account will remain <strong style="color:#374151;">inactive</strong> until an officer validates your enrollment application.
        </p>

        <button type="submit" class="auth-submit" style="font-size:.85rem;padding:.6rem 1rem;">Create Cadet Account</button>
    </form>

    <div style="margin-top:.625rem;text-align:center;">
        <a href="{{ route('login') }}"
           style="font-size:.77rem;color:#800000;text-decoration:none;font-weight:500;"
           onmouseover="this.style.textDecoration='underline';"
           onmouseout="this.style.textDecoration='none';">
            Already have an account? Sign in
        </a>
    </div>

    <script>
    function togglePw(id, btn) {
        var inp = document.getElementById(id);
        var open = btn.querySelector('.eye-open'), closed = btn.querySelector('.eye-closed');
        if (inp.type === 'password') { inp.type='text'; open.style.display='none'; closed.style.display='block'; }
        else { inp.type='password'; open.style.display='block'; closed.style.display='none'; }
    }
    (function () {
        var ln = document.getElementById('last_name'),
            fn = document.getElementById('first_name'),
            s  = document.getElementById('student_id'),
            em = document.getElementById('email'),
            pw = document.getElementById('password'),
            cf = document.getElementById('password_confirmation');
        var lE=document.getElementById('last-err'), fE=document.getElementById('first-err'),
            sE=document.getElementById('sid-err'),  eE=document.getElementById('email-err'),
            pE=document.getElementById('pw-err'),   cE=document.getElementById('confirm-err');

        function show(el,err,msg){ el.classList.add('is-error'); err.textContent=msg; err.style.display='block'; }
        function clear(el,err)   { el.classList.remove('is-error'); err.textContent=''; err.style.display='none'; }

        function vLast()    { var v=ln.value.trim(); if(!v){show(ln,lE,'Last name is required.'); return false;} clear(ln,lE); return true; }
        function vFirst()   { var v=fn.value.trim(); if(!v){show(fn,fE,'First name is required.'); return false;} clear(fn,fE); return true; }
        function vSid()     { var v=s.value.trim();  if(!v){show(s,sE,'Student ID is required.'); return false;} if(v.length>50){show(s,sE,'Max 50 characters.'); return false;} clear(s,sE); return true; }
        function vEmail()   { var v=em.value.trim(); if(!v){show(em,eE,'Email is required.'); return false;} if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v)){show(em,eE,'Enter a valid email.'); return false;} clear(em,eE); return true; }
        function vPw()      { var v=pw.value; if(!v){show(pw,pE,'Password is required.'); return false;} if(v.length<8||!/[A-Z]/.test(v)||!/[a-z]/.test(v)||!/[0-9]/.test(v)){show(pw,pE,'Does not meet requirements.'); return false;} clear(pw,pE); return true; }
        function vConfirm() { var v=cf.value; if(!v){show(cf,cE,'Please confirm.'); return false;} if(v!==pw.value){show(cf,cE,'Passwords do not match.'); return false;} clear(cf,cE); return true; }

        // Live password requirements
        var svgOk='<svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" fill="#16a34a"/><path d="M3 5l1.5 1.5L7 3.5" stroke="#fff" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>';
        var svgNo='<svg width="9" height="9" viewBox="0 0 10 10" fill="none"><circle cx="5" cy="5" r="4.5" stroke="currentColor" stroke-width="1.3"/></svg>';
        var rules={length:function(v){return v.length>=8;},upper:function(v){return /[A-Z]/.test(v);},lower:function(v){return /[a-z]/.test(v);},number:function(v){return /[0-9]/.test(v);}};
        pw.addEventListener('input',function(){
            var v=pw.value;
            document.querySelectorAll('.pw-req').forEach(function(el){
                var ok=rules[el.getAttribute('data-rule')](v);
                el.style.color=ok?'#16a34a':(v.length?'#dc2626':'#9ca3af');
                el.querySelector('.req-dot').innerHTML=ok?svgOk:svgNo;
            });
        });

        ln.addEventListener('blur',vLast);   ln.addEventListener('input',function(){ if(ln.classList.contains('is-error')) vLast(); });
        fn.addEventListener('blur',vFirst);  fn.addEventListener('input',function(){ if(fn.classList.contains('is-error')) vFirst(); });
        s.addEventListener('blur',vSid);     s.addEventListener('input',function(){ if(s.classList.contains('is-error'))   vSid(); });
        em.addEventListener('blur',vEmail);  em.addEventListener('input',function(){ if(em.classList.contains('is-error')) vEmail(); });
        pw.addEventListener('blur',vPw);     pw.addEventListener('input',function(){ if(pw.classList.contains('is-error')) vPw(); if(cf.value&&cf.classList.contains('is-error')) vConfirm(); });
        cf.addEventListener('blur',vConfirm);cf.addEventListener('input',function(){ if(cf.classList.contains('is-error')) vConfirm(); });

        document.getElementById('registerForm').addEventListener('submit',function(ev){
            var r=[vLast(),vFirst(),vSid(),vEmail(),vPw(),vConfirm()];
            if(r.includes(false)){ ev.preventDefault(); [ln,fn,s,em,pw,cf][r.indexOf(false)].focus(); }
        });
    })();
    </script>

</x-guest-layout>
