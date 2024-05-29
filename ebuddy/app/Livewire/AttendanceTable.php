<?php

namespace App\Livewire;

use App\Models\Attendance;
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
use Livewire\Attributes\On;

final class AttendanceTable extends PowerGridComponent
{
    use WithExport;
    public $checked = [];
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
        return Attendance::with('positions');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('start_time')
            ->add('batas_start_time')
            ->add('end_time')
            ->add('batas_end_time')
            ->add('created_at')
            ->add('positions', function ($row) {
                return $row->positions->pluck('name')->implode(', ');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Title', 'title')
                ->sortable()
                ->searchable(),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

            Column::make('Start time', 'start_time')
                ->sortable()
                ->searchable(),

            Column::make('Batas start time', 'batas_start_time')
                ->sortable()
                ->searchable(),

            Column::make('End time', 'end_time')
                ->sortable()
                ->searchable(),

            Column::make('Batas end time', 'batas_end_time')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Positions', 'positions')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
        ];
    }


    public function actions(Attendance $row): array
    {
        return [
            Button::make('edit', 'Edit')
            ->class('badge text-bg-success')
            ->target('')
            ->route('attendances.edit', ['id' => $row->id]),

            Button::make('delete', 'Hapus')
                ->class('badge text-bg-danger')
                ->target('')
                ->route('attendances.destroy', ['id' => $row->id])
        ];
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

    #[On('bulkDelete.{tableName}')]
    public function bulkDelete(): void
    {
        $this->js('alert(window.pgBulkActions.get(\'' . $this->tableName . '\'))');
    }

    #[\Livewire\Attributes\On('deleteRecord')]
    public function deleteRecord($data)
    {
        $attendance = Attendance::find($data['id']);
        if ($attendance) {
            $attendance->delete();
            session()->flash('message', 'Data absensi berhasil dihapus.');
        } else {
            session()->flash('error', 'Data absensi tidak ditemukan.');
        }

        // Optional: You may want to refresh the data table after deletion
        $this->emit('refreshDatatable');
    }

}
