@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">🛒 Checkout</h2>

    @if(empty($cart) || count($cart) === 0)
        <div class="alert alert-warning text-center">
            Your cart is empty.
        </div>
    @else
    <form id="checkoutForm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-4">
                <label>Customer Name</label>
                <input type="text" id="customer_name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Phone</label>
                <input type="text" id="phone" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label>Address</label>
                <input type="text" id="address" class="form-control" required>
            </div>
        </div>

        <div class="table-responsive mb-3">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>KG</th>
                        <th>Rate / KG</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($cart as $id => $item)
                    <tr data-id="{{ $id }}">
                        <td>{{ $item['name'] }}</td>
                        <td>
                            <input type="number" class="form-control kg-input" 
                                   value="{{ $item['kg'] ?? 0.5 }}" step="0.1" min="0.1">
                        </td>
                        <td>Rs {{ $item['price'] }}</td>
                        <td class="item-total">Rs {{ ($item['kg'] ?? 0.5) * $item['price'] }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger remove-btn">Remove</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <h4 class="text-end">Grand Total: Rs <span id="grandTotal">{{ $grand_total }}</span></h4>
        <button type="submit" class="btn btn-success w-100 mt-3">Place Order & Send WhatsApp</button>
    </form>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
axios.defaults.headers.common['X-CSRF-TOKEN'] =
    document.querySelector('meta[name="csrf-token"]').content;

function showMessage(message, type='info') {
    alert(message); // Replace with toast if needed
}

// Update KG dynamically
document.querySelectorAll('.kg-input').forEach(input => {
    input.addEventListener('change', function() {
        const tr = this.closest('tr');
        const id = tr.dataset.id;
        const kg = parseFloat(this.value) || 0.5;

        const url = "{{ route('cart.update', ['id'=>'ID_PLACEHOLDER']) }}".replace('ID_PLACEHOLDER', id);

        axios.post(url, { kg })
            .then(res => {
                tr.querySelector('.item-total').innerText = 'Rs ' + res.data.item_total;
                document.getElementById('grandTotal').innerText = res.data.grand_total;
            })
            .catch(err => {
                console.error(err.response ? err.response.data : err);
                showMessage('Update failed. Check console.', 'danger');
            });
    });
});

// Remove item
document.querySelectorAll('.remove-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const tr = this.closest('tr');
        const id = tr.dataset.id;

        const url = "{{ route('cart.remove', ['id'=>'ID_PLACEHOLDER']) }}".replace('ID_PLACEHOLDER', id);

        axios.post(url)
            .then(res => {
                tr.remove();
                document.getElementById('grandTotal').innerText = res.data.grand_total;
                showMessage('Item removed.', 'warning');
                if(res.data.grand_total == 0) location.reload();
            })
            .catch(err => {
                console.error(err.response ? err.response.data : err);
                showMessage('Remove failed. Check console.', 'danger');
            });
    });
});

// Checkout / WhatsApp
document.getElementById('checkoutForm')?.addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('customer_name').value;
    const phone = document.getElementById('phone').value;
    const address = document.getElementById('address').value;

    if (!name || !phone || !address) { 
        alert('Name, phone & address are required'); 
        return; 
    }

    axios.post("{{ route('cart.submit') }}", { name, phone, address })
        .then(res => {
            if(res.data.success) {
                window.open(res.data.whatsapp_url, '_blank');
                showMessage('✅ Order placed successfully', 'success');
                window.location.href = "{{ url('menu') }}";
            }
        })
        .catch(err => {
            console.error(err.response ? err.response.data : err);
            showMessage('❌ Checkout failed. Check console.', 'danger');
        });
});
</script>
@endsection
