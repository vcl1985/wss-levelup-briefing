<?php

namespace App\Livewire\Admin;

use App\Models\BriefingSubmission;
use Livewire\Attributes\On;
use Livewire\Component;

class SubmissionModal extends Component
{
    public bool $open = false;
    public ?BriefingSubmission $submission = null;

    #[On('openSubmission')]
    public function load(int $id): void
    {
        $this->submission = BriefingSubmission::with('briefingType')->findOrFail($id);
        $this->open = true;
    }

    public function close(): void
    {
        $this->open = false;
        $this->submission = null;
    }

    public function render()
    {
        return view('livewire.admin.submission-modal');
    }
}