@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Employee') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
					<div class="d-flex justify-content-end mb-4">
						<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Add Data</button>
					</div>
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">Name</th>
								<th scope="col">Email</th>
								<th scope="col">Company</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
					<tbody>
						@foreach($getEmployees as $key => $data)
						<tr>
							<th>{{ $data->name }}</th>
							<td>{{ $data->email }}</td>
							<td>{{ $data->companies->name }}</td>
							<td>
								<button type="button" class="btn btn-primary my-1" data-toggle="modal" data-target="#modalDetail{{ $data->id }}">Details</button>
								<button type="button" class="btn btn-warning my-1" data-toggle="modal" data-target="#modalUpdate{{ $data->id }}">Edit</button>
								<form action="deleteEmployee/{{ $data->id }}" method="post" class="form-validation">
									{{ csrf_field() }}
             						{{ method_field('DELETE') }}
									<button type="submit" class="btn btn-danger my-1">Delete</button>
								</form>
							</td>
						</tr>
						{{--Modal detail--}}
						<div class="modal fade" id="modalDetail{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDetail">
							<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">{{ $data->name }}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Employee Name</label>
											<input type="text" class="form-control" placeholder="Enter name" name="nama" value="{{ $data->name }}" disabled>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $data->email }}" disabled>
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Company</label>
											<input type="text" class="form-control" placeholder="Enter websites" name="website" value="{{ $data->companies->name }}" disabled>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
						{{--end modal--}}

						{{--Modal Edit--}}
						<div class="modal fade" id="modalUpdate{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="modalUpdate">
							<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="POST" action="updateEmployee/{{ $data->id }}" enctype="multipart/form-data">
									{{ csrf_field() }}
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Edit Employee Data</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="exampleInputEmail1">Employee Name</label>
											<input type="text" class="form-control" placeholder="Enter name" name="nama" value="{{ $data->name }}">
										</div>
										<div class="form-group">
											<label for="exampleInputEmail1">Email address</label>
											<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ $data->email }}">
											<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
										</div>
										<div class="form-group">
											<label>Company</label>
											<select name="company" class="form-control">
											<option value="">Select a Company</option>
												@foreach ($companyList as $key => $combo)
													<option value="{{ $combo->id }}" {!! ($data->company_id ? "selected" : "") !!}>{{ $combo->name }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Save changes</button>
									</div>
									</form>
								</div>
							</div>
						</div>
						{{--Modal end--}}
						@endforeach
					</tbody>
					</table>
					{{ $getEmployees->links() }}
                </div>
            </div>
        </div>
    </div>

	{{--Modal Add--}}
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
			<div class="modal-content">
				<form method="POST" action="{{ route('employee.submit') }}" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Employee Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label for="exampleInputEmail1">Employee Name</label>
						<input type="text" class="form-control" placeholder="Enter name" name="nama" required>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">Email address</label>
						<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" required>
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
					<div class="form-group">
						<label>Company</label>
						<select name="company" class="form-control">
						<option value="">Select a Company</option>
							@foreach ($companyList as $key => $combo)
								<option value="{{ $combo->id }}">{{ $combo->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	{{--End modal--}}
</div>
@endsection
