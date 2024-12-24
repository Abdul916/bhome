<?php
User_View_Template::instace()->getHeader();
?>
<div id="app">
  <div class="content">
    <h2 class="bc"><a href="/sites/pulporecords/<?php Core_Common_Route::linkController('index:index');?>">Registros</a> &gt; Crear nuevo registro</h2>
    <div class="form">
      <form id="form1" name="form1" method="post" action="<?php Core_Common_Route::linkController('index:index'); ?>" class="app" autocomplete="off">
        <fieldset class="vertical">
          <h3><a id="personal-info" href="#personal-info">Información Personal</a></h3>
          <ul>
            <li>
              <div class="label"><label for="name">Nombre de usuario</label></div>
              <div class="cell"><input type="text" name="name" id="name" /></div>
            </li>
            <li>
              <div class="label"><label for="email">Email</label></div>
              <div class="cell"><input type="text" name="email" id="email" /></div>
            </li>
            <li>
              <div class="label"><label for="login">Usuario</label></div>
              <div class="cell"><input type="text" name="login" id="login" /></div>
            </li>
            <li>
              <div class="label"><label for="password1">Password</label></div>
              <div class="cell"><input type="password" name="password1" id="password1" /></div>
            </li>
            <li>
              <div class="label"><label for="password2">Confirme password</label></div>
              <div class="cell"><input type="password" name="password2" id="password2" /></div>
            </li>
            <li>
              <div class="label"><label>Estatus</label></div>
              <div class="cell">
                <select name="status">
                  <option value="1">Activo</option>
                  <option value="2">Inactivo</option>
                </select>
              </div>
            </li>
            <li>
              <div class="label"><label for="password2">&nbsp;</label></div>
              <div class="cell">
                <input type="hidden" name="domain" id="domain" value="SITE.CIEV"/>
                <input type="submit" name="button" id="button" value="Registrar" />
                <input name="process" type="hidden" id="process" value="user:save" />
              </div>
            </li>
          </ul>
        </fieldset>
      </form>
    </div>	
  </div>
  <div class="menu">
    <a href="/sites/pulporecords/<?php Core_Common_Route::linkController('registro:create');?>" id="create_new_register" class="button">Crear nuevo registro</a>
  </div>
</div>
<?php 
User_View_Template::instace()->getFooter();
?>