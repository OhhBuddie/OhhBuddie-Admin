<?php

namespace App\Http\Controllers\Sellers;

use App\Models\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Brand;
class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seller.index');
    }
    
    public function registration()
    {
        // $sid= Auth::user()->id;
        
        // $seller_data = DB::table('sellers')->where('user_table_id',$sid)->latest()->first();
        $city = DB::table('cities')->latest()->get();
        
        // $state = DB::table('states')->latest()->get();
        $state = DB::table('states')->orderBy('name', 'asc')->get();

        
        
        // return view('seller.registration',compact('city','state','seller_data'));
        
        return view('seller.registration',compact('city','state'));
        
    }
    
    public function getCities(Request $request)
    {
        // $cities = DB::table('cities')->where('state_id', $request->state_id)->get();
        $cities = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();

        return response()->json($cities);
    }
    
    
    public function submitform(Request $request)
    {

        
        $mobileNo = $request->registered_phone_number;
        $prefixedNumber = '+91' . $mobileNo; // Append +91 for Indian numbers

        // Check if the mobile number exists in the `users` table
        $user = User::where('phone', $prefixedNumber)->first();
        
   
        // return $prefixedNumber;
        if (!$user) {
            

            // User ID
            $lastUser = DB::table('users')->whereNotNull('user_id')->orderBy('id', 'desc')->first();

            if ($lastUser && preg_match('/OBD-(\d+)/', $lastUser->user_id, $matches)) {
                $nextNumber = str_pad($matches[1] + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '1000'; // Start from OBD-0001
            }

            $newUserId = 'OBD-' . $nextNumber;
            
            $id = DB::table('users')->insertGetId([
                            'phone' => $prefixedNumber,
                            'name' => $request->owner_name,
                            'email' => $request->registered_email_id,
                            'password' => Hash::make($request->password), // Hash the password 
                            'user_type' => 'Seller',
                            'user_id' => $newUserId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                        
                        
            // Seller ID
            
            $lastUser1 = DB::table('sellers')->whereNotNull('seller_id')->orderBy('id', 'desc')->first();

            if ($lastUser1 && preg_match('/OBD-SLR-(\d+)/', $lastUser1->seller_id, $matches1)) {
                $nextNumber1 = str_pad($matches1[1] + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $nextNumber1 = '1000'; // Start from OBD-0001
            }

            $newSellerId = 'OBD-SLR-' . $nextNumber1;
            

            $sid = DB::table('sellers')->insertGetId([
                                        'registered_phone_number' => $prefixedNumber,
                                        'password' => Hash::make($request->password), // Hash the password 
                                        'user_table_id' => $id,
                                        'seller_id' => $newSellerId,
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]);
                                    
    
            $seller_id = Db::table('sellers')->where('user_table_id', $id)->latest()->first();
             DB::table('sellers')
                    ->where('user_table_id', $id)
                    ->update([
                        'company_name' => $request->company_name ?? $seller->company_name,
                        'owner_name' => $request->owner_name ?? $seller->owner_name,
                        'registered_phone_number' => $request->registered_phone_number,
                        'shipping_mode' => $request->shipping_mode,
                        'registered_email_id' => $request->registered_email_id,
                        'registered_address1' => $request->registered_address1,
                        'registered_address2' => $request->registered_address2,
                        'registered_pincode' => $request->registered_pincode,
                        'registered_city' => $request->registered_city,
                        'registered_state' => $request->registered_state,
                        'warehouse_phone_number' => $request->warehouse_phone_number,
                        'warehouse_email_id' => $request->warehouse_email_id,
                        'warehouse_address1' => $request->warehouse_address1,
                        'warehouse_address2' => $request->warehouse_address2,
                        'warehouse_pincode' => $request->warehouse_pincode,
                        'warehouse_city' => $request->warehouse_city,
                        'warehouse_state' => $request->warehouse_state,
                        'bank_account_holder' => $request->bank_account_holder,
                        'bank_account_number' => $request->bank_account_number,
                        'bank_account_ifsc' => $request->bank_account_ifsc,
                        'bank_account_type' => $request->bank_account_type,
                        'bank_name' => $request->bank_name,
                        'gst_number' => $request->gst_number,
                        'brand_name' => $request->brand_name,
                    ]);
                
            $fileFields = ['gst_certificate', 'govt_id_proof', 'cancelled_cheque', 'trademark_certificate', 'brand_logo'];
        
            foreach ($fileFields as $fileField) {
                if ($request->hasFile($fileField)) {
                    $file = $request->file($fileField);
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('uploads/sellers/' . $seller_id->seller_id, $filename, 'public');
                    $data[$fileField] = 'storage/' . $filePath;
                }
            }
        
            DB::table('sellers')->where('user_table_id', $id)->update($data);
            
            
            //////////////////////////////////////////////////////////////
            
            

            $lastProduct = DB::table('brands')
                ->where('seller_id', $seller_id->seller_id)
                ->where('brand_id', 'LIKE', 'OBD-BR-' . $seller_id->seller_id . '-%')
                ->orderBy('id', 'desc')
                ->first();
            
            // Extract last number and increment
            if ($lastProduct) {
                preg_match('/OBD-BR-' . $seller_id->seller_id . '-(\d+)/', $lastProduct->product_id, $matches);
                $nextNumber = isset($matches[1]) ? ((int) $matches[1] + 1) : 1001;
            } else {
                $nextNumber = 1001;
            }
            
            // Generate unique product ID
            $brand_id = 'OBD-BR-' . $seller_id->seller_id . '-' . $nextNumber;
            
            
            
            
            
            $brand_count = DB::table('brands')->where('user_table_id',$id)->count();
            
            $brands_total = $brand_count + 1;
            
            DB::table('sellers')->where('user_table_id',$id)->update(['total_brands'=>$brands_total]);
            
            

            /////////////////////////////////////////////////////////////
            
            
            try{
            
                // Handle file uploads
                if ($request->hasFile('brand_logo')) {
                    $logoPath = $request->file('brand_logo')->store('brand_logos', 'public');
                }
                
                if ($request->hasFile('trademark_certificate')) {
                    $documentPath = $request->file('trademark_certificate')->store('brand_documents', 'public');
                }   
                
                DB::table('brands')
                    ->insert([
                        'user_table_id' => $id,
                        'seller_id' => $newSellerId,
                        'seller_table_id' =>  $seller_id->id,
                        'brand_id' => $brand_id,
                        'brand_name' =>$request->brand_name,
                        'nature_of_brand' => $request->nature_of_brand,
                        'brand_logo' => $logoPath,
                        'document_type' => $request->document_type,
                        'document' => $documentPath,
                        'no_of_products' => $request->no_of_products,
                    ]);
            }
            catch (\Exception $e) {
                // Log the error
                Log::error('ERROR');
                return back();
            }
                
                
    
                
        return back();

        }
    }
    public function login()
    {
        return view('seller.login');
    }

    public function enterOtp()
    {
        return view('seller.enter-otp');
    }

    public function enterEmail()
    {
        return view('seller.enter-email');
    }

    public function enterEmailOtp()
    {
        return view('seller.enter-email-otp');
    }

    public function submitPhone(Request $request)
    {
        return redirect()->route('seller.enter-otp');
    }

    public function submitOtp(Request $request)
    {
        return redirect()->route('seller.enter-email');
    }

    public function submitEmail(Request $request)
    {
        return redirect()->route('seller.enter-email-otp');
    }

    public function submitEmailOtp(Request $request)
    {
        return redirect()->route('seller.registration');
    }
    
    public function dashboard()
    {

        return view('seller.dashboard');
    }
    
    
    
    public function profile()
    {
         $seller_data = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
        $city = DB::table('cities')->latest()->get();
        $state = DB::table('states')->latest()->get();
       
        return view('seller.profile',compact('city','state','seller_data'));
    }
    
    public function profileedit()
    {   
        $seller_data = DB::table('sellers')->where('user_table_id', Auth::user()->id)->latest()->first();
        $city = DB::table('cities')->latest()->get();
        $state = DB::table('states')->latest()->get();
       
        return view('seller.profile_edit', compact('city','state','seller_data'));
    }

    public function editform(Request $request, $id)
    {
        // Get the latest seller record for the user
        $seller = DB::table('sellers')->where('user_table_id', $id)->latest()->first();
    
        // Update the main seller details
        DB::table('sellers')
            ->where('user_table_id', $id)
            ->update([
                'company_name' => $request->company_name,
                'owner_name' => $request->owner_name,
                'registered_phone_number' => $request->registered_phone_number,
                'registered_address1' => $request->registered_address1,
                'registered_address2' => $request->registered_address2,
                'registered_pincode' => $request->registered_pincode,
                'registered_city' => $request->registered_city,
                'registered_state' => $request->registered_state,
                'warehouse_phone_number' => $request->warehouse_phone_number,
                'warehouse_email_id' => $request->warehouse_email_id,
                'warehouse_address1' => $request->warehouse_address1,
                'warehouse_address2' => $request->warehouse_address2,
                'warehouse_pincode' => $request->warehouse_pincode,
                'warehouse_city' => $request->warehouse_city,
                'warehouse_state' => $request->warehouse_state,
                'bank_account_holder' => $request->bank_account_holder,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_ifsc' => $request->bank_account_ifsc,
                'bank_account_type' => $request->bank_account_type,
                'bank_name' => $request->bank_name,
                'gst_number' => $request->gst_number,
                'brand_name' => $request->brand_name,
            ]);
    
        // Initialize $data array to store file paths
        $data = [];
    
        // List of file fields
        $fileFields = ['gst_certificate', 'govt_id_proof', 'cancelled_cheque', 'trademark_certificate', 'brand_logo'];
    
        // Process file uploads
        foreach ($fileFields as $fileField) {
            if ($request->hasFile($fileField)) {
                $file = $request->file($fileField);
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads/sellers/' . $seller->seller_id, $filename, 'public');
                $data[$fileField] = 'storage/' . $filePath;
            }
        }
    
        // Update file paths if there are any
        if (!empty($data)) {
            DB::table('sellers')->where('user_table_id', $id)->update($data);
        }
    
        return back();
    }

    
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Seller $seller)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Seller $seller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seller $seller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Seller  $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seller $seller)
    {
        //
    }
}
