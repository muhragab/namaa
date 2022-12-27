<?php

namespace App\DataTables;

use App\Models\Blog;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class BlogDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'blogs.datatables_actions')
            ->editColumn('image', function ($blog) {
                $url = asset($blog->image);
                return '<a href="' . $url . '" target="_blank">
                <img src=' . $url . ' border="0" width="40" class="img-rounded" align="center"/>
                </a>';
            })->rawColumns(['image', 'action'])
            ->filter(function ($query) {
                $input = array_filter(request()->all());
                if (isset($input['title'])) {
                    $query->where('title', 'like', "%" . request('title') . "%");
                }
                if (isset($input['content'])) {
                    $query->where('content', 'like', "%" . request('content') . "%");
                }
                if (isset($input['from'])) {
                    $query->whereDate('publish_date', '>=', request('from'));
                }

                if (isset($input['to'])) {
                    $query->whereDate('publish_date', '<=', request('to'));
                }
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Blog $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Blog $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false])
            ->parameters([
                'dom' => 'Bfrtip',
                'stateSave' => true,
                'order' => [[0, 'desc']],
                'buttons' => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'image',
            'title',
            'publish_date',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'blogs_datatable_' . time();
    }
}
