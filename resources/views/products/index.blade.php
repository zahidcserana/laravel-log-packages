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
                    <div class="list-group">
                        @foreach ($products as $product)
                            <a href="{{ route('product.edit', ['product' => $product]) }}" class="list-group-item">
                                {{ $product->name }}
                            </a>
                            |
                            <a href="{{ route('product.activitylog', ['product' => $product]) }}" class="">
                                activitylog
                            </a>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
