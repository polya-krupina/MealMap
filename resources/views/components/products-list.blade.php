@props(['dish'])

<p {{ $attributes(['class' => '']) }}>
    @foreach ($dish->products as $product)
        {{ $product->name . ', ' }}
    @endforeach
</p>