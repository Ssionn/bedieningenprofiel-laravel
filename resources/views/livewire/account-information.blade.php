<div class="bg-gray-100 w-full md:w-2/3 rounded-md p-2">
    <h1 class="text-2xl font-medium">{{ __('settings/index.headers.account_information.header') }}</h1>
    <p class="text-xs text-gray-400 font-light italic">
        {{ __('settings/index.headers.account_information.subheader') }}
    </p>

    <div class="mt-4 w-full">
        <form wire:submit.prevent="updateAccountInformation" class="flex flex-col w-full">
            <div class="flex flex-col sm:flex-row items-center w-full" x-data="{ file: null }">
                <div class="flex flex-row w-full space-x-2">
                    <img src="{{ Auth::user()->defaultAvatar() }}" alt="Profile Picture"
                        class="rounded-2xl w-24 h-24 object-cover">

                    <div class="flex items-center justify-center w-full">
                        <label for="avatar_dropzone"
                            class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-400 border-dashed rounded-md cursor-pointer bg-gray-300 hover:bg-gray-400 hover:border-gray-500"
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
                            x-bind:class="{ 'border-blue-500 bg-gray-200': file }">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <template x-if="!file">
                                    <x-bi-image class="w-6 h-6" />
                                </template>
                                <template x-if="file">
                                    <span class="text-sm font-medium" x-text="file.name"></span>
                                </template>
                                <span
                                    class="text-sm font-medium">{{ __('settings/index.headers.account_information.fields.avatar.header') }}</span>
                                <span
                                    class="text-xs font-light text-gray-700">{{ __('settings/index.headers.account_information.fields.avatar.subheader') }}</span>
                            </div>
                            <input id="avatar_dropzone" name="avatar_dropzone" wire:model="avatarDropzone"
                                type="file" class="hidden" accept="image/jpg, image/png"
                                @change="file = $event.target.files[0]" />
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-4 mt-4">
                <div class="flex flex-col w-full">
                    <label for="username"
                        class="text-sm font-medium">{{ __('settings/index.headers.account_information.fields.username') }}</label>
                    <input wire:model="username" type="text" id="username" value="{{ Auth::user()->username }}"
                        class="p-1 rounded-md border border-gray-300 w-full">
                </div>
                <div class="flex flex-col w-full">
                    <label for="name"
                        class="text-sm font-medium">{{ __('settings/index.headers.account_information.fields.name') }}</label>
                    <input wire:model="name" type="text" id="name" value="{{ Auth::user()->name }}"
                        class="p-1 rounded-md border border-gray-300 w-full">
                </div>
            </div>

            <div class="flex flex-col sm:flex-row w-full space-y-2 sm:space-y-0 sm:space-x-4 mt-4">
                <div class="flex flex-col w-full">
                    <label for="email"
                        class="text-sm font-medium">{{ __('settings/index.headers.account_information.fields.email') }}</label>
                    <input wire:model="email" type="email" id="email" value="{{ Auth::user()->email }}"
                        class="p-1 rounded-md border border-gray-300 mb-1 w-full">
                </div>
            </div>

            <button type="submit" class="mt-2 px-4 py-2 bg-gray-300 hover:bg-gray-400 hover:text-white rounded-md">
                {{ __('settings/index.headers.account_information.button') }}
            </button>
        </form>
    </div>
</div>
