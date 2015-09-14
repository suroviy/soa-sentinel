<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"                => "Das Feld :attribute muss bestätigt werden.",
	"active_url"              => "Im Feld :attribute steht keine gültige URL.",
	"after"                   => "Das Datum im Feld :attribute muss nach dem :date liegen.",
	"alpha"                   => "Das Feld :attribute darf nur Buchstaben enthalten.",
	"alpha_dash"              => "Das Feld :attribute darf nur Buchstaben, Zahlen und '-' enthalten.",
	"alpha_num"               => "Das Feld :attribute darf nur Buchstaben und Zahlen enthalten.",
	"array"                   => "Das Feld :attribute muss ein Array sein.",
	"before"                  => "Das Datum im Feld :attribute muss vor dem :date liegen",
	"between"                 => [
		"numeric" => "Das Feld :attribute muss zwischen :min und :max sein.",
		"file"    => "Die Datei im Feld :attribute muss zwischen :min und :max kilobytes haben.",
		"string"  => "Das Feld :attribute muss zwischen :min und :max Zeichen haben.",
		"array"   => "Das Feld :attribute darf nur zwischen :min und :max Einträge haben.",
	],
	"confirmed"               => "Die Wiederholung im Feld :attribute stimmt nicht überein.",
	"date"                    => "Das Datum im Feld :attribute ist nicht gültig.",
	"date_format"             => "Das Feld :attribute muss im Format :format eingegeben werden.",
	"different"               => "Die Felder :attribute und :other dürfen nicht identisch sein.",
	"digits"                  => "Das Feld :attribute muss mindestens :digits Zeichen lang sein.",
	"digits_between"          => "Das Feld :attribute muss zwischen :min und :max Zeichen lang sein.",
	"email"                   => "Das Feld :attribute enthält keine gültige E-Mail Adresse.",
	"exists"                  => "Die Auswahl im Feld :attribute is ungültig.",
	"image"                   => "Das Feld :attribute muss eine Bilddatei enthalten.",
	"in"                      => "Die Auswahl im Feld :attribute is ungültig.",
	"integer"                 => "Das Feld :attribute muss eine ganze Zahl enthalten.",
	"ip"                      => "Das Feld :attribute muss eine gültige IP-Adresse enthalten.",
	"max"                     => [
		"numeric" => "Der Wert im Feld :attribute darf nicht größer als :max sein.",
		"file"    => "Die Datei im Feld :attribute darf nicht größer als :max kilobytes sein.",
		"string"  => "Der Wert im Feld :attribute darf nicht mehr als :max Zeichen haben.",
		"array"   => "Das Feld :attribute darf nicht mehr als :max Einträge haben.",
	],
	"mimes"                   => "Im Feld :attribute sind nur folgende Dateitypen erlaubt: :values.",
	"min"                     => [
		"numeric" => "Der Wert im Feld :attribute darf nicht kleiner als :min sein.",
		"file"    => "Die Datei im Feld :attribute muss mindestens :min kilobytes groß sein.",
		"string"  => "Der Wert im Feld :attribute muss mindestens :min Zeichen haben.",
		"array"   => "Das Feld :attribute muss mindestens :min Einträge haben.",
	],
	"not_in"                  => "Die Auswahl im Feld :attribute is ungültig.",
	"not_php"                 => "Falscher Dateityp.",
	"numeric"                 => "Das Feld :attribute muss eine Zahl enthalten.",
	"regex"                   => "Das Feld :attribute hat das falsche Format.",
	"required"                => "Das Feld :attribute muss ausgefüllt werden.",
	"required_only_on_create" => "Das Feld :attribute muss ausgefüllt werden.",
	"required_if"             => "Das Feld :attribute muss ausgefüllt werden, wenn :other :value ist.",
	"required_with"           => "Das Feld :attribute muss ausgefüllt werden, wenn :values existiert.",
	"required_with_all"       => "Das Feld :attribute muss ausgefüllt werden, wenn :values existiert.",
	"required_without"        => "Das Feld :attribute muss ausgefüllt werden, wenn :values nicht existiert.",
	"required_without_all"    => "Das Feld :attribute muss ausgefüllt werden, wenn nichts von :values existiert.",
	"same"                    => "Die Felder :attribute and :other müssen identisch sein.",
	"size"                    => [
		"numeric" => "Der Wert im Feld :attribute muss dem Wert :size entsprechen.",
		"file"    => "Die Datei im Feld :attribute muss :size kilobytes haben.",
		"string"  => "Der Wert im Feld :attribute muss :size Zeichen haben.",
		"array"   => "Das Feld :attribute muss :size Einträge haben.",
	],
	"unique"                  => "Der Eintrag im Feld :attribute existiert bereits.",
	"url"                     => "Das Format im Feld :attribute ist ungültig.",
	"url_stub"                => "Das Format im Feld :attribute ist ungültig.",
	"url_stub_full"           => "Das Format im Feld :attribute ist ungültig.",


	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes'              => [],

];