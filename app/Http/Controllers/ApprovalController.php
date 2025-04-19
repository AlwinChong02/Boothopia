<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use Illuminate\Http\Request;

class ApprovalController extends Controller
{
    public function index()
    {
        $approvals = Approval::where('organiser_id', auth()->id())
            ->orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END")
            ->orderBy('created_at', 'asc')
            ->get();

        return view('organiser.approval', compact('approvals'));
    }
    public function show($id)
    {
        $approval = Approval::findOrFail($id);

        return view('organiser.approval', compact('approval'));
    }
    public function approve($id)
    {
        $approval = Approval::findOrFail($id);
        $approval->status = 'approved';
        $approval->reviewed_at = now();
        $approval->save();

        if ($approval->event) {
            $approval->event->update(['status' => 'ongoing']);
        }

        return redirect()->route('organiser.approval')
            ->with('success', 'Booking approved!');
    }

    public function reject($id)
    {
        $approval = Approval::findOrFail($id);
        $approval->status = 'rejected';
        $approval->reviewed_at = now();
        $approval->save();

        return redirect()->route('organiser.approval')->with('success', 'Booth booking rejected successfully.');
    }
    public function uploadApproval(Request $request)
    {
        $request->validate([
            'approval_image' => 'required|image|max:2048',
        ]);

        $path = $request->file('approval_image')->store('approval-images', 'public');

        $approval = new Approval();
        $approval->approval_image = $path;
        $approval->save();

        return redirect()->route('organiser.approval')->with('success', 'Approval image uploaded successfully.');
    }
    public function __construct()
    {
        $this->middleware(['auth', 'role:organiser']);
    }
}
