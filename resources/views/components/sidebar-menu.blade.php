<!-- BEGIN: Sidebar -->
<div class="sidebar-wrapper group w-0 hidden xl:w-[248px] xl:block">
    <div id="bodyOverlay" class="w-screen h-screen fixed top-0 bg-slate-900 bg-opacity-50 backdrop-blur-sm z-10 hidden">
    </div>
    <div class="logo-segment">

        <!-- Application Logo -->
        <x-application-logo />

        <!-- Sidebar Type Button -->
        <div id="sidebar_type" class="cursor-pointer text-slate-900 dark:text-white text-lg">
            <iconify-icon class="sidebarDotIcon extend-icon text-slate-900 dark:text-slate-200" icon="fa-regular:dot-circle"></iconify-icon>
            <iconify-icon class="sidebarDotIcon collapsed-icon text-slate-900 dark:text-slate-200" icon="material-symbols:circle-outline"></iconify-icon>
        </div>
        <button class="sidebarCloseIcon text-2xl inline-block md:hidden">
            <iconify-icon class="text-slate-900 dark:text-slate-200" icon="clarity:window-close-line"></iconify-icon>
        </button>
    </div>
    <div id="nav_shadow" class="nav_shadow h-[60px] absolute top-[80px] nav-shadow z-[1] w-full transition-all duration-200 pointer-events-none
      opacity-0"></div>
    <div class="sidebar-menus bg-white dark:bg-slate-800 py-2 px-4 h-[calc(100%-80px)] z-50" id="sidebar_menus">
        <ul class="sidebar-menu">
            <li class="sidebar-menu-title">{{ __('MENU') }}</li>
            <li>
                <a href="{{ route('dashboard.index') }}" class="navItem {{ (request()->is('dashboard*')) ? 'active' : '' }}">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="heroicons-outline:home"></iconify-icon>
                        <span>{{ __('Inicio') }}</span>
                    </span>
                </a>
            </li>
            <!-- Settings -->
            <li>
                <a href="{{ route('products.index') }}" class="navItem {{ (request()->is('products*')) || (request()->is('products*')) || (request()->is('products*')) || (request()->is('products*')) || (request()->is('products*')) ? 'active' : '' }}">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="streamline:food-drum-stick-1-cook-animal-drumsticks-products-chicken-cooking-nutrition-food"></iconify-icon>
                        <span>{{ __('Productos') }}</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.index') }}" class="navItem {{ (request()->is('users*')) || (request()->is('users*')) || (request()->is('users*')) || (request()->is('users*')) || (request()->is('users*')) ? 'active' : '' }}">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="fa:users"></iconify-icon>
                        <span>{{ __('Usuarios') }}</span>
                    </span>
                </a>
            </li>
            <li>
                <a href="{{ route('areas.index') }}" class="navItem {{ (request()->is('areas*')) || (request()->is('areas*')) || (request()->is('areas*')) || (request()->is('areas*')) || (request()->is('areas*')) ? 'active' : '' }}">
                    <span class="flex items-center">
                        <iconify-icon class=" nav-icon" icon="carbon:area-custom"></iconify-icon>
                        <span>{{ __('Areas') }}</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- End: Sidebar -->