@props(['dish'])

<p {{ $attributes(['class' => '']) }}>
    @foreach ($dish->products as $product)
        {{ ucwords($product->name) . ', ' }}
    @endforeach
</p>