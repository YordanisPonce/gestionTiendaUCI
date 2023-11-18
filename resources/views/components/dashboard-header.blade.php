<div class="z-[9] sticky top-0" id="app_header">
    <div class="app-header z-[999] bg-white dark:bg-slate-800 shadow-sm dark:shadow-slate-700">
        <div class="flex justify-between items-center h-full">
            <div class="flex items-center md:space-x-4 space-x-4 rtl:space-x-reverse vertical-box">
                <div class="xl:hidden inline-block">
                    <x-application-logo class="mobile-logo" />
                </div>
                <button class="smallDeviceMenuController  open-sdiebar-controller hidden xl:hidden md:inline-block">
                    <iconify-icon class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
                <button class="sidebarOpenButton text-xl text-slate-900 dark:text-white !ml-0">
                    <iconify-icon icon="ph:arrow-right-bold"></iconify-icon>
                </button>
               {{--  <x-header-search /> --}}
            </div>
            <!-- end vertcial -->

            <div class="items-center space-x-4 rtl:space-x-reverse horizental-box">
                <x-application-logo />
                <button class="smallDeviceMenuController  open-sdiebar-controller  hidden xl:hidden md:inline-block">
                    <iconify-icon
                        class="leading-none bg-transparent relative text-xl top-[2px] text-slate-900 dark:text-white"
                        icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
                <x-header-search />
            </div>
            <!-- end horizontal -->

            <!-- start horizontal nav -->
            <x-topbar-menu />
            <!-- end horizontal nav -->

            <div class="nav-tools flex items-center lg:space-x-5 space-x-3 rtl:space-x-reverse leading-0">
                <x-dark-light />
                <x-nav-user-dropdown />
                <button class="smallDeviceMenuController md:hidden block leading-0">
                    <iconify-icon class="cursor-pointer text-slate-900 dark:text-white text-2xl" icon="heroicons-outline:menu-alt-3"></iconify-icon>
                </button>
                <!-- end mobile menu -->
            </div>
            <!-- end nav tools -->
        </div>
    </div>
</div>

<!-- BEGIN: Search Modal -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto inset-0 bg-slate-900/40" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form>
                <label for="amount" class="p-4 border-b text-2xl">Nyeva asignacion</label>
                <div class="relative">
                    <input type="text" class="form-control p-5" placeholder="Cantidad" autofocus>
                </div>
                <button class="btn inline-flex justify-center btn-dark rounded-[25px] items-center !p-2 !px-3"
                href="{{ route('products.create') }}">
                <iconify-icon icon="ic:round-plus" class="text-lg mr-1">
                </iconify-icon>
                {{ __('Creare') }}
            </button>
            </form>
        </div>
    </div>
</div>
<!-- END: Search Modal -->
