<?php

namespace App\Http\Controllers\Admin;

use App\Exports\MeetingExport;
use App\Http\Controllers\Controller;
use App\Meeting;
use App\MeetingCategory;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MeetingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:rapat-list|rapat-detail', ['only' => ['index', 'show', 'getMeetingById', 'exportMeetingById']]);
        $this->middleware('permission:rapat-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:rapat-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:rapat-delete', ['only' => ['destroy']]);
        $this->middleware('permission:rapat-delete', ['only' => ['destroy']]);
        $this->middleware('permission:rapat-detail-edit', ['only' => ['getUserToMeeting', 'getUserNotMeeting', 'createUserToMeeting', 'deleteUserMeeting', 'editUserMeeting', 'editStatusMeeting']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Rapat";
        $data = Meeting::with(['meeting_category'])->latest()->get();
        return view('admin.meeting.index', compact('title'));
    }

    public function getMeeting(Request $request)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['meeting_category'])->latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('meeting_category', function ($row) {
                    return $row->meeting_category->name;
                })
                ->addColumn('users', function ($row) {
                    return $row->users->count();
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('action', function ($row) {
                    $edit_url = route('admin.meeting.edit', $row->id);
                    $show_url = route('admin.meeting.show', $row->id);
                    $actionBtn = '<a class="btn btn-success" href="' . $show_url . '">
                    <svg class="c-icon">
                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-magnifying-glass">
                        </use>
                    </svg>
                    </a>
                    <a class="btn btn-info" href="' . $edit_url . '">
                        <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-pencil">
                            </use>
                        </svg>
                    </a>
                    <a class="btn btn-danger hapus_record" data-id="' . $row->id . '" data-name="' . $row->name . '" href="#">
                        <svg class="c-icon">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-trash">
                            </use>
                        </svg>
                    </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        $title = "Buat Rapat";
        $meetingCategories = MeetingCategory::all();
        return view('admin.meeting.create', compact('title', 'meetingCategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->presence !== "on") {
            $this->validate($request, [
                'name' => 'required|min:5',
                'meeting_category_id' => 'required|integer',
                'detail' => 'required',
                'begin_date' => 'required',
                'start_meet_at' => 'required|date_format:H:i',
                'end_meet_at' => 'required|date_format:H:i|after:start_meet_at',
            ]);
            $start_meet_at = $request->start_meet_at;
            $start_presence_time = strtotime("+1 minutes", strtotime($start_meet_at));
            $start_presence = date('h:i', $start_presence_time);

            $end_presence = $request->end_meet_at;
            $data = $request->except(['_token', 'start_presence', 'end_presence']);
            $data['start_presence'] = $start_presence;
            $data['end_presence'] = $end_presence;
            Meeting::create($data);
        } else {
            $this->validate($request, [
                'name' => 'required|min:5',
                'meeting_category_id' => 'required|integer',
                'detail' => 'required',
                'begin_date' => 'required',
                'start_meet_at' => 'required|date_format:H:i',
                'end_meet_at' => 'required|date_format:H:i|after:start_meet_at',
                'start_presence' => 'required|date_format:H:i|after:start_meet_at',
                'end_presence' => 'required|date_format:H:i|after:start_presence|before_or_equal:end_meet_at',
            ]);
            Meeting::create($request->except(['_token', 'presence']));
        }
        return redirect()->route('admin.meeting')->with('success', 'Rapat berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail Rapat';
        $meeting = Meeting::with(['users', 'meeting_category'])->find($id);
        return view('admin.meeting.show', compact('title', 'meeting'));
    }

    public function getMeetingById(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = Meeting::with(['users', 'meeting_category'])->find($id);
            return DataTables::of($data->users)
                ->addIndexColumn()
                ->addColumn('nrp', function ($row) {
                    return $row->nrp;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->pivot->created_at->toDateTimeString();
                })
                ->editColumn('status', function ($row) {
                    return $row->pivot->status;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <button type="button" class="btn btn-info edit_record" data-toggle="modal" data-target="#modal-edit" data-id="' . $row->id . '" data-nrp="' . $row->nrp . '" data-name="' . $row->name . '" data-pivot="' . $row->pivot->id . '">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a class="btn btn-danger hapus_record" data-name="' . $row->name . '" data-pivot="' . $row->pivot->id . '" href="#">
                        <i class="fas fa-trash-alt"></i>
                        </a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function exportMeetingById($id)
    {
        $export = new MeetingExport($id);

        return Excel::download($export, "export_meeting_id_$id.xlsx");
    }

    public function getUserToMeeting(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = DB::table('users')->where('level', 'user')->whereNotExists(function ($query) use ($id) {
                $query->select(DB::raw(1))
                    ->from('meeting_user')
                    ->whereRaw('users.id = meeting_user.user_id')
                    ->where('meeting_user.meeting_id', '=', $id);
            })->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nrp', function ($row) {
                    return $row->nrp;
                })
                ->addColumn('name', function ($row) {
                    return $row->name;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getUserNotMeeting(Request $request)
    {
        $request->validate([
            'id' => 'required|integer'
        ]);
        $id = $request->id;
        $data = DB::table('users')->where('level', 'user')->whereNotExists(function ($query) use ($id) {
            $query->select(DB::raw(1))
                ->from('meeting_user')
                ->whereRaw('users.id = meeting_user.user_id')
                ->where('meeting_user.meeting_id', '=', $id);
        })->get();
        DB::transaction(function () use ($id, $data) {
            foreach ($data as $peserta) {
                DB::table('meeting_user')->insert([
                    'meeting_id' => $id,
                    'user_id' => $peserta->id,
                    'status' => 'alfa',
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        });
        return redirect()->back()->with('success', 'Generate user alfa berhasil! Mohon dicek ulang data peserta.');
    }

    public function createUserToMeeting(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            foreach ($request->peserta as $peserta) {
                DB::table('meeting_user')->insert([
                    'meeting_id' => $id,
                    'user_id' => $peserta["id"],
                    'status' => 'hadir',
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]);
            }
        });
        return response()->json(['status' => TRUE]);
    }

    public function deleteUserMeeting(Request $request)
    {
        DB::transaction(function () use ($request) {
            DB::table('meeting_user')->where('id', $request->pivot)->delete();
        });
        return response()->json(['status' => TRUE]);
    }

    public function editUserMeeting(Request $request)
    {
        $request->validate([
            'nrp' => 'required',
            'name' => 'required',
            'status' => 'required',
        ]);
        DB::transaction(function () use ($request) {
            DB::table('meeting_user')->where('id', $request->pivot_id)->update([
                'status' => $request->status
            ]);
        });
        return redirect()->route('admin.meeting.show', $request->meeting_id)->with('success', 'Status user pada rapat berhasil diubah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $title = "Buat Rapat";
        $meeting = Meeting::findOrFail($id);
        $meetingCategories = MeetingCategory::all();
        return view('admin.meeting.edit', compact('title', 'meetingCategories', 'meeting'));
    }

    public function editStatusMeeting(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:closed,open'
        ]);
        $meeting = Meeting::findOrFail($id);
        $meeting->update([
            'status' => $request->status
        ]);
        return redirect()->back()->with('success', 'Status rapat berhasil diubah!');
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
        $meeting = Meeting::find($id);
        if ($request->presence !== "on") {
            $this->validate($request, [
                'name' => 'required|min:5',
                'meeting_category_id' => 'required|integer',
                'detail' => 'required',
                'begin_date' => 'required',
                'start_meet_at' => 'required',
                'end_meet_at' => 'required|after:start_meet_at',
            ]);
            $start_meet_at = $request->start_meet_at;
            $start_presence_time = strtotime("+1 minutes", strtotime($start_meet_at));
            $start_presence = date('h:i', $start_presence_time);

            $end_presence = $request->end_meet_at;
            $data = $request->except(['_token', 'start_presence', 'end_presence']);
            $data['start_presence'] = $start_presence;
            $data['end_presence'] = $end_presence;
            $meeting->update($data);
        } else {
            $this->validate($request, [
                'name' => 'required|min:5',
                'meeting_category_id' => 'required|integer',
                'detail' => 'required',
                'begin_date' => 'required',
                'start_meet_at' => 'required',
                'end_meet_at' => 'required|after:start_meet_at',
                'start_presence' => 'required|after:start_meet_at',
                'end_presence' => 'required|after:start_presence|before_or_equal:end_meet_at',
            ]);
            $meeting->update($request->except(['_token', 'presence']));
        }
        return redirect()->route('admin.meeting')->with('success', 'Rapat berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Meeting::find($id)->delete();
        return response()->json(['status' => TRUE]);
    }
}
