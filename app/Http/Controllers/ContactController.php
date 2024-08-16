<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sortField = $request->input('sort', 'name');
        $sortDirection = $request->input('direction', 'asc');

        $contacts = Contact::query()
            ->when($search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy($sortField, $sortDirection)
            ->get();

        return view('contacts.index', compact('contacts', 'search', 'sortField', 'sortDirection'));
    }

    public function create()
    {
        return view('contacts.create');
    }

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
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

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
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
