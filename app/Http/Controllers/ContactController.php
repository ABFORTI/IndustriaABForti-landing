<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Mail\ContactSubmitted;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        $companies = config('contact.companies');
        $preselected = request()->query('empresa');

        return view('pages.contact', [
            'companies' => $companies,
            'selected' => array_key_exists($preselected, $companies) ? $preselected : null,
        ]);
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $company = config("contact.companies.{$data['company']}");

        $recipients = collect([$company['email'], config('contact.corporate_email')])
            ->filter()
            ->unique()
            ->values();

        Mail::to($recipients->first())
            ->cc($recipients->slice(1)->all())
            ->send(new ContactSubmitted([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'message' => $data['message'],
                'company_label' => $company['label'],
            ]));

        return redirect()
            ->route('contact.show')
            ->with('status', 'sent');
    }
}
