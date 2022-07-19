@extends('layouts.main')
@section('title',$category->title)
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="/styles/categories.css">
    <link rel="stylesheet" type="text/css" href="/styles/categories_responsive.css">
@endsection

@section('custom_js')
    <script src="/js/categories.js"></script>
{{--    <script src="/js/sort-items.js"></script>--}}
    <script>
        $(document).ready(function () {
            $(".product_sorting_btn").click(function () {
                let dataOptions = $(this).attr("data-isotope-option");
                let dataOption = JSON.parse(dataOptions);
                $.ajax({
                    url: "{{route('showCategory',$category->alias)}}",
                    type: 'GET',
                    data: {
                        sortBy: dataOption.sortBy,
                        page: {{isset($_GET['page']) ? $_GET['page'] : 1}}
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (data) => {
                        console.log(data);
                        let positionParameters = location.pathname.indexOf('?');
                        let url = location.pathname.substring(positionParameters,location.pathname.length);
                        let newUrl = url + '?';
                        newUrl += 'sortBy=' + dataOption.sortBy + "&page={{isset($_GET['page']) ? $_GET['page'] : 1}}";
                        history.pushState({}, '', newUrl);

                        $(".product_grid").html(data);
                        $(".product_grid").isotope('destroy');
                        // $(".product_grid").imagesLoaded ( function () )
                        $(".product_grid").isotope({
                            layoutMode: 'fitRows',
                            itemSelector: '.product',
                            percentPosition: true,
                            fitRows: {
                                gutter: 30
                            }
                        })
                    },
                })
            })
        });
    </script>
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_container">
            <div class="home_background" style="background-image:url(/images/{{$category->image}})"></div>
            <div class="home_content_container">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="home_content">
                                <div class="home_title">{{$category->title}}<span>.</span></div>
                                <div class="home_text">{!!$category->description!!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products -->

    <div class="products">
        <div class="container">
            <div class="row">
                <div class="col">

                    <!-- Product Sorting -->
                    <div
                        class="sorting_bar d-flex flex-md-row flex-column align-items-md-center justify-content-md-start">
                        <div class="results">Showing <span>{{$products->count()}} of {{$category->products->count()}}
                            </span> results
                        </div>
                        <div class="sorting_container ml-md-auto">
                            <div class="sorting">
                                <ul class="item_sorting">
                                    <li>
                                        <span class="sorting_text">Sort by</span>
                                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                                        <ul>
                                            <li class="product_sorting_btn"
                                                data-isotope-option='{ "sortBy": "original-order" }'>
                                                <span>Default</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price-low-high" }'>
                                                <span>Price Low-High</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "price-high-low" }'>
                                                <span>Price High-Low</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "name-a-z" }'>
                                                <span>Name A-Z</span></li>
                                            <li class="product_sorting_btn" data-isotope-option='{ "sortBy": "name-z-a" }'>
                                                <span>Name Z-A</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <div class="product_grid">

                        <!-- Product -->
                        @foreach($products as $product)
                            @php
                                $image = '';
                                if(count($product->images) > 0) {
                                    $image = $product->images[0]['img'];
                                } else {
                                    $image = 'no_image.png';
                                }
                            @endphp
                            <div class="product">
                                <div class="product_image"><img src="images/{{$image}}" alt="{{$product->title}}"></div>
                                <div class="product_extra product_new">
                                    <a href="{{route('showCategory',$product->category['alias'])}}">{{$product->category['title']}}</a>
                                </div>
                                <div class="product_content">
                                    <div class="product_title">
                                        <a href="{{route('showItem',['category', $product->alias])}}">{{$product->title}}</a>
                                    </div>
                                    @if($product->new_price > 0)
                                        <div style="text-decoration: line-through">${{$product->price}}</div>
                                        <div class="product_price">${{$product->new_price}}</div>
                                    @else
                                        <div class="product_price">${{$product->price}}</div>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{$products->appends(request()->query())->links('pagination.index')}}

                </div>
            </div>
        </div>
    </div>

    <!-- Icon Boxes -->
    @include('layouts.icon_boxes')
    @include('layouts.newsletter')
@endsection
