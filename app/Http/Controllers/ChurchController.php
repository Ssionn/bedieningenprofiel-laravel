<?php

namespace App\Http\Controllers;

use Filament\Notifications\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChurchController extends Controller
{
    public function show(): View
    {
        return view('churches.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'church_name' => 'required|string|unique:churches|max:255',
            'church_email' => 'required|string|email',
            'church_address' => 'required|string',
        ]);

        if (! $validated) {
            Notification::make()
                ->title('Something went wrong.')
                ->danger()
                ->duration(2500)
                ->send();

            return to_route('churches.create');
        }

        $this->createChurch(
            $request->church_name,
            $request->church_email,
            $request->church_address,
        );

        Notification::make()
            ->title('Church has been created.')
            ->success()
            ->duration(2500)
            ->send();

        return to_route('dashboard');
    }

    protected function createChurch(string $name, string $email, string $address): self
    {
        auth()->user()->ownedChurch()->create([
            'church_name' => $name,
            'church_email' => $email,
            'church_address' => $address,
        ]);

        return $this;
    }
}
