<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item"><a href="/products">Products</a></li>
        <li class="breadcrumb-item">Create Product</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Form Create Product</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="form form-horizontal" action="/products" method="post">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama Produk <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="text" id="nama" class="form-control" name="nama"
                                    placeholder="Kopi Gayo" required>
                            </div>

                            <div class="col-md-4">
                                <label>Kategori <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="category" id="category" class="choices form-select" required>
                                    <option value="" selected disabled hidden>Pilih Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Biaya Produksi <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" min="0" id="biaya_produksi" class="form-control"
                                    name="biaya_produksi" value="0" required>
                            </div>

                            <div class="col-md-4">
                                <label>Harga Jual <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="harga" min="0" class="form-control" name="harga"
                                    value="0" required>
                            </div>

                            <div class="col-md-4">
                                <label>Harga Reseller <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="harga_reseller" min="0" class="form-control"
                                    name="harga_reseller" value="0" required>
                            </div>

                            <div class="col-md-4">
                                <label>Stok <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-md-8 form-group">
                                <input type="number" id="stok" min="0" class="form-control" name="stok"
                                    value="0" required>
                            </div>

                            <div class="col form-group">
                                <table class="table form">
                                    <thead>
                                        <tr>
                                            <th>Material</th>
                                            <th>jumlah</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-sm-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-slot:script>
        <script>
            let material = @json($materials);

            function initialRow() {
                let select = document.createElement("select");
                let option = undefined;
                material.forEach(materi => {
                    option = document.createElement("option");
                    option.value = materi.id;
                    option.text = materi.nama;
                    select.appendChild(option);
                });
                $(".table.form tbody").append(`
                            <tr>
                                <td>
                                    <select name="materials[]" class="form-select choices">
                                        <option value="" disabled selected hidden>Pilih Material</option>
                                        ${select.innerHTML}
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="0" value="0" name="jumlah[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" onclick="tambahRow(this)" class="btn btn-success">Tambah Bahan</button>
                                </td>
                            </tr>
        `);
                new Choices(document.querySelector("select.choices:last-child"));
            };

            function tambahRow(element) {
                let select = document.createElement("select");
                let option = undefined;
                material.forEach(materi => {
                    option = document.createElement("option");
                    option.value = materi.id;
                    option.text = materi.nama;
                    select.appendChild(option);
                });
                $(element).parent().parent().parent().append(`
                            <tr>
                                <td>
                                    <select name="materials[]" class="form-select choices">
                                        <option value="" disabled selected hidden>Pilih Material</option>
                                        ${select.innerHTML}
                                    </select>
                                </td>
                                <td>
                                    <input type="number" min="0" value="0" name="jumlah[]" class="form-control">
                                </td>
                                <td>
                                    <button type="button" onclick="tambahRow(this)" class="btn btn-success">Tambah Bahan</button>
                                </td>
                            </tr>
        `);
                new Choices(document.querySelector("select.choices:last-child"));
            }

            initialRow();
        </script>
    </x-slot:script>
</x-layout>
