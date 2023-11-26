@extends('layouts.base')

@section('content')


<section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3>Wishlist</h3>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('app.index') }}">
                                <i class="fas fa-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Cart Section Start -->
<section class="cart-section section-b-space">
    <div class="container">
        @if ($items->count() > 0)
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <table class="table cart-table">
                        <thead>
                            <tr class="table-head">
                                <th scope="col">image</th>
                                <th scope="col">product name</th>
                                <th scope="col">price</th>
                                <th scope="col">availability</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($items as $item)

                                <tr>
                                    <td>
                                        <a href="{{ route('shop.product.details', ['slug' => $item->model->slug]) }}">
                                            <img src="{{ asset('assets/images/fashion/product/front') }}/{{ $item->model->image }}" class="blur-up lazyloaded"
                                                alt="">
                                        </a>
                                    </td>


                                    <td>
                                        <a href="{{ route('shop.product.details', ['slug' => $item->model->slug]) }}">{{ $item->model->name }}</a>
                                        <div class="mobile-cart-content row">
                                            <div class="col">
                                                <div class="qty-box">
                                                    <div class="input-group">
                                                        <input type="text" name="quantity" class="form-control input-number"
                                                            value="1">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <h2>${{ $item->model->regular_price }}</h2>
                                            </div>
                                            <div class="col">
                                                <h2 class="td-color">
                                                    <a href="javascript:void(0)">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </h2>
                                            </div>
                                        </div>
                                    </td>



                                    <td>
                                        <h2>${{ $item->model->regular_price }}</h2>
                                    </td>



                                    <td>
                                        @if ($item->model->stock_status == "instock")
                                            <p>In Stock</p>
                                        @else
                                            <p>Out of Stock</p>                                            
                                        @endif
                                    </td>



                                    <td>
                                        @if ($item->model->stock_status == 'instock')         
                                            <a href="javascript:void(0)" class="icon" onclick="moveToCart('{{ $item->rowId }}')">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="icon disabled">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        @endif

                                        <a href="javascript:void(0)" class="icon" onclick="removeFromWishlist('{{ $item->rowId }}')">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </td>



                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 text-center mt-4">
                    <a href="javascript:void(0)" onclick="clearWishlist()">Clear All Wishlist Items</a>
                </div>
            </div>

        @else

            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Your wishlist is empty</h2>
                    <h5 class="mt-3">Add items to it now!</h5>
                    <a href="{{ route('shop.index') }}" class="btn btn-warning mt-5">Shop Now</a>
                </div>
            </div>

        @endif

    </div>
</section>


<form action="{{ route('wishlist.remove') }}" id="deleteFromWishlist" method="POST">
    @csrf
    @method('delete')
    <input type="hidden" name="rowId" id="rowId">
</form>


<form action="{{ route('wishlist.clear') }}" id="clearWishlist" method="POST">
    @csrf
    @method('delete')
</form>

<form action="{{ route('wishlist.move.to.cart') }}" id="moveToCart" method="POST">
    @csrf
    <input type="hidden" name="rowId" id="mrowId">
</form>


@endsection

@push('scripts')
    <script>
        function removeFromWishlist(rowId)
        {
            $("#rowId").val(rowId);
            $("#deleteFromWishlist").submit();
        }

        function clearWishlist()
        {
            $("#clearWishlist").submit();
        }

        function moveToCart(rowId)
        {
            $("#mrowId").val(rowId)
            $("#moveToCart").submit();
        }

    </script>
@endpush