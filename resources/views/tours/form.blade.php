<x-app-layout>
  <div>
    <?php
        $data = $data ?? [];
        $id = $data['uuid'] ?? null;
        $admin = \Auth::user()->is_admin;
    ?>
    @if(isset($id))
    {!! Form::open(['route' => ['tours.update.post', $id], 'method' => 'post' , 'enctype' => 'multipart/form-data']) !!}
    @else
    {!! Form::open(['route' => ['tours.create.post'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
    @endif
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
              <div class="header-title">
                  <h4 class="card-title">Informasi Tour</h4>
              </div>
              <div class="card-action">
                    <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary" role="button">Back</a>
              </div>
            </div>
            <div class="card-body">
              <div class="new-user-info">
                <div class="row">
                    <div class="form-group col-md-12">
                      <label class="form-label" for="fname">Nama tour: <span class="text-danger">*</span></label>
                      {{ Form::text('nama', $data['nama'] ?? old('nama'), ['class' => 'form-control', 'placeholder' => 'Nama  ', 'required', 'disabled' => $admin ? false : true]) }}
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="fname">Tanggal mulai: <span class="text-danger">*</span></label>
                      {{ Form::date('tanggal_mulai', $data['tanggal_mulai'] ?? old('tanggal_mulai'), ['class' => 'form-control', 'placeholder' => 'Tanggal mulai', 'required', 'disabled' => $admin ? false : true]) }}
                    </div>
                    <div class="form-group col-md-6">
                      <label class="form-label" for="fname">Tanggal selesai: <span class="text-danger">*</span></label>
                      {{ Form::date('tanggal_selesai', $data['tanggal_selesai'] ?? old('tanggal_selesai'), ['class' => 'form-control', 'placeholder' => 'Tanggal selesai', 'required', 'disabled' => $admin ? false : true]) }}
                    </div>
                    <div class="form-group col-md-12">
                      <label class="form-label" for="lname">Klien: <span class="text-danger">*</span></label>
                      <?php $value = isset($data['user_id']) ? $data['user_id'] : null; ?>
                      {{Form::select('user_id', getAvailableKlien(), $value ? $value : old('user_id'), ['class' => 'form-control', 'placeholder' => 'Pilih klien', 'required', 'disabled' => $admin ? false : true])}}
                    </div>                    
                </div>
                @if($id)
                  <hr>
                  @if($admin)
                  <h5 class="mb-3">Peserta <button style="float: right;" onclick="tambahForm('#peserta', 'peserta')" type="button" class="btn btn-primary">Tambah peserta</button></h5>                
                  @endif
                  <div id="peserta">
                  <br>
                  
                    @foreach($data['peserta'] as $peserta)
                    <div class="form-group">
                      <label style="width: 20%">Nama peserta</label>
                      <input {{!$admin ? 'disabled' : ''}} type="text" name="peserta[nama][]" value="{{$peserta->nama}}" placeholder="Nama peserta" style="width: 100%; margin-bottom: 10px">
                      @if($admin)<a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>@endif
                    </div>
                    @endforeach
                  </div>
                  <hr>
                  @if($admin)
                  <h5 class="mb-3">Transportasi <button style="float: right;" onclick="tambahForm('#transportasi', 'transportasi')" type="button" class="btn btn-primary">Tambah transportasi</button></h5>
                  @endif
                  <div id="transportasi">
                  <br>
                  
                  @foreach($data['transportasi'] as $transportasi)
                  <div class="form-group">
                    <label style="width: 20%">Nama transportasi</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$transportasi->nama}}" type="text" name="transportasi[nama][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Harga per orang</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$transportasi->harga_perorang}}" type="text" name="transportasi[harga_perorang][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Tanggal mulai sewa</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{date_format($transportasi->tanggal_mulai, 'Y-m-d')}}" type="date" name="transportasi[tanggal_mulai][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Tanggal selesai sewa</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{date_format($transportasi->tanggal_selesai, 'Y-m-d')}}" type="date" name="transportasi[tanggal_selesai][]" style="width: 100%; margin-bottom: 10px">
                    @if($admin)<a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>@endif
                  </div>
                  @endforeach
                  </div>
                  <hr>
                  @if($admin)
                  <h5 class="mb-3">Penginapan <button style="float: right;" onclick="tambahForm('#penginapan', 'penginapan')" type="button" class="btn btn-primary">Tambah penginapan</button></h5>
                  @endif
                  <div id="penginapan">
                  <br>
                  
                  @foreach($data['penginapan'] as $penginapan)
                  <div class="form-control">
                    <label style="width: 20%">Nama penginapan</label>  
                    <input {{!$admin ? 'disabled' : ''}} value="{{$penginapan->nama}}" type="text" name="penginapan[nama][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Alamat</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$penginapan->alamat}}" type="text" name="penginapan[alamat][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Tanggal check in</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{date_format($penginapan->tanggal_checkin, 'Y-m-d')}}" type="date" name="penginapan[tanggal_checkin][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Tanggal check out</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{date_format($penginapan->tanggal_checkout, 'Y-m-d')}}" type="date" name="penginapan[tanggal_checkout][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Harga per malam</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$penginapan->harga_permalam}}" type="text" name="penginapan[harga_permalam][]" style="width: 100%; margin-bottom: 10px">
                    @if($admin)<a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>@endif
                  </div>
                  @endforeach
                  </div>
                  <hr>
                  @if($admin)
                  <h5 class="mb-3">Wisata <button style="float: right;" onclick="tambahForm('#wisata', 'wisata')" type="button" class="btn btn-primary">Tambah wisata</button></h5>
                  @endif
                  <div id="wisata">
                  <br>
                  
                  @foreach($data['wisata'] as $wisata)
                  <div class="form-control">
                    <label style="width: 20%">Nama wisata</label>  
                    <input {{!$admin ? 'disabled' : ''}} value="{{$wisata->nama}}" type="text" name="wisata[nama][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Alamat</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$wisata->alamat}}" type="text" name="wisata[alamat][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Tanggal berangkat</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{date_format($wisata->tanggal_berangkat, 'Y-m-d')}}" type="date" name="wisata[tanggal_berangkat][]" style="width: 100%; margin-bottom: 10px">
                    <label style="width: 20%">Harga tiket</label>
                    <input {{!$admin ? 'disabled' : ''}} value="{{$wisata->harga_tiket}}" type="text" name="wisata[harga_tiket][]" style="width: 100%; margin-bottom: 10px">
                    @if($admin)<a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>@endif
                  </div>
                  @endforeach
                  </div>
                @endif
                <br>
                @if($admin)
                <button type="submit" class="btn btn-primary">{{ $id ? 'Update' : 'Tambah' }} Tour</button>
                @endif
              </div>
            </div>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
  @section('custom')
  <script>
    function tambahForm(parent, jenis) {
      forms = {
        'peserta': `
          <div class="form-group">
            <label style="width: 20%">Nama peserta</label>
            <input type="text" name="peserta[nama][]" placeholder="Nama peserta" style="width: 100%; margin-bottom: 10px">
            <a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>
          </div>
        `,
        'transportasi': `
          <div class="form-group">
            <label style="width: 20%">Nama transportasi</label>
            <input type="text" name="transportasi[nama][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Harga per orang</label>
            <input type="text" name="transportasi[harga_perorang][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Tanggal mulai sewa</label>
            <input type="date" name="transportasi[tanggal_mulai][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Tanggal selesai sewa</label>
            <input type="date" name="transportasi[tanggal_selesai][]" style="width: 100%; margin-bottom: 10px">
            <a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>
          </div>
        `,
        'penginapan': `
          <div class="form-control">
            <label style="width: 20%">Nama penginapan</label>  
            <input type="text" name="penginapan[nama][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Alamat</label>
            <input type="text" name="penginapan[alamat][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Tanggal check in</label>
            <input type="date" name="penginapan[tanggal_checkin][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Tanggal check out</label>
            <input type="date" name="penginapan[tanggal_checkout][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Harga per malam</label>
            <input type="text" name="penginapan[harga_permalam][]" style="width: 100%; margin-bottom: 10px">
            <a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>
          </div>
        `,
        'wisata': `
          <div class="form-control">
            <label style="width: 20%">Nama wisata</label>  
            <input type="text" name="wisata[nama][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Alamat</label>
            <input type="text" name="wisata[alamat][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Tanggal berangkat</label>
            <input type="date" name="wisata[tanggal_berangkat][]" style="width: 100%; margin-bottom: 10px">
            <label style="width: 20%">Harga tiket</label>
            <input type="text" name="wisata[harga_tiket][]" style="width: 100%; margin-bottom: 10px">
            <a class="btn btn-sm btn-danger" onclick="hapusItem(event)">Hapus</a>
          </div>
        `
      }

      $(parent).append(forms[jenis])
    }

    function hapusItem(e) {
      $(e.target).parent().remove()
    }
  </script>
  @endsection
</x-app-layout>