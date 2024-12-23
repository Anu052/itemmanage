<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Management</title>
    <link href="{{ asset('css/item.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Manage Items</h1>
        <form action="{{ route('items.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div id="itemContainer">
                <div class="row item-row">
                    <input type="file" name="image[]" required>
                    <input type="text" name="title[]" placeholder="Title" required>
                    <textarea name="description[]" maxlength="250" placeholder="Description" required></textarea>
                    <input type="number" name="qty[]" placeholder="Qty" required>
                    <input type="number" name="price[]" placeholder="Price" step="0.01" required>
                    <input type="date" name="date[]" required>
                    <button type="button" class="btn btn-success add-remove-item">+</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>

        <hr>
        <h2>Item List</h2>
        <form method="get" action="{{ route('items.index') }}" class="filter-form">
            <input type="text" name="title" placeholder="Filter by Title" value="{{ request('title') }}">
            <input type="date" name="date" value="{{ request('date') }}">
            <button type="submit">Filter</button>
        </form>

        @if ($items->isEmpty())
            <div class="no-items">Item not found</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->image) }}" alt="Image"></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->qty }}</td>
                            <td>{{ $item->price }}</td>
                            <td>{{ $item->date }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                @if ($items->onFirstPage())
                    <span class="disabled">Previous</span>
                @else
                    <a href="{{ $items->previousPageUrl() }}">Previous</a>
                @endif

                @if ($items->hasMorePages())
                    <a href="{{ $items->nextPageUrl() }}">Next</a>
                @else
                    <span class="disabled">Next</span>
                @endif
            </div>
        @endif
    </div>
    <script src="{{ asset('js/item.js') }}"></script>
</body>

</html>
