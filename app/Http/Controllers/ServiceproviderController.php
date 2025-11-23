<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServiceproviderController extends Controller
{
    public function SERVICEPROVIDERLOGINPAGE()
    {
        return view('SERVICEPROVIDER.SERVICEPROVIDERLOGIN');
    }
    public function SERVICEPROVIDERSIGNUPPAGE()
    {
        return view('SERVICEPROVIDER.SERVICEPROVIDERSIGNUP');
    }
    public function SERVICEPROVIDERHOME()
    {
        return view('SERVICEPROVIDER.HOME');
    }
    public function SERVICEPROVIDERPROFILE()
    {
        return view('SERVICEPROVIDER.PROFILE');
    }
    public function SERVICEPROVIDERSIGNUP(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:serviceproviders,email',
            'phone' => 'required|string|max:20',
            'service' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $signup = DB::table('serviceproviders')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'service_type' => $request->service,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'image_url' => $request->file('image')->store('image', 'public'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($signup) {
            return redirect()->route('serviceproviderlogin')->with('success', 'Registered successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
    public function SERVICEPROVIDERLOGIN(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'approve_status'=>1,
        ]);
        $credentials['approve_status'] = 1;

        if (Auth::guard('serviceprovider')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('serviceproviderhome')->with('success', 'Welcome back, Vendor!');
        }
        return back()->with('error', 'Your account is not approved yet or credentials are invalid.');
    }
    public function SERVICEPROVIDERLOGOUT(Request $request)
    {
        Auth::guard('serviceprovider')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('serviceproviderlogin');
    }
    public function TASKS()
    {
        $tasks = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->select('servicerequests.*', 'customers.*')
            ->where('sp_id', Auth::guard('serviceprovider')->id())
            ->where(function ($query) {
                $query->where('status', 'approved')
                    ->orWhere('status', 'started');
            })
            ->get();
        return view('SERVICEPROVIDER.TASKS', compact('tasks'));
    }
    public function WORKDONE($id)
    {
        $update = DB::table('servicerequests')
            ->where('request_id', $id)
            ->update([
                'status' => 'done',
                'work_completed_at' => now(),
            ]);
        if ($update) {
            return redirect()->route('tasks')->with('success', 'Task marked as completed.');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to update task status.');
        }
    }
    public function WORKSTARTED($id)
    {
        $update = DB::table('servicerequests')
            ->where('request_id', $id)
            ->update([
                'status' => 'started',
                'work_started_at' => now(),
            ]);
        if ($update) {
            return redirect()->route('tasks')->with('success', 'Task marked as completed.');
        } else {
            return redirect()->route('tasks')->with('error', 'Failed to update task status.');
        }
    }
    public function COMPLETEDTASKS()
    {
        $tasks = DB::table('servicerequests')
            ->join('customers', 'servicerequests.c_id', '=', 'customers.c_id')
            ->select('servicerequests.*', 'customers.*')
            ->where('sp_id', Auth::guard('serviceprovider')->id())
            ->where('status', 'completed')
            ->get();
        $total_earnings = DB::table('servicerequests')
            ->where('sp_id', Auth::guard('serviceprovider')->id())
            ->where('status', 'completed')
            ->sum('payment_sp');
        return view('SERVICEPROVIDER.COMPLETEDTASKS', compact('tasks', 'total_earnings'));
    }
    function UPDATEPASSWORD()
    {
        return view('SERVICEPROVIDER.UPDATEPASSWORD');
    }
    public function CHANGEPASS(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('serviceprovider')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        DB::table('serviceproviders')
            ->where('sp_id', $user->sp_id)
            ->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password changed successfully!');
    }
    public function STATUSACTIVE()
    {
        $update = DB::table('serviceproviders')
            ->where('sp_id', Auth::guard('serviceprovider')->id())
            ->update(['status' => 'active']);
        if ($update) {
            return redirect()->route('serviceproviderprofile')->with('success', 'Status updated to active.');
        } else {
            return redirect()->route('serviceproviderprofile')->with('error', 'Failed to update status.');
        }
    }
    public function STATUSINACTIVE()
    {
        $update = DB::table('serviceproviders')
            ->where('sp_id', Auth::guard('serviceprovider')->id())
            ->update(['status' => 'inactive']);
        if ($update) {
            return redirect()->route('serviceproviderprofile')->with('success', 'Status updated to inactive.');
        } else {
            return redirect()->route('serviceproviderprofile')->with('error', 'Failed to update status.');
        }
    }
}
