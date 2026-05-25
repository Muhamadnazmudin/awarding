<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

Data Jurusan

<button
class="btn btn-primary btn-sm float-right"
data-toggle="modal"
data-target="#modalTambah">

Tambah Jurusan

</button>

</h6>

</div>

<div class="card-body">

<div class="table-responsive">

<table
class="table table-bordered"
id="dataTable">

<thead>

<tr>
<th>No</th>
<th>Kode</th>
<th>Nama Jurusan</th>
<th>Status</th>
<th width="150">Aksi</th>
</tr>

</thead>

<tbody>

<?php
$no = 1;
foreach($jurusan as $j)
:
?>

<tr>

<td><?= $no++; ?></td>

<td>
<?= $j->kode_jurusan; ?>
</td>

<td>
<?= $j->nama_jurusan; ?>
</td>

<td>
<?= $j->status; ?>
</td>

<td>

<button
class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#edit<?= $j->id_jurusan; ?>">

Edit

</button>

<a
href="<?= site_url('admin/jurusan/delete/'.$j->id_jurusan); ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<!-- Modal Edit -->
<div class="modal fade"
id="edit<?= $j->id_jurusan; ?>">

<div class="modal-dialog">

<form
action="<?= site_url('admin/jurusan/update'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Edit Jurusan</h5>
</div>

<div class="modal-body">

<input
type="hidden"
name="id_jurusan"
value="<?= $j->id_jurusan; ?>">

<div class="form-group">

<label>Kode</label>

<input
type="text"
name="kode_jurusan"
class="form-control"
value="<?= $j->kode_jurusan; ?>"
required>

</div>

<div class="form-group">

<label>Nama Jurusan</label>

<input
type="text"
name="nama_jurusan"
class="form-control"
value="<?= $j->nama_jurusan; ?>"
required>

</div>

<div class="form-group">

<label>Status</label>

<select
name="status"
class="form-control">

<option value="aktif">
Aktif
</option>

<option value="nonaktif">
Nonaktif
</option>

</select>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-success">

Update

</button>

</div>

</div>

</form>

</div>

</div>

<?php endforeach; ?>

</tbody>

</table>

</div>
</div>
</div>

<!-- Modal Tambah -->

<div class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<form
action="<?= site_url('admin/jurusan/store'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Tambah Jurusan</h5>
</div>

<div class="modal-body">

<div class="form-group">

<label>Kode Jurusan</label>

<input
type="text"
name="kode_jurusan"
class="form-control"
required>

</div>

<div class="form-group">

<label>Nama Jurusan</label>

<input
type="text"
name="nama_jurusan"
class="form-control"
required>

</div>

<div class="form-group">

<label>Status</label>

<select
name="status"
class="form-control">

<option value="aktif">
Aktif
</option>

<option value="nonaktif">
Nonaktif
</option>

</select>

</div>

</div>

<div class="modal-footer">

<button
class="btn btn-primary">

Simpan

</button>

</div>

</div>

</form>

</div>

</div>