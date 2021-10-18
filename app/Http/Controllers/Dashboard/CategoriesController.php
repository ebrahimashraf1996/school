<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\ColumnStoreRequest;
use App\Http\Requests\ColumnUpdateRequest;
use App\Http\Requests\StudentsRequest;
use App\Models\Category;
use App\Models\Column;
use App\Models\Student;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index()
    {
        $classes = Category::specific()->orderby('id', 'desc')->get();
        return view('dashboard.categories.index', compact('classes'));
    }

    public function storeClass(CategoryRequest $request)
    {
        // validation by CategoryRequest
        try {
            DB::beginTransaction();
            Category::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'user_id' => auth()->id()
            ]);
            DB::commit();
            return redirect()->route('dashboard.categories')->with(['success' => 'تم الحفظ بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('dashboard.categories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function editClass($id)
    {
        $class = Category::specific()->find($id);
        if (!$class)
            return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود']);
        return view('dashboard.categories.editClass', compact('class'));
    }

    public function updateClass(CategoryRequest $request, $id)
    {
        try {
            // validation by CategoryRequest

            //Check if Exists
            $class = Category::specific()->find($id);
            if (!$class)
                return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود ']);

            // Start Update
            DB::beginTransaction();
            $class->update($request->except('_token', 'user_id'));

            DB::commit();
            return redirect()->route('dashboard.categories')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('dashboard.categories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function repeatClass($id)
    {
        try {
            $oldClass = Category::with('columns')->findOrFail($id);
            $newClassId = Category::insertGetId([
                'name' => $oldClass->name,
                'subject' => $oldClass->subject,
                'user_id' => $oldClass->user_id,
            ]);

            // Redirect Success
            return redirect()->route('dashboard.categories')->with(['success' => 'تم التكرار بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }


    }

    public function destroyClass($id)
    {
        try {
            //get specific Class
            $class = Category::specific()->find($id);

            // check if exists
            if (!$class)
                return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود ']);

            // delete row from Table
            $class->delete();

            // redirect success
            return redirect()->route('dashboard.categories')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.categories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function show($id)
    {
        // 41 -> $item->type
//        $childrenColumns = Column::with(['childrens_sum' => function($q) {
//            $q->select('id', 'parent_id_sum');
//        }])->find(41);
//        $childrenColumns = $childrenColumns->childrens_sum;
//return$childrenColumns;
        //$tet = 25 + $column->childrens_sum[0]->id ;
//        //
        //return $tet;

//        return $child = Column::with('students')->find($child_id);
//        return $child->students->sum('pivot.student_degree');

        $columns = Column::with(['childrens_sum' => function ($q) {
            $q->select('id', 'parent_id_sum');
        }])->specific($id)->get();

        $students = Student::with('columns')->where('category_id', $id)->get();
        //return $students->columns->first()->pivot->student_degree;
        $class = Category::specific()->find($id);
        if (!$class)
            return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود']);
        return view('dashboard.categories.show', compact('class', 'students', 'columns'));
    }


    public function addStudents($id)
    {
        $class = Category::specific()->find($id);
        if (!$class)
            return redirect()->route('dashboard.categories.show', $class->id)->with(['error' => 'هذا العنصر غير موجود']);
        return view('dashboard.categories.addStudents', compact('class'));
    }

    public function storeStudents(StudentsRequest $request)
    {
        // validation by StudentsRequest

        DB::beginTransaction();

        // Fitch Data & Store
        $students = explode("\n", $request->name);
        $students = str_replace("\r", "", $students);
        foreach ($students as $value) {
            $student_id = Student::insertGetId([
                'name' => $value,
                'category_id' => $request->category_id
            ]);
            $student = Student::find($student_id);
            $columns = Column::specific($request->category_id)->pluck('id');
            $student->columns()->syncWithoutDetaching($columns);
        }
        DB::commit();
        return redirect()->route('dashboard.categories.show', $request->category_id)->with(['success' => 'تم الحفظ بنجاح']);

    }

    public function manageColumns($id)
    {
        $class = Category::specific()->find($id);
        if (!$class)
            return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود']);
        $columns = Column::specific($id)->get();
        return view('dashboard.categories.manageColumns', compact('columns', 'class'));
    }

    public function addColumn($id)
    {

        $class = Category::specific()->find($id);
        if (!$class)
            return redirect()->route('dashboard.categories')->with(['error' => 'هذا العنصر غير موجود']);

        $numColumns = Column::typeNum($id)->get();
        return view('dashboard.categories.addColumns', compact('class', 'numColumns'));
    }


    public function storeColumns(ColumnStoreRequest $request)
    {
//      validation by ColumnStoreRequest
        DB::beginTransaction();
//            Column Type 1 Number
        if ($request->type == 1) {
            $id = Column::insertGetId([
                'name' => $request->name,
                'slug' => $request->slug,
                'column_degree' => $request->column_degree,
                'description' => $request->description,
                'type' => $request->type,
                'category_id' => $request->classId,
            ]);
            $column = Column::find($id);
            $students = Student::pluck('id');
            $column->students()->syncWithoutDetaching($students);
        }


//                Column Type 3 Total or 2 average
        if ($request->type == 3 || $request->type == 2) {

            $parent_id = Column::insertGetId([
                'name' => $request->name,
                'slug' => $request->slug,
                'description' => $request->description,
                'column_degree' => $request->column_degree,
                'type' => $request->type,
                'category_id' => $request->classId,
            ]);
            $column = Column::find($parent_id);
            $students = Student::pluck('id');
            $column->students()->syncWithoutDetaching($students);

            $child_ids = array_keys($request->child_id);

            if ($request->type == 3) {
                foreach ($child_ids as $child_id) {
                    $child = Column::find($child_id);
                    $child->update(['parent_id_sum' => $parent_id]);
                }
                $parent_column_degree = Column::where('parent_id_sum', $parent_id)->sum('column_degree');
                $parent = Column::find($parent_id);
                $parent->update(['column_degree' => $parent_column_degree]);

            } else if ($request->type == 2) {
                foreach ($child_ids as $child_id) {
                    $child = Column::find($child_id);
                    $child->update(['parent_id_avg' => $parent_id]);
                }
                $parent_column_degree = Column::where('parent_id_avg', $parent_id)->avg('column_degree');
                $parent = Column::find($parent_id);
                $parent->update(['column_degree' => $parent_column_degree]);
            }
        }
        DB::commit();
        return redirect()->route('dashboard.categories.manageColumns', $request->classId)->with(['success' => 'تم الحفظ بنجاح']);
    }


    public function editColumn($classId, $columnId)
    {
        $column = Column::specific($classId)->find($columnId);
        if (!$column)
            return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'هذا العنصر غير موجود']);
        return view('dashboard.categories.editColumn', compact('column'));
    }

    public function updateColumn(ColumnUpdateRequest $request, $classId, $columnId)
    {
        try {
            // validation by ColumnUpdateRequest

            //Check if Exists
            $column = Column::specific($classId)->find($columnId);
            if (!$column)
                return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'هذا العنصر غير موجود ']);

            // Start Update
            DB::beginTransaction();
            $column->update($request->except('_token', 'category_id'));

            DB::commit();
            return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

    public function destroyColumn($classId, $columnId)
    {

        try {
            //get specific Column
            $column = Column::specific($classId)->find($columnId);

            // check if exists
            if (!$column)
                return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'هذا العنصر غير موجود ']);

            if ($column->type == 1) {

                if ($column->parent_id_sum != null || $column->parent_id_avg != null) {
                    return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'هذا العمود لا يمكن حذفه نظرا لارتباطه بعمود آخر من نوع مجموع أو من نوع متوسط']);
                }
                $column->delete();
            }
            if ($column->type == 3) {
                $child_columns = Column::where('parent_id_sum', $columnId)->get();
                foreach ($child_columns as $child) {
                    $child->update([
                        'parent_id_sum' => null
                    ]);
                }
                $column->delete();
            }
            if ($column->type == 2) {
                $child_columns = Column::where('parent_id_avg', $columnId)->get();
                foreach ($child_columns as $child) {
                    $child->update([
                        'parent_id_avg' => null
                    ]);
                }
                $column->delete();
            }
            // delete row from Table


            // redirect success
            return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.categories.manageColumns', $classId)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function updateStudentDetails(Request $request, $classId)
    {
        try {

            $sumParents = Column::specific($classId)->where('type', 3)->get();
//            return $parents[0];
            $deg = 0;
            foreach ($sumParents as $parent) {
                foreach ($request->except('_token') as $key => $value) {
                    $requestKey = $key;
                    $requestVal = $value;
//                    $key = collect($request->all())->keys(); // student_degree_70_29_child_of_41_42
                    $key = str_replace('student_degree_', '', $key); //70_29_child_of_41_42
                    $key = str_replace('name_', '', $key); //70_29_child_of_41_42
                    $key = str_replace('child_of_', '', $key); //70_29_41_42
                    $arr = explode('_', $key); // [70,29,41,42] [Student_id, inputColumn_id, parent_student_degree, parent_avg]


                    if (count($arr) > 3) {
                        $student = Student::with('columns')->find($arr[0]);
                        $studentParent = $student->columns->where('pivot.student_id', $arr[0])
                            ->where('pivot.column_id', $arr[2])->first();


                        $studentChild = $student->columns->where('pivot.student_id', $arr[0])
                            ->where('pivot.column_id', $arr[1])->first();
                        // checkIfSameDegree
                        if ($requestVal != $studentChild->pivot->student_degree) {
                            if ($arr[2] == $parent->id) {
                                $student = Student::with('columns')->find($arr[0]);
                                $studentParent = $student->columns->where('pivot.student_id', $arr[0])
                                    ->where('pivot.column_id', $arr[2])->first();
                                $deg = $deg + $request->$requestKey;
                                $studentParent->pivot->update([
                                    'student_degree' => $deg
                                ]);
                            }
                        }

                    }
                }
            }


            $avgParents = Column::specific($classId)->where('type', 2)->get();

//            return $parents[0];
            $degAVG = 0;
            foreach ($avgParents as $avgParent) {
                foreach ($request->except('_token') as $key => $value) {
                    $requestKey = $key;
                    $requestVal = $value;
//                    $key = collect($request->all())->keys(); // student_degree_70_29_child_of_41_42
                    $key = str_replace('student_degree_', '', $key); //70_29_child_of_41_42
                    $key = str_replace('name_', '', $key); //70_29_child_of_41_42
                    $key = str_replace('child_of_', '', $key); //70_29_41_42
                    $arr = explode('_', $key); // [70,29,41,42] [Student_id, inputColumn_id, parent_student_degree, parent_avg]

                    if (count($arr) > 3) {

                        $student = Student::with('columns')->find($arr[0]);
                        $studentParent = $student->columns->where('pivot.student_id', $arr[0])
                            ->where('pivot.column_id', $arr[3])->first();


                        $studentChild = $student->columns->where('pivot.student_id', $arr[0])
                            ->where('pivot.column_id', $arr[1])->first();

                        // checkIfSameDegree
                        if ($requestVal != $studentChild->pivot->student_degree) {

                            if ($arr[3] == $avgParent->id) {

                                $student = Student::with('columns')->find($arr[0]);
                                $studentParent = $student->columns->where('pivot.student_id', $arr[0])
                                    ->where('pivot.column_id', $arr[3])->first();
                                $degAVG = $degAVG + $request->$requestKey;
                                $studentParent->pivot->update([
                                    'student_degree' => $degAVG
                                ]);
                            }
                        }

                    }
                }
            }


            foreach ($request->except('_token') as $key => $value) {
                $requestKey = $key;
                $key = str_replace('student_degree_', '', $key);
                $key = str_replace('name_', '', $key);
                $res = Str::contains($key, '_');
                if ($res == true) {
                    $arr = explode('_', $key);
//                    update data in pivod table $ids_arr[0] = student_id -- $ids_arr[1] = column_id
                    $student = Student::with('columns')->find($arr[0]);
                    $student = $student->columns->where('pivot.student_id', $arr[0])
                        ->where('pivot.column_id', $arr[1])->first();
                    $student->pivot->update([
                        'student_degree' => $request->$requestKey
                    ]);
                } else {
//                    update name in student table
                    $student = Student::find($key);
                    $student->update(['name' => $request->$requestKey]);
                }
            }


//        $parent = Column::with(['childrens_sum' => function($q) {
//            $q->select('id', 'parent_id_sum');
//        }])->find(41);
//
//        $key = collect($request->all())->keys(); // student_degree_70_29
//        $key = str_replace('student_degree_', '', $key); //70_29

            // <p>
            //      select el input elly el name bta3o student_degree_(student_id)_
            //</p>

//        $key = collect($request->all())->keys(); // student_degree_70_29_child_of_41_42
//        $key = str_replace('student_degree_', '', $key); //70_29_child_of_41_42
//        $key = str_replace('name_', '', $key); //70_29_child_of_41_42
//        $key = str_replace('child_of_', '', $key); //70_29_41_42
//        $arr = explode('_', $key); // [70,29,41,42] [Student_id, Column_id, parent_sum, parent_avg]
//
//        for each 3la el requestat elly gaya if el request key =
//        [Student_id, Column_id, hena hn7ot elparent elly gay men el for each elly 2pl de elly how bta3 el parents, parent_avg]
//        e3mly update 3la el parent->student_degree 5aleha + el value elly gaya mn el request


//    $student = Student::with('columns')->find($arr[0]);
//                    $student = $student->columns->where('pivot.student_id', $arr[0])
//                        ->where('pivot.column_id', $arr[1])->first();
//                    $student->pivot->update([
//                        'student_degree' => $request->$requestKey
//                    ]);


//        return $arr;

//        return $request->student_degree_70_29;
//        return $request;


            // redirect success
            return redirect()->route('dashboard.categories.show', $classId)->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('dashboard.categories.show', $classId)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroyStudent($classId, $studentId)
    {
        try {
            //get specific Student
            $student = Student::with('columns')->specific($classId)->find($studentId);


            // check if exists
            if (!$student)
                return redirect()->route('dashboard.categories.show', $classId)->with(['error' => 'هذا العنصر غير موجود ']);

            // delete row from Table
            $student->delete();

            // redirect success
            return redirect()->route('dashboard.categories.show', $classId)->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect()->route('dashboard.categories.show', $classId)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function printView($classId)
    {
        $columns = Column::with(['childrens_sum' => function ($q) {
            $q->select('id', 'parent_id_sum');
        }])->specific($classId)->get();

        $students = Student::with('columns')->where('category_id', $classId)->get();
        $user = auth()->user();
        $class = Category::specific()->find($classId);
        return view('dashboard.print', compact('class', 'user', 'columns', 'students'));
    }


}
