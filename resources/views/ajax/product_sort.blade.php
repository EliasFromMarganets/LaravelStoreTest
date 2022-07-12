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