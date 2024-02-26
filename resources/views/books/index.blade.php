@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2xl">Books</h1>

    <form method="get" action="{{ route('books.index') }}" class="mb-4 flex space-x-2">
        <input type="text" name="title" placeholder="Search by title" value="{{ request('title') }}"
               class="input"/>
        <input type="hidden" name="filter" value="{{ request('filter') }}" />
        <button type="submit" class="btn">Search</button>
        <a href="{{ route('books.index') }}" class="btn">Clear</a>
    </form>

    <div class="filter-container mb-4 flex">
        @php
            $filters = [
            '' => 'Latest',
            'popular_last_month' => 'Popular last Month',
            'popular_last_6_months' => 'Popular last 6 Months',
            'highest_rated_last_month' => 'Highest rated last Month',
            'highest_rated_last_6_months' => 'Highest rated last 6 Months',
            ];

        @endphp

    @foreach($filters as $key => $label)
        <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}" class="{{ request('filter') === $key || (request('filter') === null && $key === '') ? 'filter-item-active' : 'filter-item' }}">
            {{ $label }}
        </a>
    @endforeach
    </div>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div
                        class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', $book) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">by {{ $book->author }}</span>
                        </div>
                        <div>
                            <div class="book-rating">
{{--                                {{ number_format($book->reviews_avg_rating, 1) }}--}}
                                <x-star-rating :rating="$book->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">
                                out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No books found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    @if($books->count())
        <nav class="mt-4">
            {{ $books->links() }}
        </nav>
    @endif

@endsection
