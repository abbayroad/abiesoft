 $('form#grupcreate').submit(function(e){ e.preventDefault(); var nama = document.forms['grupcreate']['nama'].value; var akses = document.forms['grupcreate']['akses'].value; var act = document.forms['grupcreate']['act'].value; var menu = document.forms['grupcreate']['menu'].value;   if(setText(nama)){ gagal('Nama ' + setText(nama)); document.getElementById('nama').focus(); return false;  }else  if(setText(akses)){ gagal('Akses ' + setText(akses)); document.getElementById('akses').focus(); return false;  }else  if(setText(act)){ gagal('Action ' + setText(act)); document.getElementById('act').focus(); return false;  }else  if(setText(menu)){ gagal('Menu ' + setText(menu)); document.getElementById('menu').focus(); return false;  }else{ document.getElementById('btnsimpangrup').disabled = true; document.getElementById('btnsimpangrup').innerHTML = 'Sedang menyimpan..'; var formData = new FormData(this);  var doAction = 'http://127.0.0.1:8000/grup/create';  $.ajax({ url: doAction, type: 'POST', data: formData, success: function (msg) { if(msg == 'Y'){ document.getElementById('btnsimpangrup').disabled = false; document.getElementById('btnsimpangrup').innerHTML = 'Simpan'; document.getElementById('nama').value = ''; document.getElementById('akses').value = ''; document.getElementById('act').value = ''; document.getElementById('menu').value = '';  berhasil('Data grup baru telah ditambahkan'); return false;  }else{ document.getElementById('btnsimpangrup').disabled = false; document.getElementById('btnsimpangrup').innerHTML = 'Simpan'; gagal(msg);  return false; }  return false;  },  cache: false, contentType: false, processData: false }); return false;  } }); 