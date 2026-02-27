@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="mb-4 fw-bold text-danger">🛒 Add New Product</h2>

    <div class="card shadow p-4">

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Price</label>
                <input type="number" step="0.01" name="price" id="price" class="form-control" required>
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">Tax (%)</label>
                <input type="number" step="0.01" name="tax_percent" id="tax_percent" class="form-control" value="0">
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">Final Price (Auto)</label>
                <input type="number" step="0.01" name="final_price" id="final_price" class="form-control" readonly>
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">Category</label>

                <div class="input-group">
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>



                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#addCategoryModal">
                        + Add
                    </button>
                </div>
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>


            <div class="mb-3">
                <label class="form-label fw-bold">Product Image</label>
                <input type="file" name="image" class="form-control">
            </div>

            <button class="btn btn-danger w-100 fw-bold">Save Product</button>

        </form>

    </div>
</div>





<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <form id="addCategoryForm">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-danger w-100 fw-bold">Save Category</button>
                </form>
            </div>

        </div>
    </div>
</div>




<script>
document.getElementById("addCategoryForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('categories.store') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {

        if (data.success) {

            let select = document.querySelector("select[name='category_id']");
            let option = document.createElement("option");
            option.value = data.category.id;
            option.textContent = data.category.name;
            select.appendChild(option);

            select.value = data.category.id;

            var modal = bootstrap.Modal.getInstance(document.getElementById("addCategoryModal"));
            modal.hide();

            document.getElementById("addCategoryForm").reset();
        }
    })
    .catch(err => console.error(err));
});


document.getElementById('price').addEventListener('input', calculateFinal);
document.getElementById('tax_percent').addEventListener('input', calculateFinal);

function calculateFinal() {
    let price = parseFloat(document.getElementById('price').value) || 0;
    let tax = parseFloat(document.getElementById('tax_percent').value) || 0;

    let finalPrice = price + (price * (tax / 100));
    document.getElementById('final_price').value = finalPrice.toFixed(2);
}
</script>

@endsection
