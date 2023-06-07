<?php 

include 'header.php';
$invoices = $_GET['inv'];
$d_order = mysqli_query($conn, "SELECT * FROM produksi WHERE invoice = '$invoices'");

if ($d_order === false) {
    echo "Error executing query: " . mysqli_error($conn);
} else {
    $t_order = mysqli_fetch_assoc($d_order);

    $sortage = mysqli_query($conn, "SELECT * FROM produksi where cek = '1'");
    $cek_sor = mysqli_num_rows($sortage);

    // customer
    $cs = mysqli_query($conn, "SELECT * FROM customer WHERE kode_customer = '".$t_order['kode_customer']."'");
    $t_cs = mysqli_fetch_assoc($cs);

    $nama_material = array(); // Tambahkan inisialisasi array

    ?>

    <div class="container">
        <h2 style=" width: 100%; border-bottom: 4px solid gray"><b>Daftar Pesanan</b></h2>
        <br>
        <h5 class="bg-success" style="padding: 7px; width: 710px; font-weight: bold;"><marquee>Lakukan Reload Setiap Masuk Halaman ini, untuk menghindari terjadinya kesalahan data dan informasi</marquee></h5>
        <a href="produksi.php" class="btn btn-default"><i class="glyphicon glyphicon-refresh"></i> Reload</a>
        <!-- Sisa kode berikutnya -->
    <?php 
    }
    ?>

    <!-- Sisa kode berikutnya -->

    <?php 
    if($cek_sor > 0){
    ?>
        <br>
        <br>
        <div class="row">
            <div class="col-md-4 bg-danger" style="padding:10px;">
                <h4>Kekurangan Material </h4>
                <h5 style="color: red;font-weight: bold;">Silahkan Tambah Stok Material dibawah ini : </h5>
                <table class="table table-striped">
                    <tr>
                        <th>No</th>
                        <th>Material</th>
                    </tr>
            <?php 
            $arr = array_values(array_unique($nama_material));
            for ($i=0; $i < count($arr); $i++) { 

             ?>
                    <tr>
                        <td><?= $i+1 ?></td>
                        <td><?= $arr[$i]; ?></td>
                    </tr>
            <?php } ?>
                </table>
            </div>
        </div>
    <?php 
    }
    ?>
    
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <script type="text/javascript">
        $( document ).ready(function() {
            $( "#btn" ).click();
        });
    </script>

    <?php 
    include 'footer.php';
    ?>
 