<script src="/WhatsAppCenter/public/assets/plugins/jquery/jquery.min.js"></script>

<script src="/WhatsAppCenter/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<script src="/WhatsAppCenter/public/assets/dist/js/adminlte.min.js"></script>

<script src="/WhatsAppCenter/public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>


<!-- =========================
     DATATABLES
========================= -->

<script src="/WhatsAppCenter/public/assets/plugins/datatables/jquery.dataTables.min.js"></script>

<script src="/WhatsAppCenter/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="/WhatsAppCenter/public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>

<script src="/WhatsAppCenter/public/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>


<!-- =========================
     ARCHIVOS GENERALES
========================= -->

<script src="/WhatsAppCenter/public/js/app.js"></script>

<script src="/WhatsAppCenter/public/js/helpers.js"></script>


<!-- =========================
     CONTACTOS
========================= -->

<?php if (($_GET['page'] ?? '') === 'contacts'): ?>

<script src="/WhatsAppCenter/public/js/contacts.js"></script>

<?php endif; ?>


<!-- =========================
     CONVERSACIONES
========================= -->

<?php if (($_GET['page'] ?? '') === 'conversations'): ?>

<script src="/WhatsAppCenter/public/js/conversations.js"></script>

<?php endif; ?>


<!-- =========================
     DASHBOARD
========================= -->

<?php if (($_GET['page'] ?? '') === 'dashboard'): ?>

<script src="/WhatsAppCenter/public/js/dashboard.js"></script>

<?php endif; ?>


<!-- =========================
     REPORTES
========================= -->

<?php if (($_GET['page'] ?? '') === 'reports'): ?>

<script src="/WhatsAppCenter/public/js/reports.js"></script>

<?php endif; ?>


<!-- =========================
     CONFIGURACIÓN
========================= -->

<?php if (($_GET['page'] ?? '') === 'settings'): ?>

<script src="/WhatsAppCenter/public/js/settings.js"></script>

<?php endif; ?>


</div>

</body>

</html>