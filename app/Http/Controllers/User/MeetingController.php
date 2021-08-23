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
            $data = Meeting::with(['meeting_category', 'users'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('kehadiran', function ($row) {
                    foreach ($row->users as $user) {
                        $getPivot = $user->pivot->where('user_id', auth()->user()->id)->where('meeting_id', $row->id)->first();
                        if ($getPivot !== null) {
                            return $getPivot->status;
                        } else {
                            return '';
                        }
                    }
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a class="btn btn-success check_record" data-id="' . $row->id . '" data-name="' . $row->name . '">
                        <i class="fas fa-check-circle text-white"></i>
                    </a>';
                    if ($row->users != Collection::make([])) {
                        foreach ($row->users as $user) {
                            $getPivot = $user->pivot->where('user_id', auth()->user()->id)->where('meeting_id', $row->id)->first();
                            if ($getPivot !== null) {
                                if ($getPivot->status === null && $row->status === "open") {
                                    return $actionBtn;
                                } else if ($row->status === "closed") {
                                    return '';
                                }
                            } else {
                                return $actionBtn;
                            }
                        }
                    } else {
                        return $actionBtn;
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
