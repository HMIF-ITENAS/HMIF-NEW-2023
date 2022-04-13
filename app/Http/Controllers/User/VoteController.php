<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\LeaderCandidate;
use App\User;
use DB;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $title = "E-Vote";
        $kahim = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 1)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
        $bpa = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 2)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
        if ($kahim == null) {
            $has_vote_kahim = false;
        } else {
            $has_vote_kahim = true;
        }
        if ($bpa == null) {
            $has_vote_bpa = false;
        } else {
            $has_vote_bpa = true;
        }
        return view('user.e-vote.index', compact('title', 'has_vote_kahim', 'has_vote_bpa'));
    }

    public function kahim()
    {
        $title = "Kahim";
        $kahim = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 1)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
        if ($kahim) {
            return redirect()->back()->with('danger', 'Anda sudah memilih kahim!');
        }
        $data = LeaderCandidate::with(['user'])->where('status', '=', 1)->get();
        return view('user.e-vote.kahim', compact('title', 'data'));
    }

    public function kahimDetail(Request $request, $id)
    {
        $data = LeaderCandidate::with(['user'])->where('status', '=', 1)->find($id);
        return response()->json(['success' => TRUE, 'data' => $data]);
    }

    public function vote(Request $request, $id)
    {
        if ($request->status == 1) {
            $kahim = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 1)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
            if ($kahim) {
                return response()->json(['success' => FALSE, 'message' => 'Anda telah memilih kahim!']);
            }
            $leader = LeaderCandidate::kahim()->find($id);
            $leader->voters()->attach($request->user()->id);
        } else {
            $bpa = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 2)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
            if ($bpa) {
                return response()->json(['success' => FALSE, 'message' => 'Anda telah memilih ketua bpa!']);
            }
            $leader = LeaderCandidate::bpa()->find($id);
            $leader->voters()->attach($request->user()->id);
        }
        return response()->json(['success' => TRUE, 'data' => $leader]);
    }

    public function bpa()
    {
        $title = "BPA";
        $bpa = DB::table('candidate_voters')->join('leader_candidates', 'leader_candidates.id', '=', 'candidate_voters.leader_candidate_id')->where('leader_candidates.status', '=', 2)->where('candidate_voters.voter_id', '=', auth()->user()->id)->first();
        if ($bpa) {
            return redirect()->back()->with('danger', 'Anda sudah memilih bpa!');
        }
        $data = LeaderCandidate::with(['user'])->where('status', '=', 2)->get();
        return view('user.e-vote.bpa', compact('title', 'data'));
    }

    public function bpaDetail(Request $request, $id)
    {
        $data = LeaderCandidate::with(['user'])->where('status', '=', 2)->find($id);
        return response()->json(['success' => TRUE, 'data' => $data]);
    }
}
