<div>
    <h2 class="text-xl font-semibold text-gray-900 mb-6">Komentar ({{ $comments->total() }})</h2>

    @auth
        <div class="mb-8">
            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                     role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <form wire:submit.prevent="saveComment">
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Komentar Anda</label>
                    <textarea wire:model="content" id="content" rows="3"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500"
                              placeholder="Bagikan pendapat Anda tentang buku ini..."></textarea>
                    @error('content')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-500"
                            wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="saveComment">Kirim Komentar</span>
                        <span wire:loading wire:target="saveComment">Mengirim...</span>
                    </button>
                </div>
            </form>
        </div>
    @else
        <div class="mb-8 bg-primary-50 p-4 rounded-md text-center">
            <p class="text-gray-700">Silahkan <a href="{{ route('login') }}"
                                                 class="text-primary-600 hover:text-primary-900">login</a> untuk menambahkan komentar.</p>
        </div>
    @endauth

    <div class="space-y-6">
        @forelse ($comments as $comment)
            <div class="bg-gray-50 p-4 rounded-md" id="comment-{{ $comment->id }}">
                <div class="flex justify-between items-start">
                    <div class="flex items-center">
                        <div class="text-sm font-medium text-gray-900">
                            {{ $comment->user ? $comment->user->name : 'Anonim' }}
                        </div>
                        <span class="mx-1 text-gray-500">&bull;</span>
                        <div class="text-sm text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>

                <div class="mt-2 text-sm text-gray-700 whitespace-pre-line">
                    {{ $comment->content }}
                </div>
            </div>
        @empty
            <div class="text-center py-4 text-gray-500">
                Belum ada komentar untuk buku ini.
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $comments->links() }}
    </div>
</div>
