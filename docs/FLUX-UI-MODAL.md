# Flux Modal Component

Display content in a layer above the main page. Ideal for confirmations, alerts, and forms.

## Basic Usage

```php
<flux:modal.trigger name="edit-profile">
    <flux:button>Edit profile</flux:button>
</flux:modal.trigger>

<flux:modal name="edit-profile" class="md:w-96">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Update profile</flux:heading>
            <flux:text class="mt-2">Make changes to your personal details.</flux:text>
        </div>

        <flux:input label="Name" placeholder="Your name" />
        <flux:input label="Date of birth" type="date" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
```

## Unique Modal Names

If you are placing modals inside a loop, ensure that you are dynamically generating unique modal names. Otherwise, one modal trigger will trigger all modals of that name on the page causing unexpected behavior.

```php
@foreach ($users as $user)
    <flux:modal :name="'edit-profile-'.$user->id">
        <!-- Modal content -->
    </flux:modal>
@endforeach
```

## Control Methods

### Livewire Methods

In addition to triggering modals in your Blade templates, you can also control them directly from Livewire.

Consider a "confirm" modal in your Blade template:

```php
<flux:modal name="confirm">
    <!-- Modal content -->
</flux:modal>
```

You can now open and close this modal from your Livewire component:

```php
<?php

class ShowPost extends \Livewire\Component 
{
    public function delete() 
    {
        // Control "confirm" modals anywhere on the page
        Flux::modal('confirm')->show();
        Flux::modal('confirm')->close();

        // Control "confirm" modals within this Livewire component
        $this->modal('confirm')->show();
        $this->modal('confirm')->close();

        // Closes all modals on the page
        Flux::modals()->close();
    }
}
```

### JavaScript Methods

You can control modals from Alpine directly using Flux's magic methods:

```php
<button x-on:click="$flux.modal('confirm').show()">
    Open modal
</button>

<button x-on:click="$flux.modal('confirm').close()">
    Close modal
</button>

<button x-on:click="$flux.modals().close()">
    Close all modals
</button>
```

Or use the `window.Flux` global object to control modals from any JavaScript:

```javascript
// Control "confirm" modals anywhere on the page
Flux.modal('confirm').show()
Flux.modal('confirm').close()

// Closes all modals on the page
Flux.modals().close()
```

## Data Binding

You can bind a Livewire property directly to a modal to control its state from your Livewire component.

```php
<flux:modal wire:model.self="showConfirmModal">
    <!-- Modal content -->
</flux:modal>
```

**Important:** Add the `.self` modifier to the `wire:model` attribute to prevent nested elements from dispatching input events that would interfere with the modal state.

Control the modal from your Livewire component:

```php
<?php

class ShowPost extends \Livewire\Component 
{
    public $showConfirmModal = false;

    public function delete() 
    {
        $this->showConfirmModal = true;
    }
}
```

You can also control the state directly from the browser without a server roundtrip:

```php
<flux:button x-on:click="$wire.showConfirmModal = true">Delete post</flux:button>
```

## Event Listeners

### Close Events

Perform logic after a modal closes:

```php
<flux:modal @close="someLivewireAction">
    <!-- Modal content -->
</flux:modal>
```

Alternative syntaxes: `wire:close` or `x-on:close`

### Cancel Events

Perform logic after a modal is cancelled:

```php
<flux:modal @cancel="someLivewireAction">
    <!-- Modal content -->
</flux:modal>
```

Alternative syntaxes: `wire:cancel` or `x-on:cancel`

## Configuration

### Disable Click Outside

By default, clicking outside the modal will close it. To disable this behavior:

```php
<flux:modal :dismissible="false">
    <!-- Modal content -->
</flux:modal>
```

## Examples

### Confirmation Modal

Prompt a user for confirmation before performing a dangerous action:

```php
<flux:modal.trigger name="delete-profile">
    <flux:button variant="danger">Delete</flux:button>
</flux:modal.trigger>

<flux:modal name="delete-profile" class="min-w-[22rem]">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Delete project?</flux:heading>
            <flux:text class="mt-2">
                <p>You're about to delete this project.</p>
                <p>This action cannot be reversed.</p>
            </flux:text>
        </div>

        <div class="flex gap-2">
            <flux:spacer />
            
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>

            <flux:button type="submit" variant="danger">Delete project</flux:button>
        </div>
    </div>
</flux:modal>
```

### Flyout Modal

Use the "flyout" variant for a more anchored and long-form dialog:

```php
<flux:modal.trigger name="edit-profile">
    <flux:button>Edit profile</flux:button>
</flux:modal.trigger>

<flux:modal name="edit-profile" variant="flyout">
    <div class="space-y-6">
        <div>
            <flux:heading size="lg">Update profile</flux:heading>
            <flux:text class="mt-2">Make changes to your personal details.</flux:text>
        </div>

        <flux:input label="Name" placeholder="Your name" />
        <flux:input label="Date of birth" type="date" />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">Save changes</flux:button>
        </div>
    </div>
</flux:modal>
```

### Flyout Positioning

By default, flyouts open from the right. Change this with the `position` prop:

```php
<flux:modal variant="flyout" position="left">
    <!-- Modal content -->
</flux:modal>
```

## API Reference

### flux:modal

#### Props

| Prop | Description |
|------|-------------|
| `name` | Unique identifier for the modal. Required when using triggers. |
| `variant` | Visual style of the modal. Options: `default`, `flyout`, `bare`. |
| `position` | For flyout modals, the direction they open from. Options: `right` (default), `left`, `bottom`. |
| `dismissible` | If `false`, prevents closing the modal by clicking outside. Default: `true`. |
| `wire:model` | Optional Livewire property to bind the modal's open state to. |

#### Events

| Event | Description |
|-------|-------------|
| `close` | Triggered when the modal is closed by any means. |
| `cancel` | Triggered when the modal is closed by clicking outside or pressing escape. |

#### Slots

| Slot | Description |
|------|-------------|
| `default` | The modal content. |

#### Common Classes

| Class | Description |
|-------|-------------|
| `w-*` | Common use: `md:w-96` for width. |

### flux:modal.trigger

#### Props

| Prop | Description |
|------|-------------|
| `name` | Name of the modal to trigger. Must match the modal's name. |
| `shortcut` | Keyboard shortcut to open the modal (e.g., `cmd.k`). |

#### Slots

| Slot | Description |
|------|-------------|
| `default` | The trigger element (e.g., button). |

### flux:modal.close

#### Slots

| Slot | Description |
|------|-------------|
| `default` | The close trigger element (e.g., button). |

## PHP Methods

### Flux::modal()

| Parameter | Description |
|-----------|-------------|
| `name` | Name of the modal to control. |

| Method | Description |
|--------|-------------|
| `show()` | Shows the modal. |
| `close()` | Closes the modal. |

### Flux::modals()

| Method | Description |
|--------|-------------|
| `close()` | Closes all modals on the page. |

## Alpine.js Methods

### $flux.modal()

| Parameter | Description |
|-----------|-------------|
| `name` | Name of the modal to control. |

| Method | Description |
|--------|-------------|
| `show()` | Shows the modal. |
| `close()` | Closes the modal. |

### $flux.modals()

| Method | Description |
|--------|-------------|
| `close()` | Closes all modals on the page. |
