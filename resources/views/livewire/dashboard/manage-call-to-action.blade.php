<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Manage Call To Action</h2>
    </div>

    @if (session()->has('message'))
        <flux:callout class="mb-4" variant="success" icon="check-circle" heading="{{ session('message') }}" />
    @endif

    <div class="bg-zinc-50 border border-zinc-200 shadow-md rounded-lg p-6">
        <form wire:submit="save" enctype="multipart/form-data">
            <flux:field class="mb-4">
                <flux:label>Title</flux:label>

                <flux:input wire:model="title" type="text" />

                <flux:error name="title" />
            </flux:field>

            <flux:field class="mb-4">
                <flux:label>Subtitle</flux:label>

                <flux:textarea wire:model="subtitle" />

                <flux:error name="subtitle" />
            </flux:field>

            <flux:field class="mb-4">
                <flux:label>Button Text</flux:label>

                <flux:input wire:model="button_text" type="text" />

                <flux:error name="button_text" />
            </flux:field>

            <flux:field class="mb-4">
                <flux:label>Image</flux:label>

                <flux:input wire:model="image" type="file" />

                <flux:error name="image" />

                <flux:description>The image must not be larger than 1MB.</flux:description>

                @if ($image)
                    <div class="mt-2">
                        <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-32 h-32 object-cover rounded">
                    </div>
                @elseif ($this->callToAction && $this->callToAction->image)
                    <div class="mt-2">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ Storage::url($this->callToAction->image) }}" alt="Current" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
            </flux:field>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">Update</flux:button>
            </div>
        </form>
    </div>
</div>