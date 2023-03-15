<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit pendaftaran</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="" type="" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet" />
</head>

<body>
    <br><br><br>
    <div class="container">
        <h1> Form pendaftaran pengusul</h1>
        <?php echo validation_errors(); ?>
        <div class="modal-body">
            <form action="<?= base_url('data/update'); ?>" method="post" enctype="multipart/form-data">
                <div class="row">
                    <input hidden type="text" class="form-control" id="id" name="id" placeholder="id_user" value="<?= $users['id'] ?>">

                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="nama" value="<?= $users['nama'] ?>" required>
                            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group form-group-default">
                            <label>Alamat</label>
                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="alamat" value="<?= $users['alamat'] ?>" required>
                            <?= form_error('alamat', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="provinsi">PROVINSI</label>
                            <select name="provinsi" id="prov" class="form-control" required>
                                <option value="">Pilih Provinsi</option>
                                <?php foreach ($provinces as $p) : ?>
                                    <option value="<?= $p->id; ?>"><?= $p->nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('provinsi'); ?>
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
                        <img src="<?= base_url('assets/foto/users/'); ?><?= $users['image'] ?>" alt="" width="60px" height="60px"><br>
                        <label for="">Foto</label>
                        <input type="file" class="form-control" placeholder="foto" name="imagefile">
                        <br><br>
                    </div>

                </div>
                <div class="modal-footer no-bd">
                    <button type="submit" id="addRowButton" class="btn btn-primary">Edit</button>
                    <a href="<?= base_url('/') ?>" type="button" class="btn btn-danger">Back</a>
                </div>
            </form>
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
<script>
    $(document).ready(function() {
        $("#prov").change(function() {
            var url = "<?php echo site_url('data/add_ajax_kab'); ?>/" + $(this).val();

            $('#kab').load(url);
            return false;
        });
        $("#kab").change(function() {
            var
                url = "<?php echo site_url('Data/add_ajax_kec'); ?>/" + $(this).val();
            $('#kec').load(url);
            return
            false;
        });
        $("#kec").change(function() {
            var url = "<?php echo site_url('Data/add_ajax_des'); ?>/" +
                $(this).val();
            $('#des').load(url);
            return false;
        })
    });
</script>

</html>