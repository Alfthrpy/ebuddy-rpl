<div>
    <form wire:submit.prevent="update" method="post" novalidate enctype="multipart/form-data">
        @include('partials.alerts')
        <div class="w-100">
            <div class="mb-3">
                <x-form-label id="tanggal_surat" label='Tanggal Surat' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input type="date" id="date_out" name="date_out" wire:model.defer="letter.date_out" />
                        <x-form-error key="letter.date_out" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="no_letter" label='Nomor Surat' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="no_letter" name="no_letter" wire:model.defer="letter.no_letter" />
                        <x-form-error key="letter.no_letter" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="attachment" label='Lampiran' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="attachment" name="attachment" wire:model.defer="letter.attachment" />
                        <x-form-error key="letter.attachment" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="subject" label='Perihal' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="subject" name="subject" wire:model.defer="letter.subject" />
                        <x-form-error key="letter.subject" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="destination" label='Tujuan' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="destination" name="destination" wire:model.defer="letter.destination" />
                        <x-form-error key="letter.destination" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="destination_position" label='Jabatan Tujuan (Bila ada)' />
                <div class="row">
                    <div class="col-md-6">
                        <x-form-input id="destination_position" name="destination_position" wire:model.defer="letter.destination_position" />
                        <x-form-error key="letter.destination_position" />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <x-form-label id="content" label='Isi Surat' />
                <div class="row">
                    <div class="col-md-6">
                        <textarea id="content" name="content" class="form-control" wire:model.defer="letter.content"></textarea>
                        <x-form-error key="letter.content" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="wm_creator" label='Upload Gambar Tanda Tangan' />
                <div class="row">
                    <div class="col-md-6">
                        <input type="file" id="wm_creator" name="wm_creator" class="form-control" wire:model.defer="letter.wm_creator" />
                        <x-form-error key="letter.wm_creator" />
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <x-form-label id="user_id_approver" label='Penyetuju' />
                <div class="row">
                    <div class="col-md-6">
                        <select id="user_id_approver" name="user_id_approver" class="form-control" wire:model.defer="letter.user_id_approver">
                            <option value="">Pilih Penyetuju</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <x-form-error key="letter.user_id_approver" />
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <x-form-label id="template_id" label='Template Surat' />
                <div class="row">
                    <div class="col-md-6">
                        <select id="template_id" name="template_id" class="form-control" wire:model.defer="letter.template_id">
                            <option value="">Pilih Template</option>
                            @foreach ($templates as $template)
                                <option value="{{ $template->id }}">{{ $template->nama_template }}</option>
                            @endforeach
                        </select>
                        <x-form-error key="letter.template_id" />
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
