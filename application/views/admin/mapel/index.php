<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

Data Mata Pelajaran

<button
class="btn btn-primary btn-sm float-right"
data-toggle="modal"
data-target="#modalTambah">

Tambah Mapel

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
<th>Nama Mata Pelajaran</th>
<th>Status</th>
<th width="150">Aksi</th>
</tr>

</thead>

<tbody>

<?php
$no = 1;
foreach($mapel as $m)
:
?>

<tr>

<td><?= $no++; ?></td>

<td>
<?= $m->nama_mapel; ?>
</td>

<td>
<?= $m->status; ?>
</td>

<td>

<button
class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#edit<?= $m->id_mapel; ?>">

Edit

</button>

<a
href="<?= site_url('admin/mapel/delete/'.$m->id_mapel); ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<!-- Modal Edit -->

<div class="modal fade"
id="edit<?= $m->id_mapel; ?>">

<div class="modal-dialog">

<form
action="<?= site_url('admin/mapel/update'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Edit Mapel</h5>
</div>

<div class="modal-body">

<input
type="hidden"
name="id_mapel"
value="<?= $m->id_mapel; ?>">

<div class="form-group">

<label>Nama Mapel</label>

<input
type="text"
name="nama_mapel"
class="form-control"
value="<?= $m->nama_mapel; ?>"
required>

</div>

<div class="form-group">

<label>Status</label>

<select
name="status"
class="form-control">

<option
value="aktif"
<?= ($m->status=='aktif')
? 'selected' : ''; ?>>

Aktif

</option>

<option
value="nonaktif"
<?= ($m->status=='nonaktif')
? 'selected' : ''; ?>>

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
<div class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<form
action="<?= site_url('admin/mapel/store'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Tambah Mapel</h5>
</div>

<div class="modal-body">

<div class="form-group">

<label>Nama Mapel</label>

<input
type="text"
name="nama_mapel"
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