<?= $this->extend('layout/template') ?>
<?= $this->section('konten') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <form id="detail" method="post">
                <div class="form-group row">
                    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="nama" name="nama" value="<?=$komik['nama']?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="creator" class="col-sm-2 col-form-label">Creator</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="creator" name="creator" value="<?=$komik['creator']?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>