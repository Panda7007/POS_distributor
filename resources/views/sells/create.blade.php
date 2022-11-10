<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <x-slot:breadcrumb>
        <li class="breadcrumb-item">Transaksi</li>
    </x-slot:breadcrumb>
    <x-slot:saldo>{{ $saldo[0]->saldo }}</x-slot:saldo>

    <div class="card">
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="reseller">Reseller</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <select name="reseller" id="reseller" class="form-select">
                            <option value="" disabled hidden selected>Pelanggan Biasa</option>
                            @foreach ($resellers as $reseller)
                                <option value="{{ $reseller->id }}">{{ $reseller->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="product">Produk <span class="text-danger">*</span></label>
                    </div>
                    <div class="col-md-8 form-group ">
                        <select name="product" id="product" class="form-select">
                            <option value="" disabled hidden selected>Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">
                                    {{ $product->id . ' - ' . $product->nama . ' - ' . $product->category->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Transaksi</p>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped" id="table2">
                <thead>
                    <tr>
                        <th>ID Barang</th>
                        <th>Kategori</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p>Detail Transaksi</p>
        </div>
        <div class="card-body">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="total_barang">Total Barang</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" class="form-control" value="0" id="total_barang" name="total_barang"
                            disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="total_harga">Total Harga</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" harga="0" id="total_harga"
                            name="total_harga" disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="terbayar">Terbayar</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="number" class="form-control" min="0" value="0" id="terbayar"
                            name="terbayar" oninput="updateDetailTransaksi(this)">
                    </div>

                    <div class="col-md-4">
                        <label for="kembalian">Kembalian</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" kembalian="0" id="kembalian"
                            disabled>
                    </div>

                    <div class="col-md-4">
                        <label for="kekurangan">Kekurangan</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" class="form-control" value="Rp. 0,-" kekurangan="0" id="kekurangan"
                            name="kekurangan" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade text-left" id="danger" tabindex="-1" aria-labelledby="myModalLabel120"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">
                        Data diri pelanggan biasa
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="feather feather-x">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <label>Nama Pelanggan</label>
                        </div>
                        <div class="col-lg-8 form-group">
                            <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        </div>
                        <div class="col-lg-4">
                            <label>Alamat</label>
                        </div>
                        <div class="col-lg-8 form-group">
                            <textarea class="form-control" id="alamat" name="alamat"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label>Nomor Telepon</label>
                        </div>
                        <div class="col-lg-8 form-group">
                            <input type="text" class="form-control" id="nomor" name="nomor">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="button" onclick="submitUtang()" class="btn btn-danger ml-1"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <button onclick="submitForm()" class="btn btn-primary">Simpan Transaksi</button>
    <x-slot:script>
        <script>
            let transaksi = {};
            let reseller = harga = product = max = kecil = total = id = undefined;
            let kembalian = document.getElementById("kembalian");
            let kekurangan = document.getElementById("kekurangan");
            const products = @json($products);

            transaksi.reseller_id = null;
            transaksi.products = [];
            transaksi.user_id = {{ auth()->user()->id }};
            transaksi.nama_pelanggan = null;
            transaksi.alamat = null;
            transaksi.nomor = null;
            transaksi.terbayar = 0;
            transaksi.kekurangan = 0;

            $("#reseller").on("change", () => {
                reseller = $("#reseller").val();
                transaksi.reseller_id = $("#reseller").val()
            });

            $("#product").on("change", () => {
                product = products.find(product => product.id == $("#product").val());
                transaksi.products.push({
                    "id": product.id
                });

                kecil = product.materials.map(material => Math.floor(parseInt(material.stok) / parseInt(material.pivot
                    .jumlah)));

                kecil.push(parseInt(product.stok));

                kecil = Math.min(...kecil);

                harga = (reseller) ? product.harga_reseller : product.harga;

                $("#table2 tbody").append(`
                    <tr>
                        <td>${product.id}</td>
                        <td>${product.category.nama}</td>
                        <td>${product.nama}</td>
                        <td>
                            <input type="number" oninput="updateTable(this)" onfocus="this.value = this.value == 0 ? '' : this.value" onblur="this.value = this.value == '' ? 0 : this.value" class="form-control jumlah" value="0" min="0" max="${kecil}" harga=${harga}>
                        </td>
                        <td harga=${harga} class="harga">${convertRupiah(harga)}</td>
                    </tr>
                `);

                $("#product").val("");
                $("#reseller").attr("disabled", true);
            })

            function updateTable(element) {
                id = transaksi.products.map(product => product.id).indexOf(parseInt(element.parentElement.parentElement
                    .children[0].innerHTML));
                if (parseInt(element.value) > parseInt(element.getAttribute("max"))) {
                    window.alert("stok produk / stok material tidak mencukupi");
                    element.value = element.getAttribute("max");
                } else if (parseInt(element.value) < 0 || element.value == "") {
                    window.alert("jumlah tidak boleh kurang dari 0");
                    element.value = 0;
                }

                harga = parseInt(element.value) * parseInt(element.getAttribute("harga"))

                element.parentElement.nextElementSibling.innerHTML = convertRupiah(harga);
                element.parentElement.nextElementSibling.setAttribute("harga", harga);
                transaksi.products[id].harga = harga;
                transaksi.products[id].jumlah = parseInt(element.value);

                total = 0;

                document.querySelectorAll("tbody tr").forEach(tr => {
                    total += parseInt(tr.querySelector(".harga").getAttribute("harga"));
                });

                document.querySelector("#total_harga").value = convertRupiah(total);
                document.querySelector("#total_harga").setAttribute("harga", total);
                transaksi.total_harga = total;

                total = 0;

                document.querySelectorAll("tbody tr").forEach(tr => {
                    total += parseInt(tr.querySelector(".jumlah").value);
                });

                document.querySelector("#total_barang").value = total;
                transaksi.total_barang = total;
            }

            function updateDetailTransaksi(element) {
                harga = document.getElementById("total_harga").getAttribute("harga");
                total = parseInt(element.value) - parseInt(harga);
                if (document.querySelectorAll("tbody tr").length > 0) {
                    if (isNaN(total)) {
                        kembalian.setAttribute("kembalian", 0);
                        kembalian.value = convertRupiah(0);
                        kekurangan.setAttribute("kekurangan", 0);
                        kekurangan.value = convertRupiah(0);
                        transaksi.kekurangan = 0;
                        transaksi.terbayar = 0;
                    } else if (total < 0) {
                        kembalian.setAttribute("kembalian", 0);
                        kembalian.value = convertRupiah(0);
                        kekurangan.setAttribute("kekurangan", 0);
                        kekurangan.value = convertRupiah(-total);
                        transaksi.kekurangan = -total;
                        transaksi.terbayar = parseInt(element.value);
                    } else {
                        kekurangan.setAttribute("kekurangan", 0);
                        kekurangan.value = convertRupiah(0);
                        transaksi.kekurangan = 0;
                        kembalian.setAttribute("kembalian", total);
                        kembalian.value = convertRupiah(total);
                        transaksi.terbayar = parseInt(harga);
                    }
                }
            }

            function Submit() {
                $.ajax({
                    url: "/sells",
                    type: "post",
                    data: {
                        _token: "{{ csrf_token() }}",
                        transaksi: transaksi
                    },
                    success: function(response) {
                        window.location.href = "/sells/create";
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            }

            function submitForm() {
                if (transaksi.kekurangan >= 0 && transaksi.reseller_id == null && kembalian.getAttribute(
                        "kembalian") == 0) {
                    if (confirm(
                            "uang pelanggan biasa masih kurang, apabila anda ingin melanjutkan,silakan isi data pelanggan terlebih dahulu"
                        )) {
                        $("#danger").modal("show");
                    }
                } else if (transaksi.kekurangan >= 0 && transaksi.reseller_id && kembalian.getAttribute(
                        "kembalian") == 0) {
                    if (confirm(
                            "Uang yang dibayarkan pelanggan tidak cukup, apakah anda yakin ingin melanjutkan transaksi?")) {
                        Submit();
                    }
                } else {
                    Submit();
                }
            }

            function submitUtang() {
                transaksi.nama_pelanggan = $("#nama_pelanggan").val();
                transaksi.alamat = $("#alamat").val();
                transaksi.nomor = $("#nomor").val();

                Submit();
            }

            function focus(input) {
                input.value = ""
            }

            function blur(input) {
                if (input.value == "") {
                    input.value = 0
                }
            }
        </script>
    </x-slot:script>
</x-layout>
