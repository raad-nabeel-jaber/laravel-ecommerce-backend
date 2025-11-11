<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts, 200);
    }

    public function store(StoreContactRequest $request)
    {
        $data = $request->validated();
        $contact = Contact::create($data);
        return response()->json($contact, 201);
    }
    
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json(['message' => 'Contact deleted successfully'], 200);
    }
}
