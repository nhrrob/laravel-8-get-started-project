@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Roles') }}</div>

                <div class="card-body">
                    @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                    @endif

                    <p><a class="btn btn-success" href='{{ route("admin.roles.create") }}'><i class="fa fa-plus"></i> Create Role</a></p>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Name
                                </th>

                                <th>
                                    Permissions
                                </th>

                                <th>
                                    Created
                                </th>
                                <th width="5%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $role)
                            <tr>
                                <td>
                                    {{ $role->name ?? 'N/A' }}
                                </td>

                                <td>
                                    @foreach($role->permissions as $perm)
                                    <span class="badge badge-info mb-1 p-1 text-white" style="font-size: 12px;">{{$perm->name}}</span>
                                    @endforeach
                                </td>

                                <td>
                                    {{ optional($role->created_at)->diffForHumans() }}
                                </td>

                                <td>
                                    <a class="btn btn-success d-block mb-2" href='{{ route("admin.roles.edit", $role->id) }}'><i class="fa fa-pencil"></i> Edit</a>

                                    <form method="POST" action='{{ route("admin.roles.destroy", $role->id) }}'>
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <div class="form-group">
                                            <i class="fa fa-times"></i>
                                            <input type="submit" class="btn btn-danger d-block" value="Delete">
                                        </div>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" align="center">No records found!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination  -->
                    <div class="d-flex justify-content-center">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection