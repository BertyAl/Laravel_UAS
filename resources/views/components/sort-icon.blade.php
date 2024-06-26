@props(['sortField', 'sortBy', 'sortAsc'])

@if ($sortBy === $sortField)
    @if ($sortAsc)
        <!-- Icon for ascending order -->
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M6 10l4-4 4 4H6z" clip-rule="evenodd" />
        </svg>
    @else
        <!-- Icon for descending order -->
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M14 10l-4 4-4-4h8z" clip-rule="evenodd" />
        </svg>
    @endif
@endif
