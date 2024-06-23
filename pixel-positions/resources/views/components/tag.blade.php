 @props(['tag', 'size' => 'base'])

 @php
     $classes = 'rounded-xl bg-white/10  font-bold transition-colors duration-300 hover:bg-white/25';
     if ($size == 'base') {
         $classes .= ' px-5 py-1 text-sm';
     }

     if ($size == 'small') {
         $classes .= ' px-3 py-1 text-2xs';
     }
 @endphp

 <a href="/tags/{{ strtoLower($tag->name) }}" class="{{ $classes }}">{{ $tag->name }}</a>
