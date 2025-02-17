<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary</title>
</head>

<body class="container w-50">
    <div class="mt-5 card" style="border-left: 5px solid #0d6efd;">
        <div class="card-body p-4">
            <h2 class="card-title text-center">Notes</h2>
            <div class="card-text">
                <p class="fs-5">Welcome <?= $user->username ?></p>
                <p class="fs-7">Total Notes: <?= $total ?></p>
                <button class="btn btn-sm btn-outline-success" type="button"
                    data-bs-toggle="modal"
                    data-bs-target="#addNote"
                    title="Tambah Catatan"><i class="bi bi-plus fs-4"></i></button>
            </div>
        </div>
    </div>
    <div class="mt-3 row">
        <?php foreach ($notes as $note): ?>
            <div class="col-6 col-md-4 mb-3" data-bs-toggle="modal"
                data-bs-target="#viewNoteModal"
                data-title="<?= htmlspecialchars($note->judul) ?>"
                data-tanggal="<?= date("l, d M Y", strtotime($note->created)) ?>"
                data-content="<?= nl2br(htmlspecialchars($note->catatan)) ?>">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <h5 class="mb-0"><?= htmlspecialchars($note->judul) ?></h5>
                                <small class="text-muted"><?= date("l, d M Y", strtotime($note->created)) ?></small>
                            </div>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary" type="button"
                                    data-bs-toggle="modal"
                                    data-bs-target="#updateNote"
                                    data-id="<?= $note->id ?>"
                                    data-judul="<?= $note->judul ?>"
                                    data-catatan="<?= $note->catatan ?>"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="/note/delete" method="post" onsubmit="return confirm('Apakah kamu yakin ingin menghapus catatan ini?')" class="mb-0">
                                    <button type="submit" class="btn btn-outline-danger" name="id" value="<?= $note->id ?>" title="Hapus"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                        <?php $max = 20 ?>
                        <p class="card-text">
                            <?= strlen($note->catatan) > $max
                                ? nl2br(htmlspecialchars(substr($note->catatan, 0, $max))) . "..."
                                : nl2br(htmlspecialchars($note->catatan)) ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <!-- Modal Note Lengkap -->
    <div class="modal fade" id="viewNoteModal" tabindex="-1" aria-labelledby="viewNoteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="d-flex flex-column">
                        <h1 class="modal-title fs-5" id="viewNoteTitle"></h1>
                        <small class="text-muted" id="viewNoteTanggal"></small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="viewNoteContent"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Note -->
    <div class="modal fade" id="addNote" tabindex="-1" aria-labelledby="addNoteLabel" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addNoteLabel">Tambah Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/note/add" method="post">
                    <div class=" modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="judul" name="judul" placeholder="">
                            <label for="judul">Judul</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <textarea type="" class="form-control" id="catatan" name="catatan" placeholder=""></textarea>
                            <label for="catatan">Catatan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal EDit Note -->
    <div class="modal fade" id="updateNote" tabindex="-1" aria-labelledby="updateNote" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateNote">Edit Note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/note/update" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id" name="edit-id">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="edit-judul" name="edit-judul" placeholder="">
                            <label for="edit-judul">Judul</label>
                        </div>
                        <div class="form-floating mb-3 ">
                            <textarea type="" class="form-control" id="edit-catatan" name="edit-catatan" placeholder="" style="height: 159px;"></textarea>
                            <label for="edit-catatan">Catatan</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var updateNote = document.getElementById('updateNote');
            updateNote.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var id = button.getAttribute('data-id');
                var judul = button.getAttribute('data-judul');
                var catatan = button.getAttribute('data-catatan');

                document.getElementById('edit-id').value = id;
                document.getElementById('edit-judul').value = judul;
                document.getElementById('edit-catatan').value = catatan;
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var viewNoteModal = document.getElementById("viewNoteModal");
            viewNoteModal.addEventListener("show.bs.modal", function(event) {

                var card = event.relatedTarget;
                var title = card.getAttribute("data-title");
                var tanggal = card.getAttribute("data-tanggal");
                var content = card.getAttribute("data-content");

                document.getElementById("viewNoteTitle").textContent = title;
                document.getElementById("viewNoteTanggal").textContent = tanggal;
                document.getElementById("viewNoteContent").innerHTML = content;
            });
        });
    </script>
</body>

</html>