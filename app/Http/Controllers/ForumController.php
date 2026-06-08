<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;

class ForumController extends Controller
{
    public function index()
    {
        $forums = Forum::with(['user', 'comments.user'])->latest()->paginate(10);
        return view('forum.index', compact('forums'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $forum = new Forum();
        $forum->user_id = auth()->id();
        $forum->title = $request->title;
        $forum->body = $request->body;
        $forum->save();

        return redirect()->route('forum.index')->with('success', 'Forum thread created successfully.');
    }

    public function show(Forum $forum)
    {
        $forum->load(['user', 'comments.user']);
        // Optional: increment views
        $forum->increment('views');
        return view('forum.show', compact('forum'));
    }

    public function destroy(Forum $forum)
    {
        // Pastikan hanya admin yang dapat menghapus forum
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        // Hapus forum
        $forum->delete();

        // Redirect kembali ke halaman forum dengan pesan sukses
        return redirect()->route('forum.index')->with('success', 'Forum deleted successfully.');
    }

    public function subscribe(Forum $forum)
    {
        $user = auth()->user();
        if ($user->isSubscribedTo($forum)) {
            $user->subscribedForums()->detach($forum->id);
        } else {
            $user->subscribedForums()->attach($forum->id);
        }
        return back();
    }

    public function edit(Forum $forum)
    {
        // Hanya admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        return view('forum.edit', compact('forum'));
    }

    public function update(Request $request, Forum $forum)
    {
        // Hanya admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);
        $forum->update($request->only('title', 'body'));
        return redirect()->route('forum.show', $forum)->with('success', 'Forum updated successfully.');
    }
}
