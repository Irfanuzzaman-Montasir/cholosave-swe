<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    // Show the campaign creation form
    public function create()
    {
        return view('admin.campaign.create');
    }

    // Store a new campaign
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today',
            'bKash' => 'nullable|string|max:50',
            'Rocket' => 'nullable|string|max:50',
            'Nagad' => 'nullable|string|max:50',
        ]);

        $validated['current_amount'] = 0;
        $validated['status'] = 'active';

        Campaign::create($validated);

        return redirect()->route('admin.campaign.manage')->with('success', 'Campaign created successfully!');
    }

    // List/manage campaigns
    public function index()
    {
        $campaigns = Campaign::orderBy('created_at', 'desc')->get();
        return view('admin.campaign.manage', compact('campaigns'));
    }

    // Show the edit form for a campaign
    public function edit($id)
    {
        $campaign = Campaign::findOrFail($id);
        return view('admin.campaign.edit', compact('campaign'));
    }

    // Update the campaign
    public function update(Request $request, $id)
    {
        $campaign = Campaign::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
            'deadline' => 'required|date|after:today',
            'status' => 'required|in:active,completed',
            'bKash' => 'nullable|string|max:50',
            'Rocket' => 'nullable|string|max:50',
            'Nagad' => 'nullable|string|max:50',
        ]);
        $campaign->update($validated);
        return redirect()->route('admin.campaign.manage')->with('success', 'Campaign updated successfully!');
    }
} 