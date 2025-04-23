<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <!-- Success Message -->
        <div id="successMessage" class="hidden fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-500 ease-in-out">
            <div class="flex items-center">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Question updated successfully!
            </div>
        </div>

        <!-- Back Button -->
        <a href="{{ route('forum.index') }}" class="text-blue-500 hover:text-blue-700 mb-4 inline-block">
            <i class="fas fa-arrow-left text-2xl"></i>
        </a>

        <!-- Question Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center mb-4">
                <div class="flex justify-between items-start w-full">
                    <div class="flex-1">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">
                            {{ $question->title }}
                        </h1>
                        <div class="prose max-w-none">
                            {{ $question->content }}
                        </div>
                        <div class="flex items-center mt-6 space-x-4">
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-user"></i> {{ $question->user->name }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-clock"></i> {{ $question->created_at->format('M d, Y') }}
                            </span>
                            <span class="text-sm text-gray-500">
                                <i class="fas fa-eye"></i> {{ $question->views }} views
                            </span>

                            @if(Auth::id() == $question->user_id)
                                <button onclick="deleteQuestion({{ $question->id }})"
                                    class="ml-4 text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i> Delete Question
                                </button>
                                <button onclick="showEditQuestionModal({{ $question->id }}, '{{ $question->title }}', '{{ $question->content }}')"
                                    class="ml-4 text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-edit"></i> Edit Question
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Replies Section -->
        <div class="space-y-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $question->replies->count() }} Replies</h2>

            @foreach($question->replies as $reply)
                <div class="bg-white rounded-lg shadow-md p-6">
                    <div class="flex justify-between">
                        <div class="flex-1">
                            <div class="prose max-w-none">
                                {{ $reply->content }}
                            </div>
                            <div class="flex items-center mt-4 space-x-4">
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-user"></i> {{ $reply->user->name }}
                                </span>
                                <span class="text-sm text-gray-500">
                                    <i class="fas fa-clock"></i> {{ $reply->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Reply Form -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Add Your Reply</h3>
                <form action="{{ route('forum.reply.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{ $question->id }}">
                    <div class="mb-4">
                        <textarea name="content" rows="4" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            placeholder="Write your reply here..."></textarea>
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg transition duration-200">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Question Modal -->
    <div id="editQuestionModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
        <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-8 w-full max-w-2xl">
            <h2 class="text-2xl font-bold mb-4">Edit Question</h2>
            <form id="editQuestionForm" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="_method" value="PATCH">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_title">
                        Title
                    </label>
                    <input type="text" id="edit_title" name="title" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="edit_content">
                        Content
                    </label>
                    <textarea id="edit_content" name="content" rows="6" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"></textarea>
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="hideEditQuestionModal()"
                        class="bg-gray-500 hover:bg-gray-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg">
                        Update Question
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showEditQuestionModal(id, title, content) {
            document.getElementById('editQuestionModal').classList.remove('hidden');
            document.getElementById('editQuestionForm').action = `/community/forum/question/${id}`;
            document.getElementById('edit_title').value = title;
            document.getElementById('edit_content').value = content;
        }

        function hideEditQuestionModal() {
            document.getElementById('editQuestionModal').classList.add('hidden');
        }

        function showSuccessMessage() {
            const successMessage = document.getElementById('successMessage');
            successMessage.classList.remove('hidden');
            successMessage.classList.add('translate-y-0', 'opacity-100');
            
            setTimeout(() => {
                successMessage.classList.add('translate-y-[-20px]', 'opacity-0');
                setTimeout(() => {
                    successMessage.classList.add('hidden');
                    successMessage.classList.remove('translate-y-[-20px]', 'opacity-0');
                }, 500);
            }, 3000);
        }

        // Handle form submission
        document.getElementById('editQuestionForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const form = this;
            const formData = new FormData(form);
            const questionId = form.action.split('/').pop();
            
            fetch(`/community/forum/question/${questionId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    title: formData.get('title'),
                    content: formData.get('content')
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    hideEditQuestionModal();
                    showSuccessMessage();
                    // Update the question content on the page
                    document.querySelector('.text-3xl.font-bold').textContent = formData.get('title');
                    document.querySelector('.prose').textContent = formData.get('content');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

        function deleteQuestion(id) {
            if (confirm('Are you sure you want to delete this question?')) {
                fetch(`/community/forum/question/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.href = '/community/forum';
                    }
                });
            }
        }
    </script>
</x-app-layout> 