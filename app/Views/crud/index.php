<?= $this->extend('layout/template') ?>
<?= $this->section('konten') ?>

<div class="container">
    <div class="col">
        <a href="/crud/tambah" class="btn btn-success btn-xs">Tambah</a>
    </div>
    <div class="row">
        <div class="col">
            <?php 
                if (session()->getFlashdata('pesan')) {
                    ?>
                        <h1><?= session()->getFlashdata('pesan') ?></h1>
                    <?php
                }
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Creator</th>
                        <th scope="col">Handle</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $no = 1;
                        foreach ($komik as $data) {
                            ?>
                                <tr>
                                    <th scope="row"><?= $no++ ?></th>
                                    <td><?= $data['nama'] ?></td>
                                    <td><?= $data['creator'] ?></td>
                                    <td><?= $data['created_at'] ?></td>
                                    <td>
                                        <a href="/crud/detail/<?=$data['id']?>" class="btn btn-success btn-xs">Detail</a>
                                        
                                        <form action="/crud/detail/<?=$data['id']?>" method="post" class="d-inline">
                                            <?= csrf_field();?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-xs">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>