<aside class="admin__sidebar">
    <nav class="admin__menu">
        <a class="admin__enlace <?php echo pagina_actual('/admin/dashboard') ? 'admin__enlace--actual' : '' ?>" href="/admin/dashboard">
            <i class="admin__icono fa-solid fa-house"></i>
            <span class="admin__menu-texto">Inicio</span>
        </a>
        <a class="admin__enlace <?php echo pagina_actual('/admin/categorias') ? 'admin__enlace--actual' : '' ?>" href="/admin/categorias">
            <i class="admin__icono fa-solid fa-list"></i>
            <span class="admin__menu-texto">Categorias</span>
        </a>
        <a class="admin__enlace <?php echo pagina_actual('/admin/productos') ? 'admin__enlace--actual' : '' ?>" href="/admin/productos">
            <i class="admin__icono fa-solid fa-shirt"></i>
            <span class="admin__menu-texto">Productos</span>
        </a>
        <a class="admin__enlace <?php echo pagina_actual('/admin/usuarios') ? 'admin__enlace--actual' : '' ?>" href="/admin/usuarios">
            <i class="admin__icono fa-solid fa-users"></i>
            <span class="admin__menu-texto">Usuarios</span>
        </a>
        <a class="admin__enlace <?php echo pagina_actual('/admin/compras') ? 'admin__enlace--actual' : '' ?>" href="/admin/compras">
            <i class="admin__icono fa-solid fa-cart-shopping"></i>
            <span class="admin__menu-texto">Compras</span>
        </a>
        <a class="admin__enlace <?php echo pagina_actual('/admin/imagenes') ? 'admin__enlace--actual' : '' ?>" href="/admin/imagenes">
            <i class="admin__icono fa-solid fa-image"></i>
            <span class="admin__menu-texto">Loguin</span>
        </a>
    </nav>
</aside>