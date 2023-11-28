@php

    $areaId = request()->query('area');
    $productId = request()->query('product');
@endphp

<x-app-layout>
    <div class="space-y-8">
        <div class="block sm:flex items-center justify-between mb-6">
            <x-breadcrumb :pageTitle="$pageTitle" />
        </div>
        {{-- Dashboard Top Card --}}
        <div class="grid sm:grid-cols-2 xl:grid-cols-4 gap-7">
            <div class="dasboardCard bg-white dark:bg-slate-800 rounded-md px-5 py-4 flex items-center justify-between bg-center bg-cover bg-no-repeat"
                style="background-image:url('{{ asset('/images/ecommerce-wid-bg.png') }}')">
                <div class="w-56 ">
                    <h3 class="font-Inter font-normal text-white text-lg">
                        {{ __('Buenas noches') }},
                    </h3>
                    <h3 class="font-Interfont-medium text-white text-2xl pb-2">
                        {{ auth()->user()->name }}
                    </h3>
                    <p class="font-Intertext-base text-white font-normal">
                        {{ __('Bienvenido a ' . config('app.name')) }}
                    </p>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-md px-5 py-4 ">
                <div class="pl-14 relative">
                    <div
                        class="w-10 h-10 rounded-full bg-sky-100 text-sky-800 text-base flex items-center justify-center absolute left-0 top-2">
                        <iconify-icon icon="ph:shopping-cart-simple-bold"></iconify-icon>
                    </div>
                    <h4 class="font-Interfont-normal text-sm text-textColor dark:text-white pb-1">
                        {{ __('Asignaciones') }}
                    </h4>
                    <p class="font-Intertext-xl text-black dark:text-white font-medium">
                        {{ $data['revenue']['total'] }}
                    </p>
                </div>
                <div class="ml-auto w-24">
                    <div id="EChart"></div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-md px-5 py-4 ">
                <div class="pl-14 relative">
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-800 text-base flex items-center justify-center absolute left-0 top-2">
                        <iconify-icon icon="fluent-mdl2:product-variant"></iconify-icon>
                    </div>
                    <h4 class="font-Interfont-normal text-sm text-textColor dark:text-white pb-1">
                        {{ __('Productos') }}
                    </h4>
                    <p class="font-Intertext-xl text-black dark:text-white font-medium">
                        {{ $data['productSold']['total'] }}
                    </p>
                </div>
                <div class="ml-auto w-24">
                    <div id="EChart2"></div>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-md px-5 py-4 ">
                <div class="pl-14 relative">
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-800 text-base flex items-center justify-center absolute left-0 top-2">
                        <iconify-icon icon="carbon:area"></iconify-icon>
                    </div>
                    <h4 class="font-Interfont-normal text-sm text-textColor dark:text-white pb-1">
                        &Aacute;reas
                    </h4>
                    <p class="font-Intertext-xl text-black dark:text-white font-medium">
                        {{ $data['growth']['total'] }}
                    </p>
                </div>
                <div class="ml-auto w-24">
                    <div id="EChart3"></div>
                </div>
            </div>
        </div>

        {{-- Dashboard Chart --}}
        <div class="xl:flex gap-y-8 xl:gap-8 overflow-hidden h-fit">
            {{-- Statistics Chats  --}}
            <div class="mt-8 xl:mt-0 xl:w-4/12 bg-white  dark:bg-slate-800 rounded-md w-full flex flex-col h-fit">
                <h3
                    class="flex px-6 py-5 font-Interfont-normal text-black dark:text-white text-xl border-b border-b-slate-100 dark:border-b-slate-900">
                    <span class="flex-1">Total de productos</span>
                    <span>
                        <label class="relative" for="range-picker2">
                            <span class="z-40 cursor-pointer">
                                <iconify-icon icon="clarity:calendar-solid"></iconify-icon>
                            </span>
                            <input
                                class="z-30 form-control py-2 flatpickr flatpickr-input active absolute top-[-10px] invisible"
                                id="range-picker2" data-mode="range" value="" type="text" readonly="readonly">
                        </label>
                    </span>
                </h3>
                <div @class(['overflow-hidden'])>
                    @isset($products)
                        @forelse ($products as $item)
                            <div
                                class="flex justify-between border-b border-b-slate-200 p-4 text-gray dark:text-white items-center w-full">
                                <p class="flex flex-col flex-1">
                                    <span>
                                        {{ $item->product->name }}
                                    </span>
                                    <small class="text-slate-400">
                                        {{ $item->product->format }}
                                    </small>
                                </p>
                                <small>
                                    <span>Total: {{ $item->amount }}</span>
                                </small>
                            </div>
                        @empty
                            <p class="text-slate-400 mt-12 w-full text-center">Esta secci&oacute;n esta vac&iacute;a</p>
                        @endforelse
                    @endisset
                </div>
                <div class="mt-auto p-3">

                    {{ $products->links() }}
                </div>
            </div>

            <div class="flex-1">
                <div class="card">
                    <div class="card-header noborder">
                        <h4 class="card-title">
                            Ventas
                        </h4>
                        <div class="flex gap-2 items-center">
                            <div>
                                <select name="select2basic" id="products"
                                    class="select2 form-control w-full mt-2 py-2">
                                    <option value="0"
                                        class=" inline-block font-Inter font-normal text-sm text-slate-600 w-72">Todos
                                        los
                                        productos
                                    </option>
                                    @foreach ($singleProducts as $item)
                                        <option value="{{ $item->id }}" @selected($productId && $productId == $item->id)
                                            class=" inline-block font-Inter font-normal text-sm text-slate-600 w-72">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <select name="select2basic" id="areas"
                                    class="select2 form-control w-full mt-2 py-2">
                                    <option value="0"
                                        class=" inline-block font-Inter font-normal text-sm text-slate-600 w-72">Todas
                                        las
                                        areas
                                    </option>

                                    @foreach ($singleAreas as $item)
                                        <option @selected($areaId && $areaId == $item->id) value="{{ $item->id }}"
                                            class=" inline-block font-Inter font-normal text-sm text-slate-600 w-72">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <label class="relative" for="range-picker">
                                <span class="z-40 cursor-pointer">
                                    <iconify-icon icon="clarity:calendar-solid"></iconify-icon>
                                </span>
                                <input
                                    class="z-30 form-control py-2 flatpickr flatpickr-input active absolute top-[-10px] invisible"
                                    id="range-picker" data-mode="range" value="" type="text"
                                    readonly="readonly">
                            </label>
                            <!-- END: Card Droopdown -->
                        </div>
                    </div>
                    <div class="card-body p-6">
                        <!-- BEGIN: Order table -->

                        <div class="overflow-x-auto -mx-6">
                            <div class="inline-block min-w-full align-middle">
                                <div class="overflow-hidden ">
                                    <table
                                        class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                        <thead class=" bg-slate-200 dark:bg-slate-700">
                                            <tr>

                                                <th scope="col" class=" table-th ">
                                                    Asignado por
                                                </th>

                                                <th scope="col" class=" table-th ">
                                                    Producto
                                                </th>

                                                <th scope="col" class=" table-th ">
                                                    &Aacute;rea
                                                </th>

                                                <th scope="col" class=" table-th ">
                                                    Fecha
                                                </th>
                                                <th scope="col" class=" table-th ">
                                                    Cantidad
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody
                                            class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                            @forelse ($assigments as $item)
                                                <tr>
                                                    <td class="table-td">
                                                        <div class="flex items-center">
                                                            <div class="flex-1 text-start">
                                                                <h4
                                                                    class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                                                    {{ $item->user->name }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-td">{{ $item->product->name ?? 'No definido' }}
                                                    </td>
                                                    <td class="table-td">{{ $item->area->name ?? 'No definido' }}</td>
                                                    <td class="table-td">{{ $item->created_date }}</td>
                                                    <td class="table-td ">
                                                        <div
                                                            class="inline-block px-3 min-w-[90px] text-center mx-auto py-1 rounded-[999px]">
                                                            {{ $item->amount }}
                                                        </div>

                                                    </td>
                                                </tr>

                                            @empty

                                                <tr>
                                                    <td colspan="5" class="text-center p-5">No existen ventas para
                                                        mostrar</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="flex justify-end pr-3 pt-3">
                                                        <span>{{ $assigments->links() }}</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END: Order Table -->
                    </div>
                </div>
            </div>
        </div>

    </div>
    @push('scripts')
        @vite(['resources/js/plugins/flatpickr.js'])
        @vite(['resources/js/plugins/Select2.min.js'])
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
                    if (id == 'range-picker') {
                        if (dates.length && dates[0]) {
                            // Agrega o actualiza los parámetros de consulta deseados
                            queryParams.set('dates', dates);

                            // Crea una nueva URL con los parámetros actualizados
                            var nuevaUrl = url.origin + url.pathname + '?' + queryParams.toString();

                            // Redirige a la nueva URL

                        }
                    } else {
                        if (dates.length && dates[0]) {
                            // Agrega o actualiza los parámetros de consulta deseados
                            queryParams.set('datesProduct', dates);
                            // Crea una nueva URL con los parámetros actualizados
                            var nuevaUrl = url.origin + url.pathname + '?' + queryParams.toString();
                        }
                    }
                    nuevaUrl && (window.location.href = nuevaUrl);
                }
            });
            // flatpickr
            $("#disabled-range-picker").flatpickr({
                mode: "range",
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: [
                    function(date) {
                        // disable every multiple of 8
                        return !(date.getDate() % 8);
                    },
                ],

            });

            function delayChart() {
                revenueReportChart.render();
            }
            let revenueChartConfig = {
                chart: {
                    type: "area",
                    height: "48",
                    toolbar: {
                        autoSelected: "pan",
                        show: false,
                    },
                    offsetX: 0,
                    offsetY: 0,
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                colors: ["#00EBFF"],
                tooltip: {
                    theme: "light",
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0,
                    },
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    type: "solid",
                    opacity: [0.1],
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    low: 0,
                    offsetX: 0,
                    offsetY: 0,
                    show: false,
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    categories: {{ Js::from($data['revenue']['year']) }},
                },
                series: [{
                    data: {{ Js::from($data['revenue']['data']) }},
                }, ],
            };
            const revenueChartSelector = document.querySelector("#EChart")
            const revenueChart = new ApexCharts(
                revenueChartSelector,
                revenueChartConfig
            ).render();
            {{-- Total Revenue Chart end --}}


            {{-- Product Sales Chart start --}}
            {{-- Chart Type: area --}}``
            let productSalesChartConfig = {
                chart: {
                    type: "area",
                    height: "48",
                    toolbar: {
                        autoSelected: "pan",
                        show: false,
                    },
                    offsetX: 0,
                    offsetY: 0,
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                colors: ["#5743BE"],
                tooltip: {
                    theme: "light",
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0,
                    },
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    type: "solid",
                    opacity: [0.1],
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    low: 0,
                    offsetX: 0,
                    offsetY: 0,
                    show: false,
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    categories: {{ Js::from($data['productSold']['year']) }},
                },
                series: [{
                    data: {{ Js::from($data['productSold']['quantity']) }},
                }, ],
            };
            const productSalesChartSelector = document.querySelector("#EChart2")
            const productSalesChart = new ApexCharts(
                productSalesChartSelector,
                productSalesChartConfig
            ).render();
            let growthChartConfig = {
                chart: {
                    type: "area",
                    height: "48",
                    width: "48",
                    toolbar: {
                        autoSelected: "pan",
                        show: false,
                    },
                    offsetX: 0,
                    offsetY: 0,
                    zoom: {
                        enabled: false,
                    },
                    sparkline: {
                        enabled: true,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },
                colors: ["#fd5693"],
                tooltip: {
                    theme: "light",
                },
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0,
                    },
                },
                yaxis: {
                    show: false,
                },
                fill: {
                    type: "solid",
                    opacity: [0.1],
                },
                legend: {
                    show: false,
                },
                xaxis: {
                    low: 0,
                    offsetX: 0,
                    offsetY: 0,
                    show: false,
                    labels: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    axisBorder: {
                        low: 0,
                        offsetX: 0,
                        show: false,
                    },
                    categories: {{ Js::from($data['growth']['year']) }},
                },
                series: [{
                    data: {{ Js::from($data['growth']['perYearRate']) }},
                }, ],
            };
            const growthChartSelector = document.querySelector("#EChart3");
            const growthChart = new ApexCharts(
                growthChartSelector,
                growthChartConfig
            ).render();

            // Form Select Area
            $(".select2").select2({
                placeholder: "Seleccionar opción",
            });

            $(".select2").on("change", function(e) {
                var selectedValue = $(this).val();
                // Obtén la URL actual
                var url = new URL(window.location.href);
                // Obtiene los parámetros de consulta actuales
                var queryParams = new URLSearchParams(url.search);

                // Agrega o actualiza los parámetros de consulta deseados
                if (selectedValue) {
                    queryParams.set(e.target.id.slice(0, -1), selectedValue);
                } else {
                    queryParams.delete(e.target.id.slice(-1, 0));
                }


                // Crea una nueva URL con los parámetros actualizados
                var nuevaUrl = url.origin + url.pathname + '?' + queryParams.toString();
                window.location.href = nuevaUrl;
            });
        </script>
    @endpush
</x-app-layout>
