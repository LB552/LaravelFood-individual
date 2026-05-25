@extends('layouts.app')

@section('content')
<button id="filter-products-btn">Filter products</button>

<div class="modal" id="filter-modal">
    <div class="modal-content">
        <span class="close" id="filter-modal-close">&times;</span>
        <h2>Filter Products</h2>

        <form id="filter-form" method="GET" action="{{ route('index') }}">
            <label>Category:</label>
            <select name="category_id">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            <label>Minimum Price:</label>
            <input type="number" name="min_price" step="0.01" placeholder="Any" value="{{ $minPrice ?? '' }}">

            <label>Maximum Price:</label>
            <input type="number" name="max_price" step="0.01" placeholder="Any" value="{{ $maxPrice ?? '' }}">

            <!-- Preserve sorting parameters -->
            <input type="hidden" name="sort_by" value="{{ $sortBy }}">
            <input type="hidden" name="sort_order" value="{{ $sortOrder }}">

            <button type="submit">Apply Filter</button>
            <button type="button" id="filter-reset-btn">Reset</button>
        </form>
    </div>
</div>

<div class="banner">
    <p></p>
    <p>Image</p>
    <p><a href="{{ route('index', array_merge(request()->query(), ['sort_by' => 'name', 'sort_order' => $sortBy === 'name' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" class="sort-link" data-column="name">Product
            @if($sortBy === 'name')
            @if($sortOrder === 'asc')
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="#D9D9D9" />
            </svg>
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="#D9D9D9" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
        </a></p>
    <p><a href="{{ route('index', array_merge(request()->query(), ['sort_by' => 'category_id', 'sort_order' => $sortBy === 'category_id' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" class="sort-link" data-column="category">Category
            @if($sortBy === 'category_id')
            @if($sortOrder === 'asc')
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="#D9D9D9" />
            </svg>
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="#D9D9D9" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
        </a></p>
    <p><a href="{{ route('index', array_merge(request()->query(), ['sort_by' => 'price', 'sort_order' => $sortBy === 'price' && $sortOrder === 'asc' ? 'desc' : 'asc'])) }}" class="sort-link" data-column="price">Price
            @if($sortBy === 'price')
            @if($sortOrder === 'asc')
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="#D9D9D9" />
            </svg>
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="#D9D9D9" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
            @else
            <svg width="12" height="12" viewBox="0 0 14 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 0L13.0622 10.5H0.937822L7 0Z" fill="black" />
                <path d="M7 24L13.0622 13.5H0.937822L7 24Z" fill="black" />
            </svg>
            @endif
        </a></p>
    <p>Description</p>
</div>@foreach ($products as $product)
<div class="list">
    <div class="hori">
        <button class="edit-btn" data-id="{{ $product->id }}">Edit</button>
        <button class="delete-btn" data-id="{{ $product->id }}">Delete</button>
    </div>

    <div class="product-row">
        <img src="{{ asset($product->image) }}" width="30" height="30">

        <a href="{{ route('products.show', $product->id) }}" class="product-name-link">{{ $product->name }}</a>

        <p>{{ $product->category->name }}</p>

        <p>${{ number_format($product->price, 2) }}</p>

        <p>{{ \Illuminate\Support\Str::limit($product->description, 50) }}</p>
    </div>

    <div class="modal" id="modal-{{ $product->id }}">
        <div class="modal-content">
            <span class="close" data-id="{{ $product->id }}">&times;</span>
            <h2>Edit Product: {{ $product->name }}</h2>

            <form method="POST" action="{{ route('products.update', $product->id) }}">
                @csrf
                @method('PUT')

                <label>Name:</label>
                <input type="text" name="name" value="{{ $product->name }}">

                <label>Image URL:</label>
                <input type="text" name="image" value="{{ $product->image }}" placeholder="e.g., product-images/myimage.jpg or https://example.com/image.jpg">
                <small style="color: #666;">You can use local paths (e.g., product-images/image.jpg) or full URLs</small> <label>Category:</label>
                <div class="category-input-group">
                    <select name="category_id" class="category-select">
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                    <button type="button" class="add-category-btn">+ New Category</button>
                </div>
                <div class="new-category-input" style="display: none;">
                    <input type="text" placeholder="Enter new category name" class="new-category-name">
                    <button type="button" class="save-category-btn">Save</button>
                    <button type="button" class="cancel-category-btn">Cancel</button>
                </div>

                <label>Price:</label>
                <input type="number" step="0.01" name="price" value="{{ $product->price }}">

                <label>Description:</label>
                <textarea name="description">{{ $product->description }}</textarea>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>
</div>
@endforeach

<button id="add-product-btn">Add</button>

<div class="modal" id="add-product-modal">
    <div class="modal-content">
        <span class="close" id="add-modal-close">&times;</span>
        <h2>Add New Product</h2>

        <form id="add-product-form" method="POST">
            @csrf

            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Image URL:</label>
            <input type="text" name="image" placeholder="e.g., product-images/myimage.jpg or https://example.com/image.jpg">
            <small style="color: #666;">You can use local paths (e.g., product-images/image.jpg) or full URLs</small>

            <label>Category:</label>
            <div class="category-input-group">
                <select name="category_id" class="category-select" required>
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                <button type="button" class="add-category-btn">+ New Category</button>
            </div>
            <div class="new-category-input" style="display: none;">
                <input type="text" placeholder="Enter new category name" class="new-category-name">
                <button type="button" class="save-category-btn">Save</button>
                <button type="button" class="cancel-category-btn">Cancel</button>
            </div>

            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>

            <label>Description:</label>
            <textarea name="description"></textarea>

            <button type="submit">Save</button>
        </form>
    </div>
