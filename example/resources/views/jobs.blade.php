<x-layout>
    <x-slot:heading>
        Jobs List
    </x-slot:heading>

    @foreach ($jobs as $job)
        <li>
            <a href="/job/{{ $job['id'] }}" class="hover:bg-blue-gray-500">
                <strong>{{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per month.
            </a>
        </li>
    @endforeach
</x-layout>
