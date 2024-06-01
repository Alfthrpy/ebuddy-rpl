<div>
    <form wire:submit.prevent="updatePassword" method="post" novalidate>
        @include('partials.alerts')

        <div class="mb-3">
            <div class="w-100">
                <div class="mb-3">
                    <x-form-label id="old_password" label='Password Lama'
                        required="false" />
                    <x-form-input id="old_password" name="old_password"
                        type="password" wire:model.defer="old_password" />
                    <x-form-error key="old_password" />
                </div>
                <div class="mb-3">
                    <x-form-label id="new_password" label='Password Baru'
                        required="false" />
                    <x-form-input id="new_password" name="new_password"
                        type="password" wire:model.defer="new_password" />
                    <x-form-error key="new_password" />
                </div>
                <div class="mb-3">
                    <x-form-label id="confirm_password" label='Konfirmasi Password Baru'
                        required="false" />
                    <x-form-input id="confirm_password" name="confirm_password"
                        type="password" wire:model.defer="confirm_password" />
                    <x-form-error key="confirm_password" />
                </div>
            </div>
        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>
