<x-mail::message>
# 📋 Novo Briefing Recebido

**Empresa:** {{ $submission->empresa }}
**Responsável:** {{ $submission->responsavel_nome ?? '—' }}
**E-mail:** {{ $submission->responsavel_email ?? '—' }}
**Telefone:** {{ $submission->responsavel_contato ?? '—' }}
**Tipo:** {{ $submission->briefingType->name }}
**Data:** {{ $submission->created_at->format('d/m/Y H:i') }}

---

@foreach($submission->data as $key => $value)
@if(!empty($value))
**{{ Str::title(str_replace('_', ' ', $key)) }}:** {{ is_array($value) ? implode(', ', $value) : $value }}

@endif
@endforeach

Att,
{{ config('app.name') }}
</x-mail::message>