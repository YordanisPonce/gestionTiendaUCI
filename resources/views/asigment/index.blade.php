@php
    $date = request()->query('date');
@endphp

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
            <header class="card-header noborder justify-start">
                <span>
                    <label class="relative" for="range-picker2">
                        <span class="z-40 cursor-pointer">
                            <iconify-icon icon="clarity:calendar-solid"></iconify-icon>
                        </span>
                        <input
                            class="z-30 form-control py-2 flatpickr flatpickr-input active absolute top-[-10px] invisible"
                            id="range-picker2" {{-- data-mode="range" --}} value="" type="text" readonly="readonly">
                    </label>
                </span>
                @if ($date)
                    <a href="{{ route('area-products.index') }}" class="btn btn-sm mr-auto">
                        <iconify-icon icon="radix-icons:cross-1"></iconify-icon>
                    </a>
                @endif
                <button onclick="exportToExcel()">
                    <span class="z-40 cursor-pointer">
                        <iconify-icon icon="ph:export"></iconify-icon>
                    </span>
                    </button>
            </header>
            <div class="card-body px-6 pb-6">
                <div class="overflow-x-auto -mx-6">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700" id="tableToExport">
                                <thead class="bg-slate-200 dark:bg-slate-700">
                                    <tr>
                                        <th scope="col" class="table-th ">
                                            {{ __('#') }}
                                        </th>
                                        <th scope="col" class="table-th ">
                                            Area
                                        </th>
                                        @foreach ($products as $item)
                                            <th scope="col" class="table-th ">
                                                {{ $item->name }}
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @forelse ($areas as $area)
                                        <tr>
                                            <td class="table-td">
                                                # {{ $loop->iteration }}
                                            </td>
                                            <td class="table-td">
                                                {{ $area['name'] }}
                                            </td>
                                            @foreach ($area['amountProducts'] as $amount)
                                                <td class="table-td">
                                                    {{ $amount }}
                                                </td>
                                            @endforeach
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
        @vite(['resources/js/plugins/flatpickr.js'])
        <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.4/dist/xlsx.full.min.js"></script>
        <script type="module">
            // flatpickr
            $(".flatpickr").flatpickr({
                dateFormat: "Y-m-d",
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                        longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    },
                    months: {
                        shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Оct', 'Nov', 'Dic'],
                        longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                        ],
                    },
                },
                onClose: (selectedDates, dateStr, instance) => {
                    const id = instance?.input?.id;
                    // Obtén la URL actual
                    var url = new URL(window.location.href);

                    // Obtiene los parámetros de consulta actuales
                    var queryParams = new URLSearchParams(url.search);

                    // Acciones a realizar cuando se actualiza el rango de fechas
                    let dates = dateStr.substring(dateStr.lastIndexOf(':'));
                    dates = dates.split("to").map(el => el.trim());
                    if (dates.length && dates[0]) {
                        // Agrega o actualiza los parámetros de consulta deseados
                        queryParams.set('date', dates);
                        // Crea una nueva URL con los parámetros actualizados
                        var nuevaUrl = url.origin + url.pathname + '?' + queryParams.toString();
                    }

                    nuevaUrl && (window.location.href = nuevaUrl);
                }
            });
        </script>
        <script>
            function exportToExcel() {
                var table = document.getElementById('tableToExport');
                var workbook = XLSX.utils.table_to_book(table);
                var excelBuffer = XLSX.write(workbook, {
                    bookType: 'xlsx',
                    type: 'array'
                });
                var blob = new Blob([excelBuffer], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var url = URL.createObjectURL(blob);
                var link = document.createElement('a');
                link.href = url;
                link.download = 'tabla.xlsx';
                link.click();
            }


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
