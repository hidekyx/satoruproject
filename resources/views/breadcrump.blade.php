<section id="page-title">
    <div id="particles-stars" class="particles"></div>
    <div class="container">
        <div class="page-title">
            <h1>{{ $page }}</h1>
            <span>{{ $subtitle }}</span>
        </div>
        <div class="breadcrumb">
            <ul>
                <li><a href="{{ asset('/') }}">Home</a>
                </li>
                <li><a href="#">{{ $page }}</a>
                </li>
            </ul>
        </div>
    </div>
</section>