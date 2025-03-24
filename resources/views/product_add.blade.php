<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="POST" action="{{route('product.store')}}" class="w-[90%] max-w-[500px] bg-white text-black p-7 mx-auto my-7 flex flex-col gap-7">
        @csrf
        <h1 class="text-center text-2xl font-bold">Add Product</h1>

        @if ( session('success') )
            <span class="success text-green-500 text-center">{{ session('success') }}</span>
        @endif

        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="productName">Name: </label>
            <input
                class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md"
                id="productName" name="productName" type="text" placeholder="Lamborghini">
        </div>
        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="price">Price: </label>
            <input
                class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md"
                id="price" name="price" type="text" placeholder="200">
        </div>
        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="quantity">Quantity: </label>
            <input
                class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md"
                id="quantity" name="quantity" type="text" placeholder="99">
        </div>

        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="warranty">Warranty: </label>
            <input
                class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md"
                id="warranty" name="warranty" type="text" placeholder="99">
        </div>

        <input type="hidden" name="category_id" value="1">
        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="productCategory">Category: </label>
            {{-- <input class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md" id="productCategory" name="productCategory" type="text" placeholder="Car"> --}}
            <div x-data="{ open: false, selected: 'Options' }" class="relative w-full inline-block text-left">
                <div>
                    <button @click="open = !open" type="button"
                        class="inline-flex w-full justify-between gap-x-1.5 rounded-md bg-white text-gray-800 px-3 py-2 text-sm shadow-md hover:bg-gray-50"
                        id="menu-button" aria-expanded="true" aria-haspopup="true">
                        <span x-text="selected"></span>
                        <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path fill-rule="evenodd"
                                d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div x-show="open" @click.outside="open = false" class="absolute right-0 z-10 mt-2 origin-top-right w-full rounded-md bg-white ring-1 shadow-lg ring-black/5"
                    role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                        <button type="button" @click="selected = 'Account settings'; open = false" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Account settings</button>
                        <button type="button" @click="selected = 'Support'; open = false" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">Support</button>
                        <button type="button" @click="selected = 'License'; open = false" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1">License</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex justify-center items-start flex-col gap-2">
            <label class="text-sm text-gray-600" for="description">Description: </label>
            <textarea
                class="focus:outline-hidden focus:border-4 focus:border-transparent focus:border-b-indigo-600 border-transparent transition-colors duration-300 ease-in-out text-md px-5 py-2 rounded-md w-full shadow-md min-w-full max-w-full min-h-[200px]"
                id="description" name="description" type="text" placeholder="Car"></textarea>
        </div>
        <div class="flex justify-end">
            <input
                class="bg-gray-800 text-white px-4 py-2 rounded-md cursor-pointer transition-colors hover:bg-gray-600"
                type="submit" value="Submit" name="submit" id="submit">
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
