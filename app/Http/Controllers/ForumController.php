<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $questions = Question::with(['user', 'replies'])
            ->withCount('replies')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('forum.index', compact('questions'));
    }

    public function myQuestions()
    {
        $questions = Question::with(['user', 'replies'])
            ->where('user_id', Auth::id())
            ->withCount('replies')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('forum.index', compact('questions'));
    }

    public function show(Question $question)
    {
        // Increment view count
        $question->increment('views');
        
        $question->load(['user', 'replies.user']);
        
        return view('forum.question', compact('question'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $question = Question::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('forum.question', $question);
    }

    public function storeReply(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'content' => 'required|string',
        ]);

        $reply = Reply::create([
            'question_id' => $validated['question_id'],
            'user_id' => Auth::id(),
            'content' => $validated['content'],
        ]);

        return redirect()->route('forum.question', $validated['question_id']);
    }

    public function destroy(Question $question)
    {
        if ($question->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        $question->delete();
        
        return response()->json(['success' => true]);
    }

    public function update(Request $request, Question $question)
    {
        if ($question->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $question->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return response()->json(['success' => true]);
    }
} 