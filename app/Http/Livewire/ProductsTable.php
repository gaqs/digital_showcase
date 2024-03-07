<?php

namespace App\Http\Livewire;

use App\Models\Business;
use App\Models\Product;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductsTable extends DataTableComponent
{
    //protected $model = Product::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Product::query()
            ->leftjoin('business','business.id','=','product.business_id' )
            ->select('product.*','business.id as bsns_id','business.name','business.score')
            ->where('product.user_id','=',Auth::user()->id);

    }

    public function columns(): array
    {
        return [
            //'uploads/products/'.$product[$i]->folder.'/'.show_product_picture($product[$i]->folder);
            ImageColumn::make('Avatar')
                ->location(
                    fn($row) => asset('uploads/products/'.$row->folder.'/'.show_product_picture($row->folder))
                )
                ->attributes(fn($row) => [
                    'style' => 'max-width: 100px'
                ]),
            Column::make('Nombre', 'name')
                ->sortable()
                ->searchable(),
            Column::make('Negocio', 'business.name')
                ->sortable()
                ->searchable(),
            ButtonGroupColumn::make('Acciones')
                ->unclickable()
                ->buttons([
                    LinkColumn::make('Ver')
                    ->title(fn($row) => 'Ver')
                    ->location(fn($row) => route('product.show', ['id' => $row->id ]))
                    ->attributes(function($row){
                        return[
                            'class' => 'inline-block rounded bg-primary px-3 pb-2 pt-2 text-xs font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]'
                        ];
                    }),
                    LinkColumn::make('Editar')
                    ->title(fn($row) => 'Editar')
                    ->location(fn($row) => route('product.edit', ['id' => $row->id ]))
                    ->attributes(function($row){
                        return[
                            'class' => 'inline-block rounded bg-primary px-3 pb-2 pt-2 text-xs font-medium leading-normal text-white shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:bg-primary-600 hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:bg-primary-600 focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:outline-none focus:ring-0 active:bg-primary-700 active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]'
                        ];
                    }),
                    LinkColumn::make('Borrar')
                    ->title(fn($row) => 'Borrar')
                    ->location(fn($row) => route('product.destroy',['id' => $row->id ]))
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
