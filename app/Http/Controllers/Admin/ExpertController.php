<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpertTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertController extends Controller
{
    public function index()
    {
        $experts = ExpertTeam::latest()->get();
        return view('admin.experts.index', compact('experts'));
    }

    public function create()
    {
        return view('admin.experts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:expert_team',
            'phone' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('experts', $filename, 'public');
            $validated['image'] = $path;
        }

        ExpertTeam::create($validated);

        return redirect()->route('admin.experts.index')
            ->with('success', 'Expert added successfully.');
    }

    public function edit(ExpertTeam $expert)
    {
        return view('admin.experts.edit', compact('expert'));
    }

    public function update(Request $request, ExpertTeam $expert)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:expert_team,email,' . $expert->id,
            'phone' => 'required|string|max:255',
            'expertise' => 'required|string|max:255',
            'bio' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($expert->image && Storage::disk('public')->exists($expert->image)) {
                Storage::disk('public')->delete($expert->image);
            }

            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('experts', $filename, 'public');
            $validated['image'] = $path;
        }

        $expert->update($validated);

        return redirect()->route('admin.experts.index')
            ->with('success', 'Expert updated successfully.');
    }

    public function destroy(ExpertTeam $expert)
    {
        // Delete image
        if ($expert->image && Storage::disk('public')->exists($expert->image)) {
            Storage::disk('public')->delete($expert->image);
        }

        $expert->delete();

        return redirect()->route('admin.experts.index')
            ->with('success', 'Expert deleted successfully.');
    }
} 