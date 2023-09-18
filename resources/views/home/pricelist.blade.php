<section id="pricelist" class="background-grey">
    <div class="container">
        <div class="col-lg-6 p-t-10 m-b-20" data-animate="fadeIn" data-animate-delay="0">
            <h3 class="m-b-20">Harga Jasa Cuci</h3>
            <p>Kami menawarkan beberapa barang yang bisa di laundry.</p>
        </div>
        <nav class="grid-filter gf-outline" data-layout="#portfolio">
            <ul>
                <li class="active"><a href="#" data-category="*" data-animate="fadeInRight" data-animate-delay="0">Show All</a></li>
                @foreach($kategori as $key => $k)
                <li><a href="#" data-category=".ct-{{ str_replace(' ', '-', strtolower($k->kategori)) }}" data-animate="fadeInRight" data-animate-delay="{{ $key }}00">{{ $k->kategori }}</a></li>
                @endforeach
            </ul>
            <div class="grid-active-title">Show All</div>
        </nav>
        <div id="portfolio" class="grid-layout portfolio-3-columns grid-loaded" data-margin="20" style="margin: 0px -20px -20px 0px; position: relative; height: 997.593px;">
            @foreach($item as $key => $i)
            <div class="portfolio-item light-bg no-overlay img-zoom ct-{{ str_replace(' ', '-', strtolower($i->kategori)) }}" style="padding: 0px 20px 20px 0px; position: absolute; left: 377.328px; top: 0px;">
                <div class="portfolio-item-wrap" data-animate="fadeIn" data-animate-delay="{{ $key+3 }}00">
                    <div class="portfolio-image bg-overlay">
                        <a href="#"><img src="{{ asset('storage/assets/img/layout/'.$i->gambar) }}" style="padding: 3em 8em 3em 8em;" alt=""></a>
                    </div>
                    <hr class="p-0 m-0">
                    <div class="portfolio-description">
                        <div class="row mt-4">
                            <div class="col-8" style="padding-left: 25px;">
                                <h3 style="display: flex; align-items: left; justify-content: left;">{{ $i->nama_item }}</h3>
                                <span style="display: flex; align-items: left; justify-content: left;">@duit($i->harga)</span>
                            </div>
                            <div class="col-4" style="padding-right: 25px; display: flex; align-items: right; justify-content: right;">
                                @if($logged_user == null)
                                <a href="{{ asset('/login') }}"><button type="button" class="btn btn-info btn-sm">Cuci</button></a>
                                @else
                                <a href="{{ asset('/detail/'.$i->id_item) }}" class="lightbox-detail"><button type="button" class="btn btn-info btn-sm">Cuci</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        <div class="grid-loader"></div></div>
    </div>
</section>