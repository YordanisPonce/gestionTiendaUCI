<x-app-layout>
    <div>
        {{-- Breadcrumb start --}}
        <div class="mb-6">
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />
        </div>
        {{-- Breadcrumb end --}}

        {{-- Create area form start --}}
        <form method="POST" action="{{ route('areas.asignProduct', $area) }}" class="max-w-4xl m-auto">
            @csrf

            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="select2basic" class="form-label">Productos</label>
                        <select name="product_id" id="select2basic" class="select2 form-control w-full mt-2 py-2">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}"
                                    class=" inline-block font-Inter font-normal text-sm text-slate-600">
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @if (count($products))
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-fit">
                    {{ __('Save Changes') }}
                </button>
                @endif
            </div>

        </form>
        {{-- Create area form end --}}
    </div>
</x-app-layout>
