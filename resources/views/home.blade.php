@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(auth()->user()->is_admin)
                        <h1>Pending user list</h1>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">No.</th>
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Email</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td scope="row" align="center">{{$loop->index + 1}}</td>
                                        <td align="center">{{$user->name}}</td>
                                        <td align="center">{{$user->email}}</td>
                                        <td align="center">
                                            <a href="{{route('user.status', [$user->id, 'approved'])}}" class="btn btn-success">Accept</a>
                                            <a href="{{route('user.status', [$user->id, 'rejected'])}}" class="btn btn-danger">Decline</a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" align="center">No pending request</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @else
                        @if(auth()->user()->status === 'approved')
                            <p>Welcome! You have successfully logged in.</p>
                        @else
                            <p>Your registration is pending approval from an Admin.</p>
                            <p>Please be patient. We will notify you.</p>
                        @endif
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
