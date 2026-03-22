<?php

namespace App\Livewire\Admin;

use App\Models\BriefingSubmission;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Button;

final class SubmissionsTable extends PowerGridComponent
{
    public string $tableName = 'submissions-table';

    public function setUp(): array
    {
        return [
            PowerGrid::header()->showSearchInput(),
            PowerGrid::footer()->showPerPage()->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return BriefingSubmission::query()
            ->with('briefingType')
            ->latest();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('empresa')
            ->add('responsavel_nome')
            ->add('responsavel_email')
            ->add('responsavel_contato')
            ->add('briefing_type', fn($row) => $row->briefingType->name ?? '—')
            ->add('status')
            ->add('created_at_formatted', fn($row) => $row->created_at->format('d/m/Y H:i'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->sortable(),
            Column::make('Empresa', 'empresa')->sortable()->searchable(),
            Column::make('Responsável', 'responsavel_nome')->sortable()->searchable(),
            Column::make('E-mail', 'responsavel_email')->searchable(),
            Column::make('Telefone', 'responsavel_contato'),
            Column::make('Tipo', 'briefing_type'),
            Column::make('Status', 'status')->sortable(),
            Column::make('Enviado em', 'created_at_formatted', 'created_at')->sortable(),
            Column::action('Ações'),
        ];
    }

    public function actions(BriefingSubmission $row): array
    {
        return [
        Button::add('ver')
            ->slot('Ver detalhes')
            ->class('px-3 py-1 text-xs font-semibold text-white rounded-full cursor-pointer bg-[#1E6F5C]')
            ->dispatch('openSubmission', ['id' => $row->id]),
        ];
    }    

    public function filters(): array
    {
        return [
            Filter::inputText('empresa', 'empresa'),
            Filter::select('status', 'status')
                ->dataSource(collect([
                    ['value' => 'novo',       'label' => 'Novo'],
                    ['value' => 'em_analise', 'label' => 'Em Análise'],
                    ['value' => 'concluido',  'label' => 'Concluído'],
                ]))
                ->optionLabel('label')
                ->optionValue('value'),
        ];
    }
}