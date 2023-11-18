<x-app-layout>
    <div>
        {{--Breadcrumb start--}}
        <div class="mb-6">
            {{--BreadCrumb--}}
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />
        </div>
        {{--Breadcrumb end--}}

        {{--Create product form start--}}
        <form method="POST" action="{{ route('products.store') }}"  class="max-w-4xl m-auto">
            @csrf
            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">

                <div class="grid sm:grid-cols-1 gap-x-8 gap-y-4">
                    {{--Name input end--}}
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                        <input name="name" type="text" id="name" class="form-control"
                               placeholder="{{ __('Enter your name') }}" value="{{ old('name') }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>
                    <div class="input-area">
                        <label for="format" class="form-label">{{ __('Formato') }}</label>
                        <input name="format" type="text" id="format" class="form-control"
                               placeholder="{{ __('Introducir formato') }}" value="{{ old('format') }}" required>
                        <x-input-error :messages="$errors->get('format')" class="mt-2"/>
                    </div>
                    <div class="input-area">
                        <label for="format" class="form-label">{{ __('Precio') }}</label>
                        <input name="price" type="text" id="price" class="form-control"
                               placeholder="{{ __('Introducir precio') }}" value="{{ old('price') }}" required>
                        <x-input-error :messages="$errors->get('price')" class="mt-2"/>
                    </div>
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-fit">
                    {{ __('Save') }}
                </button>
            </div>

        </form>
        {{--Create product form end--}}
    </div>
</x-app-layout>
