<?php

namespace App\Http\Controllers\Backend\Course;

use App\DataTables\CoursesDataTable;
use App\Helper\FileHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course\Course;
use App\Repositories\Courses\CourseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    protected $course;

    public function __construct(CourseRepository $course)
    {
        $this->course = $course;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CoursesDataTable $dataTable)
    {
        return $dataTable->render('backend.pages.courses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCourseRequest $request)
    {
        try {
            $newCourse = $this->course->create($request->except('_token'));
            if ($newCourse) {
                flash(__('notify.backend.course.success.create'));
            } else {
                flash(__('notify.backend.course.fail.create'), 'danger');
            }

            return redirect(route('admin.courses.index'));
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $course = $this->course->findById($id)->load('image');
            return view('backend.pages.courses.edit', ['course' => $course]);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $course = $this->course->findById($id);
            if (!$course) {
                return abort(404);
            }
            return view('backend.pages.courses.edit', ['course' => $course]);
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCourseRequest $request, $id)
    {
        try {
            $update = $this->course->update($request->except('_token', '_method'), $id);
            if ($update) {
                flash(__('notify.backend.course.success.update'));
                return redirect(route('admin.courses.index'));
            }

            flash(__('notify.backend.course.fail.update'), 'danger');
            return redirect(route('admin.courses.show', ['course' => $id]));
        } catch (\Throwable $th) {
            \Log::error($th->getMessage());
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = $this->course->findById($id);
        $course->delete();
        flash(__('notify.backend.course.success.delete'));

        return redirect(route('admin.courses.index'));
    }
}
