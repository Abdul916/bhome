moment.lang('es_mx', {
months : "Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre".split("_"),
monthsShort : "Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic".split("_"),
weekdays : "Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado".split("_"),
weekdaysShort : "Dom_Lun_Mar_Mie_Jue_Vie_Sab".split("_"),
longDateFormat : {
L : "DD/MM/YYYY",
LL : "D MMMM YYYY",
LLL : "D MMMM YYYY HH:mm",
LLLL : "dddd, D MMMM YYYY HH:mm"
},
relativeTime : {
future : "en %s",
past : "hace %s",
s : "segundos",
m : "un minuto",
mm : "%d minutos",
h : "una hora",
hh : "%d horas",
d : "un día",
dd : "%d días",
M : "un mes",
MM : "%d meses",
y : "un año",
yy : "%d años"
},
ordinal : function (number) {
	var b = number % 10;
	return (~~ (number % 100 / 10) === 1) ? '' :
	(b === 1) ? 'ero' :
	(b === 2) ? 'do' :
	(b === 3) ? 'ero' : '';
}
});