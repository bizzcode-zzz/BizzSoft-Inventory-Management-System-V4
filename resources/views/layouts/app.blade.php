<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Practice Project</title>
    
    <!-- INIWAN ANG SAKTONG VERSION LINES MO BRO -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
 
<body class="main-layout-body d-flex flex-column min-vh-100">

    <!-- 🌐 GLOBAL HEADER NAVIGATION BAR (Upgraded to Luxury Modern Bootstrap Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow py-3">
        <div class="container-fluid px-4">
            <!-- 🏢 BRAND LOGO TEXT -->
            <a class="navbar-brand fw-bold text-uppercase tracking-wider me-4" href="{{ route('dashboard.index') }}">
                📦 IMS v4
            </a>
            
            <!-- MOBILE COLLAPSE HAMBURGER BUTTON (Para responsive kung sakaling i-mobile ng instructor niyo) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- NAVIGATION LINKS CLUSTER -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav g-2">
                    
                    <!-- 🏠 Dashboard -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.index') ? 'active fw-bold' : '' }}" href="{{ route('dashboard.index') }}">
                            🏠 Dashboard
                        </a>
                    </li>

                    <!-- 📦 Products -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('products.*') ? 'active fw-bold' : '' }}" href="{{ route('products.index') }}">
                            📦 Products
                        </a>
                    </li>

                    <!-- 📂 Categories -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-bold' : '' }}" href="{{ route('categories.index') }}">
                            📂 Categories
                        </a>
                    </li>

                    <!-- 🏢 Suppliers -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('suppliers.*') ? 'active fw-bold' : '' }}" href="{{ route('suppliers.index') }}">
                            🏢 Suppliers
                        </a>
                    </li>

                    <!-- 🛒 Purchases -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('purchases.*') ? 'active fw-bold' : '' }}" href="{{ route('purchases.index') }}">
                            🛒 Purchases
                        </a>
                    </li>

                    <!-- 💰 Sales -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('sales.*') ? 'active fw-bold' : '' }}" href="{{ route('sales.index') }}">
                            💰 Sales
                        </a>
                    </li>

                    <!-- 📁 Reports -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('reports.*') ? 'active fw-bold' : '' }}" href="{{ route('reports.index') }}">
                            📁 Reports
                        </a>

                        
                    </li>

                                        <!-- 👤 Users -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active fw-bold' : '' }}" href="{{ route('users.index') }}">
                            👤 Users
                        </a>
                    </li>

                    <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('activity-logs.*') ? 'active fw-bold' : '' }}" href="{{ route('activity-logs.index') }}">
        📜 Activity Logs
    </a>
</li>




                    <li class="nav-item">
    <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
        @csrf
        <!-- ✨ UPGRADE: Ginamitan ng klase na 'nav-link btn border-0 py-2' para makuha ang saktong font, kulay gray, at alignment ng Reports link mo bro -->
        <button type="submit" class="nav-link btn border-0 py-2 text-start text-lg-center" style="background: none;">
            🚪 Logout
        </button>
    </form>
</li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- 🏛️ THE MAIN CONTAINER FOR YOUR CONTENT -->
    <main class="main-content-wrapper flex-grow-1">
        <!-- Dito ipinapasok ng Laravel ang mga table at porma natin galing sa index.blade files -->
        @yield('content')
    </main>




    <!-- 🧦 GLOBAL FOOTER COMPONENT (Static Sticky Footer Pattern) -->
    <footer class="bg-dark text-white text-center p-3 mt-auto w-100 shadow-lg flex-shrink-0">
        <p class="m-0">&copy; 2026 Inventory Management System</p>
    </footer>


    <!-- INIWAN ANG SAKTONG JS BUNDLE VERSION MO BRO -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
