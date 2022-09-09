<div class="container">
    <div class="row d-flex justify-center align-center" style="height: 100vh;">
        <div class="card bg-white p-3">
            <div class="card-body">
                <form action="#" method="post">
                    <h2 class="text-center w-100 mb-2">
                        Login
                    </h2>

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
                        <button class="w-100 btn btn-primary">Login</button>
                    </div>

                    <div class="text-center">
                        <span class="font-sm">
                            Don’t have an account?
                        </span>

                        <a href="/auth/register">
                            Register
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="dropDownSelect1"></div>
