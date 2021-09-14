<?php

namespace App\Http\Controllers\Admin;

use App\ExternalAspiration;
use App\Http\Controllers\Controller;
use App\InternalAspiration;
use App\Meeting;
use App\Post;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:dashboard');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $user_count = User::where('status', '=', 'active')->where('level', 'user')->count();
        $post_count = Post::where('status', '=', 1)->count();
        $internal = InternalAspiration::count();
        $external = ExternalAspiration::count();
        return view('admin.home', compact('title', 'user_count', 'post_count', 'internal', 'external'));
    }

    public function getUsersByAngkatan()
    {
        $users = User::select(DB::raw('angkatan as label, COUNT(*) as total'))->groupBy('angkatan')->get();
        return $users;
    }

    public function getPostsByMonth()
    {
        $posts = Post::select(DB::raw('COUNT(*) as total, MONTHNAME(created_at) as month'))->groupBy(DB::raw('MONTHNAME(created_at)'))->get();
        return $posts;
    }

    public function getInternalByMonth()
    {
        $internal = InternalAspiration::select(DB::raw('COUNT(*) as total, MONTHNAME(created_at) as month'))->groupBy(DB::raw('MONTHNAME(created_at)'))->get();
        return $internal;
    }

    public function getExternalByMonth()
    {
        $external = ExternalAspiration::select(DB::raw('COUNT(*) as total, MONTHNAME(created_at) as month'))->groupBy(DB::raw('MONTHNAME(created_at)'))->get();
        return $external;
    }

    public function getMeeting(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('meetings')->select(DB::raw("meetings.id, meetings.name as label, 
            COUNT(case when meeting_user.`status` = 'hadir' then 1 else null END) AS hadir, 
            COUNT(case when meeting_user.`status` = 'izin' then 1 else null END) AS izin, 
            COUNT(case when meeting_user.`status` = 'alfa' then 1 else null END) AS alfa,
            COUNT(case when meeting_user.`status` = 'sakit' then 1 else null END) AS sakit
            "))
                ->leftJoin('meeting_user', 'meeting_user.meeting_id', '=', 'meetings.id')
                ->leftJoin('users', 'meeting_user.user_id', '=', 'users.id')
                ->groupBy(DB::raw('meetings.id, meetings.name'))->get();
            return $data;
        }
    }

    public function getMeetingByAngkatan(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('meetings')->select(DB::raw("meetings.id, meetings.name as label, 
            COUNT(case when meeting_user.`status` = 'hadir' then 1 else null END) AS hadir, 
            COUNT(case when meeting_user.`status` = 'izin' then 1 else null END) AS izin, 
            COUNT(case when meeting_user.`status` = 'alfa' then 1 else null END) AS alfa,
            COUNT(case when meeting_user.`status` = 'sakit' then 1 else null END) AS sakit
            "))
                ->leftJoin('meeting_user', 'meeting_user.meeting_id', '=', 'meetings.id')
                ->leftJoin('users', 'meeting_user.user_id', '=', 'users.id')
                ->whereRaw('users.angkatan = ? ', $request->angkatan)
                ->groupBy(DB::raw('meetings.id, meetings.name'))
                ->get();
            return $data;
        }
    }
}
