<section class="">
    <div class="container">
        <div class="heading-text heading-gradient">
            <h2><span>Ulasan Terbaru</span></h2>
            <p>Ulasan dari pelanggan yang telah melakukan jasa laundry melalui platform website</p>
        </div>
        <div class="carousel arrows-visibile testimonial testimonial-single testimonial-left mb-0 pb-0" data-items="1" data-autoplay="true" data-loop="true" data-autoplay="3500">
            @foreach($review as $r)
            <div class="testimonial-item mb-0 background-grey" style="border: 1px solid; border-radius: 15px;">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="carousel dots-inside arrows-visible arrows-only" data-items="1" data-loop="true" data-autoplay="true" data-lightbox="gallery">
                            @foreach($r->detail as $d)
                            <a href="{{ asset('storage/hasil_cuci/'.$d->foto_hasil) }}" data-lightbox="gallery-image">
                                <img alt="{{ $d->item->nama_item }} - {{ $d->merk }} - {{ $d->seri }}" src="{{ asset('storage/hasil_cuci/'.$d->foto_hasil) }}">
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <p style="font-size: 16px;">"{{ $r->ulasan }}"</p>
                        <div class="product-rate mt-0 pt-0 mb-3 text-warning">
                            @for($i=0; $i < $r->rate; $i++)
                                <i class="fa fa-star"></i>
                            @endfor
                        </div>
                        <span>Ulasan oleh:</span><br>
                        <span style="font-weight: 500;">{{ $r->user->nama }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>