</div>

<div class="modal" id="delete-confirmation-modal">
    <div class="modal-content">
        <h2>Confirm Deletion</h2>
        <p id="delete-confirmation-text">Are you sure you want to delete this product?</p>
        <div class="modal-buttons">
            <button id="confirm-delete-btn" class="confirm-btn">Delete</button>
            <button id="cancel-delete-btn" class="cancel-btn">Cancel</button>
        </div>
    </div>
</div>


<script>
    let pendingDeleteId = null;

    // Handle Filter button
    document.getElementById('filter-products-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('filter-modal').style.display = 'block';
    });

    // Handle Filter modal close button
    document.getElementById('filter-modal-close').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('filter-modal').style.display = 'none';
    });

    // Handle Filter reset button
    document.getElementById('filter-reset-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('filter-form').reset();
        // Clear the filter but keep sorting
        const form = document.getElementById('filter-form');
        form.querySelector('input[name="min_price"]').value = '';
        form.querySelector('input[name="max_price"]').value = '';
        form.querySelector('select[name="category_id"]').value = '';
        // Submit the form to apply reset
        form.submit();
    });

    // Handle Edit button
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.dataset.id;
            document.getElementById('modal-' + id).style.display = 'block';
        });
    });

    // Handle Add button
    document.getElementById('add-product-btn').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('add-product-modal').style.display = 'block';
    });

    // Handle Add modal close button
    document.getElementById('add-modal-close').addEventListener('click', function(e) {
        e.preventDefault();
        document.getElementById('add-product-modal').style.display = 'none';
    });

    // Handle Add Product form submission
    document.getElementById('add-product-form').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('/products', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    document.getElementById('add-product-modal').style.display = 'none';
                    document.getElementById('add-product-form').reset();
                    location.reload();
                } else {
                    return response.text().then(text => {
                        throw text;
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating product');
            });
    }); // Handle add category button click
    document.querySelectorAll('.add-category-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal-content');
            const inputGroup = modal.querySelector('.new-category-input');
            inputGroup.style.display = 'flex';
            modal.querySelector('.new-category-name').focus();
        });
    });

    // Handle cancel category button
    document.querySelectorAll('.cancel-category-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal-content');
            const inputGroup = modal.querySelector('.new-category-input');
            inputGroup.style.display = 'none';
            modal.querySelector('.new-category-name').value = '';
        });
    });

    // Handle save new category
    document.querySelectorAll('.save-category-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const modal = this.closest('.modal-content');
            const categoryName = modal.querySelector('.new-category-name').value.trim();

            if (!categoryName) {
                alert('Please enter a category name');
                return;
            }

            fetch('/categories', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        name: categoryName
                    })
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                    } else {
                        return response.json().then(data => {
                            throw data;
                        });
                    }
                })
                .then(category => {
                    // Add new category to all dropdowns
                    document.querySelectorAll('.category-select').forEach(select => {
                        const option = document.createElement('option');
                        option.value = category.id;
                        option.textContent = category.name;
                        select.appendChild(option);
                    });

                    // Set the newly created category as selected in current modal
                    modal.querySelector('.category-select').value = category.id;

                    // Reset and hide the input
                    const inputGroup = modal.querySelector('.new-category-input');
                    inputGroup.style.display = 'none';
                    modal.querySelector('.new-category-name').value = '';
                })
                .catch(error => {
                    console.error('Error:', error);
                    if (error.errors && error.errors.name) {
                        alert('Error: ' + error.errors.name[0]);
                    } else {
                        alert('Error creating category');
                    }
                });
        });
    });

    // Allow Enter key to save category
    document.querySelectorAll('.new-category-name').forEach(input => {
        input.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.closest('.new-category-input').querySelector('.save-category-btn').click();
            }
        });
    });

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            pendingDeleteId = this.dataset.id;
            document.getElementById('delete-confirmation-modal').style.display = 'block';
        });
    });

    document.getElementById('confirm-delete-btn').addEventListener('click', function() {
        if (pendingDeleteId) {
            fetch(`/products/${pendingDeleteId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Error deleting product');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error deleting product');
                });
        }
    });

    document.getElementById('cancel-delete-btn').addEventListener('click', function() {
        document.getElementById('delete-confirmation-modal').style.display = 'none';
        pendingDeleteId = null;
    });

    document.querySelectorAll('.close').forEach(span => {
        span.addEventListener('click', function() {
            const id = this.dataset.id;
            document.getElementById('modal-' + id).style.display = 'none';
        });
    });

    // Close modal if click outside content
    window.addEventListener('click', function(e) {
        document.querySelectorAll('.modal').forEach(modal => {
            if (e.target == modal) {
                modal.style.display = 'none';
                pendingDeleteId = null;
            }
        });
    });
</script>
@endsection

</html>