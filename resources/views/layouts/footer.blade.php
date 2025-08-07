 <footer class="bg-gray-800 text-white mt-12">
     <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
         <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
             <div class="col-span-1 md:col-span-2">
                 <h4 class="text-lg font-bold mb-4">RuangBerita</h4>
                 <p class="text-gray-400">Selamat datang di Ruang Berita, platform informasi
                     digital yang berkomitmen menyajikan berita akurat, mendalam, dan terverifikasi.
                     Kami hadir untuk menjadi ruang terpercaya Anda dalam memahami dunia</p>
             </div>
             <div>
                 <h4 class="text-lg font-bold mb-4">Navigasi</h4>
                 <ul class="space-y-2">
                     <li><a href="#" class="text-gray-400 hover:text-white">Artikel</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-white">Tentang Saya</a></li>
                     <li><a href="#" class="text-gray-400 hover:text-white">Kontak</a></li>
                 </ul>
             </div>
             <div>
                 <h4 class="text-lg font-bold mb-4">Ikuti Saya</h4>
                 <div class="flex space-x-4">
                     <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></a>
                     <a href="#" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-github"></i></a>
                     <a href="#" class="text-gray-400 hover:text-white text-xl"><i
                             class="fab fa-linkedin"></i></a>
                 </div>
             </div>
         </div>
         <div class="border-t border-gray-700 pt-8 text-center text-gray-400 text-sm">
             &copy; {{ date('Y') }} RuangBerita. All Rights Reserved.
         </div>
     </div>
 </footer>

 <script>
     // Ambil elemen tombol dan menu dari HTML menggunakan ID-nya
     const avatarButton = document.getElementById('avatar-button');
     const dropdownMenu = document.getElementById('dropdown-menu');

     // Tambahkan event listener saat tombol avatar di-klik
     avatarButton.addEventListener('click', () => {
         // Toggle (tambah/hapus) class 'hidden' pada menu dropdown
         dropdownMenu.classList.toggle('hidden');
     });

     // Tambahkan event listener untuk menutup menu saat mengklik di luar area menu
     window.addEventListener('click', (event) => {
         // Cek apakah yang di-klik BUKAN tombol avatar DAN BUKAN bagian dari menu dropdown
         if (!avatarButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
             // Jika ya, sembunyikan menu dengan menambahkan class 'hidden'
             dropdownMenu.classList.add('hidden');
         }
     });
 </script>
