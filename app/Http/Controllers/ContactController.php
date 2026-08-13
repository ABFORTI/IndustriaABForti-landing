<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactSubmitted;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller {
    public function show(): View {
        $companies = config('contact.companies');
        $preselected = request()->query('empresa');

        return view('pages.contact', [
            'companies' => $companies,
            'selected' => array_key_exists($preselected, $companies) ? $preselected : null,
        ]);
    }

    public function store(StoreContactRequest $request): RedirectResponse{
        $data = $request->validated();
        $company = config("contact.companies.{$data['company']}");

        $recipients = collect([$company['email'], config('contact.corporate_email')])
            ->filter()
            ->unique()
            ->values();

        try {
            Mail::to($recipients->first())
                ->cc($recipients->slice(1)->all())
                ->send(new ContactSubmitted([
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'message' => $data['message'],
                    'company_label' => $company['label'],
                ]));
        } catch (Throwable $e) {
            Log::error('No se pudo enviar el correo de contacto.', [
                'company' => $data['company'],
                'exception' => $e->getMessage(),
            ]);

            return redirect()
                ->route('contact.show')
                ->withInput()
                ->with('status', 'error');
        }

        return redirect()
            ->route('contact.show')
            ->with('status', 'sent');
    }
}
