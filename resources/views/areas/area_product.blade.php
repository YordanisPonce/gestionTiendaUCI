<x-app-layout>
    <div>
        <div class=" mb-6">
            {{-- Breadcrumb start --}}
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />

        </div>

        {{-- Alert start --}}
        @if (session('message'))
            <x-alert :message="session('message')" :type="'success'" />
        @endif
        {{-- Alert end --}}


        <div class="card">
            <header class=" card-header noborder">
                <div class="justify-end flex gap-3 items-center flex-wrap">
                    {{-- Create Button start --}}
                    {{--  @can('product create') --}}
                    <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2 !px-3"
                        href="{{ route('areas.asign', ['area' => $area]) }}">
                        <iconify-icon icon="ic:round-plus" class="text-lg mr-1">
                        </iconify-icon>
                        {{ __('New') }}
                    </a>
                    {{--      @endcan --}}
                    {{-- Refresh Button start --}}
                    <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2.5"
                        href="{{ route('areas.show', ['area' => $area]) }}">
                        <iconify-icon icon="mdi:refresh" class="text-xl "></iconify-icon>
                    </a>
                </div>
            </header>
            <div class="card-body px-6 pb-6">
                <div class="overflow-x-auto -mx-6">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                <thead class="bg-slate-200 dark:bg-slate-700">
                                    <tr>
                                        <th scope="col" class="table-th ">
                                            {{ __('#') }}
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Nombre
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Formato
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Precio
                                        </th>
                                        <th scope="col" class="table-th ">
                                            {{ __('Creado') }}
                                        </th>
                                        <th scope="col" class="table-th w-20">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @forelse ($products as $product)
                                        <tr>
                                            <td class="table-td">
                                                # {{ $product->id }}
                                            </td>
                                            <td class="table-td">
                                                <div class="flex items-center">
                                                    <div class="flex-none">
                                                        <div class="w-8 h-8 rounded-[100%] ltr:mr-3 rtl:ml-3">
                                                            <img class="w-full h-full rounded-[100%] object-cover"
                                                                src="{{ Avatar::create($product->name)->toBase64() }}"
                                                                alt="image">
                                                        </div>
                                                    </div>
                                                    <div class="flex-1 text-start">
                                                        <h4
                                                            class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                                            {{ $product->name }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="table-td">
                                                {{ $product->amount }}
                                            </td>
                                            <td class="table-td">
                                                {{ $product->format }}
                                            </td>
                                            <td class="table-td">
                                                {{ $product->price }}
                                            </td>
                                            <td class="table-td">
                                                {{ $product->created_at->diffForHumans() }}
                                            </td>
                                            <td class="table-td">
                                                <div class="flex space-x-3 rtl:space-x-reverse">
                                                    {{-- view --}}
                                                    @can('product show')
                                                        <a class="action-btn"
                                                            href="{{ route('products.show', $product) }}">
                                                            <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                        </a>
                                                    @endcan
                                                    {{-- Edit --}}
                                                    {{--   @can('product update') --}}
                                                    <a class="action-btn"
                                                        href="{{ route('products.edit', ['product' => $product]) }}">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </a>
                                                    {{--          @endcan --}}
                                                    {{-- delete --}}
                                                    {{--  @can('product delete') --}}
                                                    <form id="deleteForm{{ $product->id }}" method="POST"
                                                        action="{{ route('products.destroy', $product) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="action-btn cursor-pointer"
                                                            onclick="sweetAlertDelete(event, 'deleteForm{{ $product->id }}')"
                                                            type="submit">
                                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                        </a>
                                                    </form>
                                                    {{--      @endcan --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="border border-slate-100 dark:border-slate-900 relative">
                                            <td class="table-cell text-center" colspan="7">
                                                <img src="images/result-not-found.svg" alt="page not found"
                                                    class="w-64 m-auto" />
                                                <h2 class="text-xl text-slate-700 mb-8 -mt-4">
                                                    {{ __('No results found.') }}</h2>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <x-table-footer :per-page-route-name="'products.index'" :data="$products" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            function sweetAlertDelete(event, formId) {
                event.preventDefault();
                let form = document.getElementById(formId);
                Swal.fire({
                    title: '@lang('Are you sure ? ')',
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: '@lang('Delete ')',
                    denyButtonText: '@lang('Cancel ')',
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            }
        </script>
    @endpush
</x-app-layout>
