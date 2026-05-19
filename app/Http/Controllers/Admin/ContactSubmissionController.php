<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSubmission;
use Illuminate\Http\Request;

class ContactSubmissionController extends Controller
{
    public function index()
    {
        $submissions = ContactSubmission::orderBy('created_at', 'desc')->get();
        return view('admin.contact.index', compact('submissions'));
    }

    public function show(ContactSubmission $contact)
    {
        if ($contact->status === 'new') {
            $contact->update(['status' => 'read']);
        }
        return view('admin.contact.show', ['submission' => $contact]);
    }

    public function destroy(ContactSubmission $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contact.index')->with('success', 'Inbox submission deleted successfully.');
    }
}
