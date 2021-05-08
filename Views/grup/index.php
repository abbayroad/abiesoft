<?php

use AbieSoft\Sistem\Utility\Config; ?>
<section id="content">
    <section class="vbox">
        <section class="scrollable padder">
            <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href=''><i class='fa fa-home'></i> Home</a></li>
                <li class='active'>Grup</li>
            </ul>
            <div class="m-b-md">
                <h3 class="m-b-none">Semua Grup</h3>
            </div>
            <section class="panel panel-default">
                <header class="panel-heading">
                    Tabel Grup
                </header>
                <div class="row wrapper">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control input-s-sm inline v-middle" id='jltampil'>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="col-sm-4 m-b-xs">
                        <!-- <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-sm btn-default active">
                                <input type="radio" name="options" id="option1"> Day
                            </label>
                            <label class="btn btn-sm btn-default">
                                <input type="radio" name="options" id="option2"> Week
                            </label>
                            <label class="btn btn-sm btn-default">
                                <input type="radio" name="options" id="option2"> Month
                            </label>
                        </div> -->
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="input-sm form-control" placeholder="Cari" id="search">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
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
                                <td colspan="4" class="text-center">Tidak ditemukan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <footer class="panel-footer">
                    <div class="row">
                        <div class="col-sm-4 hidden-xs">
                            <small class="text-muted inline m-t-sm m-b-sm" id='total'>Total</small>
                        </div>
                    </div>
                </footer>
            </section>
        </section>
    </section>
    <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
</section>