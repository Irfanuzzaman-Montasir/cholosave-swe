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

        try {
            // Create expert first without image
            $expert = ExpertTeam::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'expertise' => $validated['expertise'],
                'bio' => $validated['bio'],
                'image' => null // Set to null initially
            ]);

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_extension = $image->getClientOriginalExtension();
                $new_filename = 'expert_' . $expert->id . '.' . $file_extension;
                
                // Create uploads/experts directory if it doesn't exist
                $upload_dir = public_path('uploads/experts');
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Move uploaded file
                $image->move($upload_dir, $new_filename);
                
                // Update expert with image filename
                $expert->update(['image' => $new_filename]);
            }

            return redirect()->route('admin.experts.index')
                ->with('success', 'Expert added successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to add expert: ' . $e->getMessage());
        }
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

        try {
            // Update basic info
            $expert->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'expertise' => $validated['expertise'],
                'bio' => $validated['bio']
            ]);

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($expert->image) {
                    $old_image_path = public_path('uploads/experts/' . $expert->image);
                    if (file_exists($old_image_path)) {
                        unlink($old_image_path);
                    }
                }

                $image = $request->file('image');
                $file_extension = $image->getClientOriginalExtension();
                $new_filename = 'expert_' . $expert->id . '.' . $file_extension;
                
                // Create uploads/experts directory if it doesn't exist
                $upload_dir = public_path('uploads/experts');
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Move uploaded file
                $image->move($upload_dir, $new_filename);
                
                // Update expert with new image filename
                $expert->update(['image' => $new_filename]);
            }

            return redirect()->route('admin.experts.index')
                ->with('success', 'Expert updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Failed to update expert: ' . $e->getMessage());
        }
    }

    public function destroy(ExpertTeam $expert)
    {
        try {
            // Delete image file if exists
            if ($expert->image) {
                $image_path = public_path('uploads/experts/' . $expert->image);
                if (file_exists($image_path)) {
                    unlink($image_path);
                }
            }

            $expert->delete();

            return redirect()->route('admin.experts.index')
                ->with('success', 'Expert deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete expert: ' . $e->getMessage());
        }
    }
} 