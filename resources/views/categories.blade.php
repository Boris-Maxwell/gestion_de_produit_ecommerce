@extends('home')

@section('content')

    <div class="container">
        <h1 class="mb-4">Catégories</h1>

        <div class="mb-3">
            <button class="btn btn-primary" onclick="openCategoryModal()">Créer une catégorie</button>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <button class="btn btn-success btn-sm" onclick="openCategoryModal({{ $category->id }}, '{{ $category->name }}')">Modifier</button>
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Etes-vous sur de vouloir supprimer cette catégorie?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Créer une Catégorie</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm" action="{{ route('categories.store') }}" method="POST">
                        @csrf
                        <div id="methodField"></div>
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="categoryName" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openCategoryModal(id = null, name = '') {
            const modal = new bootstrap.Modal(document.getElementById('categoryModal'));
            const form = document.getElementById('categoryForm');
            const methodField = document.getElementById('methodField');
            const categoryName = document.getElementById('categoryName');

            // Reset the form
            form.reset();
            methodField.innerHTML = '';

            if (id) {
                // Update existing category
                form.action = `/categories/${id}`;
                methodField.innerHTML = '@method("PUT")';
                categoryName.value = name;
                document.getElementById('categoryModalLabel').textContent = 'Modifier la Catégorie';
            } else {
                // Create new category
                form.action = '{{ route("categories.store") }}';
                document.getElementById('categoryModalLabel').textContent = 'Créer une Catégorie';
            }

            modal.show();
        }
    </script>

@endsection
