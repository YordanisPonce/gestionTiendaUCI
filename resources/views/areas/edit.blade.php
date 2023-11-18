<x-app-layout>
    <div>
        {{--Breadcrumb start--}}
        <div class="mb-6">
            <x-breadcrumb :breadcrumb-items="$breadcrumbItems" :page-title="$pageTitle" />
        </div>
        {{--Breadcrumb end--}}

        {{--Create area form start--}}
        <form method="POST" action="{{ route('areas.update',$area) }}" class="max-w-4xl m-auto">
            @csrf
            @method('PUT')
            <div class="bg-white dark:bg-slate-800 rounded-md p-5 pb-6">

                <div class="grid sm:grid-cols-1 gap-x-8 gap-y-4">

                    {{--Name input end--}}
                    <div class="input-area">
                        <label for="name" class="form-label">{{ __('Nombre') }}</label>
                        <input name="name" type="text" id="name" class="form-control"
                               placeholder="{{ __('Enter your name') }}" value="{{ $area->name }}" required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                    </div>

                    {{--Name input end--}}
                    <div class="input-area">
                        <label for="workers_count" class="form-label">{{ __('Cantidad de trabajadores') }}</label>
                        <input name="workers_count" type="text" id="workers_count" class="form-control"
                               placeholder="{{ __('Introducir cantidad') }}" value="{{ $area->workers_count }}" required>
                        <x-input-error :messages="$errors->get('workers_count')" class="mt-2"/>
                    </div>
                <button type="submit" class="btn inline-flex justify-center btn-dark mt-4 w-fit">
                    {{ __('Save Changes') }}
                </button>
            </div>

        </form>
        {{--Create area form end--}}
    </div>
</x-app-layout>
