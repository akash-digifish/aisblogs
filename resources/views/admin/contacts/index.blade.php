@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="m-0">Manage Contact Messages</h2>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($contacts->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country Code</th>
                        <th>Mobile</th>
                        <th>Company</th>
                        <th>Message</th>
                        <th>Country Name</th>
                        
                        <th>Accepted Policy</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($contacts as $index => $contact)
                        <tr>
                            <td>{{ $contacts->firstItem() + $index }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>{{ $contact->country_code ?? '-' }}</td>
                            <td>{{ $contact->mobile ?? '-' }}</td>
                            <td>{{ $contact->company ?? '-' }}</td>
                            <td>{{ $contact->message }}</td>
                             <td>{{ $contact->country_name }}</td>
                            <td class="text-center">
                                @if($contact->accepted_policy)
                                    <span class="badge bg-success">Yes</span>
                                @else
                                    <span class="badge bg-danger">No</span>
                                @endif
                            </td>
                            <td>{{ $contact->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $contacts->links() }}
        </div>
    @else
        <p class="text-center">No contact messages found.</p>
    @endif
</div>
@endsection
