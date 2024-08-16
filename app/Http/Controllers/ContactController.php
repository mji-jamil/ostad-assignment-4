<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // List all contacts
    public function index(Request $request)
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }


    // Show the form to create a new contact
    public function create()
    {
        return view('contacts.create');
    }

    // Store a new contact
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Contact::create($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact created successfully.');
    }

    // Show a specific contact
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    // Show the form to edit a contact
    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    // Update a contact
    public function update(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => "required|email|unique:contacts,email,{$contact->id}",
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $contact->update($request->all());
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully.');
    }

    // Delete a contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
