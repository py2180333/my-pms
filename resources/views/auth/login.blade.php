<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{asset('/assets/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" />
        <link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0; background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
            }
    
            .button-container {
                margin-bottom: 20px;
            }
    
            .button-container button {
                padding: 10px 20px;
                margin: 5px;
                font-size: 16px;
                cursor: pointer;
                border: none;
                background-color: #007bff;
                color: #fff;
                border-radius: 5px;
            }
    
            .button-container button:hover {
                background-color: #0056b3;
            }
            .rs-main-form{
                background: #fff;
                border-radius: 4px;
                padding: 20px;
                margin: 20px;
                box-shadow: 0 0 30px rgba(0, 0, 0, .2);
            }
            .form-container {
                display: none;
                width: 480px;
            }
    
            .form-container.active {
                display: block;
            }
    
            .form-container h2 {
                margin-bottom: 20px;
                font-size: 24px;
                text-align: center;
            }
    
            .form-container .input-box {
                margin-bottom: 15px;
            }
    
            .form-container .input-box label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
            }
    
            .form-container .input-box input {
                width: 100%;
                padding: 8px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
    
            .form-container button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }
    
            .button-container .rs-form:hover {
                background: linear-gradient(to right, #2250b0 0%, #fc6075 100%);
            }
            .button-container .active-btn {
                background: linear-gradient(to right, #2250b0 0%, #fc6075 100%);
                color: white;
            }
            .button-container .rs-form{
                background-color: #2250b0;
                color: white;
                transition: 0.9s;
            }
            i.user {
                position: absolute;
                top: 38px;
                right: 15px;
            }
            .fix-error-input{
                position: relative;
            }
            .fix-error-i{
                position: absolute; 
                bottom:13px; 
                right:6px;
                z-index: 10;
            }
        </style>
    </head>
    <body>
        <div class="rs-main-form">
            <div class="button-container">
                <button class="rs-form"  id="customerBtn">Customer Form</button>
                <button class="rs-form"  id="vendorBtn">Vendor Form</button>
                <button class="rs-form" id="resourceBtn">Resource Form</button>
            </div>
            {{-- <div class="account-logo">
                <a href="index.html"><img src="../assets/img/tqt/theqt-logo.png" alt="Dreamguy's Technologies"></a>
            </div> --}}
            <!-- Default Customer Form -->
            <div id="customerForm" class="form-container active account-box" style="border: none; box-shadow:none;">
                <h2>Customer Login</h2>
                <div class="form-group">
                    <form action="{{route('customer.login')}}" method="POST">
                    @csrf
                        <div class="form-group" style="position: relative;">
                            <label for="">Customer Username</label>
                            <input class="form-control" type="email" name="customer_email" required  placeholder="Username">
                            <i class="user fa-regular fa-user"></i>
                        </div>
                        <label for="customerpasword">Password</label>
                        <div class="input-group form-group">
                            <input class="form-control pass-show-icon fix-error-input" type="password" id="password" name="customer_password" placeholder="password" required 
                            minlength="8">
                            <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Password must contain at least 8 characters, including uppercase, lowercase letters, and a number" --> <!-- remove by pr 5-8-25 -->
                            <i class="toggle-password fa fa-eye-slash fix-error-i"  aria-hidden="true"></i>
                        </div>
                        @if ($errors->has('customer_email'))
                            <div class="error-customer">
                                <strong>{{ $errors->first('customer_email') }}</strong>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div id="vendorForm" class="form-container account-box " style="border: none; box-shadow:none;">
               
                <h2>Vendor Login</h2>
                <div class="form-group">
                    <form action="{{route('vendor.login')}}" method="POST">
                    @csrf
                        <div class="form-group" style="position: relative;">
                            <label for="">Vendor Username</label>
                            <input class="form-control" type="email" id="password" name="vendor_email" placeholder="Username">
                            <i class="user fa-regular fa-user"></i>
                        </div>
                        <label for="customerpasword">Password</label>
                        <div class="input-group form-group">
                            <input class="form-control pass-show-icon" type="password" id="password" name="vendor_password" placeholder="password" required 
                            minlength="8">
                            <!-- pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Password must contain at least 8 characters, including uppercase, lowercase letters, and a number" --> <!-- remove by pr 5-8-25 -->
                            <i class="toggle-password fa fa-eye-slash fix-error-i" aria-hidden="true"></i>
                        </div>
                        @if ($errors->has('vendor_email'))
                            <div class="error-vendor">
                                <strong>{{ $errors->first('vendor_email') }}</strong>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        
            <div id="resourceForm" class="form-container account-box" style="border: none; box-shadow:none;">
                <h2>Resource Login</h2>
                <div class="form-group">
                    <form action="{{route('resource.login')}}" method="POST">
                    @csrf 
                        <div class="form-group" style="position: relative;">
                            <label for="">Resource Username</label>
                            <input class="form-control" type="email" id="email" name="email" placeholder="Username">
                            <i class="user fa-regular fa-user"></i>
                        </div>
                        <label for="customerpasword">Password</label>
                        <div class="input-group form-group">
                            <input class="form-control pass-show-icon" type="password" id="password" name="password" placeholder="password" required minlength="8" title="Password must contain at least 8 characters, including uppercase, lowercase letters, and a number">
                            <i class="toggle-password fa fa-eye-slash fix-error-i" aria-hidden="true"></i>
                        </div>
                        @if ($errors->has('resource_email'))
                            <div class="error-resource">
                                <strong>{{ $errors->first('resource_email') }}</strong>
                            </div>
                        @endif
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Login</button>
                        </div>
                    </form>
                </div>
            </div>
           </div>
        {{-- <div class="center">
            <h1>Login</hi>
        <form action="{{route('resource.login')}}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="put your email"></br>
            <input type="password" name ="password" placeholder="password"></br>
            <input type="submit" value="submit">
        </form>
        @if ($errors->any())
        <div>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        </div> --}}
        <script>
            // Get all buttons and forms
            const customerBtn = document.getElementById('customerBtn');
            const vendorBtn = document.getElementById('vendorBtn');
            const resourceBtn = document.getElementById('resourceBtn');
            const customerForm = document.getElementById('customerForm');
            const vendorForm = document.getElementById('vendorForm');
            const resourceForm = document.getElementById('resourceForm');
            const buttons = document.querySelectorAll(".button-container button"); // Get all buttons
        
            // Function to show the specific form and add active class to the clicked button
            function showForm(button, formToShow) {
                // Remove 'active' class from all forms and buttons
                customerForm.classList.remove("active");
                vendorForm.classList.remove("active");
                resourceForm.classList.remove("active");
                buttons.forEach(btn => btn.classList.remove("active-btn"));
        
                // Add 'active' class to the clicked button and corresponding form
                button.classList.add("active-btn");
                formToShow.classList.add("active");
            }
        
            // Event listeners for the buttons
            customerBtn.addEventListener('click', () => showForm(customerBtn, customerForm));
            vendorBtn.addEventListener('click', () => showForm(vendorBtn, vendorForm));
            resourceBtn.addEventListener('click', () => showForm(resourceBtn, resourceForm));

            window.addEventListener('DOMContentLoaded', function () {
                const buttons = document.querySelectorAll('.button-container .rs-form');

                if (document.querySelector('.error-customer')) {
                    buttons[0]?.click();
                } else if (document.querySelector('.error-vendor')) {
                    buttons[1]?.click();
                } else if (document.querySelector('.error-resource')) {
                    buttons[2]?.click();
                }
            });
        </script>
        <script src="{{asset('/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
        <script src="{{asset('/assets/js/app.js')}}"></script>
    </body>
</html>