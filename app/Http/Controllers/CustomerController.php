<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\Serviceprovider;
use App\Models\Servicerequest;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function HOME()
    {
        return view('CUSTOMER.HOME');
    }
    public function LOGINSIGNUP()
    {
        return view('CUSTOMER.LOGINSIGNUP');
    }
    public function USERSIGNUP(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:customers,email',
            'password' => 'required|min:6',
            'phone'    => 'required',
            'address'  => 'required',
        ]);

        $signup = DB::table('customers')->insert([
            'name' => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone'  => $request->phone,
            'address'       => $request->address,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        if ($signup) {
            return redirect()->route('loginsignup')->with('success', 'Registered successfully! Please login.');
        } else {
            return redirect()->back()->with('error', 'Failed to register. Please try again.');
        }
    }
    public function USERLOGIN(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('Userhome')->with('success', 'Welcome back, Vendor!');
        }
        return back()->with('error', 'Your account is not approved yet or credentials are invalid.');
    }
    public function USERLOGOUT(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('Userhome')->with('success', 'Logged out successfully.');
    }
    public function USERPROFILE()
    {
        return view('CUSTOMER.PROFILE');
    }
    public function SERVICES()
    {
        $services = DB::table('services')->get();
        return view('CUSTOMER.SERVICES', compact('services'));
    }
    public function REQUESTSERVICE($service_id)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not logged in.');
        }
        DB::table('servicerequests')->insert([
            'c_id' => $customer->c_id,
            'service_id' => $service_id,
            'sp_id' => null,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Service request submitted successfully!');
    }
    public function UPDATEPASSWORDC()
    {
        return view('CUSTOMER.UPDATEPASSWORD');
    }
    public function CHANGEPASS(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::guard('customer')->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        DB::table('customers')
            ->where('c_id', $user->c_id)
            ->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'Password changed successfully!');
    }
    function UPDATEINFOPAGE()
    {
        return view('CUSTOMER.UPDATEINFO');
    }
    public function UPDATEPROFILE(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);
        $customer = Auth::guard('customer')->user();

        if (! $customer) {
            return redirect()->back()->with('error', 'Customer not logged in.');
        }
        DB::table('customers')
            ->where('c_id', $customer->c_id)
            ->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'updated_at' => now(),
            ]);

        return back()->with('success', 'Profile updated successfully!');
    }
    public function PENDINGSERVICESPAGE()
    {
        return view('CUSTOMER.PENDINGSERVICES');
    }
    public function PENDINGSERVICES()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not logged in.');
        }

        $pss = DB::table('servicerequests')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->leftJoin('serviceproviders', 'servicerequests.sp_id', '=', 'serviceproviders.sp_id') // FIX HERE
            ->select(
                'servicerequests.*',
                'services.service_name',
                'serviceproviders.name as provider_name',
                'serviceproviders.phone as provider_phone'
            )
            ->where('servicerequests.c_id', $customer->c_id)
            ->whereIn('servicerequests.status', ['pending', 'approved'])
            ->get();

        return view('CUSTOMER.PENDINGSERVICES', compact('pss'));
    }

    public function TAKENSERVICES()
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not logged in.');
        }

        $ps = DB::table('servicerequests')
            ->join('services', 'servicerequests.service_id', '=', 'services.service_id')
            ->join('serviceproviders', 'servicerequests.sp_id', '=', 'serviceproviders.sp_id')
            ->select(
                'servicerequests.*',
                'services.*',
                'serviceproviders.name as provider_name',
                'serviceproviders.phone'
            )
            ->where('servicerequests.c_id', $customer->c_id)
            ->where('servicerequests.status', 'completed')
            ->where('servicerequests.payment_status', 'paid')
            ->get();
        $total_payment = DB::table('servicerequests')
            ->where('c_id', $customer->c_id)
            ->where('status', 'completed')
            ->where('payment_status', 'paid')
            ->sum('total_payment');

        return view('CUSTOMER.TAKENSERVICES', compact('ps', 'total_payment'));
    }
    public function CANCLELPENDINGSERVICE($id)
    {
        $customer = Auth::guard('customer')->user();

        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not logged in.');
        }
        DB::table('servicerequests')
            ->where('request_id', $id)
            ->update(['status' => 'cancelled', 'updated_at' => now()]);

        return redirect()->back()->with('success', 'Service request cancelled successfully.');
    }
}
