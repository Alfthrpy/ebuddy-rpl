<?php

namespace App\Livewire;

use App\Models\Presence;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;

final class PresenceTable extends PowerGridComponent
{
    use WithExport;
    public $attendanceId;

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    

    public function datasource(): Builder
    {
        return Presence::query()
        ->where('attendance_id', $this->attendanceId)
        ->join('users', 'presences.user_id', '=', 'users.id')
        ->select('presences.*', 'users.name as user_name');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
        ->add('id')
        ->add('user_name')
        ->add("presence_date")
        ->add("presence_enter_time")
        ->add("presence_out_time", fn (Presence $model) => $model->presence_out_time ?? '<span class="badge text-bg-danger">Belum Absensi Pulang</span>')
        ->add("is_permission", fn (Presence $model) => $model->is_permission ?
            '<span class="badge text-bg-warning">Izin</span>' : '<span class="badge text-bg-success">Hadir</span>')
        ->add('created_at')
        ->add('created_at_formatted', fn (Presence $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Nama', 'user_name')
                ->sortable(),

            Column::make('Tanggal Hadir', 'presence_date')
                ->sortable()
                ->searchable(),

            Column::make('Waktu Masuk', 'presence_enter_time')
                ->sortable()
                ->searchable(),

            Column::make('Waktu Keluar', 'presence_out_time')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'is_permission')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted')
                ->searchable(),

            // Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

 

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
