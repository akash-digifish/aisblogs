@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($podcasts->count())
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Msg</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($podcasts as $index => $podcast)
                        <tr>
                            <td>{{ $podcasts->firstItem() + $index }}</td>
                            <td>{{ $podcast->name }}</td>
                            <td>{{ $podcast->email }}</td>
                           
                            <td>{{ $podcast->company }}</td>
                            <td>{{ $podcast->msg }}</td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $podcasts->links() }}
        </div>
    @else
        <p class="text-center">No podcasts found.</p>
    @endif
</div>
@endsection
