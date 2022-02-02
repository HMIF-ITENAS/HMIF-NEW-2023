<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Meeting;
use App\MeetingCategory;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function testing()
    {
        $data = Meeting::with(['meeting_category', 'users'])->latest()->get();
        $getPivot = [];
        foreach ($data as $d) {
            if ($d->users != []) {
                foreach ($d->users as $user) {
                    $getPivot = $user->pivot->where('user_id', auth()->user()->id)->where('meeting_id', $d->id)->get();
                    return $getPivot;
                }
            }
        }
        dd($getPivot);
    }
    public function getMeeting(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['meeting_category', 'auth_user'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('kehadiran', function ($row) {
                    if($row->auth_user != Collection::make([])){
                        return $row->auth_user[0]->pivot->status;
                    }else{
                        return null;
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-success check_record" data-id="' . $row->id . '" data-name="' . $row->name . '">
                        <i class="fas fa-check-circle text-white"></i>
                    </a>';
                    if ($row->status === "closed") {
                        return '<a class="btn btn-danger text-white">Closed</a>';
                    } else {
                        if($row->auth_user == Collection::make([]) && $row->status === "open"){
                            return $actionBtn;
                        }
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function check(Request $request, $id)
    {
        $currentTime = Carbon::now()->toTimeString();
        $meeting = Meeting::where('id', '=', $id)
            ->where('begin_date', '>=', date('Y-m-d'))
            ->where('status', '=', 'open')->first();
        if ($meeting != null) {
            if ((strtotime($currentTime) >= strtotime($meeting->start_presence)) && (strtotime($currentTime) <= strtotime($meeting->end_presence))) {
                $meeting->users()->attach([1 => ['user_id' => auth()->user()->id, 'status' => 'hadir']]);
                return  response()->json([
                    'data' => $meeting,
                    'status' => TRUE
                ]);
            } else {
                return  response()->json([
                    'data' => $meeting,
                    'error' => 'melebihi batas waktu absensi!',
                    'status' => FALSE
                ]);
            }
        } else {
            return  response()->json([
                'data' => $meeting,
                'error' => 'melebihi batas waktu tanggal!',
                'status' => FALSE
            ]);
        }
    }
}
