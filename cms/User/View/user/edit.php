<?php
User_View_Template::instace()->getHeader();
$st = $credencial->get('status');
?>
<div id="app">
  <div class="content">
    <h2 class="bc"><a href="/sites/pulporecords/<?php Core_Common_Route::linkController('index:index');?>">Registros</a> &gt; Editar registro</h2>
      <div class="form">
        <form id="form1" name="form1" method="post" action="<?php Core_Common_Route::linkController('index:index'); ?>" class="app">
          <fieldset class="vertical">
          <h3><a id="personal-info" href="#personal-info">Información Personal</a></h3>
          <ul>
            <li><div class="label"><label for="name">Nombre de usuario</label></div>
            <div class="cell"><input type="text" name="name" id="name"  value="<?php echo $registro->get('name'); ?>"/> </div></li>
            <li><div class="label"><label for="email">Email</label></div>
            <div class="cell"><input type="text" name="email" id="email" value="<?php echo $registro->get('email'); ?>"/></div></li>
            <li><div class="label"><label for="login">Usuario</label></div>
            <div class="cell"><input type="text" name="login" id="login" value="<?php echo $credencial->get('user'); ?>"/></div></li>
            <li><div class="label"><label for="password1">Password</label></div>
            <div class="cell"><input type="password" name="password1" id="password1" /></div></li>
            <li><div class="label"><label for="password2">Confirme password</label></div>
            <div class="cell"><input type="password" name="password2" id="password2" />
            </div></li>
            <li><div class="label"><label>Estatus</label></div>
            <div class="cell">
            <select name="status">
            <option value="1" <?php if( $st == 1){ echo 'selected'; } ?> >Activo</option>
            <option value="2" <?php if( $st == 2){ echo 'selected'; } ?> >Inactivo</option>
            <option value="3" <?php if( $st == 3){ echo 'selected'; } ?> >Cancelar</option>
            </select>
            </div></li>
            <li><div class="label"><label for="password2">&nbsp;</label></div>
            <div class="cell">
            <input type="submit" name="button" id="button" value="Actualizar" />
            <input type="hidden" name="id" value="<?php echo $registro->get('id'); ?>" />
            <input name="process" type="hidden" id="process" value="user:update" />
            </div>
            </li>
          </ul>
        </fieldset>
      </form>
    </div>
  </div>
  <div class="menu">
    <!-- <a href="/sites/pulporecords/<?php //Core_Common_Route::linkController('registro:create');?>" id="create_new_register" class="button">Crear nuevo registro</a> -->
  </div>
</div>
<?php
User_View_Template::instace()->getFooter();
?>