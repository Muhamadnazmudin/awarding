<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

Data Kelas

<button
class="btn btn-primary btn-sm float-right"
data-toggle="modal"
data-target="#modalTambah">

Tambah Kelas

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
<th>Kelas</th>
<th>Tingkat</th>
<th>Jurusan</th>
<th>Status</th>
<th width="150">Aksi</th>
</tr>

</thead>

<tbody>

<?php
$no=1;
foreach($kelas as $k)
:
?>

<tr>

<td><?= $no++; ?></td>
<td><?= $k->nama_kelas; ?></td>
<td><?= $k->tingkat; ?></td>
<td><?= $k->nama_jurusan; ?></td>
<td><?= $k->status; ?></td>

<td>

<button
class="btn btn-warning btn-sm"
data-toggle="modal"
data-target="#edit<?= $k->id_kelas; ?>">

Edit

</button>

<a
href="<?= site_url('admin/kelas/delete/'.$k->id_kelas); ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus data?')">

Hapus

</a>

</td>

</tr>

<!-- modal edit -->

<div class="modal fade"
id="edit<?= $k->id_kelas; ?>">

<div class="modal-dialog">

<form
action="<?= site_url('admin/kelas/update'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Edit Kelas</h5>
</div>

<div class="modal-body">

<input
type="hidden"
name="id_kelas"
value="<?= $k->id_kelas; ?>">

<div class="form-group">
<label>Nama Kelas</label>

<input
type="text"
name="nama_kelas"
class="form-control"
value="<?= $k->nama_kelas; ?>"
required>
</div>

<div class="form-group">
<label>Tingkat</label>

<select
name="tingkat"
class="form-control">

<option value="X">X</option>
<option value="XI">XI</option>
<option value="XII">XII</option>

</select>

</div>

<div class="form-group">
<label>Jurusan</label>

<select
name="id_jurusan"
class="form-control">

<?php foreach($jurusan as $j): ?>

<option
value="<?= $j->id_jurusan; ?>"

<?= ($k->id_jurusan ==
$j->id_jurusan)
? 'selected' : ''; ?>>

<?= $j->nama_jurusan; ?>

</option>

<?php endforeach; ?>

</select>

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

<div class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<form
action="<?= site_url('admin/kelas/store'); ?>"
method="post">

<div class="modal-content">

<div class="modal-header">
<h5>Tambah Kelas</h5>
</div>

<div class="modal-body">

<div class="form-group">

<label>Nama Kelas</label>

<input
type="text"
name="nama_kelas"
class="form-control"
required>

</div>

<div class="form-group">

<label>Tingkat</label>

<select
name="tingkat"
class="form-control">

<option value="X">X</option>
<option value="XI">XI</option>
<option value="XII">XII</option>

</select>

</div>

<div class="form-group">

<label>Jurusan</label>

<select
name="id_jurusan"
class="form-control"
required>

<?php foreach($jurusan as $j): ?>

<option
value="<?= $j->id_jurusan; ?>">

<?= $j->nama_jurusan; ?>

</option>

<?php endforeach; ?>

</select>

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