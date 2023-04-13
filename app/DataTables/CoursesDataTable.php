<?php

namespace App\DataTables;

use App\Models\Course\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CoursesDataTable extends DataTable
{
    protected $actions = ['excel', 'print'];

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('content', function ($data) {
                return strip_tags($data->content);
            })
            ->editColumn('created_at', function ($data) {
                return date_format($data->created_at, 'd/m/Y');
            })
            ->addColumn('action', function ($data) {
                return $this->getActionColumn($data);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Course $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Course $model)
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
            ->setTableId('courses-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->buttons(
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            );
    }


    /**
     * 
     * @param $data
     * 
     * @return mixed
     */
    protected function getActionColumn($data)
    {
        $showNameRoute = route('admin.courses.show', ['course' => $data->id]);
        $editNameRoute = route('admin.courses.edit', ['course' => $data->id]);
        $deleteNameRoute = route('admin.courses.destroy', ['course' => $data->id]);
        $dataId = $data->id;

        return view('backend.partials.action', [
            'routeEdit' => $editNameRoute,
            'routeDelete' => $deleteNameRoute,
            'dataId' => $dataId,
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
            Column::make('id'),
            Column::make('name'),
            Column::make('content'),
            Column::make('created_at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Courses_' . date('YmdHis');
    }
}
