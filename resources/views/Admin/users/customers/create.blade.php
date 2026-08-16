@extends('Admin.layouts.master')
@include('Admin.layouts.sidebar')
@include('Admin.layouts.headerMenu')
@section('content')
<!-- Page Wrapper -->
    <div class="page-wrapper create_p">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="crms-title row bg-white">
                <div class="col  p-0">
                    <h3 class="page-title m-0">
                        <span class="page-title-icon bg-gradient-primary text-white me-2">
                            <i class="bi bi-grid"></i>
                        </span>Create Customer
                    </h3>
                </div>
                <div class="col p-0 text-end">
                    <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.users.customers.index')}}">Customers Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{route('admin.users.customers.create')}}">Create</a></li>
                    </ul>
                </div>
            </div>
            @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
            <!-- Content Starts -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <form action="{{route('admin.users.customers.store')}}" class="needs-validation card" id="rs-vel" novalidate onsubmit="handleSubmit(event)" oninput="checkFormValidity()" method="POST"  enctype="multipart/form-data" >
                                @csrf
                                <div>
                                    <div class="d-flex mb-4 position-relative">
                                        <img id="selectedAvatar" src="{{asset('/assets/img/user_profile.png')}}"
                                        class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                        <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                        <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedImage(event, 'selectedAvatar')" />
                                        {{-- <input type="file" class="form-control " name="profile_picture"/> --}}
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-4">
                                    <!-- <select  name="company_ids[]" multiple>
                                        <option disabled>select companies</option>
                                        @foreach ($companys as $company)
                                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                                        @endforeach
                                    </select> -->
                                    <div class="multipleSelection">
                                            <div class="selectBox">
                                                <p class="mb-0"> Select Companies</p>
                                                <span class="down-icon"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                            </div>
                                            <div id="checkBoxes">
                                                    <p class="checkbox-title">Select Companies</p>
                                                    <div class="selectBox-cont">
                                                    @foreach ($companys as $company)
                                                        <label class="custom_check w-100">
															<input value="{{$company->id}}" name="company_ids[]" {{ in_array($company->id, old('company_ids', [])) ? 'checked' : '' }} type="checkbox">{{$company->company_name}}
															<span class="checkmark"></span>
														</label>
                                                    @endforeach
                                                    </div>
                                            </div>
                                        </div>
                                </div>
                                <h3>Company Details</h3>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label">Company Name<span class="text-danger">*</span>
                                        @error('company_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input class="form-control alp" type="text" required name="company_name" value="{{ old('company_name') }}" placeholder="Company Name" >
                                    <div class="valid-feedback">Looks good!</div>
                                    <div class="invalid-feedback">Enter your Company Name</div>
                                </div>
                                <div class="col-md-4 mynumber">
                                    <label class="col-form-label">Company Phone Number
                                       
                                        @error('company_phone_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input class="form-control phone"  minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^+\d]/g, '');"  type="text" pattern="[0-9]+" name="company_phone_number">
                                    
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">Company Email
                                        @error('company_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input class="form-control" type="email" name="company_email" value="{{ old('company_email') }}" pattern="[^@\s]+@[^@\s]+\.[a-z]{2,6}"  placeholder="Example@gmail.com">
                                    <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your Company Email</div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <label class="col-form-label">PAN No
                                        @error('pan_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input class="form-control text-uppercase"    type="text" name="pan_number" value="{{ old('pan_number') }}" min="10" max="15" pattern="^[A-Z]{5}[0-9]{4}[A-Z]{1}$" placeholder="AAAPA1234A">
                                    <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Please Enter A Valid PAN Number (Eg., ABCDE1234F).</div>
                                    </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">Tax No
                                        @error('tax_number')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <input class="form-control"  name="tax_number" value="{{ old('tax_number') }}" type="text" min="10" max="15" placeholder="Eg: GST,VAT.Etc">
                                    <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your Tax No</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="col-form-label">Address
                                        @error('address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </label>
                                    <textarea class="form-control"  name="address" style="height: 41px;" type="text" placeholder="Address">{{ old('address') }}</textarea>
                                    <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your  Address</div>
                                </div>
                            </div>
                                <h3>Customer Details</h3>
                                
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">First Name
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </label>
                                        <input class="form-control alp" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" >
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your  Name</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Last Name
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control alp" type="text"  name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your  Last Name</div>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="col-form-label">Designation
                                            @error('description')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input type="text" class="form-control" name="description" value="{{ old('description') }}" style="height: 41px;" id="" placeholder="Designation"></input>
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your Designation</div>
                                    </div>
                                </div>
                               
                            <div class="form-group row">
                            <div class="col-md-4">
                                        <label class="col-form-label">Email
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <!-- <input class="form-control" type="email" name="email" pattern="[^@\s]+@[^@\s]+"  oninvalid="this.setCustomValidity('Enter your email ID')" placeholder="example@gmail.com"> -->
                                        <input class="form-control" type="email" name="email" value="{{ old('email') }}" pattern="[^@\s]+@[^@\s]+\.[a-z]{2,6}"  placeholder="Example@gmail.com">
                                        <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your  Email</div>
                                    </div>
                                <div class="col-md-4 mynumber">
                                    <label class="col-form-label ">Phone Number
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </label>
                                    <input class="form-control phone num"  minlength="10" maxlength="10"  type="text" oninput="this.value = this.value.replace(/[^+\d]/g, '');" name="phone_number">
                                </div>
                                <!-- <div class="col-md-4">
                                    <label class="col-form-label">National ID
                                        <span class="text-danger">*</span>
                                            @error('national_id')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                    </label>
                                    <input class="form-control"  name="national_id" type="number" placeholder="National ID">
                                    <div class="valid-feedback">Looks good!</div>
                                        <div class="invalid-feedback">Enter your  National ID</div>
                                </div> -->
                            </div>
                           
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                    <input id="password" class="form-control" type="password" name="password" required
                                      placeholder="Password"><i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                     <div class="valid-feedback">Looks good!</div>
                                     <div class="invalid-feedback">Minimum 8 Character Password</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                    <input id="confirm_password" class="form-control" type="password" name="password_confirmation" required
                                      placeholder="Confirm Password"><i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                     <div class="valid-feedback">Looks good!</div>
                                     <div class="invalid-feedback">Password Do Not Match</div>
                                </div>
                            </div>
                                <div class="py-3">
                                    <button type="submit"
                                        class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Create
                                        Customer</button>&nbsp;&nbsp;
                                    <!-- <button type="cancle" class="btn btn-secondary btn-rounded">Cancel</button> -->
                                </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Content End -->
    </div>   
<!-- /Page Wrapper -->

@endsection