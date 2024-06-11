<div>
    <form wire:submit.prevent="savePositions" method="post">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @foreach ($positions as $i => $position)
        <div class="mb-3 position-relative">
            <x-form-label id="name{{ $i }}" label='Nama Jabatan {{ $i + 1 }}' />
            <div class="row">
                <div class="col-5">
                    <x-form-input id="name{{ $i }}" name="name{{ $i }}" wire:model.defer="positions.{{ $i }}.name" />
                </div>
                @if ($i > 0)
                <div class="col-2">
                    <button class="btn btn-danger" wire:click="removePositionInput({{ $i }})"
                        wire:target="removePositionInput({{ $i }})" type="button" wire:loading.attr="disabled">Hapus</button>
                </div>
                @endif
            </div>
        </div>
        @endforeach

        <div class="d-flex justify-content-start align-items-center">
            <button class="btn btn-primary">
                Simpan
            </button>
            <button class="btn btn-light ms-2" type="button" wire:click="addPositionInput" wire:loading.attr="disabled">
                Tambah Input
            </button>
        </div>
    </form>
</div>
