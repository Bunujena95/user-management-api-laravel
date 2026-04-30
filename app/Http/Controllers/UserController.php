<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; //For Login
use Illuminate\Support\Facades\Hash;//For Register Password

class UserController extends Controller
{
    
    public function MtdHome(){
        
        return view('welcome');
    }



    //Register Btn
    public function MtdRegisterBtn(Request $request){
  
    //      $validator = Validator::make($request->all(), [
    //     'name' => 'required|string|max:255',
    //     'phone' => 'required|phone|unique:users,phone',
    //     'password' => 'required',
    //      ],
    //      [
    //     'name.required' => 'Please enter your name Bunu',
    //     'name.string' => 'Name must be text Bunu',
    //     'name.max' => 'Name cannot exceed 255 characters Bunu',
    //     'phone.required' => 'Please enter your phone Bunu',
    //     'phone.phone' => 'Enter a valid phone address Bunu',
    //     'phone.unique' => '❌ This phone is already Exist Bunu',
    //     'password.required' => 'Please enter your Password Bunu',
    //    ]);

    $validator = Validator::make($request->all(), [
    'name' => 'required|string|max:255',
    'phone' => 'required|digits:10|unique:users,phone',
    'password' => 'required|min:6',
], [
    'name.required' => 'Please enter your name Bunu',
    'name.string' => 'Name must be text Bunu',
    'name.max' => 'Name cannot exceed 255 characters Bunu',

    'phone.required' => 'Please enter your phone Bunu',
    'phone.digits' => 'Phone must be 10 digits Bunu',
    'phone.unique' => '❌ This phone is already Exist Bunu',

    'password.required' => 'Please enter your Password Bunu',
    'password.min' => 'Password must be at least 6 characters Bunu',
]);


       $name = $request->name;
          $phone = $request->phone;
       // $password = $request->password;
         $password = Hash::make($request->password);

        if ($validator->fails()) {
             return response()->json([
             'success' => false,
            'message' => $validator->errors()->first()
           ], 422); 
        }
       

        $user = User::create([
                'name' =>  $name,
                'phone' =>  $phone,   
                'password' => $password           
         ]);
   
         return response()->json([
               'success' => true,
               'message' => 'User registered successfully',
               'data' => $user
           ], 200);

    }


   //=============Login User=================================
    public function MtdLoginBtn(Request $request){
          
           $credentials = $request->only('phone', 'password');
           
          //$user = User::where('email', $credentials['email'])->where('user_role', 'User')->first();
          $user = User::where('phone', $credentials['phone'])->first();

           if(!$user){
                  return response()->json([
                  'success' => false,
                  'message' => 'Invalid Email Bunu '
             ], 404);
           }
          
          
        if (Auth::attempt(['phone' => $credentials['phone'],'password' => $credentials['password']])) {
      
             $user = Auth::user(); 
             
             $user->tokens()->delete(); // sab purane token delete Bunu
             $token = $user->createToken('AndroidToken')->plainTextToken;   //?New Token add in Table Name-  personal_access_tokens

             return response()->json([
                 'success' => true,
                 'message' => 'User LogedIn successfully ✅ ✅',
                 'token' => $token,
                 'data' => [
                    'id' => $user->id,
                    'name' => $user->name, 
                    'phone' => $user->phone
                ]
           ], 200);
        }

        //else Auth
          return response()->json([
                  'success' => false,
                  'message' => 'Invalid Credential'
                   ], 401);
            

    }




    //===Logout User===
    public function MtdLogoutUser(Request $request){
  
       $request->user()->currentAccessToken()->delete();
   
       return response()->json([
        'success' => true,
        'message' => 'Logged out'
      ]);
    }  

 
   
