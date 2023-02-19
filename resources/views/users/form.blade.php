<x-app-layout>
  <div>
    <?php
        $data = $data ?? [];
        $id = $data['uuid'] ?? null;
        $admin = \Auth::user()->is_admin;
    ?>
    @if(isset($id))
    {!! Form::open(['route' => ['users.update.post', $id], 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
    @else
    {!! Form::open(['route' => ['users.create.post'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
    @endif
    <form id="form-users-create">
    <div class="row">
      @if($admin)
      <div class="col-xl-3 col-lg-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">{{$id !== null ? 'Update' : 'Add' }} User</h4>
              </div>
            </div>
            <div class="card-body">              
              <label class="form-label">Admin: <span class="text-danger">*</span></label>
              <div class="grid" style="--bs-gap: 1rem">
                  <div class="form-check g-col-6">
                      <?php $is_admin = isset($data['is_admin']) ? $data['is_admin'] : null ?>
                      {{ Form::radio('is_admin', false, $is_admin != null && !$is_admin ? true : true, ['class' => 'form-check-input', 'id' => 'status-active', 'required']); }}
                      <label class="form-check-label" for="status-active">
                          User
                      </label>
                  </div>
                  <div class="form-check g-col-6">
                      {{ Form::radio('is_admin', true, $is_admin != null && $is_admin ? true : false, ['class' => 'form-check-input', 'id' => 'status-inactive', 'required']); }}
                      <label class="form-check-label" for="status-inactive">
                          Admin
                      </label>
                  </div>
              </div>
            </div>
        </div>
      </div>
      @endif
      <div class="col-xl-{{$admin ? '9' : '12'}}">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">User Information</h4>
              </div>
              <div class="card-action">
                    <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary" role="button">Back</a>
              </div>
            </div>
            <div class="card-body">
              <div class="new-user-info">
                <div class="row">
                    <div class="form-group col-md-6">
                      <label class="form-label" for="fname">Nama: <span class="text-danger">*</span></label>
                      {{ Form::text('name', $data['name'] ?? old('name'), ['class' => 'form-control', 'placeholder' => 'Nama', 'required']) }}
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="lname">Alamat:</label>
                      {{ Form::text('address', $data['address'] ?? old('address'), ['class' => 'form-control', 'placeholder' => 'Alamat']) }}
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="lname">No. HP:</label>
                      {{ Form::text('phone_number', $data['phone_number'] ?? old('phone_number'), ['class' => 'form-control', 'placeholder' => 'No. HP']) }}
                    </div>
                </div>
                <hr>
                <h5 class="mb-3">Security</h5>
                <div class="row">
                    <div class="form-group col-md-6">
                      <label class="form-label" for="uname">Username: <span class="text-danger">*</span></label>
                      {{ Form::text('username', $data['username'] ?? old('username'), ['class' => 'form-control', 'placeholder' => 'Username', 'required']) }}
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="pass">Password: <span class="text-danger">*</span></label>
                      {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password', 'required' => $id ? false : true]) }}
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">{{ $id ? 'Update' : 'Tambah' }} User</button>
              </div>
            </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</x-app-layout>