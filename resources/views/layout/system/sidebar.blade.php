   <!-- /.search form -->
   <!-- sidebar menu: : style can be found in sidebar.less -->
   <ul class="sidebar-menu">
       <li class="header">MAIN NAVIGATION</li>
       @php
           $menus = [
               [
                   'route' => 'home.index',
                   'icon' => 'fa fa-home',
                   'label' => 'Beranda',
                   'header' => false,
               ],
               // Menambahkan menu 'User' jika role adalah 'admin'
               [
                   'route' => 'profile.profile',
                   'icon' => 'fa fa-user',
                   'label' => 'Profile',
                   'header' => 'SETTING',
               ],
               [
                   'route' => 'logout',
                   'icon' => 'fa fa-sign-out',
                   'label' => 'Keluar',
                   'header' => false,
               ],
           ];

           // Menambahkan menu 'User' setelah 'Dashboard' jika role adalah 'admin'
           if (Auth::user()->role == 'admin') {
               array_splice($menus, 1, 0, [
                   [
                       'route' => 'user.index',
                       'icon' => 'fa fa-users',
                       'label' => 'Data User',
                       'header' => false,
                   ],
                   [
                       'route' => 'kategori.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Kategori Aset',
                       'header' => false,
                   ],
                   [
                       'route' => 'jenisbarang.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Jenis Barang',
                       'header' => false,
                   ],
               ]);
           } elseif (Auth::user()->role == 'pegawai') {
               array_splice($menus, 1, 0, [
                   [
                       'route' => 'asettetap.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Aset Tetap',
                       'header' => false,
                   ],
                   [
                       'route' => 'asettidaktetap.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Aset Tidak Tetap',
                       'header' => false,
                   ],
                   [
                       'route' => 'penghapusanaset.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Penghapusan Aset',
                       'header' => false,
                   ],
               ]);
           } elseif (Auth::user()->role == 'walinagari') {
               array_splice($menus, 1, 0, [
                   [
                       'route' => 'asettetap.indexwali',
                       'icon' => 'fa fa-table',
                       'label' => 'Aset Tetap',
                       'header' => false,
                   ],
                   [
                       'route' => 'asettidaktetapwali.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Aset Tidak Tetap',
                       'header' => false,
                   ],
                   [
                       'route' => 'penghapusanasetwali.index',
                       'icon' => 'fa fa-table',
                       'label' => 'Penghapusan Aset',
                       'header' => false,
                   ],
               ]);
           }
       @endphp


       @foreach ($menus as $menu)
           @if ($menu['header'])
               <li class="header">{{ $menu['header'] }}</li>
           @endif
           <li class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}">
               <a href="{{ route($menu['route']) }}">
                   <i class="{{ $menu['icon'] }}"></i>
                   <span>{{ $menu['label'] }}</span>
               </a>
           </li>
       @endforeach
   </ul>
