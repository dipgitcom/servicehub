@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Add New Category</h1>
                <a href="{{ route('admin.categories') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left me-2"></i> Back to Categories
                </a>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Select Icon</label>
                                    <input type="hidden" id="icon" name="icon" value="{{ old('icon', 'grid') }}">
                                    
                                    <div class="icon-grid">
                                        <div class="icon-option selected" data-icon="grid">
                                            <i class="bi bi-grid"></i>
                                            <span>Grid</span>
                                        </div>
                                        <div class="icon-option" data-icon="house">
                                            <i class="bi bi-house"></i>
                                            <span>House</span>
                                        </div>
                                        <div class="icon-option" data-icon="tools">
                                            <i class="bi bi-tools"></i>
                                            <span>Tools</span>
                                        </div>
                                        <div class="icon-option" data-icon="car-front">
                                            <i class="bi bi-car-front"></i>
                                            <span>Car</span>
                                        </div>
                                        <div class="icon-option" data-icon="laptop">
                                            <i class="bi bi-laptop"></i>
                                            <span>Laptop</span>
                                        </div>
                                        <div class="icon-option" data-icon="camera">
                                            <i class="bi bi-camera"></i>
                                            <span>Camera</span>
                                        </div>
                                        <div class="icon-option" data-icon="heart">
                                            <i class="bi bi-heart"></i>
                                            <span>Heart</span>
                                        </div>
                                        <div class="icon-option" data-icon="flower1">
                                            <i class="bi bi-flower1"></i>
                                            <span>Flower</span>
                                        </div>
                                        <div class="icon-option" data-icon="cup-hot">
                                            <i class="bi bi-cup-hot"></i>
                                            <span>Coffee</span>
                                        </div>
                                        <div class="icon-option" data-icon="book">
                                            <i class="bi bi-book"></i>
                                            <span>Book</span>
                                        </div>
                                        <div class="icon-option" data-icon="calendar">
                                            <i class="bi bi-calendar"></i>
                                            <span>Calendar</span>
                                        </div>
                                        <div class="icon-option" data-icon="truck">
                                            <i class="bi bi-truck"></i>
                                            <span>Truck</span>
                                        </div>
                                        <div class="icon-option" data-icon="droplet">
                                            <i class="bi bi-droplet"></i>
                                            <span>Droplet</span>
                                        </div>
                                        <div class="icon-option" data-icon="fan">
                                            <i class="bi bi-fan"></i>
                                            <span>Fan</span>
                                        </div>
                                        <div class="icon-option" data-icon="scissors">
                                            <i class="bi bi-scissors"></i>
                                            <span>Scissors</span>
                                        </div>
                                        <div class="icon-option" data-icon="shield">
                                            <i class="bi bi-shield"></i>
                                            <span>Shield</span>
                                        </div>
                                        <div class="icon-option" data-icon="lock">
                                            <i class="bi bi-lock"></i>
                                            <span>Lock</span>
                                        </div>
                                        <div class="icon-option" data-icon="file-text">
                                            <i class="bi bi-file-text"></i>
                                            <span>File</span>
                                        </div>
                                    </div>
                                    @error('icon')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="status" name="status" {{ old('status', '1') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status">Active</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Category Image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
                                    <div class="form-text">Recommended size: 600x400 pixels. Max size: 2MB.</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="mt-2">
                                        <img id="image-preview" src="{{ asset('images/services/service-placeholder.jpg') }}" alt="Category Image Preview" class="img-fluid rounded">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
        
        // Icon selection
        const iconOptions = document.querySelectorAll('.icon-option');
        const iconInput = document.getElementById('icon');
        
        iconOptions.forEach(option => {
            option.addEventListener('click', function() {
                // Remove selected class from all options
                iconOptions.forEach(opt => opt.classList.remove('selected'));
                
                // Add selected class to clicked option
                this.classList.add('selected');
                
                // Update hidden input value
                iconInput.value = this.dataset.icon;
            });
        });
        
        // Set initial selected icon
        const initialIcon = iconInput.value;
        if (initialIcon) {
            const selectedOption = document.querySelector(`.icon-option[data-icon="${initialIcon}"]`);
            if (selectedOption) {
                iconOptions.forEach(opt => opt.classList.remove('selected'));
                selectedOption.classList.add('selected');
            }
        }
    });
</script>
@endsection
