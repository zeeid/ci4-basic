<?= $this->extend('layout/template') ?>
<?= $this->section('konten') ?>

<div class="container">
    <div class="row">
        <div class="col">

        <?php 
            // ======= JIKA ADA ID MAKA UPDATE ELSE SIMPAN ================
            $urlnya = isset($komik['id']) ? "/crud/update" : "/crud/insert";

            $error_list ='';
            $error_nama = '';
            $error_nama_detail = '';
            if(isset($validasi)){
                $error_list = $validasi->listErrors();
                $error_nama = ($validasi->hasError('nama')) ? 'is-invalid' : '';
                $error_nama_detail = ($validasi->hasError('nama')) ? $validasi->getError('nama') : '';
            }

        ?>
            <?= $error_list; ?>

            <form id="detail" method="post" action="<?=$urlnya?>">
                <input type="text" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input class="xx" type="hidden" id="idnya" name="idnya" value="<?= isset($komik['id']) ? $komik['id'] : ""; ?>">
                        <input type="text" class="form-control <?= $error_nama ?>" id="nama" name="nama" value="<?= isset($komik['nama']) ? $komik['nama'] : ""; ?>">
                        <div class="invalid-feedback">
                            <?= $error_nama_detail ?>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="creator" class="col-sm-2 col-form-label">Creator</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="creator" name="creator" value="<?= isset($komik['creator']) ? $komik['creator'] : ""; ?>">
                    </div>
                </div>
                <button type="submit" class="btn btn-warning">Simpan Edit</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>