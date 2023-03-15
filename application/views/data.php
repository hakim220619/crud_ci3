<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="" type="" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
</head>

<body>
    <br><br><br>
    <div class="container">
        <h1> Form pendaftaran pengusul</h1>
        <form class="data" method="post" action="<?= base_url('data/insert'); ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" placeholder="Masukan Nama" name="nama" required>
                </div>
                <div class="col-md-6 col-lg-6">
                    <label for="">Alamat</label>
                    <input type="text" class="form-control" placeholder="Alamat" name="alamat" required>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="provinsi">PROVINSI</label>
                        <select name="provinsi" id="propinsi" class="form-control" required>
                            <option>Pilih Provinsi</option>
                            <?php foreach ($provinces as $p) : ?>
                                <option value="<?= $p->id; ?>"><?= $p->nama; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="kab">Kabupaten</label>
                        <select name="kabupaten" class="form-control" id="kabupaten">
                            <option value=''>Pilih Kabupaten</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="kec">Kecamatan</label>
                        <select name="kecamatan" class="form-control" id="kecamatan">
                            <option value=''>Pilih Kecamatan</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                        <label for="des">Desa</label>
                        <select name="desa" class="form-control" id="desa">
                            <option value=''>Pilih Desa</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" placeholder="foto" name="imagefile">
                    <br><br>
                </div>

                <div class="col-md-6 col-lg-6">
                    <button class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <br><br>
    <div class="container">

        <div>
            <select id='searchProvinsi'>
                <option value=''>-- Select Provinsi --</option>
                <?php
                foreach ($provinces as $p) {
                    echo "<option value='" . $p->id . "'>" . $p->nama . "</option>";
                }
                ?>
            </select>
            <select id='searchKabupaten'>
                <option value=''>-- Select Kabupaten --</option>
            </select>
            <select id='searchKecamatan'>
                <option value=''>-- Select Kecamatan --</option>
            </select>
            <select id='searchDesa'>
                <option value=''>-- Select Desa --</option>
            </select>
            <input type="text" id="searchNama" placeholder="Search Nama">
        </div>

    </div>
    <br>
    <div class="container">
        <div class="card">
            <table id="datatables" class="display dataTable">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Image</th>
                        <th>ACTION</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>


</body>

<script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        var userDataTable = $('#datatables').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                'url': '<?= base_url() ?>data/userList',
                'data': function(data) {
                    data.searchProvinsi = $('#searchProvinsi').val();
                    data.searchKabupaten = $('#searchKabupaten').val();
                    data.searchKecamatan = $('#searchKecamatan').val();
                    data.searchDesa = $('#searchDesa').val();
                    data.searchNama = $('#searchNama').val();
                }
            },
            'columns': [{
                    data: 'nama'
                },
                {
                    data: 'alamat'
                },
                {
                    data: 'namaProvinsi'
                },
                {
                    data: 'namaKabupaten'
                },
                {
                    data: 'namaKecamatan'
                },
                {
                    data: 'namaDesa'
                },
                {
                    data: 'image',
                    render: function(data) {
                        return '<img src=<?= base_url('assets/foto/users/') ?>' + data +
                            ' style="height: 60px; width: 60px;" />';
                    }
                },
                {
                    data: null,
                    bSortable: false,
                    mRender: function(o) {
                        return '<a href=<?= base_url('data/edit') ?>/' + o.id + '>' + 'Edit' +
                            '</a>';
                    }

                },
                {
                    data: null,
                    bSortable: false,
                    mRender: function(o) {
                        return '<a href=<?= base_url('data/delete') ?>/' + o.id + '>' + 'Delete' +
                            '</a>';
                    }
                },
            ],
        });

        $('#searchProvinsi,#searchKabupaten, #searchKecamatan, #searchDesa').change(function() {
            userDataTable.draw();
        });
        $('#searchNama').keyup(function() {
            userDataTable.draw();
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#propinsi").change(function() {
            var url = "<?php echo site_url('data/add_ajax_kab'); ?>/" + $(this).val();
            console.log(url);
            $('#kabupaten').load(url);
            return false;
            console.log(url);
        })
        $("#kabupaten").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_kec'); ?>/" + $(this).val();
            $('#kecamatan').load(url);
            return false;
        })
        $("#kecamatan").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_des'); ?>/" + $(this).val();
            $('#desa').load(url);
            return false;
        })
        //serach
        $("#searchProvinsi").change(function() {
            var url = "<?php echo site_url('data/add_ajax_kab'); ?>/" + $(this).val();
            console.log(url);
            $('#searchKabupaten').load(url);
            return false;
            console.log(url);
        })
        $("#searchKabupaten").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_kec'); ?>/" + $(this).val();
            $('#searchKecamatan').load(url);
            return false;
        })
        $("#searchKecamatan").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_des'); ?>/" + $(this).val();
            $('#searchDesa').load(url);
            return false;
        })
    });
</script>


</html>