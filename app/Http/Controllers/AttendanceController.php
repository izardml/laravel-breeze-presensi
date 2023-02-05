<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Subject;
use App\Models\Attdetail;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role == 'guru'){
            $attendance = Attendance::where('teacher_id', $user->id)->orderBy('id', 'desc')->paginate(5);
        }else{
            $attendance = Attendance::where([
                ['date', '=', date('Y-m-d')],
                ['class_id', '=', $user->class_id],
            ])->orderBy('id', 'desc')->paginate(5);
        }

        return view('dashboard', ['attendances' => $attendance]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Subject::all();
        $class = Classes::whereNot('id', 1)->get();

        return view('attendance.form', [
            'subjects' => $subject,
            'classes' => $class,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required',
            'class_id' => 'required',
            'topic' => 'required',
        ]);

        $success = Attendance::create([
            'teacher_id' => Auth::user()->id,
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'date' => date('Y-m-d'),
            'topic' => $request->topic,
        ]);

        if($success){
            return redirect()->route('guru.create')->with([
                'message' => 'Yay, kamu berhasil membuat presensi!',
                'color' => 'green',
            ]);
        }

        return redirect()->route('guru.create')->with([
            'message' => 'Yah, kamu gagal membuat presensi...',
            'color' => 'red',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        $attdetail = Attdetail::where('attendance_id', $attendance->id)->get();

        return view('attendance.detail', [
            'attendance' => $attendance,
            'attdetails' => $attdetail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        $success = $attendance->delete();

        if($success){
            return redirect()->route('dashboard')->with([
                'message' => 'Yay, presensi berhasil dihapus!',
                'color' => 'green',
            ]);
        }

        return redirect()->route('dashboard')->with([
            'message' => 'Yah, presensi gagal dihapus...',
            'color' => 'red',
        ]);
    }

    public function history()
    {
        //
    }
}
