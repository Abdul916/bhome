<?php
User_View_Template::instace()->getHeader();
?>
<div id="app">
		<div class="content">
			<h2 class="bc">Dashboard</h2>
			<table class="list">
				<caption><h5 class="topborder">Usuarios activos</h5></caption>
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Status</th>
						<th>Email</th>
						<th>Fecha registro</th>
                        <th>Fecha actualización</th>
                        <th></th>
					</tr>
				</thead>
                <?php if($registros->count() > 0): ?>
				<tbody>
                <?php foreach($registros as $registro): ?>
					<tr>
						<td><?php echo $registro->get('name'); ?></td>
						<td><?php 

							$cred = $registro->getCredential();
							$credential = new User_Model_Credentials( User_User::getDbConnection());
							$credential->find( $cred->get('id'));
							echo $credential->getCredentialStatus();

						?></td>
						<td><?php echo $registro->get('email'); ?></td>
                        <td><?php echo $registro->get('created_at'); ?></td>
                        <td><?php echo $registro->get('updated_at'); ?></td>
						<td class="opt"><a href="<?php Core_Common_Route::linkController('user:edit', array('id' => $registro->get('id'))) ?>">Editar</a></td>
					</tr>
                <?php endforeach; ?>
				</tbody>
                <?php endif; ?>
			</table>
		</div>
		<div class="menu">
		<a href="<?php Core_Common_Route::linkController('user:create');?>" id="create_new_register" class="button">Crear nuevo registro</a>
        <!--<a href="<?php //Core_Common_Route::linkController('user:users');?>" id="create_new_register_external" class="button">Ver registros</a>-->
		</div>
	</div>

<?php foreach($registros as $registro): ?>
<a href="<?php Core_Common_Route::linkController('user:edit', array('id' => $registro->get('id'))) ?>"></a><br />
<?php endforeach; ?>

<?php
User_View_Template::instace()->getFooter();
?>