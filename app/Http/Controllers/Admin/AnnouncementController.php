<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::with('author')
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at')
            ->get();

        return view('admin.announcements.index', compact('announcements'));
    }

    public function create(): View
    {
        return view('admin.announcements.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'is_pinned'    => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'expires_at'   => ['nullable', 'date', 'after:published_at'],
        ]);

        Announcement::create([
            'author_id'    => $request->user()->id,
            'title'        => $data['title'],
            'content'      => $data['content'],
            'is_pinned'    => $data['is_pinned'] ?? false,
            'published_at' => $data['published_at'] ?? now(),
            'expires_at'   => $data['expires_at'] ?? null,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement posted successfully.');
    }

    public function edit(Announcement $announcement): View
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement): RedirectResponse
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'content'      => ['required', 'string'],
            'is_pinned'    => ['boolean'],
            'published_at' => ['nullable', 'date'],
            'expires_at'   => ['nullable', 'date', 'after:published_at'],
        ]);

        $announcement->update([
            'title'        => $data['title'],
            'content'      => $data['content'],
            'is_pinned'    => $data['is_pinned'] ?? false,
            'published_at' => $data['published_at'] ?? now(),
            'expires_at'   => $data['expires_at'] ?? null,
        ]);

        return redirect()->route('admin.announcements.index')
            ->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement): RedirectResponse
    {
        $announcement->delete();

        return back()->with('success', 'Announcement deleted.');
    }
}
