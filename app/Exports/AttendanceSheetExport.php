<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use Illuminate\Support\Collection;

use App\Models\Member;
use App\Models\Schedule;

class AttendanceSheetExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $members = Member::all();
        $schedules = Schedule::whereBetween('date', [$this->startDate, $this->endDate])->orderBy('date')->get();

        $attendanceData = new Collection();
        $headers = new Collection(['Name']);

        foreach ($schedules as $schedule) {
            $headers->push(date('m-d-Y', strtotime($schedule->date)));
        }

        $headers->push('Attended');
        $headers->push('Absent');

        $attendanceData->push($headers);

        foreach ($members as $member) {
            $rowData = new Collection([$member->first_name . ' ' . $member->last_name]);

            $attendedCount = 0;
            $absentCount = 0;

            foreach ($schedules as $schedule) {
                $attendance = $member->attendances->where('schedule_id', $schedule->id)->first();

                if ($attendance) {
                    $rowData->push($attendance->is_makeup ? '✔ (makeup)' : '✔');
                    $attendedCount++;
                } else {
                    $rowData->push('❌');
                    $absentCount++;
                }
            }

            $rowData->push($attendedCount);
            $rowData->push($absentCount);

            $attendanceData->push($rowData);
        }

        return $attendanceData;
    }

    public function headings(): array
    {
        return [];
    }
}