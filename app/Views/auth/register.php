<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body class="container pt-5">
    <div class="row justify-content-center">
        <div class="bg-body-tertiary p-5 rounded col-md-4">
            <h2 class="text-center mb-4">Register</h2>
            <?php if (isset($error)) echo $error ?>
            <form action="/register" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
                </div>
                <div class="mb-3">
                    <input type="cPassword" class="form-control" name="cPassword" id="cPassword" placeholder="Confirm Password" required />
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary">Register</button>
                </div>
                <div class="text-center">
                    <a href="/login">Already have an account?</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>