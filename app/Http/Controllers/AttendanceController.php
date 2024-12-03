<?php

namespace App\Http\Controllers;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Resources\AttendanceResource;
use App\Http\Controllers\adate;
class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'count'=>Attendance::all()->count(),
            'data'=>AttendanceResource::collection(Attendance::all())
         ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dump($request->all());
        //Log::info('Хүсэлтийн өгөгдөл:', $request->all());

        $x=Attendance::create([
            'id'=> $request->id,
            'course_id'=> $request->course_id,
            'student_id'=> $request->student_id,
            'stat_id'=> $request->stat_id,
            'adate'=> $request->adate,

        ]);

        return  response()->json([
            "status"=>"ok",
            "data"=>$x
        ], 200);
    }


    public function stores(Request $request)
    {
        //dump($request->all());
        //Log::info('Хүсэлтийн өгөгдөл:', $request->all());

        $xx=Attendance::insert($request->all());

        // $x=Attendance::create([
        //     'id'=> $request->id,
        //     'course_id'=> 1,
        //     'student_id'=> 1,
        //     'stat_id'=> 1,
        //     'adate'=> $request->adate,

        // ]);

        return  response()->json([
            "status"=>"ok",
            "data"=>$xx
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $x=Attendance::find($id);
        if ($x){
           return $x.$id."->id-тай attendance-ийн Мэдээллийг харууллаа";
        }else{
            return $id."->id-тай Мэдээлэл байхгүй байна";
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oneAttendance=Attendance::find($id);
        
        if($oneAttendance){
             $res=$oneAttendance->update([
                'course_id'=> $request->course_id,
                'student_id'=> $request->student_id,
                'stat_id'=> $request->stat_id,
                'adate'=> null,
                //'created_at'=> $request->true,
                //'updated_at'=> $request->true,
            ]);
            return response()->json([
                "status"=>"ok",
                "data"=>$oneAttendance
            ], 200);
        }else{
            return $id." кодтой өгөгдөл байхгүй";
        }        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $x=Attendance::find($id);
        if($x){
            $aa=$x->delete();
            return $id." id-тэй курс устгалаа";
        }else{
            return $id." id-тэй курс олдсонгүй";
        }
    }
}
