<x-app-layout>
    <div>
        <div>
            <div>
                <div>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div>
                <div>
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
