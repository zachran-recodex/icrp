<div class="bg-white rounded-lg shadow-sm border border-gray-100">
    <!-- Tabs -->
    <div x-data="{ selectedTab: '{{ $activeTab }}' }" class="w-full pt-2" wire:ignore>
        <div x-on:keydown.right.prevent="$focus.wrap().next()" x-on:keydown.left.prevent="$focus.wrap().previous()"
            class="flex gap-2 overflow-x-auto border-b border-neutral-300 dark:border-neutral-700 px-6" role="tablist"
            aria-label="tab options">
            <button x-on:click="selectedTab = 'general'; @this.setActiveTab('general')"
                x-bind:aria-selected="selectedTab === 'general'"
                x-bind:tabindex="selectedTab === 'general' ? '0' : '-1'"
                x-bind:class="selectedTab === 'general' ?
                    'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' :
                    'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                class="h-min px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelGeneral">General
                Settings</button>
            <button x-on:click="selectedTab = 'social'; @this.setActiveTab('social')"
                x-bind:aria-selected="selectedTab === 'social'"
                x-bind:tabindex="selectedTab === 'social' ? '0' : '-1'"
                x-bind:class="selectedTab === 'social' ?
                    'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' :
                    'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                class="h-min px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelSocial">Social
                Media</button>
            <button x-on:click="selectedTab = 'appearance'; @this.setActiveTab('appearance')"
                x-bind:aria-selected="selectedTab === 'appearance'"
                x-bind:tabindex="selectedTab === 'appearance' ? '0' : '-1'"
                x-bind:class="selectedTab === 'appearance' ?
                    'font-bold text-black border-b-2 border-black dark:border-white dark:text-white' :
                    'text-neutral-600 font-medium dark:text-neutral-300 dark:hover:border-b-neutral-300 dark:hover:text-white hover:border-b-2 hover:border-b-neutral-800 hover:text-neutral-900'"
                class="h-min px-4 py-2 text-sm" type="button" role="tab" aria-controls="tabpanelAppearance">Logo &
                Appearance</button>
        </div>

        <!-- Form Content -->
        <div class="p-6">
            <form wire:submit.prevent="save">
                <!-- General Settings Tab -->
                <div x-cloak x-show="selectedTab === 'general'" id="tabpanelGeneral" role="tabpanel"
                    aria-label="general" class="space-y-6">
                    <div>
                        <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                            Address
                        </label>
                        <textarea wire:model="address" id="address" rows="3"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                Phone Number
                            </label>
                            <input type="text" wire:model="phone" id="phone"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('phone')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                Email Address
                            </label>
                            <input type="email" wire:model="email" id="email"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('email')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="footer_text" class="block text-sm font-medium text-gray-700 mb-1">
                            Footer Text
                        </label>
                        <textarea wire:model="footer_text" id="footer_text" rows="3"
                            class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                    </div>
                </div>

                <!-- Social Media Tab -->
                <div x-cloak x-show="selectedTab === 'social'" id="tabpanelSocial" role="tabpanel" aria-label="social"
                    class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="facebook_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-facebook-f text-blue-600 mr-1"></i> Facebook Link
                            </label>
                            <input type="url" wire:model="facebook_link" id="facebook_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('facebook_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="instagram_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-instagram text-pink-600 mr-1"></i> Instagram Link
                            </label>
                            <input type="url" wire:model="instagram_link" id="instagram_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('instagram_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="twitter_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-twitter text-blue-400 mr-1"></i> Twitter Link
                            </label>
                            <input type="url" wire:model="twitter_link" id="twitter_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('twitter_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="linkedin_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-linkedin-in text-blue-700 mr-1"></i> LinkedIn Link
                            </label>
                            <input type="url" wire:model="linkedin_link" id="linkedin_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('linkedin_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="youtube_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fab fa-youtube text-red-600 mr-1"></i> YouTube Link
                            </label>
                            <input type="url" wire:model="youtube_link" id="youtube_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('youtube_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="google_map_link" class="block text-sm font-medium text-gray-700 mb-1">
                                <i class="fas fa-map-marker-alt text-red-500 mr-1"></i> Google Map Link
                            </label>
                            <input type="url" wire:model="google_map_link" id="google_map_link"
                                class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @error('google_map_link')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Logo & Appearance Tab -->
                <div x-cloak x-show="selectedTab === 'appearance'" id="tabpanelAppearance" role="tabpanel"
                    aria-label="appearance" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Logo Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Website Logo
                            </label>

                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="flex items-center space-x-4">
                                    <label class="block">
                                        <input type="file" wire:model="temp_logo" accept="image/*"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-medium
                                            file:bg-primary-50 file:text-primary-700
                                            hover:file:bg-primary-100">
                                    </label>
                                </div>

                                <div x-show="isUploading" class="mt-2">
                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-2 bg-primary-500 rounded-full" :style="`width: ${progress}%`">
                                        </div>
                                    </div>
                                </div>

                                @error('temp_logo')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror

                                <!-- Logo Preview -->
                                <div class="mt-4">
                                    @if ($temp_logo)
                                        <img src="{{ $temp_logo->temporaryUrl() }}" alt="Logo Preview"
                                            class="h-16 object-contain">
                                    @elseif ($logo)
                                        <img src="{{ Storage::url('settings/' . $logo) }}" alt="Current Logo"
                                            class="h-16 object-contain">
                                    @endif
                                </div>

                                <p class="text-xs text-gray-500 mt-2">Recommended: PNG format with transparent
                                    background, around 200x80 pixels</p>
                            </div>
                        </div>

                        <!-- Favicon Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Website Favicon
                            </label>

                            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">

                                <div class="flex items-center space-x-4">
                                    <label class="block">
                                        <input type="file" wire:model="temp_favicon" accept="image/*"
                                            class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-md file:border-0
                                            file:text-sm file:font-medium
                                            file:bg-primary-50 file:text-primary-700
                                            hover:file:bg-primary-100">
                                    </label>
                                </div>

                                <div x-show="isUploading" class="mt-2">
                                    <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                        <div class="h-2 bg-primary-500 rounded-full" :style="`width: ${progress}%`">
                                        </div>
                                    </div>
                                </div>

                                @error('temp_favicon')
                                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                                @enderror

                                <!-- Favicon Preview -->
                                <div class="mt-4">
                                    @if ($temp_favicon)
                                        <img src="{{ $temp_favicon->temporaryUrl() }}" alt="Favicon Preview"
                                            class="h-10 w-10 object-contain border border-gray-200 rounded">
                                    @elseif ($favicon)
                                        <img src="{{ Storage::url('settings/' . $favicon) }}" alt="Current Favicon"
                                            class="h-10 w-10 object-contain border border-gray-200 rounded">
                                    @endif
                                </div>

                                <p class="text-xs text-gray-500 mt-2">Recommended: ICO, PNG or SVG format, 32x32 or
                                    64x64 pixels</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="mt-8 pt-5 border-t border-gray-200">
                    <div class="flex justify-end">
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
