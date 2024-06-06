<x-layout>
    <x-slot:heading>
        Jobs List
    </x-slot:heading>


    <div class="space-y-4">
        @foreach ($jobs as $job)
            <a href="/job/{{ $job['id'] }}" class="block rounded-md border border-gray-200 px-4 py-6">
                <div class="text-sm font-bold text-blue-600">
                    {{ $job->employer->name }}
                </div>
                <div>
                    <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per month.
                </div>
            </a>
        @endforeach

        <div>
            {{ $jobs->links() }}
        </div>
    </div>
</x-layout>
