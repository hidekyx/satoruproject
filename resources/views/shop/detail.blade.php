<div class="ajax-quick-view" style="padding: 20px">
	<div class="quick-view-content">
		<div class="product">
			<div class="row">
				<div class="col-lg-5">
					<div class="carousel" data-items="1">
						<img src="{{ asset('storage/assets/img/layout/'.$item->gambar) }}" style="padding: 6em;" alt="">
					</div>
				</div>
				<div class="col-lg-7">
					<div class="product-description">
						<div class="product-category">{{ $item->kategori }}</div>
						<div class="product-title"><h3><a href="#">{{ $item->nama_item }}</a></h3></div>
						<div class="product-price"><ins>@duit($item->harga)</ins></div>
						<div class="seperator m-b-10 mt-0"></div>
					</div>
                    <form role="form" class="text-start" action="{{ asset('/keranjang/tambah/'.$item->id_item); }}" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="merk">Merk / Brand</label>
                                <input type="text" class="form-control" name="merk" placeholder="Isikan merk atau brand barang" required="">
                            </div>
                            <div class="form-group col-12">
                                <label for="seri">Tipe / Series</label>
                                <input type="text" class="form-control" name="seri" placeholder="Isikan tipe atau seri barang" required="">
                            </div>
                        </div>
                        <div class="m-t-20">
                            <button class="btn btn-lg btn-info" type="submit"><i class="icon-shopping-cart"></i> Tambah ke Keranjang</button>
                        </div>
                    </form>
				</div>
			</div>
		</div>
	</div>
</div>