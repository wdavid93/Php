<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nos produits') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto py-8">
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($products as $product)
                    <div tabindex="0" class="focus:outline-none mx-2 w-72">
                        <div>
                            <img alt="Image du produit" src="{{ $product->image }}" tabindex="0" class="focus:outline-none w-full h-44 object-cover" />
                        </div>
                        <div class="bg-white shadow-md rounded-lg overflow-hidden">
                            <div class="flex items-center justify-between px-4 pt-4">
                                <div class="bg-yellow-200 py-1.5 px-6 rounded-full">
                                    <p tabindex="0" class="focus:outline-none text-xs text-yellow-700">{{ $product->formatted_price }}</p>
                                </div>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center">
                                    <h2 tabindex="0" class="focus:outline-none text-lg font-semibold">{{ $product->name }}</h2>
                                </div>
                                <p tabindex="0" class="focus:outline-none text-xs text-gray-600 mt-2">{{ $product->description }}</p>
                                <add-to-cart :product-id="{{ $product->id }}"></add-to-cart>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
