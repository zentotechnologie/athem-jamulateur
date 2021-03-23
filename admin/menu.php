<ul class="sidebar-menu">
  <li class="header">Menu</li>
  <li class="treeview" >
    <a href="../" target="_blank">
      <i class="fa fa-globe"></i> <span>Voir le site</span> </i>
    </a> 
  </li>
  <li class="treeview <?= ($activePage == 'home') ? 'active':'' ?>">
    <a href="./home.php">
      <i class="fa fa-chevron-right"></i> <span>Liste des devis</span> </i>
    </a> 
  </li>
  <li class="treeview <?= ($activePage == 'prices') ? 'active':'' ?>">
    <a href="./prices.php">
      <i class="fa fa-chevron-right"></i> <span>Coûts & Forfaits</span> </i>
    </a> 
  </li>
  <li class="treeview <?= ($activePage == 'types') ? 'active':'' ?>">
    <a href="types.php">
      <i class="fa fa-chevron-right"></i> <span>Types des événements</span> </i>
    </a> 
  </li>
  <li class="treeview <?= ($activePage == 'contact') ? 'active':'' ?>">
    <a href="contact.php">
      <i class="fa fa-chevron-right"></i> <span>Contact</span> </i>
    </a> 
  </li>
  <li class="treeview <?= ($activePage == 'cgv') ? 'active':'' ?>">
    <a href="cgv.php">
      <i class="fa fa-chevron-right"></i> <span>Conditions générales</span> </i>
    </a> 
  </li>
  <li class="treeview">
    <a href="logout.php">
      <i class="fa fa-sign-out"></i> <span>Déconnexion</span> </i>
    </a> 
  </li>
    
</ul>