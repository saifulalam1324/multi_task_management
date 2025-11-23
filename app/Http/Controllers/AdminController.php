<?php

namespace App\Http\Controllers;

use App\Mail\AttachmentEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function ADMINLOGINPAGE()
    {
        return view('ADMIN.ADMINLOGIN');
    }
    public function ADMINSIGNUPPAGE()
    {
        return view('ADMIN.ADMINSIGNUP');
    }
    public function ADMINHOME()
    {
        return view('ADMIN.ADMINHOME');
    }
    public function ALLSERVICEPROVIDER()
    {
        return view('ADMIN.ALLSERVICEPROVIDER');
    }
    public function ADMINPROFILE()
    {
        return view('ADMIN.PROFILE');
    }
    public function APPROVESERVICE()
    {
        return view('ADMIN.APPROVEDSERVICES');
    }
    public function ADMINSIGNUPS(Request $request)
    {
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        $signup = DB::table('admins')->insert([
            'name' => $request->admin_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($signup) {
            return redirect()->route('adminloginpage')->with('success', 'Registered successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
    public function ADMINLOGINS(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('adminhome')->with('success', 'Welcome back, Admin!');
        }

        return back()->with('error', 'Invalid email or password. Please try again.');
    }
    public function ADMINLOGOUT(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('adminloginpage');
    }
    public function ADDSERVICEPAGE()
    {
        return view('ADMIN.ADDSERVICE');
    }
    public function ADDSERVICE(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'per_hour_rate' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);

        $insert = DB::table('services')->insert([
            'service_name' => $request->service_name,
            'per_hour_rate' => $request->per_hour_rate,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($insert) {
            return redirect()->back()->with('success', 'Service added successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to add service.');
        }
    }
    public function SERVICEREQUESTS()
    {
        $requests = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select('servicerequests.*', 'customers.*', 'services.*')
            ->where('status', 'pending')->get();
        return view('ADMIN.SERVICEREQUESTS', compact('requests'));
    }
    // public function APPROVESERVICEREQUEST(Request $request, $request_id)
    // {
    //     $update = DB::table('servicerequests')
    //         ->where('request_id', $request_id)
    //         ->update(['status' => 'approved', 'sp_id' => $request->input('sp_id'), 'updated_at' => now()]);

    //     if ($update) {
    //         return redirect()->back()->with('success', 'Service request approved successfully!');
    //     } else {
    //         return redirect()->back()->with('error', 'Failed to approve service request.');
    //     }
    // }
    public function APPROVESERVICEREQUEST(Request $request, $request_id)
    {
        // Get the service request data
        $req = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select(
                'customers.name as customer_name',
                'customers.email as customer_email',
                'services.service_name as service_name'
            )
            ->where('servicerequests.request_id', $request_id)
            ->first();

        if (!$req) {
            return redirect()->back()->with('error', 'Request not found!');
        }

        // Get service provider name
        $sp = DB::table('serviceproviders')
            ->where('sp_id', $request->input('sp_id'))
            ->first();

        if (!$sp) {
            return redirect()->back()->with('error', 'Invalid Service Provider ID!');
        }

        // Update status + assigned SP
        $update = DB::table('servicerequests')
            ->where('request_id', $request_id)
            ->update([
                'status' => 'approved',
                'sp_id' => $request->input('sp_id'),
                'updated_at' => now()
            ]);

        if ($update) {
            // Send email to customer
            Mail::to($req->customer_email)->send(
                new AttachmentEmail(
                    $req->customer_name,
                    $req->service_name,
                    $sp->name
                )
            );

            return redirect()->back()->with('success', 'Service request approved & email sent!');
        }

        return redirect()->back()->with('error', 'Failed to approve service request.');
    }
    public function REJECTSERVICEREQUEST($request_id)
    {
        $delete = DB::table('servicerequests')
            ->where('request_id', $request_id)
            ->delete();
        return redirect()->back()->with('success', 'Service request rejected successfully!');
    }
    public function SERVICEPROVIDERREQUESTS()
    {
        $serviceproviderrequests = DB::table('serviceproviders')->where('approve_status', 0)->get();
        return view('ADMIN.SERVICEPROVIDERREQUESTS', compact('serviceproviderrequests'));
    }
    public function APPROVESERVICEPROVIDERREQUEST(Request $request, $sp_id)
    {
        $update = DB::table('serviceproviders')
            ->where('sp_id', $sp_id)
            ->update(['approve_status' => 1]);

        if ($update) {
            return redirect()->back()->with('success', 'Service provider request approved successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to approve service provider request.');
        }
    }
    public function REJECTSERVICEPROVIDERREQUEST($sp_id)
    {
        $delete = DB::table('serviceproviders')
            ->where('sp_id', $sp_id)
            ->delete();
        return redirect()->back()->with('success', 'Service provider request rejected successfully!');
    }
    public function APPROVEDSERVICES()
    {
        $approvedServices = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->join('serviceproviders', 'servicerequests.sp_id', '=', 'serviceproviders.sp_id')
            ->select('servicerequests.*', 'customers.*', 'services.*', 'serviceproviders.*')
            ->where('servicerequests.status', 'approved')
            ->get();

        return view('ADMIN.APPROVEDSERVICES', compact('approvedServices'));
    }
    public function DONESERVICES()
    {
        $workdone = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select('servicerequests.*', 'customers.*', 'services.*')
            ->where('status', 'done')->get();
        return view('ADMIN.WORKDONE', compact('workdone'));
    }
    public function COMPLETESERVICES($id)
    {
        $service = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select('servicerequests.*', 'customers.*', 'services.*')
            ->where('request_id', $id)->first();
        if (!$service->work_started_at) {
            $workStartedAt = Carbon::now();
        } else {
            $workStartedAt = Carbon::parse($service->work_started_at);
        }
        $workCompletedAt = Carbon::now();
        $totalHours = $workStartedAt->diffInMinutes($workCompletedAt) / 60;
        $totalHours = number_format($totalHours, 2);
        $topayment = $totalHours * $service->per_hour_rate;
        $sp_payment = $topayment * 0.7;
        $update = DB::table('servicerequests')
            ->where('request_id', $id)
            ->update([
                'status' => 'completed',
                'work_started_at' => $workStartedAt,
                'work_completed_at' => $workCompletedAt,
                'total_hours_worked' => $totalHours,
                'updated_at' => now(),
                'total_payment' => $topayment,
                'payment_status' => 'pending',
                'payment_sp' => $sp_payment,
            ]);
        if ($update) {
            return redirect()->route('doneservices')
                ->with('success', 'Task marked as completed.');
        } else {
            return redirect()->route('doneservices')
                ->with('error', 'Failed to update task status.');
        }
    }
    public function COMPLETEDSERVICES()
    {
        $completedservices = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select('servicerequests.*', 'customers.*', 'services.*')
            ->where('status', 'completed')
            ->where('payment_status', 'paid')->get();
        $total_payment = DB::table('servicerequests')
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->sum('total_payment');
        return view('ADMIN.COMPLETEDWORK', compact('completedservices', 'total_payment'));
    }
    public function PAYMENTS()
    {
        $payments = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->select('servicerequests.*', 'customers.*', 'services.*')
            ->where('payment_status', 'pending')
            ->where('status', 'completed')
            ->get();
        return view('ADMIN.PAYMENTS', compact('payments'));
    }

    public function MARKASPAID($id)
    {
        $update = DB::table('servicerequests')
            ->where('request_id', $id)
            ->update([
                'payment_status' => 'paid',
            ]);
        if ($update) {
            return redirect()->route('payments')
                ->with('success', 'Payment marked as paid.');
        } else {
            return redirect()->route('payments')
                ->with('error', 'Failed to update payment status.');
        }
    }
    public function ALLUSERS()
    {
        $users = DB::table('customers')->get();
        return view('ADMIN.ALLUSERS', compact('users'));
    }
    public function ALLSERVICEPROVIDERS()
    {
        $serviceproviders = DB::table('serviceproviders')->where('approve_status', 1)->get();
        return view('ADMIN.ALLSERVICEPROVIDER', compact('serviceproviders'));
    }
    public function EACHUSER($id)
    {
        $user = DB::table('customers')
            ->join('servicerequests', 'customers.c_id', '=', 'servicerequests.c_id')
            ->select('customers.*', 'servicerequests.*')
            ->where('customers.c_id', $id)->first();
        $total_payment = DB::table('servicerequests')
            ->where('c_id', $id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->sum('total_payment');
        $total_services = DB::table('servicerequests')
            ->where('c_id', $id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->count();
        $distinct_services = DB::table('servicerequests')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->where('servicerequests.c_id', $id)
            ->where('servicerequests.status', 'completed')
            ->where('servicerequests.payment_status', 'paid')
            ->distinct('services.service_name')
            ->pluck('services.service_name');

        return view('ADMIN.EACHUSER', compact('user', 'total_payment', 'total_services', 'distinct_services'));
    }
    public function EACHSERVICEPROVIDER($id)
    {
        $serviceprovider = DB::table('serviceproviders')
            ->join('servicerequests', 'serviceproviders.sp_id', '=', 'servicerequests.sp_id')
            ->select('serviceproviders.*', 'servicerequests.*')
            ->where('serviceproviders.sp_id', $id)->first();
        $total_payment = DB::table('servicerequests')
            ->where('sp_id', $id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->sum('payment_sp');
        $total_services = DB::table('servicerequests')
            ->where('sp_id', $id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->count();
        return view('ADMIN.EACHSP', compact('serviceprovider', 'total_payment', 'total_services'));
    }
    public function ACTIVESP()
    {
        $activesp = DB::table('serviceproviders')
            ->where('status', 'active')
            ->groupBy('service_type', 'sp_id', 'name', 'email', 'phone', 'password', 'approve_status', 'created_at', 'updated_at', 'address', 'image_url', 'status')
            ->get();
        return view('ADMIN.ACTIVESP', compact('activesp'));
    }
    public function MONTHLYSALES()
    {
        $currentYear = Carbon::now()->year;
        $monthlySales = DB::table('servicerequests')
            ->select(
                DB::raw('MONTH(work_completed_at) as month'),
                DB::raw('SUM(total_payment) as total_sales')
            )
            ->whereYear('work_completed_at', $currentYear)
            ->where('payment_status', 'paid')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
        $salesData = array_fill(0, 12, 0);

        foreach ($monthlySales as $sale) {
            $salesData[$sale->month - 1] = $sale->total_sales;
        }

        return view('ADMIN.ADMINHOME', ['monthlySales' => $salesData]);
    }
    public function REMOVESERVICEPROVIDER($sp_id)
    {
        $delete = DB::table('serviceproviders')
            ->where('sp_id', $sp_id)
            ->delete();
        return redirect()->back()->with('success', 'Service provider removed successfully!');
    }
}
