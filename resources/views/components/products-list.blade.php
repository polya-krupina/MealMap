@props(['dish'])

<p {{ $attributes(['class' => '']) }}>
    @foreach ($dish->products as $product)
    @if ($product != $dish->products[$dish->products->keys()->last()])
    {{ ucwords($product->name) . ', ' }}
    @else
    {{ ucwords($product->name)}}
    @endif
    @endforeach
</p>