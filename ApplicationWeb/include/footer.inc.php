
</div>
<!-- /.container-fluid -->

<?php //test si la personne est connectée
if(isset($_SESSION['droits']) && !$connexion_en_cours){ ?>

  <!-- Sticky Footer -->

  <footer class="sticky-footer">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright © Projet GMP 2019</span>
      </div>
    </div>
  </footer>
<?php } ?>


<!-- /.content-wrapper -->
</div>

<!-- /#wrapper -->
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Voulez vous vraiment vous deconnecter ?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Appuyer sur "Deconnexion" pour confirmer.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
        <a class="btn btn-primary" href="index.php?page=4">Deconnexion</a>
      </div>
    </div>
  </div>
</div>

<!-- Custom scripts for all pages-->
<script type="text/javascript" src="packages/colorpicker/js/creerEnoncer.js.php"></script>
<script src="js/generalScript.js"></script>

</body>

</html>
