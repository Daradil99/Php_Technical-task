<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();
        return view('contact', ['messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($request->only(['name', 'email', 'message']));

        return back()->with('success', 'Message sent successfully!');
    }

    public function destroy($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();


        return redirect()->back()->with('success', 'Message deleted successfully');
    }
}
