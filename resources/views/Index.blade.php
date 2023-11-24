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
                    class="px-6 py-5 font-Interfont-normal text-black dark:text-white text-xl border-b border-b-slate-100 dark:border-b-slate-900">
                    Total de productos
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
                  @if (count($products) > 5)
                  {{ $products->links() }}
                  @endif
                </div>
            </div>

            <div class="flex-1">
                <div class="card">
                    <div class="card-header noborder">
                        <h4 class="card-title">
                            Ventas
                        </h4>
                        <div>
                            <!-- BEGIN: Card Dropdown -->
                            <div class="relative">
                                <div class="dropdown relative">
                                    <button class="text-xl text-center block w-full " type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <span
                                            class="text-lg inline-flex h-6 w-6 flex-col items-center justify-center border border-slate-200 dark:border-slate-700 rounded dark:text-slate-400">
                                            <iconify-icon icon="heroicons-outline:dots-horizontal"></iconify-icon>
                                        </span>
                                    </button>
                                    <ul
                                        class=" dropdown-menu min-w-[120px] absolute text-sm text-slate-700 dark:text-white hidden bg-white dark:bg-slate-700 shadow z-[2] overflow-hidden list-none text-left rounded-lg mt-1 m-0 bg-clip-padding border-none">
                                        <li>
                                            <a href="#"
                                                class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                Last 28 Days</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                Last Month</a>
                                        </li>
                                        <li>
                                            <a href="#"
                                                class="text-slate-600 dark:text-white block font-Inter font-normal px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-600 dark:hover:text-white">
                                                Last Year</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
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
                                                            <div class="flex-none">
                                                                <div class="w-8 h-8 rounded-[100%] ltr:mr-3 rtl:ml-3">
                                                                    <img src="images/users/user-1.jpg" alt=""
                                                                        class="w-full h-full rounded-[100%] object-cover">
                                                                </div>
                                                            </div>
                                                            <div class="flex-1 text-start">
                                                                <h4
                                                                    class="text-sm font-medium text-slate-600 whitespace-nowrap">
                                                                    {{ $item->user->name }}
                                                                </h4>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="table-td">{{ $item->product->name }}</td>
                                                    <td class="table-td">{{ $item->area->name }}</td>
                                                    <td class="table-td">{{ 'No definida' }}</td>
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
        <script type="module">
            {{-- Total Revenue Report Chart start --}}
            {{-- Chart Type: Bar --}}
            let revenueReportChartConfig = {
                series: [{
                        name: '{{ $data['revenueReport']['revenue']['title'] }}',
                        data: {{ Js::from($data['revenueReport']['revenue']['data']) }},
                    },
                    {
                        name: '{{ $data['revenueReport']['netProfit']['title'] }}',
                        data: {{ Js::from($data['revenueReport']['netProfit']['data']) }},
                    },
                    {
                        name: '{{ $data['revenueReport']['cashFlow']['title'] }}',
                        data: {{ Js::from($data['revenueReport']['cashFlow']['data']) }},
                    },
                ],
                chart: {
                    type: "bar",
                    height: 350,
                    width: "100%",
                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "45%",
                        endingShape: "rounded",
                    },
                },
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: "right",
                    fontSize: "13px",
                    fontFamily: "Inter",
                    offsetY: -30,
                    markers: {
                        width: 12,
                        height: 12,
                        radius: 12,
                    },
                    itemMargin: {
                        horizontal: 8,
                        vertical: 0,
                    },
                    onItemClick: {
                        toggleDataSeries: true,
                    },
                    onItemHover: {
                        highlightDataSeries: true,
                    },
                },
                title: {
                    text: "Revenue Report",
                    align: "left",
                    offsetX: 0,
                    offsetY: 13,
                    floating: false,
                    style: {
                        fontSize: "20px",
                        fontWeight: "medium",
                        fontFamily: "Inter",
                        color: "##111112",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                yaxis: {
                    labels: {
                        style: {
                            fontFamily: "Inter",
                        },
                    },
                },
                xaxis: {
                    categories: {{ Js::from($data['revenueReport']['month']) }},
                    labels: {
                        style: {
                            fontFamily: "Inter",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands";
                        },
                    },
                },
                colors: ["#4669FA", "#0CE7FA", "#FA916B"],
                grid: {
                    show: true,
                    borderColor: "#E2E8F0",
                    strokeDashArray: 10,
                    position: "back",
                },
                responsive: [{
                    breakpoint: 600,
                    options: {
                        legend: {
                            position: "bottom",
                            offsetY: 0,
                            horizontalAlign: "center",
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "80%",
                            },
                        },
                    },
                }, ],
            };
            const revenueReportSelector = document.querySelector("#barChartOne");
            const chartDelay = setTimeout(delayChart, 50);
            let revenueReportChart = new ApexCharts(
                revenueReportSelector,
                revenueReportChartConfig
            );

            function delayChart() {
                revenueReportChart.render();
            }
            {{-- Total Revenue Report Chart end --}}


            {{-- Total Revenue Chart start --}}
            {{-- Chart Type: area --}}
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
            {{-- Product Sales Chart end --}}



            {{-- Growth chart --}}
            {{-- Chart Type: area --}}
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
            {{-- Growth chart end --}}


            {{-- Order Last week chart --}}
            {{-- Chart Type: bar --}}
            let lastWeekOrderChartConfig = {
                series: [{
                    name: {{ Js::from($data['lastWeekOrder']['name']) }},
                    data: {{ Js::from($data['lastWeekOrder']['data']) }},
                }, ],
                chart: {
                    type: "bar",
                    height: 50,
                    toolbar: {
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

                plotOptions: {
                    bar: {
                        columnWidth: "50%",
                        barHeight: "100%",
                    },
                },
                legend: {
                    show: false,
                },

                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                    width: 2,
                },

                fill: {
                    opacity: 1,
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + "k";
                        },
                    },
                },
                yaxis: {
                    show: false,
                },
                xaxis: {
                    show: false,
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                colors: "#EDB899",
                grid: {
                    show: false,
                },
            };

            const lastWeekOrderChartSelector = document.querySelector("#columnChart")
            const lastWeekOrderChart = new ApexCharts(
                lastWeekOrderChartSelector,
                lastWeekOrderChartConfig
            ).render();
            {{-- Order Last week chart end --}}


            {{-- Profit Last week chart --}}
            {{-- Chart Type: line --}}
            let lastWeekProfitChartConfig = {
                series: [{
                    name: {{ Js::from($data['lastWeekProfit']['name']) }},
                    data: {{ Js::from($data['lastWeekProfit']['data']) }},
                }, ],
                chart: {
                    height: 50,
                    toolbar: {
                        show: false,
                    },
                    offsetX: 0,
                    offsetY: 0,

                    sparkline: {
                        enabled: true,
                    },
                },
                stroke: {
                    width: [2],
                    curve: "straight",
                    dashArray: [0, 8, 5],
                },
                dataLabels: {
                    enabled: false,
                },

                markers: {
                    size: 4,
                    colors: "#fff",
                    strokeColors: "#4669FA",
                    strokeWidth: 2,
                    shape: "circle",
                    radius: 2,
                    hover: {
                        sizeOffset: 1,
                    },
                },

                yaxis: {
                    show: false,
                },
                xaxis: {
                    show: false,
                    labels: {
                        show: false,
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                },
                grid: {
                    show: true,
                    borderColor: "#E2E8F0",
                    strokeDashArray: 5,
                    position: "back",
                    xaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },
                colors: ["#4669FA"],
            };

            const lastWeekProfitChartSelector = document.querySelector("#lineChart")
            const lastWeekProfitChart = new ApexCharts(
                lastWeekProfitChartSelector,
                lastWeekProfitChartConfig
            ).render();
            {{-- Profit Last week chart end --}}

            {{-- Last Week Overview chart --}}
            {{-- Chart Type: donut --}}
            let lastWeekOverviewChartConfig = {
                series: {{ Js::from($data['lastWeekOverview']['data']) }},
                chart: {
                    type: 'donut',
                    width: "240px"
                },
                labels: {{ Js::from($data['lastWeekOverview']['labels']) }},
                dataLabels: {
                    enabled: false,
                },
                colors: ["#0CE7FA", "#FA916B"],
                legend: {
                    position: "bottom",
                    fontSize: "14px",
                    fontFamily: "Inter",
                    fontWeight: 400,
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: "65%",
                        },
                    },
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        legend: {
                            position: "bottom",
                        },
                    },
                }, ],
            };
            const lastWeekOverviewChartSelector = document.querySelector("#donutChart")
            const lastWeekOverviewChart = new ApexCharts(
                lastWeekOverviewChartSelector,
                lastWeekOverviewChartConfig
            ).render();
            {{-- Last Week Overview chart end --}}
        </script>
    @endpush
</x-app-layout>
