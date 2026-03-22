<?php

namespace App\Livewire;

use App\Mail\BriefingSubmitted;
use App\Models\BriefingSubmission;
use App\Models\BriefingType;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BriefingForm extends Component
{
    public BriefingType $briefingType;
    public int $currentStep = 0;
    public array $formData = [];
    public bool $submitted = false;
    public int $totalSteps = 0;
    public array $sections = [];
    public array $currentSection = [];
    public int $progressPercent = 0;    

    public function mount(string $type = 'presenca-digital'): void
    {
        $this->briefingType   = BriefingType::where('slug', $type)
            ->where('active', true)
            ->firstOrFail();

        $this->sections       = $this->briefingType->schema;
        $this->totalSteps     = count($this->sections);
        $this->currentSection = $this->sections[0] ?? [];
        $this->progressPercent = 0;

        // Inicializa valores padrão para selects e arrays para checkboxes
        foreach ($this->sections as $section) {
            foreach ($section['fields'] as $field) {
                if ($field['type'] === 'select') {
                    $this->formData[$field['name']] = $field['options'][0];
                } elseif ($field['type'] === 'checkboxes') {
                    $this->formData[$field['name']] = [];
                }
            }
        }
    }

    public function nextStep(): void
    {
        if ($this->currentStep < $this->totalSteps - 1) {
            $this->currentStep++;
        }
    }

    public function prevStep(): void
    {
        if ($this->currentStep > 0) {
            $this->currentStep--;
        }
    }

    public function goToStep(int $step): void
    {
        if ($step >= 0 && $step < $this->totalSteps) {
            $this->currentStep = $step;
        }
    }

    public function submit(): void
    {
        $this->validate([
            'formData.empresa' => 'required|string|min:2',
        ], [
            'formData.empresa.required' => 'O nome da empresa é obrigatório.',
            'formData.empresa.min'      => 'O nome da empresa deve ter ao menos 2 caracteres.',
        ]);

        $submission = BriefingSubmission::create([
            'briefing_type_id'    => $this->briefingType->id,
            'empresa'             => $this->formData['empresa'],
            'responsavel_nome'    => $this->formData['responsavel_nome'] ?? null,
            'responsavel_email'   => $this->formData['responsavel_email'] ?? null,
            'responsavel_contato' => $this->formData['responsavel_contato'] ?? null,
            'data'                => $this->formData,
            'ip_address'          => request()->ip(),
        ]);

        $notificationEmail = Setting::get('notification_email', 'briefing@webspaceship.com.br');
        Mail::to($notificationEmail)->send(new BriefingSubmitted($submission));

        if (!empty($this->formData['responsavel_email'])) {
            Mail::to($this->formData['responsavel_email'])->send(new BriefingSubmitted($submission));
        }

        $this->formData = [];
        $this->currentStep = 0;

        // Reinicializa defaults
        foreach ($this->sections as $section) {
            foreach ($section['fields'] as $field) {
                if ($field['type'] === 'select') {
                    $this->formData[$field['name']] = $field['options'][0];
                } elseif ($field['type'] === 'checkboxes') {
                    $this->formData[$field['name']] = [];
                }
            }
        }        

        $this->submitted = true;
        $this->dispatch('formSubmitted');
    }

    public function restoreFromStorage(array $data): void
    {
        if (!empty($data)) {
            $this->formData = array_merge($this->formData, $data);
        }
    }    

public function updated(): void
{
    $this->dispatch('autosave', $this->formData);
}    
    
    public function render()
    {
        $this->currentSection  = $this->sections[$this->currentStep] ?? [];
        $this->progressPercent = (int) (($this->currentStep / max($this->totalSteps - 1, 1)) * 100);

        return view('livewire.briefing-form')->layout('layouts.briefing');
    }   
}