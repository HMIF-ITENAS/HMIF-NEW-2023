<?php

namespace App\Exports;

use App\Meeting;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MeetingExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    protected $meetingId;

    public function __construct(int $meetingId)
    {
        $this->meetingId = $meetingId;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return DB::table('meeting_user')->selectRaw(' users.nrp, users.name as user_name, meetings.name, meetings.begin_date, meeting_user.status')->join('meetings', 'meetings.id', '=', 'meeting_user.meeting_id', 'left')->join('users', 'users.id', '=', 'meeting_user.user_id')->whereRaw('meetings.id = ?', $this->meetingId)->get();
    }

    public function headings(): array
    {
        return [
            "NRP",
            "Nama",
            "Nama Rapat",
            "Tanggal Rapat",
            "Status",
        ];
    }
}
