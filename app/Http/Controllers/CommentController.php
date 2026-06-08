<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class CommentController extends BaseController
{
    public function __construct()
    {
        // Apply auth middleware to all methods
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required|string',
            'forum_id' => 'required|exists:forums,id',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->forum_id = $request->forum_id;
        $comment->user_id = auth()->id();
        $comment->save();

        return redirect()->back()->with('success', 'Comment posted successfully.');
    }

    public function destroy(Comment $comment)
    {
        // Check if the user is admin before deleting
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }

    public function edit(Comment $comment)
    {
        // Hanya admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        // Hanya admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'body' => 'required|string',
        ]);
        $comment->body = $request->body;
        $comment->save();
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }
}
