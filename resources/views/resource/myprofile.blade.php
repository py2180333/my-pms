@extends('resource.master')
@include('resource.sidebar')
@section('content') 
<div class="page-wrapper">
    <div class="content container-fluid">
      <div class="crms-title row bg-white">
                    <div class="col  p-0">
                        <h3 class="page-title m-0">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="bi bi-person"></i>
                            </span> Resource Profile
                        </h3>
                    </div>
                    <div class="col p-0 text-end">
                        <ul class="breadcrumb bg-white float-end m-0 ps-0 pe-0">
                            <li class="breadcrumb-item"><a href="{{ route('resource.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Resource Profile</li>
                        </ul>
                    </div>
                </div>

        <x-alert /> <!-- \views\components\alert to show the errors. -->

   <div class="page-header pt-3 mb-0">
     <div class="card ">
        <div class="card-body">
            <div class="row bg-white">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                @if ($data->profile_picture) 
                                    <a href = "#"> 
                                        <img alt ="" id="originalImage" src = "{{ asset('uploads/resources/' . $data->profile_picture) }}" > 
                                    </a>
                                @else
                                    <a href="#"><img alt="" id="originalImage" src="{{ asset('/assets/img/user_profile.png ') }}"></a>
                                @endif
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <!-- <div class="title">Resource Name</div> -->
                                            <a class="" href="">
                                                <h3 class="user-name m-t-0 mb-0"> 
                                                    <span id="original_first_name">{{$data->first_name}}</span> 
                                                    <span id="original_last_name">{{$data->last_name}}</span>
                                                </h3>
                                            </a>
                                    <div class="title mt-2">Birth Date</div>
                                    <div class="text">
                                        <a class=""  href="">
                                            <span class="text-muted" id="original_birth_date">{{$data->birth_date}}</span>
                                        </a>
                                    </div>
                                    <div class="title mt-2">Designation</div>
                                    <div class="text">
                                        <a class="text-muted" href="">
                                            {{$data->designation}}
                                        </a>
                                    </div>
                                    <div class="title mt-2">Username</div>
                                    <div class="text">
                                        <a class="text-muted" href="">
                                            {{$data->username}}
                                        </a>
                                    </div>
                                    <div class="title mt-2">Phone Number</div>
                                    <div class="text">
                                        <a class="text-muted" href="">
                                            <span id="original_phone_number">{{$data->phone_number}}</span>
                                        </a>
                                    </div>
                                    <div class="title mt-2">Email</div>
                                    <div class="text">
                                        <a class="text-muted" href="">
                                            <span id="original_email">{{$data->email}}</span>
                                        </a>
                                    </div>
                                    <div class="title mt-2">Pan Number</div>
                                    <div class="text">
                                        <a class="text-muted" href="">
                                            <span id="original_pan_number">{{$data->pan_number}}</span>
                                        </a>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                            <div class="title ">Skills</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="skills">{{ implode(', ', json_decode($data->skills)) }}</span>
                                                </a>
                                            </div>
                                       
                                            <div class="title mt-2">Payment Type</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->payment_type}}
                                                </a>
                                            </div>
                                       
                                            <div class="title mt-2">Rate</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->rate}}
                                                </a>
                                            </div>
                                            <div class="title mt-2">National Id</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->national_id}}
                                                </a>
                                            </div>
                                        
                                            <div class="title mt-2">Address</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    <span id="original_address">{{$data->address}}</span>
                                                </a>
                                            </div>
                                            <div class="title mt-2">Status</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{$data->status}}
                                                </a>
                                            </div>
                                        
                                            <div class="title mt-2">Role</div>
                                            <div class="text">
                                                <a class="text-muted" href="">
                                                    {{ucwords(str_replace('_', ' ', $data->role))}}
                                                </a>
                                            </div>
                                      

                                   <!-- <li>
                                            <div class="title">Reports to:</div>
                                            <div class="text">
                                                <div class="avatar-box">
                                                    <div class="avatar avatar-xs">
                                                        <img src="../assets/img/profiles//avatar-13.jpg" alt="">
                                                    </div>
                                                </div>
                                                <a href="profile.html">Jeffery Lalor</a>
                                            </div>
                                        </li> -->
                                   
                                </div>
                            </div>
                        </div>
                        <div class="pro-edit">
                            <a data-bs-toggle="modal" data-bs-target="#update-resource" onclick="resetResForm()" class="edit-icon" href="#">
                                <i class="fa fa-pencil"></i>
                            </a>
                        </div>
                        <div class="modal right fade" id="update-resource" tabindex="-1" role="dialog" aria-modal="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title text-center">Edit Resource</h4>
                                                        <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Content Starts -->
                                                        <div class="row mt-4">
                                                            <div class="col-md-12">
                                                                <!-- use Auth::id(); to update the details. -->
                                                                <form action="{{ route('resource.update') }}" id="ResourceUpdate" method="post" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <div class="row">
                                                                        <div>
                                                                            <div class="d-flex mb-4 position-relative">
                                                                                @if($data->profile_picture)
                                                                                    <img id="selectedResAvatar" src="{{ asset('uploads/resources/' . $data->profile_picture) }}"
                                                                                            class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                                @else
                                                                                    <img id="selectedResAvatar" src="{{asset('/assets/img/user_profile.png')}}" 
                                                                                        class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;" alt="example placeholder" />
                                                                                @endif    
                                                                                <label class="form-label uplode text-white m-1" for="customFile2">Choose file</label>
                                                                                <input type="file" class="form-control d-none" name="profile_picture" id="customFile2" onchange="displaySelectedResImage(event)" />
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <h3>Resource Details</h3>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">First Name<span class="text-danger">*</span></label>
                                                                            <input class="form-control" id="first_name" type="text" name="first_name" value="{{ $data->first_name }}" placeholder="First Name">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Last Name<span class="text-danger">*</span></label>
                                                                            <input class="form-control" id="last_name" type="text" name="last_name" value="{{ $data->last_name }}" placeholder="Last Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Birth Date</label>
                                                                            <input type="date" class="form-control" id="birth_date"  name="birth_date" value="{{ $data->birth_date }}" placeholder="MM/DD/YY">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Email</label>
                                                                            <input class="form-control" id="email" type="email" name="email" value="{{ $data->email }}" pattern="[^@\s]+@[^@\s]+"  placeholder="example@gmail.com">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6 mynumber">
                                                                            <label class="col-form-label">Phone Number</label>
                                                                            <input class="form-control phone" id="phone_number"  type="text" name="phone_number" value="{{ $data->phone_number }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="inputArea">
                                                                                <label class="col-form-label">Skills</label>
                                                                                <input type="text" class="inputtag form-control" id="Resourceskills" placeholder="Enter your Skills">
                                                                                <div><span class="text-danger" id="skills-error-msg"></span></div>
                                                                                <div class="tags clear resource-skill"><span class="text-danger" id="Rs-error-msg"></span></div>
                                                                                <input type="hidden" name="skills" id="ResourceUpdateskills" required> <!-- Hidden input to store skills as JSON -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">PAN.No</label>
                                                                            <input class="form-control" id="pan_number" type="text" name="pan_number" value="{{ $data->pan_number }}" placeholder="PAN.NO">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Address</label>
                                                                            <textarea class="form-control" id="address" name="address" style="height: 41px;"  rows="3" type="text" placeholder="Address">{{ $data->address }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Password<span class="text-danger">*</span></label>
                                                                            <input id="password" class="form-control" type="password"
                                                                            name="password"  placeholder="Password">
                                                                                <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                                                            <input id="confirm_password" class="form-control" type="password" name="password_confirmation"
                                                                                placeholder="Confirm Password">
                                                                                <i class="toggle-password cursor-pointer fa fa-fw fa-eye-slash"></i>
                                                                        </div>
                                                                    </div>
                                                                    <div class="py-3">
                                                                        <button type="button" id="UpdateResource-submit-btn"
                                                                            class="border-0 btn btn-primary btn-gradient-primary btn-rounded">Update</button>&nbsp;&nbsp;
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- /Content End -->
                                                    </div>
                                                </div>
                                                <!-- modal-content -->
                                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>
</div>
@endsection
@section('script')
<!-- new pr 23-7-25-->
<script>
function displaySelectedResImage(event) {
    const file = event.target.files[0]; // Get the selected file
    const imageElement = document.getElementById('selectedResAvatar');

    // Validate the file type
    if (file && file.type.match('image.*')) {
        const reader = new FileReader();
        reader.onload = function(e) {
            imageElement.src = e.target.result; // Update the image source
        }
        reader.readAsDataURL(file); // Read the file as a Data URL
    } else {
        // Reset to default image if no valid file is selected
        imageElement.src = '/assets/img/user_profile.png';
    }
}  
function resetResForm() {
    var imageEle = document.getElementById('selectedResAvatar');
    var originalImage = document.getElementById('originalImage');
    imageEle.src = originalImage.src;
    document.getElementById('first_name').value = document.getElementById('original_first_name').innerText;
    document.getElementById('last_name').value = document.getElementById('original_last_name').innerText;
    document.getElementById('birth_date').value = document.getElementById('original_birth_date').innerText;
    document.getElementById('email').value = document.getElementById('original_email').innerText;
    document.getElementById('phone_number').value = document.getElementById('original_phone_number').innerText;
    document.getElementById('pan_number').value = document.getElementById('original_pan_number').innerText;
    document.getElementById('address').value = document.getElementById('original_address').innerText;
}

$(document).ready(function () {
    
    // Initialize variables
    var inputArea = $("#Resourceskills"),
        tagArea = $("#Rs-error-msg"),
        skills = []; // Array to store the skills

    // Function to populate skills when editing the form
    function populateSkills(responseSkills) {
        // Clear any existing tags first
        tagArea.empty();
        skills = []; // Clear the skills array

        // Check if responseSkills is a string and attempt to parse it
        if (typeof responseSkills === "string") {
            try {
                skillsArray = responseSkills.split(', '); // Split the string into an array
            } catch (error) {
                console.error("Error parsing skills:", error);
                return; // Stop further execution in case of error
            }
        }

        // If skillsArray is valid and an array, add each skill as a tag
        if (Array.isArray(skillsArray)) {
            skillsArray.forEach(addSkillTag);
        } else {
            console.error("Invalid format for skills.");
        }
    }

    // Function to add a new skill tag dynamically
    function addSkillTag(skill) {
        // Prevent adding duplicate skills
        if (!skills.includes(skill)) {
            // Create the skill tag element
            var tag = $("<span class='tag'>" + skill + "</span>").appendTo(tagArea);
            var close = $("<span class='fa fa-close'></span>").appendTo(tag);

            // Push the skill into the skills array
            skills.push(skill);

            // Update the hidden input with the current skills as JSON
            $("#ResourceUpdateskills").val(JSON.stringify(skills));

            // Add click event for removing the skill
            close.on("click", function () {
                var index = skills.indexOf(skill); // Use the actual skill text for removal
                if (index > -1) {
                    skills.splice(index, 1); // Remove the skill from the array
                    $("#ResourceUpdateskills").val(JSON.stringify(skills)); // Update the hidden input
                }
                tag.remove(); // Remove the tag element
            });
        }
    }

    // Handle adding new skills dynamically when typing in the input field
    inputArea.on("change", function () {
        var data = $(this).val().trim(); // Get the entered value

        // Only add if there's a new skill entered
        if (data) {
            addSkillTag(data); // Add the new skill as a tag
            $(this).val(""); // Clear the input field
        }
    });

    // Fetch the skills when the edit form is shown (example for Bootstrap modal)
    $('#update-resource').on('show.bs.modal', function () {
        var responseSkills = $('#skills').text();
        populateSkills(responseSkills); // Populate skills
    });

    // Validation before form submission
    $("#UpdateResource-submit-btn").on("click", function (e) {
        e.preventDefault(); // Prevent default button behavior
        
        // Perform validation before submission
        if (!skills || skills.length === 0) {
            $("#skills-error-msg").text("Please add some skills!");
        } else {
            $("#ResourceUpdate").submit(); // Submit the form
        }
    });
});
</script>
@endsection