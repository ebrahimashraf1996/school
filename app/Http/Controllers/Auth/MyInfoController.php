<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\InfoUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyInfoController extends Controller
{
    public function edit($id)
    {
        if ($id != auth()->user()->id) {
            return redirect()->route('teacher.home')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
        $user = User::find($id);
        $current = date('Y');
        $pre = date('Y') - 1;
        $val = $pre . '-' . $current;
        return view('dashboard.info.editInfo', compact('user', 'current', 'pre', 'val'));
    }

    public function update(InfoUpdateRequest $request, $id)
    {
        try {

            if ($id != auth()->user()->id) {
                return redirect()->route('teacher.home')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
            }
            $user = User::find($id);

            DB::beginTransaction();

            $fileName = "";
            if ($request->has('photo')) {
                $fileName = uploadImage('userPhotos', $request->photo);
                $user->update(['photo' => $fileName]);
            }

            if ($request->password != null) {
                $user->update(['password' => $request->password]);
            }

            $user->update([
                'name' => $request->name,
                'school' => $request->school,
                'email' => $request->email,
                'year' => $request->year,
                'term' => $request->term,
            ]);

            DB::commit();
            return redirect()->route('dashboard.categories')->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('dashboard.categories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقا']);
        }
    }

//$user->update([
//
//]);

}
