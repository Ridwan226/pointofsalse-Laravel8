@extends('admin.templates.templates')

@section('app-css')
  <!-- DataTables -->
  <link href="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

  <!-- Responsive datatable examples -->
  <link href="{{ asset('/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <div class="row align-items-center">
            <div class="col-md-8">
              <h4 class="page-title m-0">Data Master Produk</h4>
            </div>
            <div class="col-md-4">
              <div class="float-right d-none d-md-block">
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="ti-settings mr-1"></i> Menu
                  </button>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated">
                    <button class="dropdown-item" id="btn-tambah" data-toggle="modal" data-target="#myModal">Add
                      Produk</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
        <!-- end page-title-box -->
      </div>
    </div>
    <!-- end page title -->


    <div class="row">
      <div class="col-12">
        <div class="card m-b-30">
          <div class="card-body">

            <h4 class="mt-0 header-title ">All List Produk</h4>

            <div class="button-items mb-3">

              <button type="button" onClick="deleteSelected('{{ url('administrator/product/delselected') }}')"
                class="btn btn-danger waves-effect waves-light">Delete Selected</button>

            </div>
            <form action="" class="form-produk"> @csrf
              <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" name="select_all" id="select_all">
                    </th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Merk</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Diskon</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div> <!-- end col -->
    </div>

  </div>


  <!-- sample modal content -->
  <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title mt-0" id="myModalLabel">Add Data</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ url('administrator/product/add') }}" method="post" id="forms"> @csrf
          <input type="hidden" name="id_edit" id="id_edit" />
          <div class="modal-body">
            <div class="form-group">
              <label>Name Produk</label>
              <input type="text" class="form-control" name="nama_produk" id="nama_produk" required
                placeholder="Name Produk" />
            </div>

            <div class="form-group ">
              <label>Kategori Produk</label>
              <div>
                <select class="form-control" name="kategori_id" id="kategori_id" required>
                  <option value="">Select Kategori Produk</option>
                  @foreach ($kategorys as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategory }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <label>Merk</label>
              <input type="text" class="form-control" name="merk" id="merk" required placeholder="Merk Produk" />
            </div>

            <div class="form-group">
              <label>Harga Beli</label>
              <input type="number" class="form-control" name="harga_beli" id="harga_beli" required
                placeholder="Harga Beli" />
            </div>

            <div class="form-group">
              <label>Harga Jual</label>
              <input type="number" class="form-control" name="harga_jual" id="harga_jual" required
                placeholder="Harga Jual" />
            </div>

            <div class="form-group">
              <label>Diskon</label>
              <input type="number" class="form-control" name="diskon" id="diskon" required placeholder="Diskon (%)" />
            </div>

            <div class="form-group">
              <label>Stok</label>
              <input type="number" class="form-control" name="stok" id="stok" required placeholder="Stok" />
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" id="btn-close" class="btn btn-secondary waves-effect"
              data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

@endsection


@section('app-js')
  <!-- Required datatable js -->
  <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <!-- Buttons examples -->
  <script src="{{ asset('/plugins/datatables/dataTables.buttons.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/jszip.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/pdfmake.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/vfs_fonts.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/buttons.html5.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/buttons.print.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/buttons.colVis.min.js') }}"></script>
  <!-- Responsive examples -->
  <script src="{{ asset('/plugins/datatables/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
  <!-- Parsley js -->
  <script src="{{ asset('/plugins/parsleyjs/parsley.min.js') }}"></script>

  <script>
    $('form').parsley();
    $('#myModal').on('hidden.bs.modal', function(e) {
      $('#forms').attr('action', "{{ url('administrator/product/add') }}")
      $('#forms')[0].reset();
    })

    $(document).ready(function() {
      $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        scrollX: true,
        fixedColumns: true,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        ajax: {
          url: "{{ url('administrator/product') }}",
          type: 'GET'
        },
        columns: [{
            data: 'select_all',
            searchable: false,
            sortable: false,
            orderable: false
          },
          {
            data: 'kode_produk',
            name: 'kode_produk'
          },
          {
            data: 'nama_produk',
            name: 'nama_produk'
          },
          {
            data: 'kategori',
            name: 'kategori'
          },

          {
            data: 'merk',
            name: 'merk'
          },
          {
            data: 'harga_beli',
            name: 'harga_beli'
          },
          {
            data: 'harga_jual',
            name: 'harga_jual'
          },
          {
            data: 'diskon',
            name: 'diskon'
          },
          {
            data: 'stok',
            name: 'stok'
          },
          {
            data: 'aksi',
            name: 'aksi'
          },

        ],
      });
    })

    $('[name=select_all]').on('click', function() {
      $(':checkbox').prop('checked', this.checked);
    })


    $(document).on('click', '.edit', function() {
      $('#forms').attr('action', "{{ url('/administrator/product/update') }}")
      let id = $(this).attr('id');
      console.log(id)
      $.ajax({
        url: "{{ url('/administrator/product/edit') }}",
        type: "post",
        data: {
          id: id,
          _token: "{{ csrf_token() }}"
        },
        success: function(res) {
          console.log(res);
          $('#nama_produk').val(res.nama_produk);
          $('#harga_beli').val(res.harga_beli);
          $('#kategori_id').val(res.kategori_id);
          $('#merk').val(res.merk);
          $('#harga_jual').val(res.harga_jual);
          $('#diskon').val(res.diskon);
          $('#stok').val(res.stok);
          $('#id_edit').val(res.id);
          $('#btn-tambah').click();

        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON.message, 'Inconceivable!');
        }
      })
    })


    $(document).on('submit', 'form', function(event) {
      event.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: $(this).attr('method'),
        typeData: "JSON",
        data: new FormData(this),
        processData: false,
        contentType: false,
        success: function(res) {
          $('#btn-close').click();
          $("#datatable").DataTable().ajax.reload(null, false);
          toastr.success(res.message, 'Sukses');
          $('#forms')[0].reset();
        },
        error: function(xhr) {
          toastr.error(xhr.responseJSON.message, 'Inconceivable!')
        }
      })
    })

    $(document).on('click', '.hapus', function() {
      let id_del = $(this).attr('id');
      //  console.log(id_del);
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "{{ url('/administrator/product/del') }}",
            type: "post",
            data: {
              id: id_del,
              _token: "{{ csrf_token() }}"
            },
            success: function(res, status) {
              if (status = '200') {
                setTimeout(() => {
                  Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Data Berhasil di Hapus',
                    showConfirmButton: false,
                    timer: 1500
                  }).then((res) => {
                    $("#datatable").DataTable().ajax.reload();
                  })
                })
              }
            },
            error: function(xhr) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: 'Gagal Menghapus'
              })
            }
          })
        }
      })
    })

    function deleteSelected(url) {
      if ($('input:checked').length > 0) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: url,
              type: "delete",
              data: $('.form-produk').serialize(),
              success: function(res) {
                if (status = '200') {
                  setTimeout(() => {
                    Swal.fire({
                      position: 'top-end',
                      icon: 'success',
                      title: 'Data Berhasil di Hapus',
                      showConfirmButton: false,
                      timer: 1500
                    }).then((res) => {
                      $("#datatable").DataTable().ajax.reload();
                    })
                  })
                }
              },
              error: function(xhr) {
                toastr.error(xhr.responseJSON.message, 'Inconceivable!');
              }
            })
          }
        })
      } else {
        toastr.error('Selected Data Not Found', 'Inconceivable!');
        return;
      }
    }

  </script>
@endsection
