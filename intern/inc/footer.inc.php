 <hr>
 <div class="container">
   <div class="blockquote-footer">
     <p>(c) Copyright by Conny Roloff, TCO Olching e. V.</p>
   </div>
 </div>

 <?php include("js_dependencies.inc.php"); ?>
 <script>
   // Dein JavaScript-Code für Tabs
   document.addEventListener('DOMContentLoaded', function() {
     const tabItems = document.querySelectorAll('.tab-item');
     const tabPanes = document.querySelectorAll('.tab-pane');

     tabItems.forEach(item => {
       item.addEventListener('click', function() {
         // Entferne die aktive Klasse von allen Tabs
         tabItems.forEach(i => i.classList.remove('active'));
         tabPanes.forEach(p => p.classList.remove('active'));

         // Setze die aktive Klasse auf das geklickte Tab
         const tabId = this.getAttribute('data-tab');
         this.classList.add('active');
         document.getElementById(tabId).classList.add('active');
       });
     });
   });
 </script>

 </body>

 </html>