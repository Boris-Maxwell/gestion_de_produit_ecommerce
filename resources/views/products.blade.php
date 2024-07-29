@extends('home')

@section('content')

<div class="container">
    <h1 class="mb-4">Produits</h1>

    <!-- Filters -->
    <div class="mb-4">
        <form method="GET" action="{{ route('products.index') }}">
            <div class="row">
                <div class="col-md-4">
                    <select class="form-select" name="category_filter">
                        <option value="">Toutes les catégories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request()->category_filter == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="min_stock" placeholder="Stock minimum" value="{{ request()->min_stock }}">
                </div>
                <div class="col-md-4">
                    <input type="number" class="form-control" name="max_stock" placeholder="Stock maximum" value="{{ request()->max_stock }}">
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary">Filtrer</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </form>
    </div>

    <!-- Add Product Button -->
    <div class="mb-3">
        <button class="btn btn-primary" onclick="openProductModal()">Ajouter un Produit</button>
    </div>

    <!-- Product Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}€</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>
                        <button class="btn btn-success btn-sm" 
    onclick="openProductModal({{ $product->id }}, '{{ addslashes($product->name) }}', '{{ addslashes($product->description) }}', {{ $product->price }}, {{ $product->stock }}, {{ $product->category_id }})">
    Modifier
</button>

                        <form action="{{ route('products.delete', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sur de vouloir supprimer ce produit?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Add/Edit Product Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">Ajouter un Produit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="productForm" action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div id="methodField"></div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Description</label>
                        <textarea class="form-control" id="productDescription" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Prix</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="productStock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="productStock" name="stock" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Catégorie</label>
                        <select class="form-select" id="productCategory" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openProductModal(id = null, name = '', description = '', price = '', stock = '', categoryId = '') {
        const modal = new bootstrap.Modal(document.getElementById('productModal'));
        const form = document.getElementById('productForm');
        const methodField = document.getElementById('methodField');
        const productName = document.getElementById('productName');
        const productDescription = document.getElementById('productDescription');
        const productPrice = document.getElementById('productPrice');
        const productStock = document.getElementById('productStock');
        const productCategory = document.getElementById('productCategory');

        // Reset the form
        form.reset();
        methodField.innerHTML = '';

        if (id) {
            // Update existing product
            form.action = `{{ route('products.update', ['product' => ':id']) }}`.replace(':id', id);
            methodField.innerHTML = '@method("PUT")';
            productName.value = name;
            productDescription.value = description;
            productPrice.value = price;
            productStock.value = stock;
            productCategory.value = categoryId;
            document.getElementById('productModalLabel').textContent = 'Modifier le Produit';
        } else {
            // Create new product
            form.action = '{{ route("products.store") }}';
            document.getElementById('productModalLabel').textContent = 'Ajouter un Produit';
        }

        modal.show();
    }

    function submitProductForm() {
        document.getElementById('productForm').submit();
    }
</script>

@endsection
