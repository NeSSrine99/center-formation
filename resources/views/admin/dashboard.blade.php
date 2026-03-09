<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3>Welcome Administrator!</h3>
                    <p>You have full access to manage the system.</p>
                    <!-- Add admin-specific content here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
