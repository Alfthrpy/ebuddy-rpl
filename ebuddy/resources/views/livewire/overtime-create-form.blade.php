<div>
    <form wire:submit.prevent="save" method="post" novalidate>
        @include('partials.alerts')
        <div class="w-100">
            <div class="mb-3">
                <x-form-label id="objective" label='Tujuan Dinas Luar' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="objective" name="objective" wire:model.defer="overtime.objective" />
                        <x-form-error key="overtime.objective" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="place" label='Tempat Dinas Luar' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="place" name="place" wire:model.defer="overtime.place" />
                        <x-form-error key="overtime.place" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="start_date" label='Tanggal Mulai' />
                        <x-form-input type="date" id="start_date" name="start_date" wire:model.defer="overtime.start_date" />
                        <x-form-error key="overtime.start_date" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <x-form-label id="end_date" label='Tanggal Selesai' />
                        <x-form-input type="date" id="end_date" name="end_date" wire:model.defer="overtime.end_date" />
                        <x-form-error key="overtime.end_date" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="result" label='Hasil Dinas Luar' />
                <div class="row">
                    <div class="col-md-6">
                        <textarea id="result" name="result" class="form-control" wire:model.defer="overtime.result"></textarea>
                        <x-form-error key="overtime.result" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="user_id_approver" label='Penyetuju' />
                <div class="row">
                    <div class="col-md-6">
                        <select id="user_id_approver" name="user_id_approver" class="form-control" wire:model.defer="overtime.user_id_approver">
                            <option value="">Pilih Penyetuju</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error key="overtime.user_id_approver" />
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-5">
            <button class="btn btn-primary">
                Simpan
            </button>
        </div>
    </form>
</div>
