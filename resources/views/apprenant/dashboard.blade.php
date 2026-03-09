<x-app-layout>
    <x-slot name="header">
        <h2 class="h5 mb-0">
            {{ __('Apprenant Dashboard') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3>Welcome Apprenant!</h3>
                    <p>Access your courses and track your progress here.</p>
                    <!-- Add apprenant-specific content here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
