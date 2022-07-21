<div class="sidebar sidebar-style-2">			
	<div class="sidebar-wrapper scrollbar scrollbar-inner">
		<div class="sidebar-content">
			<div class="user">
				<div class="avatar-sm float-left mr-2">
					<img src="{{asset('gambar/logo/logoAdmin.png')}}" alt="..." class="avatar-img rounded-circle">
				</div>
				<div class="info">
					<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
						<span>
							Munzalan Store
							<span class="user-level">Admin</span>
							<span class="caret"></span>
						</span>
					</a>
					<div class="clearfix"></div>

					<div class="collapse in" id="collapseExample">
						<ul class="nav">
							<li>
								<a href="#profile">
									<span class="link-collapse">My Profile</span>
								</a>
							</li>
							<li>
								<a href="#edit">
									<span class="link-collapse">Edit Profile</span>
								</a>
							</li>
							<li>
								<a href="#settings">
									<span class="link-collapse">Settings</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<ul class="nav nav-primary">
				<li class="nav-item {{request()->is('dashboard') ? 'active' : ''}}">
					<a href="/dashboard">
						<i class="fas flaticon-shapes"></i>
						<p>Dashboard</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('kategori') ? 'active' : ''}}">
					<a href="/kategori">
						<i class="fas flaticon-customer-support"></i>
						<p>Kategori</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('produk') ? 'active' : ''}}">
					<a href="/produk">
						<i class="fas flaticon-customer-support"></i>
						<p>Produk</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('pesananPelanggan') ? 'active' : ''}}">
					<a href="/pesananPelanggan">
						<i class="fas flaticon-presentation"></i>
						<p>Pesanan</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('pesanLangsung') ? 'active' : ''}}">
					<a href="/pesanLangsung">
						<i class="fas flaticon-agenda-1"></i>
						<p>Pesanan Langsung</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('pengguna') ? 'active' : ''}}">
					<a href="/pengguna">
						<i class="fas flaticon-presentation"></i>
						<p>Pengguna</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('laporanPenjualan') ? 'active' : ''}}">
					<a href="/laporanPenjualan">
						<i class="fas flaticon-presentation"></i>
						<p>Laporan Penjualan</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('pengaturanSlide') ? 'active' : ''}}">
					<a href="/pengaturanSlide">
						<i class="fas flaticon-presentation"></i>
						<p>Pengaturan Slide</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('pengaturanIklan') ? 'active' : ''}}">
					<a href="/pengaturanIklan">
						<i class="fas flaticon-presentation"></i>
						<p>Iklan</p>
					</a>
				</li>
				<li class="nav-item {{request()->is('tentangKami') ? 'active' : ''}}">
					<a href="/tentangKami">
						<i class="fas flaticon-agenda-1"></i>
						<p>Tentang Kami</p>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>