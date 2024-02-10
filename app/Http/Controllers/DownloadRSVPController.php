<?php
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\EventActivity;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Response;

class DownloadRSVPController extends Controller
{
    public function index($id)
    {
        $event = eventResponse($id);
        $data = [];
        $event = EventActivity::where('event_id', $id)->orderBy('id', 'DESC')->with('event','user:id,first_name,last_name,user_type,location_id,email,mobile_no,company_name,job_title','user.purchasePlan.plan')->get();
        // Add headers to the data array
        $data[] = [
            'First Name', 'Last Name', 'User Type', 'Country', 'Email',
            'Contact Number', 'Company Name', 'Job Title', 'Plan', 'Purchases',
            'Event Name', 'Status', 'Start Date Time', 'End Date Time'
        ];
        if(isset($event)) {
            foreach ($event as $attended) {
                $data[] = [
                    $attended->user->first_name ?? '',
                    $attended->user->last_name ?? '',
                    $attended->user->user_type ?? '',
                    getCountryNameById($attended->user->location_id) ?? '',
                    $attended->user->email ?? '',
                    $attended->user->mobile_no ?? '',
                    $attended->user->company_name ?? '',
                    $attended->user->job_title ?? '',
                    $attended->user->purchasePlan->plan->plan_title ?? '',
                    $attended->user->purchasePlan->plan->plan_amount ?? '',
                    $attended->event->event_title ?? '',
                    $attended->is_attending ?? '',
                    convertUtcToUserTimezone($attended->event->start_date, getUserTimeZone()),
                    convertUtcToUserTimezone($attended->event->end_date, getUserTimeZone()),
                ];
            }
        }

        $fileName = 'rsvp_report_' . date('d-m-Y') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];
        $callback = function () use ($data) {
            $handle = fopen('php://output', 'w');
            foreach ($data as $row) {
                fputcsv($handle, $row);
            }
            fclose($handle);
        };
        return Response::stream($callback, 200, $headers);
    }
}
