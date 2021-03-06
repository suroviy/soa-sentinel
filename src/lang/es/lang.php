<?php

return [
	'404'      => 'Página no encontrada.',
	'required_field'	=> 'Required',
	'auth'     => [
		'title'          => 'Autorización',
		'username'       => 'Usuario',
		'password'       => 'Contraseña',
		'login'          => 'Iniciar sesión',
		'logout'         => 'Cerrar sesión',
		'wrong-username' => 'Usuario',
		'wrong-password' => 'o contraseña incorrectos'
	],
	'ckeditor' => [
		'upload'        => [
			'success' => 'El archivo ha sido subido: \\n- Tamaño: :size kb \\n- ancho/alto: :width x :height',
			'error'   => [
				'common'              => 'No se ha podido subir el archivo.',
				'wrong_extension'     => 'El archivo ":file" tiene una extensión incorrecta.',
				'filesize_limit'      => 'El tamaño máximo de archivo permitido es :size kb.',
				'imagesize_max_limit' => 'Ancho x Alto = :width x :height \\n El Ancho x Alto máximo debe ser: :maxwidth x :maxheight',
				'imagesize_min_limit' => 'Ancho x Alto = :width x :height \\n El Ancho x Alto mínimo debe ser: :minwidth x :minheight',
			]
		],
		'image_browser' => [
			'title'    => 'Insertar imágen desde el servidor',
			'subtitle' => 'Selecciona imágen a insertar',
		],
	],
	'table'    => [
		'new-entry'      => 'Nuevo registro',
		'edit'           => 'Editar',
		'delete'         => 'Eliminar',
		'delete-confirm' => '¿Confirmas eliminar este registro?',
		'delete-error'   => 'No se ha podido eliminar este registro. Primero debes eliminar las entradas relacionadas a esta.',
		'moveUp'         => 'Mover arriba',
		'moveDown'       => 'Mover abajo',
		'filter'         => 'Mostrar registros similiares',
		'filter-goto'    => 'Mostrar',
		'save'           => 'Guardar',
		'cancel'         => 'Cancelar',
		'download'       => 'Descargar',
		'all'            => 'Todos',
		'processing'     => '<i class="fa fa-5x fa-circle-o-notch fa-spin"></i>',
		'loadingRecords' => 'Cargando...',
		'lengthMenu'     => 'Mostrar registros de _MENU_ ',
		'zeroRecords'    => 'No se han encontrado resultados.',
		'info'           => 'Mostrando de _START_ a _END_ de _TOTAL_ registros',
		'infoEmpty'      => 'Mostrando de 0 a 0 de 0 registros',
		'infoFiltered'   => '(filtrado de un total de _MAX_ registros)',
		'infoThousands'  => ',',
		'infoPostFix'    => '',
		'search'         => 'Buscar: ',
		'emptyTable'     => 'No hay información disponible.',
		'paginate'       => [
			'first'    => 'Primera',
			'previous' => '&larr;',
			'next'     => '&rarr;',
			'last'     => 'Última'
		]
	],
	'select'   => [
		'nothing'  => 'No hay nada seleccionado',
		'selected' => 'seleccionados'
	],
	'menu'		=> [
		'dashboard'	=> 'Dashboard',
		'user'	=> [
			'category'		=> 'User Management',
			'users'			=> 'Users',
			'roles'			=> 'Roles',
			'permissions'	=> 'Permissions'
		]
	],
];
