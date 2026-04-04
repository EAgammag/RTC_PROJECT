<?php

namespace App\Http\Controllers\Cadet;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\View\View;

class AnnouncementController extends Controller
{
    public function index(): View
    {
        $announcements = Announcement::visible()->ordered()->get();

        return view('cadet.announcements', compact('announcements'));
    }
}
