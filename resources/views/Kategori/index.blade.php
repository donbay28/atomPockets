@include('Template/Header')
@include('Template/Body')
    <div class="page-wrapper">
      <div class="container-fluid">
          <div class="row page-titles">
              <div class="col-md-5 align-self-center">
                  <h4 class="text-themecolor">Master Kategori</h4>
              </div>
              <div class="col-md-7 align-self-center text-right">
                  <div class="d-flex justify-content-end align-items-center">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item">Home</li>
                          <li class="breadcrumb-item active">Data Kategori</li>
                      </ol>
                  </div>
              </div>
          </div>
          <div class="row">

              <div class="col-12">
                  <div class="card">
                      <div class="card-body">
                      <div class="row">
                          <div class="col-md-5">
                            <div class="form-group">
                              <a class="btn btn-info" href="{{url('/kategoris/create')}}" role="button"><i class="fa fa-plus-circle"></i>Buat Baru</a>
                              <select class="btn btn-md btn-info" id="filter-status">
                                <option value="0">Semua</option>
                                <option value="1">Aktif</option>
                                <option value="2">Tidak Aktif</option>
                              </select>
                            </div>
                          </div>
                      </div>
                      <br>
                      <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable">
                          <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody id="dataTab">
                              @if($data_kategori ?? '' != null)
                                  @foreach($data_kategori ?? '' ?? '' as $key => $row)
                                      <tr>
                                        <td>{{ ++$key}}</td>
                                        <td>{{$row->nama}}</td>
                                        <td>{{$row->deskripsi}}</td>
                                        <td>
                                          @if ($row->status_id == 1)
                                              Aktif
                                          @else
                                              Tidak Aktif
                                          @endif
                                        </td>
                                        <td>
                                            <a href="{{url('/kategoris/show/'.$row->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i> Detail</a>
                                            <a href="{{url('/kategoris/edit/'.$row->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i> Edit</a>
                                            @if ($row->status_id == 1)
                                              <a href="{{url('/kategoris/changeStatus/'.$row->id.'/'.$row->status_id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Change To Tidak Aktif"><i class="fa fa-times"></i> Tidak Aktif</a>
                                            @else
                                              <a href="{{url('/kategoris/changeStatus/'.$row->id.'/'.$row->status_id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Change To Aktif"><i class="fa fa-check"></i> Aktif</a>
                                            @endif
                                        </td>
                                      </tr>
                                  @endforeach
                              @else
                              <tr><td>Data Not Found</td></tr>
                              @endif
                              </tbody>
                          </table>
                      </div>
                      </div>
                  </div>
              </div>

          </div>

      </div>
      <!-- ============================================================== -->
      <!-- End Container fluid  -->
      <!-- ============================================================== -->
    </div>
    <script>
        $(document).on("change", "#filter-status", function(e) {
            status_id = $('#filter-status').val();
            $.ajax({
                type: 'POST',
                url: '/dompets/filterStatus/'+status_id,
                data: {
                    "status_id": status_id,
                    '_token': '{{ csrf_token() }}',
                }
            })
            .done(function(response){
                var appendString = "";
                for(var i = 0; i < response.length; i++){
                    let status;
                    let actionTag;
                    let detailTag;
                    let editTag;
                    if(response[i].status_id == 1){
                        status = "Aktif"
                        actionTag = '<a href="{{url('/dompets/changeStatus/'.$row->id.'/'.$row->status_id)}}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Change To Tidak Aktif"><i class="fa fa-times"></i> Tidak Aktif</a>';
                        detailTag = '<a href="{{url('/dompets/show/'.$row->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i> Detail</a>';
                        editTag = '<a href="{{url('/dompets/edit/'.$row->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i> Edit</a>';
                    }else{
                        status = "Tidak Aktif"
                        actionTag = '<a href="{{url('/dompets/changeStatus/'.$row->id.'/'.$row->status_id)}}" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top" title="Change To Aktif"><i class="fa fa-check"></i> Aktif</a>';
                        detailTag = '<a href="{{url('/dompets/show/'.$row->id)}}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-eye"></i> Detail</a>';
                        editTag = '<a href="{{url('/dompets/edit/'.$row->id)}}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pen"></i> Edit</a>';
                    }

                    appendString += "<tr>" +
                        "<td>" + i + "</td>" + 
                        "<td>" + response[i].nama + "</td>" +
                        "<td>" + response[i].deskripsi + "</td>" +
                        "<td>" + status + "</td>"+
                        "<td>" + detailTag+" "+editTag+" "+actionTag+ "</td>";
                }
                $('#dataTab').empty().append(appendString);
            })
            .fail(function(){
                console.log('Something Went Wrong .... Please contact administrator');
            })
        });
    </script>
@include('Template/Footer')
