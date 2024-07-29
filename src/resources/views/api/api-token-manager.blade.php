<div>
    <!-- Generate API Token -->
    <div submit="createApiToken">
        <div name="title">
            {{ __('Create API Token') }}
        </div>

        <div name="description">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </div>

        <div name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <label for="name" value="{{ __('Token Name') }}" />
                <input id="name" type="text" class="mt-1 block w-full" wire:model.defer="createApiTokenForm.name" autofocus />
                <input for="name" class="mt-2" />
            </div>

            <!-- Token Permissions -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <label for="permissions" value="{{ __('Permissions') }}" />

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <label class="flex items-center">
                                <checkbox wire:model.defer="createApiTokenForm.permissions" :value="$permission"/>
                                <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <div name="actions">
            <div class="mr-3" on="created">
                {{ __('Created.') }}
            </div>

            <button>
                {{ __('Create') }}
            </button>
        </div>
    </div>

    @if ($this->user->tokens->isNotEmpty())
        <border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <section>
                <div name="title">
                    {{ __('Manage API Tokens') }}
                </div>

                <div name="description">
                    {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                </div>

                <!-- API Token List -->
                <div name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div>
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ml-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ml-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <modal wire:model="displayingToken">
        <div name="title">
            {{ __('API Token') }}
        </div>

        <div name="content">
            <div>
                {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
            </div>

            <input x-ref="plaintextToken" type="text" readonly :value="$plainTextToken"
                class="mt-4 bg-gray-100 px-4 py-2 rounded font-mono text-sm text-gray-500 w-full"
                autofocus autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"
                @showing-token-modal.window="setTimeout(() => $refs.plaintextToken.select(), 250)"
            />
        </div>

        <div name="footer">
            <button wire:click="$set('displayingToken', false)" wire:loading.attr="disabled">
                {{ __('Close') }}
            </button>
        </div>
    </modal>

    <!-- API Token Permissions Modal -->
    <modal wire:model="managingApiTokenPermissions">
        <div name="title">
            {{ __('API Token Permissions') }}
        </div>

        <div name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <label class="flex items-center">
                        <checkbox wire:model.defer="updateApiTokenForm.permissions" :value="$permission"/>
                        <span class="ml-2 text-sm text-gray-600">{{ $permission }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div name="footer">
            <button wire:click="$set('managingApiTokenPermissions', false)" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </button>

            <button class="ml-3" wire:click="updateApiToken" wire:loading.attr="disabled">
                {{ __('Save') }}
            </button>
        </div>
    </modal>

    <!-- Delete Token Confirmation Modal -->
    <modal wire:model="confirmingApiTokenDeletion">
        <div name="title">
            {{ __('Delete API Token') }}
        </div>

        <div name="content">
            {{ __('Are you sure you would like to delete this API token?') }}
        </div>

        <div name="footer">
            <button wire:click="$toggle('confirmingApiTokenDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </button>

            <button class="ml-3" wire:click="deleteApiToken" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </button>
        </div>
    </modal>
</div>
