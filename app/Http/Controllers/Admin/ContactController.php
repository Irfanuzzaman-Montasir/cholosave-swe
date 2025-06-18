<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = ContactUs::query();
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        $messages = $query->latest()->get();
        return view('admin.contacts.index', compact('messages', 'status'));
    }

    public function destroy(ContactUs $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message deleted successfully.');
    }

    public function markAsDone(ContactUs $contact)
    {
        $contact->status = 'done';
        $contact->save();
        return response()->json(['success' => true]);
    }
} 