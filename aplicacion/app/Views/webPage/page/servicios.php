<?=$this->extend('webPage/layout')?>

<?= $this->section('title') ?>
    Servicios
<?= $this->endSection()?>

<?= $this->section('servicios') ?>

    <div  class="mt-4">
        <div class="container gallery-container">

            <h1 class="text-dark text-center font-weight-bold" >Servicos que ofrecemos</h1>

            <p class="page-description text-center">Pudes comunicarte con nosotros</p>

            <div class="tz-gallery">

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/park.jpg">
                            <img src="../images/park.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/bridge.jpg">
                            <img src="../images/bridge.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-12 col-md-4">
                        <a class="lightbox" href="../images/tunnel.jpg">
                            <img src="../images/tunnel.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/coast.jpg">
                            <img src="../images/coast.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/rails.jpg">
                            <img src="../images/rails.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/traffic.jpg">
                            <img src="../images/traffic.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/rocks.jpg">
                            <img src="../images/rocks.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/benches.jpg">
                            <img src="../images/benches.jpg" alt="image1">
                        </a>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <a class="lightbox" href="../images/sky.jpg">
                            <img src="../images/sky.jpg" alt="image1">
                        </a>
                    </div>
                </div>

            </div>

            </div>

    </div>

    <!-- Scripts  para la galeria-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
    
    
<?= $this->endSection()?>

