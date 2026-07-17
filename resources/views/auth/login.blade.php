@extends('layouts.app')

@section('content')

<!-- 🎯 SEAMLESS CENTRAL ALIGNMENT: Binalot sa modern structural grid wrapper para nakasentro sa screen bro -->
<div class="container mt-5 page-content">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">

            <!-- 🛑 REUSABLE ERROR MESSAGES COMPONENT (Sasaluhin nito ang Invalid email password logs mo bro) -->
            <x-errors />

            <!-- =========================================================================
                 🎯 THE LUXURY BOOTSTRAP LOGIN CARD SECTION (100% Clean / No Inline Styles)
                 ========================================================================= -->
            <div class="card shadow border rounded-3">
                <div class="card-header bg-dark text-white py-3 text-center">
                    <h4 class="m-0 font-weight-bold">🔑 System Authentication</h4>
                    <small class="text-white-50">Inventory Management System v4</small>
                </div>
                <div class="card-body bg-light p-4">
                    
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf

                        <!-- 1. EMAIL CONTROL INPUT FIELD -->
                        <div class="mb-3">
                            <label class="form-label font-weight-bold">Email Address:</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control border-dark" placeholder="username@email.com" required autocomplete="username">
                        </div>

                        <!-- 2. PASSWORD CONTROL INPUT FIELD -->
                        <div class="mb-4">
                            <label class="form-label font-weight-bold">Account Password:</label>
                            <input type="password" name="password" class="form-control border-dark" placeholder="••••••••" required autocomplete="current-password">
                        </div>

                        <!-- 🎯 UNIFORM RESUABLE FULL-WIDTH SUBMIT BUTTON -->
                        <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold shadow-sm">
                            🔐 Login to Dashboard1
                        </button>

                    </form>

                </div>
            </div> <!-- /card -->

            
            <div class="text-center mt-3">
                <small class="text-muted">Secured Database Matrix Active Layer</small>
            </div>

        </div>
    </div>

    <!-- 🎯 SEAMLESS INTEGRATION: Spacer block selector class laban sa sticky footer overlay niyo -->
    <div class="footer-bumper-spacer"></div>

</div> <!-- /container -->

@endsection
