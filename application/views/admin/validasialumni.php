<section id="about" class="wow">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 text-center">

        <?php $this->load->view('/admin/nav'); ?>

      </div>

        <?php
          if (!isset( $requestid )) {
        ?>
        <div class="col-lg-8 content">
          <h2>Validasi Alumni</h2>

          <h3><i class="ion-android-checkmark-circle"></i> Waiting List</h3>
          <table class="table">
            <thead>
              <th class="text-center" width="10px">No.</th>
              <th class="text-center" width="20px">Tanggal</th>
              <th>Nama</th>
              <th>Email</th>
            </thead>
            <tbody>
              <?php if (count($waitinglist)==0): ?>
                <tr>
                  <td colspan="4"> <i>Belum ada permintaan</i> </td>
                </tr>
              <?php endif; ?>

              <?php
                $n = 0;
                foreach ($waitinglist as $key => $value):
                $n++;
              ?>

                <tr>
                  <td class="text-center"><?=$n?></td>
                  <td class="text-center"><?=date('d/m/Y',strtotime($value['tgl_entri']))?></td>
                  <td>
                    <a href="validasialumni/<?=$value['id']?>">
                      <?=$value['nama_lengkap']?>
                    </a>
                  </td>
                  <td>
                    <a href="validasialumni/<?=$value['id']?>">
                      <?=$value['email']?>
                    </a>
                  </td>
                </tr>

              <?php endforeach; ?>

              <tr><td colspan="4"></td></tr>
            </tbody>
          </table>

          <br>

          <h3><i class="ion-android-checkmark-circle"></i> Statistik Request Validasi</h3>
          <table class="table">
            <thead>
              <th>Lulusan</th>
              <th>Jumlah Request</th>
              <th>Accepted</th>
              <th>Registered</th>
            </thead>
            <tbody>
              <?php foreach ($requestValid as $key => $value): ?>
                <tr>
                  <td><?=$value['thn_lulus']?></td>
                  <td><?=$value['jml_lulusan']?></td>
                  <td><?=$value['accepted']?></td>
                  <td><?=$value['registered']?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          Total Request
          <table class="table">
            <thead>
              <th>Jumlah Request</th>
              <th>Accepted</th>
              <th>Registered</th>
              <th>Rejected</th>
              <th>Unidentified</th>
            </thead>
            <tbody>
              <?php foreach ($requestValidasi as $key => $value): ?>
                <tr>
                  <td><?=$value['jml_request']?></td>
                  <td><?=$value['accepted']?></td>
                  <td><?=$value['registered']?></td>
                  <td><?=$value['rejected']?></td>
                  <td><?=$value['unident']?></td>
                </tr>
              <?php endforeach; ?>
              <tr>
                <td colspan="5"></td>
              </tr>
            </tbody>
          </table>


        </div>

        <?php
          } else {
        ?>
        <div class="col-lg-8 content">
          <h2>Validasi Alumni</h2>
          <h3><i class="ion-android-checkmark-circle"></i> Data Entri</h3>

          <table class="table">
            <tr>
              <td class="datafields" width="150px">Email:</td>
              <td><?=$request['email']?></td>
            </tr>
            <tr>
              <td class="datafields">Nama Lengkap:</td>
              <td><?=$request['nama_lengkap']?></td>
            </tr>

            <?php if (!empty($request['nimhs'])): ?>
              <tr>
                <td class="datafields">N I M:</td>
                <td><?=$request['nimhs']?></td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($request['program_studi'])): ?>
              <tr>
                <td class="datafields">Program Studi:</td>
                <td>Program <?=$this->mylib->program_studi[$request['program_studi']]['program']." ".
                               $this->mylib->program_studi[$request['program_studi']]['nama']?></td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($request['tahun_masuk'])): ?>
              <tr>
                <td class="datafields">Tahun Masuk:</td>
                <td><?=$request['tahun_masuk']?></td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($request['tahun_wisuda'])): ?>
              <tr>
                <td class="datafields">Tahun Lulus:</td>
                <td><?=$request['tahun_wisuda']?></td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($request['nomor_ijazah'])): ?>
              <tr>
                <td class="datafields">Nomor Ijazah:</td>
                <td><?=$request['nomor_ijazah']?></td>
              </tr>
            <?php endif; ?>

            <?php if (!empty($request['judul_skriipsi'])): ?>
              <tr>
                <td class="datafields">Judul Skripsi:</td>
                <td><?=$request['judul_skriipsi']?></td>
              </tr>
            <?php endif; ?>

            <tr><td colspan="2"></td></tr>
          </table>
          <br>

          <form class="form" id="formval" action="/admin/submitvalidasi" method="post">
            <input type="hidden" id="requestid" name="requestid"
                   value="<?=$requestid?>">

            <input type="hidden" id="nimhs" name="nimhs"
                   value="<?=!empty($request['nimhs']?$request['nimhs']:'')?>">

            <input type="hidden" id="validasi" name="validasi"
                   value="<?= count($prakira)==1 ? $prakira[0]['validasi'] : 0?>">


          <?php
            if( !empty( $prakira ) ){
          ?>

            <?php if ( $prakira[0]['validasi'] == 8 ): ?>
              <p class="text-primary">
                Data alumni yang dimasukkan sudah memiliki akun user, hanya perlu menjalankan
                mekanisme <strong>Lupa Password</strong> untuk mendapatkan password yang baru
              </p>

            <?php elseif( !empty($prakira) && $prakira[0]['validasi'] == 3): ?>
              <p class="text-primary">
                Email yang dimasukkan telah terdaftar/didaftarkan sebagai contact person perusahaan mitra
                oleh rekan sejawatnya. Email sebagai alumni harus berbeda dengan email sebagai Contact
                Person Perusahaan Mitra
              </p>

            <?php else: ?>

              <h3><i class="ion-android-checkmark-circle"></i> Perkiraan data alumni yang cocok</h3>

              <table class="table">
                <?php foreach ($prakira as $key => $value): ?>
                  <tr>
                    <td><?=$value['nimhs']?></td>
                    <td><?=$value['namamhs']?></td>
                    <td>
                      <?=!empty($value['tanggal_sk_yudisium'])?'Lulus: '.$value['tanggal_sk_yudisium']:''?>
                    </td>
                    <td>
                      <?php
                        if( $value['validasi'] == '8' ){
                      ?>
                        sudah terdaftar
                      <?php
                      } else {
                      ?>
                        <input type="radio" id="raccept" name="raccept" value="<?=$value['nimhs']?>" required> setujui
                      <?php
                      }
                      ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
                <tr><td colspan="4"></td></tr>
              </table>

            <?php endif; ?>

          <?php
            } else {
              ?>

              <p class="text-danger">
                Data alumni yang dimasukkan belum ada pada database Alumni.<br>
                Satus alumni dan kelulusan perlu diperiksa pada database <strong>SISKA</strong>
                atau <strong>Forlap RistekDikti</strong>
              </p>

          <?php
            }
          ?>

          <table class="table">
            <?php
            // if( !empty($prakira) && $prakira[0]['validasi'] != 8 ){
              foreach ($this->mylib->status_validasi as $key => $value):
                if( $key != 0 && ($key != 9 || !isset($prakira)) ){
                  ?>
                  <tr>
                    <td>
                      <input type="radio" id="raccept" name="raccept" value="<?=$key?>" required> <?=$value?>
                    </td>
                  </tr>
                  <?php
                }
                ?>
              <?php endforeach;
              // }
              ?>
            </table>

          <div class="text-right">
            <button type="submit" class="btn-primary" id="btsubmit"> Selesai </button>
          </div>

        </form>

        <?php
          }
        ?>

      </div>

    </div>

  </div>
</section><!-- #about -->

<script type="text/javascript">

$(function(){
  // alert($("#validasi").val());
  $("input[name=raccept][value="+$("#validasi").val()+"]").prop('checked', true);
});

$("input[name=raccept]").change(function(){
  var val = $(this).val();
  if( val.length > 1 ){
    $("#nimhs").val( val );
    $("#validasi").val(9);
  } else {
    $("#validasi").val( val );
  }
});

</script>
