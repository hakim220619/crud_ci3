<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="" type="" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
</head>

<body>
    <br><br><br>
    <div class="container">
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
    <div class="card-body">
        <!-- Modal -->
        <div class="table-responsive">
            <table id="datatables" class="display table table-striped table-hover">
                <thead class="center">
                    <tr>
                        <th>NO</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Kecamatan</th>
                        <th>Desa</th>
                        <th>Image</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody class="center">
                    <?php $no = 1;
                    foreach ($users as $a) : ?>
                        <tr>
                            <td><?= $no; ?></td>
                            <td><?= $a['nama']; ?></td>
                            <td><?= $a['alamat']; ?></td>
                            <td><?= $a['namaProvinsi'] ?></td>
                            <td><?= $a['namaKabupaten'] ?></td>
                            <td><?= $a['namaKecamatan'] ?></td>
                            <td><?= $a['namaDesa'] ?></td>
                            <td><img src="<?= base_url('assets/foto/users/'); ?><?= $a['image'] ?>" alt="" width="60px" height="60px"></td>
                            <td>
                                <div class="form-button-action">
                                    <button data-target="#edit-apk<?= $a['id'] ?>" type="button" data-toggle="modal" title="Edit Data" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task">
                                        <i class="fa fa-edit">Edit</i>
                                    </button>
                                    <button type="button" class="btn btn-link btn-danger btn-lg" data-toggle="modal" data-target="#deluser<?= $a['id'] ?>">
                                        <i class="fa fa-times">Delete</i>
                                    </button>
                                </div>
                            </td>
                            <div class="modal fade" id="edit-apk<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header no-bd">
                                            <h5 class="modal-title">
                                                <span class="fw-mediumbold">
                                                    Edit</span>
                                                <span class="fw-light">
                                                    Users
                                                </span>
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?= base_url('data/update'); ?>" method="post" enctype="multipart/form-data">
                                                <div class="row">
                                                    <input hidden type="text" class="form-control" id="id" name="id" placeholder="id_user" value="<?= $a['id'] ?>">

                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Nama</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $a['nama'] ?>" required>
                                                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group form-group-default">
                                                            <label>Alamat</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="<?= $a['alamat'] ?>" required>
                                                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="provinsi">PROVINSI</label>
                                                            <select name="provinsi" id="prov" class="form-control" required>
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
                                                            <select name="kabupaten" class="form-control" id="kab">
                                                                <option value=''>Pilih Kabupaten</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="kec">Kecamatan</label>
                                                            <select name="kecamatan" class="form-control" id="kec">
                                                                <option value=''>Pilih Kecamatan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        <div class="form-group">
                                                            <label for="des">Desa</label>
                                                            <select name="desa" class="form-control" id="des">
                                                                <option value=''>Pilih Desa</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12">
                                                        <img src="<?= base_url('assets/foto/users/'); ?><?= $a['image'] ?>" alt="" width="60px" height="60px"><br>
                                                        <label for="">Foto</label>
                                                        <input type="file" class="form-control" placeholder="foto" name="imagefile">
                                                        <br><br>
                                                    </div>

                                                </div>
                                                <div class="modal-footer no-bd">
                                                    <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deluser<?= $a['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="addNewDonaturLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addNewDonaturLabel">Hapus Anggota</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Anda yakin ingin menghapus <?= $a['nama'] ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <a href="<?= base_url('data/delete/') ?><?= $a['id'] ?>" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    <?php $no++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

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
        //edit
        $("#prov").change(function() {
            var url = "<?php echo site_url('data/add_ajax_kab'); ?>/" + $(this).val();
            console.log(url);
            $('#kab').load(url);
            return false;
            console.log(url);
        })
        $("#kab").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_kec'); ?>/" + $(this).val();
            $('#kec').load(url);
            return false;
        })
        $("#kec").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_des'); ?>/" + $(this).val();
            $('#des').load(url);
            return false;
        })
    });
</script>
<script>
    let table = new DataTable('#datatable');
</script>

</html>