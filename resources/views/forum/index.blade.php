<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Forum') }}
            </h2>
        </div>
    </x-slot>

    <style>
        .welcome-section {
            background: linear-gradient(135deg, #1E40AF 0%, #1E3A8A 100%);
            border-radius: 1rem;
            padding: 2rem;
            color: white;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .welcome-title {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .welcome-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .question-card {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            margin-bottom: 1rem;
        }

        .question-card:hover {
            transform: translateY(-5px);
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="welcome-section">
                <h1 class="welcome-title">Welcome to the Forum, {{ Auth::user()->name }}!</h1>
                <p class="welcome-subtitle">Join the discussion or start your own topic.</p>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Community Discussions</h2>
                        <p class="text-gray-600">Share your thoughts and learn from others</p>
                    </div>
                    <div class="flex space-x-4">
                        <button onclick="showAskQuestionModal()"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Ask Question
                        </button>
                        <a href="{{ route('forum.my-questions') }}"
                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            My Questions
                        </a>
                    </div>
                </div>
            </div>

            <!-- Questions List -->
            @if($questions->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-6">
                    <p class="text-gray-600">
                        {{ request()->routeIs('forum.my-questions') ? "You haven't asked any questions yet." : "No questions found." }}
                    </p>
                </div>
            @else
                @foreach($questions as $question)
                    <div class="question-card">
                        <div class="flex justify-between">
                            <div class="flex-1">
                                <a href="{{ route('forum.question', $question) }}"
                                    class="text-xl font-semibold text-blue-600 hover:text-blue-800">
                                    {{ $question->title }}
                                </a>
                                <p class="text-gray-600 mt-2">
                                    {{ Str::limit($question->content, 200) }}
                                </p>
                                <div class="flex items-center mt-4 space-x-4">
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-user"></i> {{ $question->user->name }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-clock"></i> {{ $question->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-comment"></i> {{ $question->replies_count }} replies
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        <i class="fas fa-eye"></i> {{ $question->views }} views
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- Ask Question Modal -->
    <div id="askQuestionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-8 w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-4">Ask a Question</h2>
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                        Title
                    </label>
                    <input type="text" id="title" name="title" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                        Content
                    </label>
                    <textarea id="content" name="content" rows="6" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="hideAskQuestionModal()"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Submit Question
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function showAskQuestionModal() {
            document.getElementById('askQuestionModal').classList.remove('hidden');
        }

        function hideAskQuestionModal() {
            document.getElementById('askQuestionModal').classList.add('hidden');
        }
    </script>
    @endpush
</x-app-layout> 