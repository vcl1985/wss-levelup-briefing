<div class="p-6 max-w-lg">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-800">⚙️ Configuração de E-mail</h1>
        <a href="{{ route('admin.submissions') }}"
           class="px-4 py-2 text-sm font-semibold border border-slate-300 rounded-full hover:bg-slate-50 transition">
            ← Voltar
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow p-6 border border-slate-100">

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-xl text-sm">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-600 rounded-xl text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <label class="block text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-2">
            E-mail que receberá os briefings
        </label>
        <input type="email"
               wire:model="notificationEmail"
               placeholder="briefing@webspaceship.com.br"
               class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-[#1E6F5C] focus:ring-2 focus:ring-[#1E6F5C]/20 transition mb-4">

        <button wire:click="save"
                class="px-6 py-3 text-white rounded-full font-semibold text-sm transition hover:opacity-90 shadow"
                style="background:#1E6F5C;">
            Salvar configuração
        </button>
    </div>
</div>