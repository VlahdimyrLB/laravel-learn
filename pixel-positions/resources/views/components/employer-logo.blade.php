@props(['employer', 'width' => 90])

<img src="{{ asset('storage/' . $employer->logo) }}" alt="Employer Logo" class="rounded-xl" width="{{ $width }}">
