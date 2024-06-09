<?php

namespace App\Livewire;

use App\Models\Letter;
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

final class LetterTable extends PowerGridComponent
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
        $query = Letter::query();
        if ($this->condition == 'me') {
            $query->where('user_id_creator', auth()->id());
        } elseif ($this->condition == 'pending') {
            $query->where('status', 'pending');
            
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
            ->add('no_letter')
            ->add('date_out_formatted', fn (Letter $model) => Carbon::parse($model->date_out)->format('d/m/Y'))
            ->add('subject')
            ->add('creator',fn (Letter $letter) => $letter->creator->name)
            ->add('user_id_approver');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('No letter', 'no_letter')
                ->sortable()
                ->searchable(),

            Column::make('Tanggal Keluar', 'date_out_formatted', 'date_out')
                ->sortable(),

            Column::make('Perihal', 'subject')
                ->sortable()
                ->searchable(),

            Column::make('Tujuan', 'destination')
                ->sortable()
                ->searchable(),

            Column::make('Pembuat', 'creator')
                ->sortable()
                ->searchable(),




           

            

            
            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::datepicker('date_out_formatted','date_out'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert('.$rowId.')');
    }

    public function actions(Letter $row): array
    {
        $buttons = [];
        $buttons[] = Button::make('show', 'lihat')
            ->class('badge text-bg-success')
            ->target('')
            ->route('letters.show', ['id' => $row->id]);
        if ($this->condition === 'me') {
            $buttons[] = Button::make('edit', 'Edit')
                ->class('badge text-bg-warning')
                ->target('')
                ->route('letters.edit', ['id' => $row->id]);
    
            $buttons[] = Button::make('delete', 'Hapus')
                ->class('badge text-bg-danger')
                ->target('')
                ->route('letters.destroy', ['id' => $row->id]);
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
