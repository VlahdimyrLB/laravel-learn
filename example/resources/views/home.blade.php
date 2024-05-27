<x-layout>
    {{-- <x-layout heading="Home Page"> We can use a prop called heading(which is the name) --}}
    {{-- or a Named Slot --}}
    <x-slot:heading>
        Home Page
    </x-slot:heading>

    <h1>Hello from the Home Page</h1>
</x-layout>