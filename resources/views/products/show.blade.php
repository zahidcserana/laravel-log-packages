<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ route('product.update', ['product' => $product]) }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="productName">Product Name</label>
                            <input class="form-control" id="productName" name="name" placeholder="Product name"
                                   value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label for="productDescription">Product Description</label>
                            <textarea class="form-control" name="description" id="productDescription"
                                      rows="3">{{ $product->description }}</textarea>
                        </div>
                        <br>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control" name="category_id" id="category">
                                        @foreach(\App\Models\Product::CATEGORIES as $id => $category)
                                            <option value="{{ $id }}"
                                                    @if($product->category_id == $id) selected @endif>{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                           value="{{ $product->quantity }}">
                                </div>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                    </form>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                    <form method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger" href="#" id="edit-btn" role="button">Delete Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
