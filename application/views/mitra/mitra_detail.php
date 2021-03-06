<section id="about" class="wow fadeInUp">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 about-img text-center">
        <img src="<?=$mitra['logo']?>" alt="" class="mitra-img" style="margin-left:auto">
        <br>&nbsp;<br>
        <?php if ($this->session->who == 'ad'): ?>
          <a class="btn btn-light btn-block" href="/mitra/usulanedit/<?=$mitra['id_mitra']?>" title="Penyesuaian Data" style="margin:15px;">
            <img src="/assets/img/edit16.png"> Edit Data Perusahaan
          </a>
        <?php endif; ?>
      </div>

      <div class="col-lg-8 content">
        <h2>
          <?=$mitra['nama_perusahaan']?>
        </h2>
        <h3>
          industry: <strong><?=$mitra['bidang']?></strong><br>
          brand: <strong><?=$mitra['brand']?></strong><br>
          jumlah alumni bekerja: <strong><?=$mitra['total_alumni']?> alumni</strong>
        </h3>

        <ul>
          <li>
            <i class="ion-android-checkmark-circle"></i>
            Kantor Pusat: <?=$mitra['alamat_kantor_pusat'].", ".$mitra['lokasi']." ".
            $mitra['kodepos_kantor_pusat']?>
          </li>
          <li>
            <i class="ion-android-checkmark-circle"></i>
            Telepon: <?=$mitra['telepon_kantor_pusat']?>
          </li>
          <li>
            <i class="ion-android-checkmark-circle"></i>
            Website: <a href="<?=$mitra['website']?>" target="_blank"><?=$mitra['website']?></a>
          </li>


          <?php
            if( isset( $mitra['cabang']) ){
              ?>
              <li>
                <i class="ion-android-checkmark-circle"></i>Cabang / Unit Kerja:
                <ul>

                  <?php
                  foreach ($mitra['cabang'] as $key => $value) {
                    ?>
                    <li>
                      &nbsp; &nbsp; &nbsp;
                      <strong> <?=$value['nama_cabang']?></strong> (<?=$value['jml_alumni']?> alumni)

                      <?php if ($this->session->who == 'ad'): ?>
                        <br>&nbsp;
                        <ul>
                          <?php foreach ($alumni as $key => $value): ?>
                            <li>&nbsp; &nbsp; &nbsp; &nbsp;
                              <a href="/alumni/<?=$value['nimhs']?>"><?= $value['namamhs']?></a>
                            </li>
                          <?php endforeach; ?>
                        </ul>
                        <br>&nbsp;
                      <?php endif; ?>

                    </li>
                    <?php
                  }
                  ?>

                </ul>
              </li>

              <?php
            }
           ?>

        </ul>

      </div>
    </div>

  </div>
</section><!-- #about -->
