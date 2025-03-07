<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <!-- Tabs -->
    <div x-data="{ selectedTab: '{{ $activeTab }}' }" class="w-full pt-2" wire:ignore>
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-neutral-300 px-6" role="tablist"
            aria-label="page setup tabs">

            @foreach($this->availablePages as $key => $pageName)
                <button x-on:click="selectedTab = '{{ $key }}'; @this.changeTab('{{ $key }}')"
                    x-bind:aria-selected="selectedTab === '{{ $key }}'"
                    x-bind:tabindex="selectedTab === '{{ $key }}' ? '0' : '-1'"
                    x-bind:class="selectedTab === '{{ $key }}' ?
                        'font-bold text-black border-b-2 border-black' :
                        'text-neutral-600 font-medium hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                    class="h-min px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanel{{ ucfirst($key) }}">
                    {{ $pageName }}
                </button>
            @endforeach
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <form wire:submit.prevent="save">
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Page Title
                        </label>
                        <input type="text" wire:model.defer="title" id="title"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Enter page title">
                        @error('title')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">The title that appears in browser tabs and search results.</p>
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">
                            Meta Description
                        </label>
                        <textarea wire:model.defer="meta_description" id="meta_description" rows="3"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="Enter meta description"></textarea>
                        @error('meta_description')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">A brief description of the page that appears in search results (recommended: 150-160 characters).</p>
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-1">
                            Meta Keywords
                        </label>
                        <input type="text" wire:model.defer="meta_keywords" id="meta_keywords"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"
                            placeholder="keyword1, keyword2, keyword3">
                        @error('meta_keywords')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                        <p class="text-xs text-gray-500 mt-2">Comma-separated keywords related to the page content.</p>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-8 pt-5 border-t border-gray-200">
                    <div class="flex justify-end space-x-3">
                        <button type="button" wire:click="resetForm"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            Reset
                        </button>
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-500 hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
                            wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="save">Save Changes</span>
                            <span wire:loading wire:target="save">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Saving...
                            </span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
