@extends('layouts.app')

@section('content')
    <h1 class="mb-10 text-2x1">Add Review for {{ $book->title }}</h1>

    <form method="post" action="{{ route('books.reviews.store', $book) }}">
        @csrf
        <label for="review">Review</label>
        <textarea class="input mb-4" name="review" id="review" required></textarea>

        <label for="rating">Rating</label>
        <select class="input mb-4" name="rating" id="rating" required>
            <option value="">Select a rating</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>

        <button class="btn" type="submit">Add Review</button>
    </form>
@endsection
