<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use App\Models\Product;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return User::query()
            ->select('*');

    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Apellido', 'lastname')
                ->sortable()
                ->searchable(),
            Column::make('Correo', 'email')
                ->sortable()
                ->searchable(),
            Column::make('Rol', 'role')
                ->sortable()
                ->searchable(),
            Column::make('Creado', 'created_at')
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make('Acciones')

                ->unclickable()
                ->buttons([
                    LinkColumn::make('Editar')
                    ->title(fn($row) => 'Editar')
                    ->location(fn($row) => route('admin_users.edit', ['user' => $row->id ]))
                    ->attributes(function($row){
                        return[
                            'class' => 'inline-block rounded bg-primary px-3 pb-2 pt-2 text-xs font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]'
                        ];
                    }),
                    LinkColumn::make('Borrar')
                    ->title(fn($row) => 'Borrar')
                    ->location(fn($row) => route('admin_users.destroy',['user' => $row->id ]))
                    ->attributes(function($row){
                        return[
                            'class' => 'inline-block rounded bg-danger px-3 pb-2 pt-2 text-xs font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#dc4c64] transition duration-150 ease-in-out hover:bg-danger-600 hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:bg-danger-600 focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] focus:outline-none focus:ring-0 active:bg-danger-700 active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.3),0_4px_18px_0_rgba(220,76,100,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(220,76,100,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(220,76,100,0.2),0_4px_18px_0_rgba(220,76,100,0.1)]',
                            'id' => 'delete_link'
                        ];
                    }),

                ])
        ];
    }
}
