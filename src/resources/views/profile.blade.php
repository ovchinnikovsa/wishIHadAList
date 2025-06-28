<x-app-layout>
    <x-slot name="header">
        <h2 class="text-primary">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="bg-light">
            <livewire:profile.update-profile-information-form/>
        </div>

        <div class="bg-light">
            <livewire:profile.update-password-form/>
        </div>

        <div class="bg-light">
            <livewire:profile.delete-user-form/>
        </div>
    </div>
</x-app-layout>
