@extends('layouts.app')

@section('content')
<section class="food-diary-section">
    <h2 class="page-title">3-Day Food Diary</h2>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    {{-- Loop 3 days --}}
    @for($day = 1; $day <= 3; $day++)
        @php $meals = session("day{$day}_meals", []); @endphp

        <div class="accordion">
            <div class="accordion-header">
                <h4>Day {{ $day }}</h4>
            </div>

            <div class="accordion-body" style="display: {{ $day==1 ? 'block':'none' }};">
                <table class="table table-bordered table-food">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Meal</th>
                            <th>Time</th>
                            <th>Food</th>
                            <th>Portion</th>
                            <th>Drink</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($meals as $i => $meal)
                            <tr data-day="{{ $day }}" data-index="{{ $i }}">
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $meal['meal'] }}</td>
                                <td>{{ $meal['time'] }}</td>
                                <td>{{ $meal['food'] }}</td>
                                <td>{{ $meal['portion'] }}</td>
                                <td>{{ $meal['drink'] }}</td>
                                <td>
                                    @if(!empty($meal['image']))
                                        <img src="{{ asset($meal['image']) }}" class="meal-img">
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn-edit edit-meal">Edit</button>
                                    <button class="btn-delete delete-meal">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">No meals added for Day {{ $day }}.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#mealModal" data-day="{{ $day }}">
                    + Add Meal for Day {{ $day }}
                </button>
            </div>
        </div>
    @endfor

    {{-- Save All & View Diary --}}
<div class="save-all d-flex justify-content-center gap-3 mt-4">

    {{-- Save All --}}
    <form action="{{ route('food-diary.submitFinal') }}" method="POST">
        @csrf
        <button type="submit" class="btn-save-all">
            💾 Save All to MongoDB
        </button>
    </form>

    {{-- View Diary Log --}}
    <a href="{{ route('food-diary.index') }}" class="btn-view-diary">
        📄 View Diary Log
    </a>

</div>

</section>

{{-- Modal --}}
<div class="modal fade" id="mealModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header border-0">
                <h5 class="modal-title">Add / Edit Meal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="meal-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="day" id="meal-day">
                <input type="hidden" name="index" id="meal-index">

                <div class="form-group">
                    <label>Meal Type</label>
                    <select name="meal" id="meal-type" class="form-select" required>
                        <option value="">-- Select Meal --</option>
                        <option value="Breakfast">Breakfast</option>
                        <option value="Lunch">Lunch</option>
                        <option value="Dinner">Dinner</option>
                        <option value="Snack">Snack</option>
                        <option value="Supper">Supper</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Time</label>
                    <input type="time" name="time" id="meal-time" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Food Name & Description</label>
                    <input type="text" name="food" id="meal-food" class="form-control" placeholder="e.g. Nasi Lemak" required>
                </div>
                <div class="form-group">
                    <label>Portion</label>
                    <select name="portion" id="meal-portion" class="form-select" required>
                        <option value="">-- Select Portion --</option>
                        <option value="Full plate">Full plate</option>
                        <option value="Half plate">Half plate</option>
                        <option value="Quarter plate">Quarter plate</option>
                        <option value="1 piece">1 piece</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Drink & Description</label>
                    <input type="text" name="drink" id="meal-drink" class="form-control" placeholder="e.g. 1 glass of Milo ais" required>
                </div>
                <div class="form-group">
                    <label>Image (optional)</label>
                    <input type="file" name="image" id="meal-image" class="form-control">
                </div>

                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-primary">Save Meal</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JS --}}
<script>
    // Accordion toggle
    document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const body = header.nextElementSibling;
            const isVisible = body.style.display === 'block';
            document.querySelectorAll('.accordion-body').forEach(b => b.style.display = 'none');
            body.style.display = isVisible ? 'none' : 'block';
        });
    });

    // Modal open
    const mealModal = document.getElementById('mealModal');
    mealModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const day = button.getAttribute('data-day');
        document.getElementById('meal-day').value = day;
        document.getElementById('meal-index').value = '';
        document.getElementById('meal-form').reset();
    });

    // Save Meal
    document.getElementById('meal-form').addEventListener('submit', function(e){
        e.preventDefault();
        const day = document.getElementById('meal-day').value;
        const formData = new FormData(this);
        fetch(`{{ url('food-diary/day') }}/${day}/add-item`, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value },
            body: formData
        })
        .then(res => res.json())
        .then(data => data.success ? location.reload() : alert('Error saving meal'));
    });

    // Delete Meal
    document.querySelectorAll('.delete-meal').forEach(btn => {
    btn.addEventListener('click', function () {
        if (!confirm('Delete this meal?')) return;

        const row = this.closest('tr');
        const day = row.dataset.day;
        const index = row.dataset.index;

        fetch(`{{ url('food-diary/day') }}/${day}/${index}/delete`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                row.remove();
            } else {
                alert('Failed to delete meal');
            }
        })
        .catch(err => {
            console.error('Error:', err);
            alert('Something went wrong');
        });
    });
});

    // Edit Meal
    document.querySelectorAll('.edit-meal').forEach(btn => {
        btn.addEventListener('click', function(){
            const row = this.closest('tr');
            const day = row.dataset.day;
            const index = row.dataset.index;
            document.getElementById('meal-day').value = day;
            document.getElementById('meal-index').value = index;
            document.getElementById('meal-type').value = row.children[1].textContent.trim();
            document.getElementById('meal-time').value = row.children[2].textContent.trim();
            document.getElementById('meal-food').value = row.children[3].textContent.trim();
            document.getElementById('meal-portion').value = row.children[4].textContent.trim();
            document.getElementById('meal-drink').value = row.children[5].textContent.trim();
            new bootstrap.Modal(document.getElementById('mealModal')).show();
        });
    });
</script>
@endsection
