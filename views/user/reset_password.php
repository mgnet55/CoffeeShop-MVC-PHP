<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="/css/home/bootstrap.min.css">
</head>
<body>
<div class="container d-flex flex-column">
    <div class="row align-items-center justify-content-center g-0 min-vh-100">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-6">
                    <div class="mb-4">
                        <a href="/"><img src="/logo.png" class="mb-4" alt="logo" height="100px"></a>
                        <h1 class="mb-1 fw-bold">Forgot Password</h1>
                        <p>Fill the form to reset your password.</p>
                    </div>
                    <!-- Form -->
                    <form method="POST" action='/forget'>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                   placeholder="Enter Your Email " required="">
                        </div>
                        <!-- Button -->
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary">Send Reset Link</button>
                        </div>
                        <span>Return to <a href="/login">sign in</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>