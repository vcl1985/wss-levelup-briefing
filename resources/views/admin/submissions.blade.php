<x-app-layout>
    <div class="p-6">

        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-slate-800">📋 Submissões de Briefing</h1>
            <a href="{{ route('admin.email-settings') }}"
               class="px-4 py-2 text-sm font-semibold border border-slate-300 rounded-full hover:bg-slate-50 transition">
                ⚙️ Configurar E-mail
            </a>
        </div>

        <livewire:admin.submissions-table />
        <livewire:admin.submission-modal />
    </div>
</x-app-layout>