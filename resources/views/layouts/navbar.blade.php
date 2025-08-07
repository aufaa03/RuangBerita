<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-sm shadow-sm">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-primary-600">RuangBerita</a>

            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary-600 font-medium">Dashboard</a>


                    <button id="avatar-button"
                        class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center text-primary-600 font-bold text-sm">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </button>

                    <div id="dropdown-menu"
                        class="absolute hidden right-0 mt-28 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                class="block w-full text-left px-4 py-2  text-sm text-gray-700 hover:bg-gray-100"
                                onclick="  event.preventDefault(); 
       if(confirm('Apakah Anda yakin ingin keluar?')) {
           this.closest('form').submit();
       }">
                                Logout
                            </a>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-primary-600 font-medium">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="px-3 py-1.5 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-md">Daftar</a>
                @endauth
            </div>
        </div>
    </div>
</header>
