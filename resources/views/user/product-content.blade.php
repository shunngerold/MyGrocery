<!DOCTYPE html>
<html lang="en">
<head>
    <x-head-links />
    <title>Products | MyGrocery</title>
</head>
<body>
    {{-- Navigator --}}
    @include('partials._nav')

    <div class="flex flex-wrap justify-center items-center md:mt-24 mt-40 mb-16 gap-8">
        @unless(count($products) == 0)
            @foreach ($products as $product)
                {{-- Pass the data to another file --}}
                <x-product-template :product="$product" />
            @endforeach
        @else
            <p>No Products Found</p>
        @endunless
    </div>

    <div class="m-10 pt-4">
        {{$products->links()}}
    </div>

    <x-foot-links />
</body>
</html>