<?php

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class EmailSettings extends Component
{
    public string $notificationEmail = '';

    public function mount(): void
    {
        $this->notificationEmail = Setting::get('notification_email', 'briefing@webspaceship.com.br');
    }

    public function save(): void
    {
        $this->validate([
            'notificationEmail' => 'required|email',
        ], [
            'notificationEmail.required' => 'O e-mail é obrigatório.',
            'notificationEmail.email'    => 'Digite um e-mail válido.',
        ]);

        Setting::set('notification_email', $this->notificationEmail, 'email');

        session()->flash('success', 'E-mail salvo com sucesso!');
    }

    public function render()
    {
        return view('livewire.admin.email-settings')
            ->layout('layouts.app');
    }
}