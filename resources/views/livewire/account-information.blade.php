<div class="w-full md:w-2/3 rounded-sm p-2 border bg-secondary-full dark:bg-primary-full dark:border-primary-light">
    <h1 class="text-2xl font-medium dark:text-primary-shadWhite">
        {{ __('settings/index.headers.account_information.header') }}
    </h1>
    <p class="text-xs text-gray-400 font-light italic">
        {{ __('settings/index.headers.account_information.subheader') }}
    </p>

    <div class="mt-4 w-full">
        <form wire:submit.prevent="updateAccountInformation" class="flex flex-col w-full" x-data="{ file: null }">
            <div class="flex flex-col sm:flex-row items-center w-full">
                <div class="flex flex-row w-full space-x-2">
                    <img src="{{ Auth::user()->defaultAvatar() }}" alt="Profile Picture"
                        class="rounded-xl w-48 h-48 object-cover border border-gray-200 hover:border-gray-700">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-4 mt-4">
                <div class="flex flex-col w-full">
                    <label for="username"
                        class="text-sm font-medium dark:text-primary-shadWhite">{{ __('settings/index.headers.account_information.fields.username') }}</label>
                    <input wire:model="username" type="text" id="username"
                        class="p-1 rounded-md border border-gray-300 w-full">
                </div>
                <div class="flex flex-col w-full">
                    <label for="name"
                        class="text-sm font-medium dark:text-primary-shadWhite">{{ __('settings/index.headers.account_information.fields.name') }}</label>
                    <input wire:model="name" type="text" id="name"
                        class="p-1 rounded-md border border-gray-300 w-full">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-4 mt-4">
                <div class="flex flex-col w-full">
                    <label for="email"
                        class="text-sm font-medium dark:text-primary-shadWhite">{{ __('settings/index.headers.account_information.fields.email') }}</label>
                    <input wire:model="email" type="email" id="email"
                        class="p-1 rounded-md border border-gray-300 mb-1 w-full">
                </div>
            </div>

            <div class="flex items-center justify-center w-full mt-4">
                <label for="avatar_dropzone"
                    class="flex flex-col items-center justify-center w-full h-24 border-2 dark:border-primary-light border-dashed rounded-sm cursor-pointer bg-secondary-full dark:bg-primary-full"
                    @dragover.prevent
                    @drop.prevent="
                        const droppedFile = $event.dataTransfer.files[0];
                        if (['image/png', 'image/jpeg'].includes(droppedFile?.type)) {
                            file = droppedFile;
                            error = '';
                        } else {
                            error = 'Only PNG and JPG files are allowed.';
                        }
                    "
                    x-bind:class="{ 'bg-secondary-full border-gray-200 dark:border-primary-light dark:bg-primary-full dark:text-primary-shadWhite': file }">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <template x-if="!file">
                            <x-bi-image class="w-6 h-6 dark:text-primary-shadWhite" />
                        </template>
                        <template x-if="file">
                            <x-bi-check-circle class="w-6 h-6 text-green-400" />
                            <span class="text-sm font-medium" x-text="file.name"></span>
                        </template>
                        <span
                            class="text-sm font-medium dark:text-primary-shadWhite">{{ __('settings/index.headers.account_information.fields.avatar.header') }}</span>
                        <span
                            class="text-xs font-light text-gray-500">{{ __('settings/index.headers.account_information.fields.avatar.subheader') }}</span>
                    </div>
                    <input id="avatar_dropzone" name="avatar_dropzone" wire:model="avatarDropzone" type="file"
                        class="hidden" accept="image/jpg, image/png" @change="file = $event.target.files[0]" />
                </label>
            </div>

            <x-button type="submit">
                {{ __('settings/index.headers.account_information.button') }}
            </x-button>
        </form>
    </div>
</div>
