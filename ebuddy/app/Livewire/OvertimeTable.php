<?php

namespace App\Livewire;


use Illuminate\Support\Facades\Auth;
use App\Models\Overtime;
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

final class OvertimeTable extends PowerGridComponent
{
    use WithExport;

    public $condition;

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
        $query = Overtime::query();
        if ($this->condition == 'me') {
            $query->where('user_id_creator', auth()->id());
        } elseif ($this->condition == 'pending') {
            $query->where('status', 'pending')
                  ->where('user_id_approver', Auth::id());
            
        } else if($this->condition == 'all'){

        }
    
        return $query;
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('objective')
            ->add('place')
            ->add('result')
            ->add('status')
            ->add('creator', fn (Overtime $overtime) => $overtime->creator->name)
            ->add('created_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Tujuan', 'objective')
                ->sortable()
                ->searchable(),

            Column::make('Pembuat', 'creator')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
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

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Overtime $row): array
    {
        $buttons = [];
        $buttons[] = Button::make('show', 'lihat')
            ->class('badge text-bg-success')
            ->target('')
            ->route('overtimes.show', ['id' => $row->id]);
        if ($this->condition === 'me') {
            $buttons[] = Button::make('edit', 'Edit')
                ->class('badge text-bg-warning')
                ->target('')
                ->route('overtimes.edit', ['id' => $row->id]);
    
            $buttons[] = Button::make('delete', 'Hapus')
                ->class('badge text-bg-danger')
                ->target('')
                ->route('overtimes.destroy', ['id' => $row->id]);
        }
        return $buttons;
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
