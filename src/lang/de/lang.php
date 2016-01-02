<?php

return [
	'404'      => 'Seite nicht gefunden.',
	'required_field'	=> 'Pflichtfeld',
	'auth'     => [
		'title'          => 'Anmelden',
		'username'       => 'Benutzername',
		'password'       => 'Passwort',
		'login'          => 'Login',
		'logout'         => 'Logout',
		'email'       	 => 'E-Mail',
		'wrong-username' => 'Falscher Benutzername',
		'wrong-email' 	 => 'Falsche E-Mail',
		'wrong-password' => 'oder falsches Passwort'
	],
	'ckeditor' => [
		'upload'        => [
			'success' => 'Datei hochgeladen: \\n- Größe: :size kb \\n- Breite/Höhe: :width x :height',
			'error'   => [
				'common'              => 'Die Datei konnte nicht hochgeladen werden.',
				'wrong_extension'     => 'Das Format der Datei ":file" ist nicht erlaubt.',
				'filesize_limit'      => 'Die Datei darf höchstens :size kb groß sein.',
				'imagesize_max_limit' => 'Breite x Höhe = :width x :height \\n Maximal sind :maxwidth x :maxheight erlaubt',
				'imagesize_min_limit' => 'Breite x Höhe = :width x :height \\n Das Bild muss mindestens :minwidth x :minheight Pixel groß sein',
			]
		],
		'image_browser' => [
			'title'    => 'Bild vom Server benutzen',
			'subtitle' => 'Bild zum Einfügen auswählen',
		],
	],
	'table'    => [
		'new-entry'      => 'Neu',
		'edit'           => 'Ändern',
		'restore'        => 'Wiederherstellen',
		'delete'         => 'Löschen',
		'delete-confirm' => 'Soll dieser Eintag wirklich gelöscht werden?',
		'delete-error'   => 'Es ist ein Fehler beim Löschen aufgetreten. Bitte erst alle hiermit verknüpften Einträge löschen.',
		'moveUp'         => 'Hoch',
		'moveDown'       => 'Runter',
		'error'          => 'Da ist während der Anfrage etwas schief gelaufen.',
		'filter'         => 'Zeige ähnliche',
		'filter-goto'    => 'Anzeigen',
		'save'           => 'Speichern',
		'cancel'         => 'Abbrechen',
		'download'       => 'Herunterladen',
		'all'            => 'Alle',
		'processing'     => '<i class="fa fa-5x fa-circle-o-notch fa-spin"></i>',
		'loadingRecords' => 'Lade...',
		'lengthMenu'     => 'Zeige _MENU_ Einträge',
		'zeroRecords'    => 'Keine Einträge gefunden.',
		'info'           => 'Zeige Einträge von _START_ bis _END_ von insgesamt _TOTAL_',
		'infoEmpty'      => 'Zeige 0 bis 0 von 0 Einträgen',
		'infoFiltered'   => '(gefiltert von _MAX_ Einträgen insgesamt)',
		'infoThousands'  => '.',
		'infoPostFix'    => '',
		'search'         => 'Suche: ',
		'emptyTable'     => 'Keine Daten verfügbar',
		'paginate'       => [
			'first'    => '<i class="fa fa-angle-double-left"></i>',
			'previous' => '<i class="fa fa-angle-left"></i>',
			'next'     => '<i class="fa fa-angle-right"></i>',
			'last'     => '<i class="fa fa-angle-double-right"></i>'
		]
	],
	'select'   => [
		'nothing'  => 'Nichts ausgewählt',
		'selected' => 'ausgewählt',
		'placeholder' => 'Von Liste auswählen',
	],
	'image'    => [
		'browse'         => 'Bild auswählen',
		'browseMultiple' => 'Bilder auswählen',
		'remove'         => 'Bild löschen',
		'clear'			 => 'Leeren',
	],
	'file'     => [
		'browse' => 'Datei auswählen',
		'remove' => 'Datei löschen',
	],
	'menu'		=> [
		'dashboard'	=> '&Uuml;bersicht',
		'user'	=> [
			'category'		=> 'Benutzerverwaltung',
			'users'			=> 'Benutzer',
			'roles'			=> 'Rollen',
			'permissions'	=> 'Berechtigungen'
		]
	],
	'permission' => [
		'denied' 	=> 'Keine Berechtigung',
		'backend'	=> 'Backend',
		'without_group'	=> 'Ohne Gruppe',
		'headline'	=> [
			'permission' 	=> 'Berechtigung',
			'allowed'		=> 'Erlauben',
			'denied'		=> 'Verbieten',
			'inherited'		=> 'Vererben'
		]
	],
	'save' => [
		'edit' => 'Der Datensatz wurde erfolgreich bearbeitet.',
		'create' => 'Der Datensatz wurde erfolgreich erstellt.',
		'destroy' => 'Der Datensatz wurde erfolgreich gelöscht.',
		'restore' => 'Der Datensatz wurde erfolgreich wiederhergestellt.'
	],

	'settings'		=> 'Benutzereinstellungen'
];