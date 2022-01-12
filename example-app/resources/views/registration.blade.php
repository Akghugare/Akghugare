<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Example-App - Registration</title>
    <link href="{{URL::asset('public/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/vendor/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/dist/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{URL::asset('public/assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <noscript>
            <div class="alert alert-danger text-center">
                Your browser does not support JavaScript! This will disrupt some function and site may not work prperly.
            </div>
        </noscript>
        <div class="col-lg-12">
            <h1 class="page-header">Registration Forms</h1>
            @if(Session::has('warning'))
            <div class="alert alert-warning text-center">
                {{Session::get('warning')}}
            </div>
            @endif
            <div class="panel panel-default">
                <div class="panel-heading">
                    Basic Form Elements
                </div>
                <div class="panel-body">
                    <div class="row">
                        <form role="form" action="{{route('registerAction')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Role* @error('role_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_role_id"></span></label>
                                    <select class="form-control" name="role_id" id="role_id">
                                        <option value="">--Select Role--</option>
                                        @foreach($roleData as $row)
                                        {{ old('role_id') == $row->id?'selected':''; }}
                                        <option value="{{$row->id}}" {{ old('role_id') == $row->id?'selected':''; }}>{{$row->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email* @error('email')<span style="color:red;">{{$message}}</span>@enderror <span id="err_email"></span></label>
                                    <input class="form-control" name="email" type="text" value="{{ old('email') }}" id="email" placeholder="Enter Eamil">
                                </div>

                                <div class="form-group">
                                    <label>Mobile* @error('mobile')<span style="color:red;">{{$message}}</span>@enderror <span id="err_mobile"></span></label>
                                    <input class="form-control" type="text" name="mobile" maxlength="10" value="{{ old('mobile') }}" id="mobile" placeholder="Enter Mobile">
                                </div>

                                <div class="form-group">
                                    <label>Languages* @error('language_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_language_id"></span></label><br>
                                    @foreach($languageData as $row)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="language_id[]" value="{{ $row->id }}" {{ (old('language_id') != "" && in_array($row->id,old('language_id')))?'checked':''; }}>{{ $row->title }}
                                    </label>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label>Hobbies* @error('hobby_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_hobby_id"></span></label>
                                    <select multiple name="hobby_id[]" class="form-control" id="hobby_id">
                                        <option value="">--Select Hobbies--</option>
                                        @foreach($hobbyData as $row)
                                        <option value="{{ $row->id }}" {{ (old('hobby_id') !="" && in_array($row->id, old('hobby_id')))?'selected':'' }}>{{ $row->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Country* @error('country_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_country_id"></span></label>
                                    <select class="form-control" name="country_id" onChange="return getStates(this.value)" id="country_id">
                                        <option value="">--Select Country--</option>
                                        @foreach($countryData as $row)
                                        <option value="{{$row->id}}" {{ old('country_id') == $row->id?'selected':''; }}>{{$row->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>City* @error('city_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_city_id"></span></label>
                                    <select name="city_id" class="form-control" id="city_id" >
                                        <option value="">--Select City--</option>
                                    </select>
                                </div>
                                
                                 <div class="form-group">
                                    <label>Image* @error('image')<span style="color:red;">{{$message}}</span>@enderror <span id="err_image"></span></label>
                                    <input type="file" name="image" id="image">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Name* @error('name')<span style="color:red;">{{$message}}</span>@enderror <span id="err_name"></span></label>
                                    <input class="form-control" name="name" value="{{ old('name') }}" type="text" id="name" placeholder="Enter text">
                                </div>

                               <div class="form-group">
                                    <label>Password* @error('password')<span style="color:red;">{{$message}}</span>@enderror <span id="err_password"></span></label>
                                    <input class="form-control" name="password" type="password" id="password"  placeholder="Enter text">
                                </div>
                                <div class="form-group">
                                    <label>DOB* @error('dob')<span style="color:red;">{{$message}}</span>@enderror <span id="err_dob"></span></label>
                                    <input class="form-control" type="text" name="dob" value="{{ old('dob') }}" id="dob" placeholder="YYYY-MM-DD">
                                </div>
                                <div class="form-group">
                                    <label>Gender* @error('gender')<span style="color:red;">{{$message}}</span>@enderror <span id="err_gender"></span></label><br>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male'?'checked':''; }}>Male
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female'?'checked':''; }}>Female
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="Female" value="Other" {{ old('gender') == 'Other'?'checked':''; }}>Other
                                    </label>
                                </div>
                                 <div class="form-group">
                                    <label>Address* @error('address')<span style="color:red;">{{$message}}</span>@enderror <span id="err_address"></span></label>
                                    <textarea class="form-control" name="address" id="address" rows="4">{{ old('address') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>State* @error('state_id')<span style="color:red;">{{$message}}</span>@enderror <span id="err_state_id"></span></label>
                                    <select name="state_id" class="form-control" id="state_id" onChange="return getCities(this.value)">
                                        <option value="">--Select State--</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Pin Code* @error('pin_code')<span style="color:red;">{{$message}}</span>@enderror <span id="err_pin_code"></span></label>
                                    <input class="form-control" name="pin_code" id="pin_code" type="text" value="{{ old('pin_code') }}" placeholder="Enter Pin Code">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success" >Submit</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
                                <button type="button" class="btn btn-danger" onclick="window.location='{{route('/')}}'">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{URL::asset('public/assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/vendor/metisMenu/metisMenu.min.js')}}"></script>
    <script src="{{URL::asset('public/assets/dist/js/sb-admin-2.js')}}"></script>
    <script type="text/javascript">
        function checkvalidation(){
            var role_id = $('#role_id').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var password = $('#password').val();
            var mobile = $('#mobile').val();
            var language_id = $('input[name="language_id[]"]:checked').length;
            var gender = $('input[name="gender"]:checked').length;
            var dob = $('#dob').val();
            var hobby_id = $('#hobby_id').val();
            var address = $('#address').val();
            var country_id = $('#country_id').val();
            var state_id = $('#state_id').val();
            var city_id = $('#city_id').val();
            var pin_code = $('#pin_code').val();
            var image = $('#image').val();
            var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

            if(role_id.trim()==""){
                $('#err_role_id').html('Required').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_role_id').hide('1500');
                },3000);
                $('#role_id').focus();
                return false;
            }
            if(name.trim()==""){
                $('#err_name').html('Required').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_name').hide('1500');
                },3000);
                $('#name').focus();
                return false;
            }
            if(email.trim()==""){
                $('#err_email').html('Required').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_email').hide('1500');
                },3000);
                $('#email').focus();
                return false;
            }else if(!pattern.test(email)){
                $('#err_email').html('Please enter valid email.').css('color','red').show('1500');
                setTimeout(function(){
                    $('#err_email').hide('1500');
                },3000);
                $('#email').focus();
                return false;
            }
            if(password.trim()==""){
                $('#err_password').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_password').hide();
                },3000);
                    $('#password').focus();
                return false;
            }
            if(mobile.trim()==""){
                $('#err_mobile').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_mobile').hide();
                },3000);
                    $('#mobile').focus();
                return false;
            }
            if(dob.trim()==""){
                $('#err_dob').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_dob').hide();
                },3000);
                    $('#dob').focus();
                return false;
            }
            if(language_id == 0){
                $('#err_language_id').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_language_id').hide();
                },3000);
                    $('input[name="language_id"]').focus();
                return false;
            }
            if(gender == 0){
                $('#err_gender').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_gender').hide();
                },3000);
                    $('input[name="gender"]').focus();
                return false;
            }
            if(hobby_id==""){
                $('#err_hobby_id').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_hobby_id').hide();
                },3000);
                    $('#hobby_id').focus();
                return false;
            }
            if(address.trim()==""){
                $('#err_address').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_address').hide();
                },3000);
                    $('#address').focus();
                return false;
            }
            if(country_id==""){
                $('#err_country_id').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_country_id').hide();
                },3000);
                    $('#country_id').focus();
                return false;
            }
            if(state_id==""){
                $('#err_state_id').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_state_id').hide();
                },3000);
                    $('#state_id').focus();
                return false;
            }
            if(city_id==""){
                $('#err_city_id').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_city_id').hide();
                },3000);
                    $('#city_id').focus();
                return false;
            }
            if(pin_code.trim()==""){
                $('#err_pin_code').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_pin_code').hide();
                },3000);
                    $('#pin_code').focus();
                return false;
            }
            if(image.trim()==""){
                $('#err_image').html('Required').css('color','red').show();
                setTimeout(function(){
                    $('#err_image').hide();
                },3000);
                    $('#image').focus();
                return false;
            }else{
                var ext = $('#image').val().split('.').pop().toLowerCase();
                if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
                    $('#err_image').html('Please select only gif, png, jpg, jpeg files').css('color','red').show();
                    setTimeout(function(){
                        $('#err_image').hide();
                    },3000);
                        $('#image').focus();
                    return false;
                }
            }
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var country_id = "{{ old('country_id') }}";
            var state_id = "{{ old('state_id') }}";
            var city_id = "{{ old('city_id') }}";

            if(country_id!=""){
                var url = '{{route("getStates")}}';
                   var data = {"_token":'{{csrf_token()}}','country_id':country_id,'state_id':state_id};
                   $.ajax({
                        type:"post",
                        url:url,
                        data:data,
                        cache:false,
                        success:function(response){
                            $('#state_id').html(response);
                        }

                   });
            }
            if(state_id!=""){
                var url = '{{route('getCities')}}';
                var data = {"_token":'{{csrf_token()}}','state_id':state_id,'city_id':city_id};
                $.ajax({
                    type:'post',
                    url:url,
                    data:data,
                    cache:false,
                    success:function(response){
                        $('#city_id').html(response);
                    }

                });
            }

            $('#mobile').keypress(function(e) {
                var verified = (e.which == 8 || e.which == undefined || e.which == 0) ? null : String.fromCharCode(e.which).match(/[^0-9]/);
                if (verified) {e.preventDefault();}
            });

        });

        function getStates(country_id){
           var url = '{{route("getStates")}}';
           var data = {"_token":'{{csrf_token()}}','country_id':country_id};
           $.ajax({
                type:"post",
                url:url,
                data:data,
                cache:false,
                success:function(response){
                    $('#state_id').html(response);
                }

           });
        }

        function getCities(state_id){
            var url = '{{route('getCities')}}';
            var data = {"_token":'{{csrf_token()}}','state_id':state_id};
            $.ajax({
                type:'post',
                url:url,
                data:data,
                cache:false,
                success:function(response){
                    $('#city_id').html(response);
                }

            });
        }
    </script>
</body>
</html>