<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Repositories\TeamRepository;
use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamsController extends Controller
{
    public function __construct(
        protected TeamRepository $teamRepository
    ) {
    }

    public function show(Team $currentTeam): View
    {
        return view('teams.show', [
            'team' => $currentTeam,
        ]);
    }

    public function create(): View
    {
        return view('teams.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->teamRepository->createTeam($request->only('name', 'description'));

        return redirect()->route('dashboard');
    }

    public function switchTeam($teamId): RedirectResponse
    {
        $this->teamRepository->switchTeamId(
            $teamId
        );

        Notification::make()
            ->title(__('teams/switch.notification.title', ['team' => auth()->user()->currentTeam->name]))
            ->success()
            ->duration(2500)
            ->send();

        return redirect()->route('dashboard');
    }
}
