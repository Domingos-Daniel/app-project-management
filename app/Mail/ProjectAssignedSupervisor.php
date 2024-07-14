<?php
namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProjectAssignedSupervisor extends Mailable
{
    use Queueable, SerializesModels;

    public $project;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user)
    { 
        $this->project = $project->load('supervisor');
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Novo Projeto Atribuído')
                    ->view('emails.project_assigned_supervisor');
    }
}
