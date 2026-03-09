<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">
            {{ __('Formateur Dashboard') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3>Welcome Formateur!</h3>
                    <p>You can manage your courses and students here.</p>
                    <!-- Add formateur-specific content here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
