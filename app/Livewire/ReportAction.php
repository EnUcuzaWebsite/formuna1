<?php

namespace App\Livewire;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Livewire\Component;

class ReportAction extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function reportAction()
    {
        return Action::make('report')
            ->label('Şikayet Et')
            ->icon('heroicon-o-exclamation-triangle')
            ->form([
                Group::make([
                    Textarea::make('reason')
                        ->label('Şikayet Nedeni')
                        ->rows(3)
                        ->required(),
                ]),
            ])
            ->action(function (array $data) {
                $this->user->report([
                    'type' => 'user report',
                    'message' => '<strong>
                                         <a href="'.route('filament.admin.resources.users.view', ['record' => auth()->user()]).'">
                                            '.auth()->user()->name.'
                                        </a>
                                        </strong>
                                      <small> Şikayet Etti </small>
                                      <strong>
                                        <a href="'.route('filament.admin.resources.users.view', ['record' => $this->user]).'">
                                            '.$this->user->name.'
                                        </a>
                                      </strong>
                                       ',
                    'reason' => $data['reason'],
                ]);

                Notification::make()
                    ->title('Şikayet Gönderildi')
                    ->warning()
                    ->icon('heroicon-o-exclamation-triangle')
                    ->send();
            });

    }

    public function render()
    {
        return view('livewire.report-action');
    }
}
