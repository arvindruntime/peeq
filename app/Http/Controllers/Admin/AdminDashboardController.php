<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Event;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\PlanTransaction;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function websiteAnalytics(Request $request)
    {
        $userCount = User::where('status', 'active')->count();
        $coachesCount = User::where('user_type', 'Coach')->count();
        $postCount = Post::where('status', 0)
                        ->where('post_type', 'post')
                        ->count();
        $articleCount = Post::where('status', 0)
                        ->where('post_type', 'article')
                        ->count();
        $courseTransactions = PlanTransaction::where('type', 'course')
                        ->where('course_price_type', 'paid')
                        ->with('user')
                        ->with('course')
                        ->orderBy('id', 'desc')
                        ->get();

        $sessionTransactions = PlanTransaction::where('type', 'session')
                        ->where('session_price_type', 'paid')
                        ->with('user')
                        ->with('session')
                        ->orderBy('id', 'desc')
                        ->get();

        $planTransactions = PlanTransaction::where('type', 'plan')
                        ->with('user')
                        ->with('plan')
                        ->orderBy('id', 'asc')
                        ->get();

        $totalCourseAmountPaymentSuccess = PlanTransaction::where('type', 'course')
                                                            ->where('course_price_type', 'paid')
                                                            ->where('payment_status', 1)
                                                            ->whereHas('user', function ($query) {
                                                                $query->whereNotNull('id');
                                                            })
                                                            ->sum('final_amount');
        $membershipAmountPaymentSuccess = PlanTransaction::where('type', 'plan')
                                                            ->where('course_price_type', 'paid')
                                                            ->where('payment_status', 1)
                                                            ->whereHas('user', function ($query) {
                                                                $query->whereNotNull('id');
                                                            })
                                                            ->sum('final_amount');
        $totalBuyCourseAmount = $totalCourseAmountPaymentSuccess;
        $totalMembershipAmount = $membershipAmountPaymentSuccess;
        $totalAmount = $totalBuyCourseAmount + $totalMembershipAmount;
        $courseBuyPercentage = ($totalAmount != 0) ? ($totalBuyCourseAmount * 100 / $totalAmount) : 0;
        $membershipBuyPercentage = ($totalAmount != 0) ? ($totalMembershipAmount * 100 / $totalAmount) : 0;
           
        // Get the top 3 countries with the highest signups based on the maximum signups in each country for a specific date range
        $browserUsage_temp = User::selectRaw('DATE_FORMAT(users.created_at, "%m-%d") as signup_date, countries.country_name, COUNT(*) as total_signups')
            ->join('countries', 'users.location_id', '=', 'countries.id')
            ->where('status', 'active')
            ->whereRaw('NOT EXISTS (
                SELECT 1
                FROM users AS u
                WHERE u.location_id = users.location_id
                AND u.status = "active"
                HAVING COUNT(*) > COUNT(users.id)
            )')
            ->groupBy('signup_date', 'countries.country_name')
            ->orderBy('total_signups', 'desc')
            ->take(3)
            ->get();

        // Get the top three country names with counts
        $topCountryNames = $browserUsage_temp->map(function ($item) {
            return [
                'country_name' => $item->country_name,
                'total_signups' => $item->total_signups,
            ];
        })->toArray();

        $browserUsage = $this->getSignupData();
        $revenueData = $this->getRevenueData();

        return view('admin.adminDashboard.dashboard', compact('userCount', 'coachesCount', 'postCount', 'articleCount', 'courseTransactions', 'sessionTransactions', 'planTransactions', 'totalBuyCourseAmount', 'totalMembershipAmount', 'totalAmount', 'courseBuyPercentage', 'membershipBuyPercentage', 'browserUsage', 'topCountryNames', 'revenueData'));
    }
    
    function getSignupData()
    {
        $startDate = Carbon::now()->startOfMonth()->toDateString();
        $endDate = now()->endOfMonth()->toDateString();
        
        $signupData = User::selectRaw('DATE_FORMAT(users.created_at, "%Y-%m-%d") as signup_date, COUNT(*) as total_signups')
        ->where('status', 'active')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->groupBy('signup_date')
        ->orderBy('signup_date')
        ->get();
        
        // Initialize arrays for labels and data counts
        $labels = [];
        $dataCounts = [];
        
        $lastDateOfMonth = date('t');
    
        // Generate labels for each day of the month (1 to 31)
        for ($day = 1; $day <= $lastDateOfMonth; $day++) {
            $labels[] = str_pad($day, 2, '0', STR_PAD_LEFT); // Format as two-digit day (e.g., "01")
        }
    
        // Initialize data counts for each day to 0
        $dataCounts = array_fill(0, $lastDateOfMonth, 0);
    
        // Populate data counts based on the fetched signup data
        foreach ($signupData as $item) {
        
            $day = intval($item->signup_date); // Convert to integer
            if ($day >= 1 && $day <= $lastDateOfMonth) {
                // Check if the day is within a valid range
                $dataCounts[$day - 1] = $item->total_signups;
            }
        }
    
        return [
            'signup_date' => $labels,
            'total_signups' => $dataCounts,
        ];
    }
    

    function getRevenueData()
    {
        // Get the current month and calculate the start and end dates for the last six months
        $currentMonth = Carbon::now();
        $startDate = $currentMonth->copy()->subMonths(5)->startOfMonth();
        $endDate = $currentMonth->endOfMonth();

        // Fetch revenue data for the last six months (from the current month to five months ago)
        $revenueData = PlanTransaction::where('type', 'course')
            ->where('course_price_type', 'paid')
            ->where('payment_status', 1)
            ->whereHas('user', function ($query) {
                $query->whereNotNull('id');
            })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        // Calculate the total revenue for the entire last six months
        $totalRevenue = $revenueData->sum('final_amount');
        
        // Initialize an array to store the dynamically generated month labels
        $labels = [];
        $currentDate = Carbon::now();

        for ($i = 0; $i <= 5; $i++) {
            $labels[] = $currentDate->format('M');
            $currentDate->subMonthNoOverflow();
        }
        
        $labels = array_reverse($labels);
       
        // Group the revenue data by month and calculate the total revenue for each month
        $revenueByMonth = $revenueData->groupBy(function ($transaction) {
            return $transaction->created_at->format('M'); // Format as short month name (e.g., "Aug")
        })->map(function ($transactions) {
            return $transactions->sum('final_amount');
        });

        // Extract data for the last six months
        $revenueValues = [];

        // Populate revenue values for each month
        foreach ($labels as $label) {
            if (isset($revenueByMonth[$label])) {
                $revenueValues[] = $revenueByMonth[$label];
            } else {
                $revenueValues[] = 0; // If no data exists for the month, set revenue to 0
            }
        }

        return [
            'labels' => $labels,
            'revenueValues' => $revenueValues,
            'totalRevenue' => $totalRevenue,
        ];
    }

}
