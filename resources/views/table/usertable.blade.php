<x-app-layout>
<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">User table</h4>
            </div>
         </div>
         <div class="card-body p-0">
            <div class="table-responsive mt-4">
               <table id="basic-table" class="table table-striped mb-0" role="grid">
                  <thead>
                     <tr>
                        <th>Nama</th>
                        <th>Username</th> 
                        <th>No. HP</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($data as $user)
                     <tr>
                        <?php $id = $user['uuid'] ?>
                        <td style="cursor:pointer;" onclick="window.location = '/users/update/{{$id}}'">
                           <div class="d-flex align-items-center">
                              <h6>{{$user['name'] ?? ''}}</h6>
                              @if($user['is_admin'] == 1)
                              <code style="padding:0 5px 0 5px;background-color:#f2d6d3;color:black;width:auto;height:auto;margin-left:3px;border-radius:20px">admin</code>
                              @endif
                           </div>
                        </td>
                        <td>
                           {{$user['username'] ?? ''}}
                        </td>
                        <td>{{$user['phone_number'] ?? ''}}</td>
                        <td style="float: right">
                           <form action="{{route('users.delete.post', ['id' => $id])}}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                           </form>
                        </td>
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
</x-app-layout>