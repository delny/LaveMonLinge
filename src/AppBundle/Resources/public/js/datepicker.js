/**
 * Created by Utilisateur on 20/04/2017.
 */
$(function() {




    $('#app_bundle_date_choice_type_dateCollect').change(function(){
        var datepickerCollect = $('#app_bundle_date_choice_type_dateCollect').val();

        var datepickerCollectAffichage = format(datepickerCollect);
        $('#app_bundle_date_choice_type_dateCollect').val(datepickerCollectAffichage);

        var dateCollecteAffichage = new Date(datepickerCollect);
        $('#app_bundle_date_choice_type_dateCollect').html(DateLocale(dateCollecteAffichage));


        var dateDelivery = new Date(datepickerCollect);
        dateDelivery.setDate(dateDelivery.getDate() + 3);
        dateDelivery.setHours(0,0,0,0);

        var day = dateDelivery.getDay();

        if(day == 0){
            dateDelivery.setDate(dateDelivery.getDate() + 1 );
        }
        
        for (i = 0; i < disabledDays.length; i++) {
            if(dateDelivery.valueOf() == disabledDays[i].valueOf()){
                dateDelivery.setDate(dateDelivery.getDate() + 1);
                $('#app_bundle_date_choice_type_dateDelivery').val(format(dateDelivery));
            }else{
                $('#app_bundle_date_choice_type_dateDelivery').val(format(dateDelivery));
            }

        }
    });

    function format(inputDate) {
        var date = new Date(inputDate);
        if (!isNaN(date.getTime())) {
            var day = date.getDate().toString();
            var month = (date.getMonth() + 1).toString();
            // Months use 0 index.

            return (day[1] ? day : '0' + day[0]) + '-' +
                (month[1] ? month : '0' + month[0]) + '-' +
                date.getFullYear();
        }
    }


    function DateLocale(d) {
        //Les traductions des jours en mois (ici juste fr et en mais on peut completer)
        var tabJours = {
            'fr': ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche']
        };
        var tabMois = {
            'fr': ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']
        };

        var Jour = tabJours['fr'][d.getDay() - 1];
        var Mois = tabMois['fr'][d.getMonth()];
        return Jour + " " + d.getDate() + " " + Mois + " " + d.getFullYear();

    }


    function JoursFeries(an) {
        var JourAn = new Date(an, "00", "1")
        var FeteTravail = new Date(an, "4", "1")
        var Victoire1945 = new Date(an, "4", "8")
        var FeteNationale = new Date(an, "6", "14")
        var Assomption = new Date(an, "7", "15")
        var Toussaint = new Date(an, "10", "1")
        var Armistice = new Date(an, "10", "11")
        var Noel = new Date(an, "11", "25")
        var G = an % 19
        var C = Math.floor(an / 100)
        var H = (C - Math.floor(C / 4) - Math.floor((8 * C + 13) / 25) + 19 * G + 15) % 30
        var I = H - Math.floor(H / 28) * (1 - Math.floor(H / 28) * Math.floor(29 / (H + 1)) * Math.floor((21 - G) / 11))
        var J = (an * 1 + Math.floor(an / 4) + I + 2 - C + Math.floor(C / 4)) % 7
        var L = I - J
        var MoisPaques = 3 + Math.floor((L + 40) / 44)
        var JourPaques = L + 28 - 31 * Math.floor(MoisPaques / 4)
        var Paques = new Date(an, MoisPaques - 1, JourPaques)
        var VendrediSaint = new Date(an, MoisPaques - 1, JourPaques - 2)
        var LundiPaques = new Date(an, MoisPaques - 1, JourPaques + 1)
        var Ascension = new Date(an, MoisPaques - 1, JourPaques + 39)
        var Pentecote = new Date(an, MoisPaques - 1, JourPaques + 49)
        var LundiPentecote = new Date(an, MoisPaques - 1, JourPaques + 50)
        return [JourAn, LundiPaques, FeteTravail, Victoire1945, Ascension, LundiPentecote, FeteNationale, Assomption, Toussaint, Armistice, Noel];
    }

    var disabledDays = JoursFeries(2017);

    /* utility functions */
    function nationalDays(date) {
        var m = date.getMonth(),
            d = date.getDate(),
            y = date.getFullYear();

        var x = new Date(y, m, d);

        for (i = 0; i < disabledDays.length; i++) {
            if ( x.valueOf() == disabledDays[i].valueOf()  || new Date() == date) {
                return [false];
            }
        }
        return [true];
    }

    function noWeekendsOrHolidays(date) {
        var day = date.getDay();
        var noSunday = [(day != 0), ''];
        if (noSunday[0]) {
            return nationalDays(date);
        } else {
            return noSunday;
        }
    }

    $('#app_bundle_date_choice_type_dateCollect').datepicker({
        altField: "#datepicker",
        closeText: 'Fermer',
        prevText: 'Précédent',
        nextText: 'Suivant',
        currentText: 'Aujourd\'hui',
        monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
        monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
        dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
        dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
        dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
        weekHeader: 'Sem.',
        dateFormat: 'yy-mm-dd',
        firstDay: 1,
        minDate: 0,
        maxDate: "+365d",
        beforeShowDay: noWeekendsOrHolidays,
        todayHighlight: true,
    });
});