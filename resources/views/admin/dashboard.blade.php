@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Admin Dashboard</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Services</h5>
                            <h2 class="mb-0">{{ $serviceCount }}</h2>
                        </div>
                        <div class="dashboard-icon">
                            <i class="bi bi-tools"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.services') }}" class="btn btn-sm btn-outline-primary mt-3">Manage Services</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Service Categories</h5>
                            <h2 class="mb-0">{{ $categoryCount }}</h2>
                        </div>
                        <div class="dashboard-icon">
                            <i class="bi bi-grid"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.categories') }}" class="btn btn-sm btn-outline-primary mt-3">Manage Categories</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="mb-0">{{ $userCount }}</h2>
                        </div>
                        <div class="dashboard-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <a href="#" class="btn btn-sm btn-outline-primary mt-3">Manage Users</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Services</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Service</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>AC Repair</td>
                                    <td>AC Services</td>
                                    <td>৳1,500</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Home Cleaning</td>
                                    <td>Cleaning</td>
                                    <td>৳1,200</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Plumbing</td>
                                    <td>Home Services</td>
                                    <td>৳800</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Bookings</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Service</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td>AC Repair</td>
                                    <td>May 10, 2025</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td>Home Cleaning</td>
                                    <td>May 9, 2025</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>Robert Johnson</td>
                                    <td>Plumbing</td>
                                    <td>May 8, 2025</td>
                                    <td><span class="badge bg-primary">Confirmed</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
