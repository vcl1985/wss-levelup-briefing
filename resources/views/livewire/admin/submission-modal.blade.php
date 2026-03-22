<div>
@if($open && $submission)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4"
         style="background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);">

        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-hidden flex flex-col">

            <div class="flex items-center justify-between p-6 border-b border-slate-100"
                 style="background: linear-gradient(135deg, #0B2B40, #1E6F5C);">
                <div>
                    <h2 class="text-xl font-bold text-white">{{ $submission->empresa }}</h2>
                    <p class="text-sm text-white/70">
                        {{ $submission->briefingType->name }} —
                        {{ $submission->created_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                <button wire:click="close"
                        class="text-white/70 hover:text-white transition text-2xl leading-none">
                    ✕
                </button>
            </div>

            <div class="flex items-center gap-3 px-6 py-3 bg-slate-50 border-b border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Status:</span>
                <button wire:click="updateStatus('novo')"
                        class="px-3 py-1 rounded-full text-xs font-semibold transition
                               {{ $submission->status === 'novo' ? 'bg-blue-500 text-white' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                    Novo
                </button>
                <button wire:click="updateStatus('em_analise')"
                        class="px-3 py-1 rounded-full text-xs font-semibold transition
                               {{ $submission->status === 'em_analise' ? 'bg-yellow-500 text-white' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                    Em Análise
                </button>
                <button wire:click="updateStatus('concluido')"
                        class="px-3 py-1 rounded-full text-xs font-semibold transition
                               {{ $submission->status === 'concluido' ? 'bg-green-500 text-white' : 'bg-slate-200 text-slate-600 hover:bg-slate-300' }}">
                    Concluído
                </button>
            </div>

            <div class="overflow-y-auto flex-1 p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-1">Responsável</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $submission->responsavel_nome ?: '—' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-1">E-mail</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $submission->responsavel_email ?: '—' }}</p>
                    </div>
                    <div class="bg-slate-50 rounded-2xl p-4">
                        <p class="text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-1">Telefone</p>
                        <p class="text-sm font-semibold text-slate-700">{{ $submission->responsavel_contato ?: '—' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach($submission->data as $key => $value)
                        @if(!empty($value))
                            <div class="bg-slate-50 rounded-2xl p-4 {{ is_array($value) ? 'md:col-span-2' : '' }}">
                                <p class="text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-1">
                                    {{ Str::title(str_replace('_', ' ', $key)) }}
                                </p>
                                <p class="text-sm text-slate-700">
                                    {{ is_array($value) ? implode(', ', $value) : $value }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="p-4 border-t border-slate-100 flex justify-end">
                <button wire:click="close"
                        class="px-6 py-2 border border-slate-300 rounded-full text-sm font-semibold hover:bg-slate-50 transition">
                    Fechar
                </button>
            </div>
        </div>
    </div>
@endif    
</div>