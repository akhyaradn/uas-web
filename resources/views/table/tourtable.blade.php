<x-app-layout>
<?php
   $admin = \Auth::user()->is_admin;
?>
<div class="row">
   <div class="col-sm-12">
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div class="header-title">
               <h4 class="card-title">Tour table</h4>
            </div>
         </div>
         <div class="card-body p-0">
            <div class="table-responsive mt-4">
               <table id="basic-table" class="table table-striped mb-0" role="grid">
                  <thead>
                     <tr>
                        <th>Nama tour</th>
                        <th>Tanggal tour</th> 
                        @if($admin)
                        <th></th>
                        @endif
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($data as $tour)
                     <tr>
                        <?php $id = $tour['uuid'] ?>
                        @if($admin)
                        <td style="cursor:pointer;" onclick="window.location = '/tours/update/{{$id}}'">
                           <div class="d-flex align-items-center">
                              <h6>{{$tour['nama'] ?? ''}}</h6>
                           </div>
                        </td>
                        @else
                        <td style="cursor:pointer;" onclick="window.location = '/tours/update/{{$id}}'">
                           <div class="d-flex align-items-center">
                              <h6>{{$tour['nama'] ?? ''}}</h6>
                           </div>
                        </td>
                        @endif
                        <td>
                           {{$tour['tanggal_mulai'] ? date_format($tour['tanggal_mulai'], "d M Y") : ''}} - {{$tour['tanggal_selesai'] ? date_format($tour['tanggal_selesai'], "d M Y") : ''}}
                        </td>
                        @if($admin)
                        <td style="float: right">
                           <form action="{{route('tours.delete.post', ['id' => $id])}}" method="post">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                              <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                           </form>
                        </td>
                        @endif
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