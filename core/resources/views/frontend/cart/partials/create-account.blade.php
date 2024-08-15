@if (!$user)
    <div class="create-account-wrapper mt-4 mt-lg-5">
        <a href="#1" class="create-accounts click-open-form2 ff-rubik fw-500 color-heading"><input type="hidden" name="create_account" value="1"> Create An Accounts </a>
        <div class="checkout-signup-form-wrapper">
            <div class="signin-contents">
                <h2 class="contact-title"> Sign Up </h2>
                <div class="login-form">
                    <div class="input-flex-item">
                        
                        <div class="single-input mt-4">
                            <label class="label-title mb-3"> Create Password </label>
                            <input class="form--control" type="password" name="password" placeholder="Type Password">
                        </div>
                        <div class="single-input mt-4">
                            <label class="label-title mb-3"> Confirm Password </label>
                            <input class="form--control" type="password" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
