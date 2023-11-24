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
                    {{--  <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2 !px-3"
                        href="{{ route('area-products.create') }}">
                        <iconify-icon icon="ic:round-plus" class="text-lg mr-1">
                        </iconify-icon>
                        {{ __('New') }}
                    </a> --}}
                    {{--      @endcan --}}
                    {{-- Refresh Button start --}}
                    <a class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2.5"
                        href="{{ route('area-products.index') }}">
                        <iconify-icon icon="mdi:refresh" class="text-xl "></iconify-icon>
                    </a>
                </div>
                <div class="justify-center flex flex-wrap sm:flex items-center lg:justify-end gap-3">
                    <div class="relative w-full sm:w-auto flex items-center">
                        <form id="searchForm" method="get" action="{{ route('area-products.index') }}">
                            <input name="q" type="text"
                                class="inputField pl-8 p-2 border border-slate-200 dark:border-slate-700 rounded-md dark:bg-slate-900"
                                placeholder="Search" value="{{ request()->q }}">
                        </form>
                        <iconify-icon class="absolute text-textColor left-2 dark:text-white"
                            icon="quill:search-alt"></iconify-icon>
                    </div>
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
                                            Area
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Producto
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="table-th w-20">
                                            {{ __('Acciones') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @forelse ($asigments as $asigment)
                                        <tr>
                                            <td class="table-td">
                                                # {{ $loop->iteration }}
                                            </td>

                                            <td class="table-td">
                                                {{ $asigment->area->name }}
                                            </td>
                                            <td class="table-td">
                                                {{ $asigment->product->name }}
                                            </td>
                                            <td class="table-td">
                                                {{ $asigment->count }}
                                            </td>
                                            <td class="table-td">
                                                <div class="flex gap-2">

                                                    <div class="flex space-x-3 rtl:space-x-reverse">
                                                        <button class="action-btn" data-bs-toggle="modal"
                                                            data-bs-target="#searchModal{{ $asigment->id }}">
                                                            <iconify-icon icon="material-symbols:edit"></iconify-icon>
                                                        </button>
                                                        <div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto inset-0 bg-slate-900/40"
                                                            id="searchModal{{ $asigment->id }}" tabindex="-1"
                                                            aria-labelledby="searchModalLabel" aria-hidden="true">
                                                            <div
                                                                class="modal-dialog relative w-auto pointer-events-none top-1/4">
                                                                <div
                                                                    class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
                                                                    <div for="amount"
                                                                        class="p-4 border-b text-xl bg-dark-500">
                                                                        Actualizar asignaci&oacute;n</div>
                                                                    <form class="flex flex-col p-8 gap-3"
                                                                        action="{{ route('area-products.update', $asigment) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="relative">
                                                                            <label for="amount">Nueva
                                                                                asignacion:</label>
                                                                            <input type="text"
                                                                                class="form-control p-5"
                                                                                placeholder="Cantidad" autofocus
                                                                                name="amount"
                                                                                value="{{ $asigment->count }}">
                                                                        </div>
                                                                        <button
                                                                            class="btn inline-flex justify-center btn-dark rounded-[25px] items-center"
                                                                            href="{{ route('products.create') }}">
                                                                            <iconify-icon icon="material-symbols:edit"
                                                                                class="text-lg mr-1">
                                                                            </iconify-icon>
                                                                            {!! __('Actualizar asignaci&oacute;n') !!}
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    {{-- view --}}
                                                    @can('product show')
                                                        <a class="action-btn"
                                                            href="{{ route('area-products.show', $asigment) }}">
                                                            <iconify-icon icon="heroicons:eye"></iconify-icon>
                                                        </a>
                                                    @endcan
                                                    {{-- Edit --}}

                                                    <a class="action-btn"
                                                        href="{{ route('area-products.edit', $asigment) }}">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </a>
                                                    {{--          @endcan --}}
                                                    {{-- delete --}}
                                                    {{--  @can('product delete') --}}
                                                    <form id="deleteForm{{ $asigment->id }}" method="POST"
                                                        action="{{ route('area-products.destroy', $asigment) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="action-btn cursor-pointer"
                                                            onclick="sweetAlertDelete(event, 'deleteForm{{ $asigment->id }}')"
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
                            <x-table-footer :per-page-route-name="'products.index'" :data="$asigments" />
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
                    title: "¿Desea ejecutar esta opración?",
                    icon: 'question',
                    showDenyButton: true,
                    confirmButtonText: "Aceptar",
                    denyButtonText: "Cancelar",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            }
        </script>
    @endpush
</x-app-layout>
