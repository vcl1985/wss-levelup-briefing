<div class="min-h-screen py-8 px-4" style="background: linear-gradient(145deg, #f0f4fa 0%, #e9eef4 100%);">
    @if($submitted)
        <div class="max-w-xl mx-auto text-center mt-20">
            <div class="text-8xl mb-6">🏆</div>
            <h2 class="text-3xl font-bold text-slate-800 mb-3">Briefing enviado com sucesso!</h2>
            <p class="text-slate-500 mb-6">Recebemos suas informações e em breve entraremos em contato.</p>
            <button wire:click="$set('submitted', false)"
                    class="px-6 py-3 bg-[#1E6F5C] text-white rounded-full font-semibold hover:bg-[#0f5444] transition">
                Enviar outro briefing
            </button>
        </div>
    @else
        <div class="max-w-5xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-8">
                <div class="inline-flex items-center gap-3 px-6 py-3 rounded-full shadow-xl mb-4 text-white"
                     style="background: linear-gradient(135deg, #0B2B40, #1E6F5C)">
                    <span class="text-2xl">👑</span>
                    <span class="text-xl font-bold">LevelUp<span class="font-light">·Brief</span></span>
                    <span class="text-xs opacity-70">by WebSpaceship</span>
                </div>
                <h1 class="text-4xl font-extrabold text-slate-800">⚡ Briefing Gamificado</h1>
                <p class="text-slate-500 mt-2 max-w-xl mx-auto text-sm">
                    Cada aba é um nível. Construa a base do seu site de sucesso.
                </p>
            </div>

            {{-- Progress bar --}}
            <div class="mb-5">
                <div class="flex justify-between text-xs text-slate-400 mb-1">
                    <span>Etapa {{ $currentStep + 1 }} de {{ $totalSteps }}</span>
                    <span>{{ $progressPercent }}% completo</span>
                </div>
                <div class="w-full bg-slate-200 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-500"
                         style="width: {{ $progressPercent }}%; background: #1E6F5C;"></div>
                </div>
            </div>

            {{-- Tabs --}}
            <div class="flex flex-wrap gap-2 mb-5 justify-center">
                @foreach($sections as $idx => $section)
                    <button wire:click="goToStep({{ $idx }})"
                            class="px-3 py-1.5 rounded-full text-xs font-semibold transition-all border
                                {{ $currentStep === $idx
                                    ? 'text-white border-transparent shadow-lg'
                                    : 'bg-white text-slate-500 border-slate-200 hover:border-[#1E6F5C]' }}"
                            style="{{ $currentStep === $idx ? 'background:#1E6F5C;' : '' }}">
                        {{ $section['name'] }}
                    </button>
                @endforeach
            </div>

            {{-- Card --}}
            <div class="bg-white rounded-3xl shadow-2xl p-8 border border-slate-100">

                <h2 class="text-xl font-bold text-slate-700 mb-6 pl-4 border-l-4 border-yellow-400">
                    {{ $currentSection['name'] ?? '' }}
                </h2>

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-600 text-sm">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($currentSection['fields'] ?? [] as $field)
                        @php $name = $field['name']; @endphp

                        @if($field['type'] === 'checkboxes')
                            <div class="col-span-full">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-2">
                                    {{ $field['label'] }}
                                </label>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($field['options'] as $option)
                                        <label class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 px-4 py-2 rounded-full text-sm cursor-pointer transition-colors">
                                            <input type="checkbox"
                                                wire:model.live="formData.{{ $name }}"
                                                value="{{ $option }}"
                                                class="accent-[#1E6F5C]">
                                            {{ $option }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                        @elseif($field['type'] === 'select')
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-2">
                                    {{ $field['label'] }}
                                </label>
                                <select wire:model="formData.{{ $name }}"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-[#1E6F5C] focus:ring-2 focus:ring-[#1E6F5C]/20 transition">
                                    @foreach($field['options'] as $option)
                                        <option value="{{ $option }}">{{ $option }}</option>
                                    @endforeach
                                </select>
                            </div>

                        @elseif($field['type'] === 'textarea')
                            <div class="col-span-full">
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-2">
                                    {{ $field['label'] }}
                                </label>
                                <textarea wire:model.live.debounce.500ms="formData.{{ $name }}"
                                          rows="{{ $field['rows'] ?? 3 }}"
                                          placeholder="{{ $field['placeholder'] ?? '' }}"
                                          class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-[#1E6F5C] focus:ring-2 focus:ring-[#1E6F5C]/20 transition resize-none"></textarea>
                            </div>

                        @else
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-[#1E6F5C] mb-2">
                                    {{ $field['label'] }}
                                    @if(!empty($field['required'])) <span class="text-red-400">*</span> @endif
                                </label>
                                <input type="{{ $field['type'] }}"
                                       wire:model.live.debounce.500ms="formData.{{ $name }}"
                                       placeholder="{{ $field['placeholder'] ?? '' }}"
                                       class="w-full bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-sm focus:outline-none focus:border-[#1E6F5C] focus:ring-2 focus:ring-[#1E6F5C]/20 transition">
                            </div>
                        @endif
                    @endforeach
                </div>

                {{-- Navegação --}}
                <div class="flex justify-between mt-8">
                    @if($currentStep > 0)
                        <button wire:click="prevStep"
                                class="px-6 py-3 border border-[#1E6F5C] text-[#1E6F5C] rounded-full font-semibold text-sm hover:bg-[#1E6F5C]/5 transition">
                            ← Anterior
                        </button>
                    @else
                        <div></div>
                    @endif

                    @if($currentStep < $totalSteps - 1)
                        <button wire:click="nextStep"
                                class="px-6 py-3 text-white rounded-full font-semibold text-sm transition hover:opacity-90"
                                style="background:#1E6F5C;">
                            Próximo →
                        </button>
                    @else
                        <button wire:click="submit"
                                class="px-8 py-3 text-white rounded-full font-semibold text-sm transition hover:opacity-90 shadow-lg"
                                style="background:#1E6F5C;">
                            🏆 Enviar Briefing
                        </button>
                    @endif
                </div>
            </div>

            <p class="text-center text-xs text-slate-400 mt-6">
                © LevelUp Briefing — WebSpaceship · Seus dados estão seguros
            </p>
            <div id="autosave-badge"
                style="display:none; opacity:0; transition: opacity 0.5s;"
                class="fixed bottom-5 left-5 flex items-center gap-2 bg-[#1E6F5C]/90 text-white text-xs font-semibold px-4 py-2 rounded-full shadow-lg backdrop-blur">
                ✓ Dados salvos automaticamente
            </div>            
        </div>
    @endif
</div>