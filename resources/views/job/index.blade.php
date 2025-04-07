<x-layout>

    <x-breadcrumbs class="mb-4" :links="['Jobs'=>route('jobs.index')]" />

    <x-card class="mb-4 text-sm">
        <form id="filtering-form" action="{{ route('jobs.index') }}" method="GET">
            <div class="mb-4 grid grid-cols-2 gap-4">
                <div>
                   <div class="mb-1 font-semibold">Search</div>
                    <x-text-input type="text" name="search" value="{{ request('search') }}" id="search" placeholder="Search for any text" form-id="filtering-form"/>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Salary</div>
                    <div class="flex space-x-2">
                        <x-text-input name="min_salary"
                         value="{{ request('min_salary') }}" placeholder="From" type="text" />
                        <x-text-input name="max_salary" value="{{ request('max_salary') }}" placeholder="To"
                        type="text"/>
                    </div>
                </div>
                <div>
                    <div class="mb-1 font-semibold">Experience</div>

                    <x-radio-group name="experience" :options="array_combine(array_map('ucfirst',\App\Models\OfferedJob::$experience), \App\Models\OfferedJob::$experience)"></x-radio-group>

                </div>
                <div>
                    <div class="mb-1 font-semibold">Category</div>

                    <x-radio-group name="category" :options="\App\Models\OfferedJob::$category"></x-radio-group>
                </div>
            </div>
            <button class="w-full">Filter</button>
        </form>
    </x-card>

    @foreach($jobs as $job)
        <x-job-card class="mb-4" :$job>
            <div>
                <x-link-button :href="route('jobs.show',$job)">
                    Show
                </x-link-button>
            </div>
        </x-job-card>
    @endforeach
</x-layout>
