<?php

namespace App\Mail;

use App\Models\Change;
use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectChange extends Mailable
{
    use Queueable, SerializesModels;

    public $change;
    public $project;
    public $userWhoUpdated;

    /**
     * Create a new message instance.
     *
     * @param Change $change
     * @param Project $project
     * @param User $userWhoUpdated
     */
    public function __construct(Change $change, Project $project, User $userWhoUpdated)
    {
        $this->change = $change;
        $this->project = $project;
        $this->userWhoUpdated = $userWhoUpdated;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.project_changes')
                    ->with([
                        'change' => $this->change,
                        'project' => $this->project,
                        'userWhoUpdated' => $this->userWhoUpdated,
                    ])
                    ->subject('Alteração no projeto ' . $this->project->name);
    }
}
