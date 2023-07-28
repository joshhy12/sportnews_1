<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\ContactSubmission;

class ContactController extends Controller
{
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Store the form data in the database
        ContactSubmission::create($request->all());

        return redirect()->back()->with('success', '  Your message was sent, thank you!!');
    }
}
