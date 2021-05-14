<?php

use AbieSoft\Sistem\Utility\Config; ?>
<main>
    <div class="page-header">
        <h1>Grup</h1>
        <div class="header-opsi">
            <button onClick=window.location.href="<?php echo weburl; ?>grup/baru">
                <span class="las la-plus"></span>
                <span class="label-opsi">Buat Grup</span>
            </button>
        </div>
    </div>
    <section class="grid">
        <div class="row">
            <div class="col-12">
                <div class="card-tabel">
                    <div class="card-tabel-header">
                        <select name="" id="" class="form-tabel" id='jltampil'>
                            <option value="">10</option>
                            <option value="">25</option>
                            <option value="">50</option>
                            <option value="">100</option>
                        </select>
                        <input type="text" class="form-tabel" placeholder="Cari" id="search">
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th style='width: 80px;'>No</th>
                                <th style='width: 200px;'>Nama</th>
                                <th>Akses</th>
                                <th style='width: 200px;'>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id='loading'></tr>
                            <tr id='notfound' style="display: none;">
                                <td colspan="4" class="center">Tidak ditemukan</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-tabel-footer">
                        <span id="total">Jumlah </span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>