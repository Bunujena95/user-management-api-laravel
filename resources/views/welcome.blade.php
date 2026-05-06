<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

<link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


</head>
<body>
    
    <h1>Android CRUD Operation Bunu</h1>

        <form  method="POST" id="uploadForm" action="{{route('NmRegisterBtn')}}">
            @csrf
            <!--Name-->
            <div class="form-group ms-lg-4 me-lg-4 mt-4">
                <label>Your Full Name</label>
                <div class="input-group" style="border: 2px solid #ddd; background-color:white; border-radius: 10px; padding: 5px;">
                    <span class="input-group-text" style="border: none; background-color: transparent;">
                        <i class="fa fa-user text-primary" aria-hidden="true"></i>
                    </span>
                    <input type="text" id="name" name="name"  value="{{old('name')}}" maxlength="20" placeholder="Enter Full Name"  style="border:none; border-radius: 5px;" class="form-control"/>               
                </div>
                
            </div>


           

           <!-- Phone -->
            <div class="form-group ms-lg-4 me-lg-4 mt-2">
                <label>Your Phone Number</label>
                <div class="input-group" style="border: 2px solid #ddd; background-color:white; border-radius: 10px; padding: 5px;">
                    <span class="input-group-text" style="border: none; background-color: transparent;">
                        <i class="fa fa-phone text-primary" aria-hidden="true"></i>
                    </span>
                    <input type="text" id="phone"  name="phone" value="{{old('email')}}"   class="form-control" placeholder="Enter Phone"  style="border:none; border-radius: 5px;"/>                                             
                </div>    
            </div>


            
            <!-- Password -->
            <div class="form-group ms-lg-4 me-lg-4 mt-2">
                <label>Your Password</label>
                <div class="input-group" style="border: 2px solid #ddd; background-color:white; border-radius: 10px; padding: 5px;">
                    <span class="input-group-text" style="border: none; background-color: transparent;">
                        <i class="fa fa-password text-primary" aria-hidden="true"></i>
                    </span>
                    <input type="text" id="password"  name="password" value="{{old('password')}}"   class="form-control" placeholder="Enter Password"  style="border:none; border-radius: 5px;"/>                                             
                </div>  
            </div>


               <div class="form-group mt-4 text-center">
                 <input type="submit" id="uploadBtn"  class="btn btn-success fw-bold" value="Register" style="border-radius: 30px; width:300px">              
               </div>

               
            
        </div>
        </form>	 

</body>
</html>