  //================Data Fetch Bunu===============
    public function MtdUserFetchBtn(Request $request){

       // $users = User::all();
        $users = User::orderBy('id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Users fetched successfully',
            'data' => $users
        ], 200);
    }

  
   


    // ===============Delete Data=======================
    public function MtdUserDeleteBtn($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ], 200);
    }



     //==========Single User Fetch  For Edit and Update==============Viewmodel se mila bunu
    // public function MtdFetchSingle(Request $request,$id)
    // {
    //     $user = User::find($id);
    //     if ($user) {
    //           return response()->json($user, 200);
    //     }
    //     else {
    //          return response()->json(['error' => 'User not found'], 404);
    //     }
    // }

    

    

    // ====================Update user Btn================
    public function MtdUpdateBtn(Request $request,$id)
    {
          $name = $request->name;
          $phone = $request->phone;

        $validator = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            //'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|digits:10|unique:users,phone,' . $id,
        ]);

       if ($validator->fails()) {
             return response()->json([
             'success' => false,
            'message' => $validator->errors()->first()
           ], 422); 
        }


        $user = User::find($id);

       if (!$user) {
            return response()->json([
                 'success' => false,
                 'message' => 'User not found'
            ],404);
        }

       $user->update([
                'name' =>  $name,
                'phone' =>  $phone,  
        ]);

        
        return response()->json([
             'success' => true,
             'message' => 'User updated successfully ✅ ✅ '
             // 'data' => $user
        ], 200);

    }

     

   
   

  //================================Product==============================================================


//Product Add For Logedin User
public function MtdProductBtn(Request $request){
   
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required',
        //'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'success' => false,
            'message' => $validator->errors()->first()
        ], 422);
    }


     $user = $request->user();   //token se login userdata get Bunu
     $userId= $user->id; 

    //  $file = $request->file('image');
    //  $filename = time().'_'.$file->getClientOriginalName();
    //  $path = $request ->file('image') -> storeAs('BnProductImage',$filename,'public'); 
           
    Product::create([
        'title' => $request->title,
        'description' => $request->description,
        'userId' => $userId,
        // 'image' => $path,
        // 'birth_date' => $request->birth_date,
        // 'gender' => $request->gender,
        // 'skils' => $request->skils,
        // 'country' => $request->country,
        // 'dropcountry' => $request->drop_country,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Product Added Successfully'
    ], 200);
    
}




       
    
//===Product Fetch  Logedin User===
public function MtdProductFetch(Request $request){

    $LoginUser = $request->user();   //token se login userdata get Bunu
    $LoginUserId= $LoginUser->id; 
     $userRole = $LoginUser->user_role;
   
     //if (!$LoginUser || $userRole !== 'Admin') { UserRole Check Keliye Important Bunu }
    
        $products = Product::where('userId', $LoginUserId)->orderBy('id', 'desc')->get();
        //$totalCount = $products->count();   
          return response()->json([
             'success' => true,
             'message' => 'Product fetched successfully',
             //'total_count' => $totalCount,
             'data' => $products
          ], 200);
}




    //==========Single Product Fetch  For Edit and Update==============
    // public function MtdFetchSingleProduct(Request $request,$id)   //Product Id
    // {
    //     $user = $request->user();   //token se login userdata get Bunu
    //     $userId= $user->id; 

    //     $Product = Product::where('userId', $userId)->find($id);

    //     if ($Product) {
    //           return response()->json($Product, 200);
    //     }
          
    //     else {
    //          return response()->json(['error' => 'Product not found'], 404);
    //     }

    // }




    //==========Product Delete===========================
    public function MtdDeleteProduct(Request $request,$id)
    {
        $user = $request->user();   //token se login userdata get Bunu
        $userId= $user->id; 
       
        $Product = Product::where('userId', $userId)->find($id);

        if (!$Product) {//Server Pe nai Room Se Delete Bunu
           return response()->json([
              'success' => false,
              'message' => 'Product Delete Offline'
           ], 404);
        }

        $Product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product Deleted Successfully'
        ], 200);
    }





    //Product UpdateBtn
    public function MtdProductUpdateBtn(Request $request,$id)
    {
         $validator = Validator::make($request->all(), [
           'title' => 'required|string|max:255',
           'description' => 'required',
           //'email' => 'required|email|max:255|unique:users,email,' . $id,
         ]);

        if ($validator->fails()) {
           return response()->json([
            'success' => false,
            'message' => $validator->errors()->first()
        ], 422);
         }

         $user = $request->user(); //token se login userdata get Bunu
         $userId = $user->id;

        $Product = Product::where('userId', $userId)->where('id', $id)->first();

        if (!$Product) {
            return response()->json([
               'success' => false,
               'message' => 'Product not found'
          ], 404);
        }

       $Product->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
             'message' => 'Product Updated successfully ✅'
           ], 200);
    }

    
}//main



