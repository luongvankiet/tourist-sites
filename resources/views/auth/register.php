<div class="container">
    <div class="row d-flex justify-center align-center" style="height: 100vh;">
        <div class="card bg-white p-3">
            <div class="card-body">
                <form action="/auth/register" method="post">
                    <h2 class="text-center w-100 mb-2">
                        Sign up
                    </h2>

                    <div class="mb-2">
                        <input class="form-control <?php echo isset($data) ? ($data->hasError('first_name') ? 'is-invalid' : '') : '' ?>" type="text" name="first_name" value="<?php echo isset($data) ? $data->first_name : '' ?>" placeholder="First Name">
                        <?php if (isset($data) && $data->hasError('first_name')) { ?>
                            <div class="invalid-feedback"><?php echo $data->getFirstError('first_name') ?></div>
                        <?php } ?>
                    </div>

                    <div class="mb-2">
                        <input class="form-control <?php echo isset($data) ? ($data->hasError('last_name') ? 'is-invalid' : '') : '' ?>" type="text" name="last_name" value="<?php echo isset($data)? $data->last_name : '' ?>" placeholder="Last Name">
                        <?php if (isset($data) && $data->hasError('last_name')) { ?>
                            <div class="invalid-feedback"><?php echo $data->getFirstError('last_name') ?></div>
                        <?php } ?>
                    </div>

                    <div class="mb-2">
                        <input class="form-control <?php echo isset($data) ? ($data->hasError('email') ? 'is-invalid' : '') : '' ?>" type="text" name="email" value="<?php echo isset($data) ? $data->email : '' ?>" placeholder="Email">
                        <?php if (isset($data) && $data->hasError('email')) { ?>
                            <div class="invalid-feedback"><?php echo $data->getFirstError('email') ?></div>
                        <?php } ?>
                    </div>

                    <div class="mb-2">
                        <input class="form-control <?php echo isset($data) ? ($data->hasError('password') ? 'is-invalid' : '') : '' ?>" type="password" name="password" value="<?php echo isset($data) ? $data->password : '' ?>" placeholder="Password">
                        <?php if (isset($data) && $data->hasError('password')) { ?>
                            <div class="invalid-feedback"><?php echo $data->getFirstError('password') ?></div>
                        <?php } ?>
                    </div>

                    <div class="mb-2">
                        <input class="form-control <?php echo isset($data) ? ($data->hasError('password_confirmation') ? 'is-invalid' : '') : '' ?>" type="password" name="password_confirmation" value="<?php echo isset($data) ? $data->password_confirmation : '' ?>" placeholder="Confirm Password">
                        <?php if (isset($data) && $data->hasError('password_confirmation')) { ?>
                            <div class="invalid-feedback"><?php echo $data->getFirstError('password_confirmation') ?></div>
                        <?php } ?>
                    </div>

                    <div class="mb-2">
                        <button class="w-100 btn btn-primary">Register</button>
                    </div>

                    <div class="text-center">
                        <span class="font-sm">
                            Already have an account?
                        </span>

                        <a href="/auth/login">
                            Login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
