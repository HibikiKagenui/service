/*
Navbar animation
 */
$(document).ready(function () {
    /*
    Drop shadow effect on navbar after scrolling
     */
    $(window).on('scroll', function () {
        if (!$(document).scrollTop()) {
            // At top of page.
            $('.navbar').removeClass('shrink').removeClass('shadow-sm');
        } else {
            // Not at top of page.
            $('.navbar').addClass('shrink').addClass('shadow-sm');
        }
    });
});

/*
Creating back button to add to div#backbutton
 */
// icon for back button
var backicon = document.createElement('span');
backicon.className = "fas fa-chevron-left";
// the back button
var backbutton = document.createElement('button');
backbutton.className = "btn btn-primary";
backbutton.setAttribute('onclick', 'window.history.back()');
backbutton.appendChild(backicon);
backbutton.appendChild(document.createTextNode(" Kembali"));
// append back button to div.backbutton
document.getElementById("back-button").appendChild(backbutton);

/*
Close (hide) message box
*/
function closeMessage() {
    document.getElementById('message-box').hidden = true;
}

/*
checkbox
 */
function onChecked(awanama) {
    var box = document.getElementById(awanama.id);

    if (box.checked) {
        document.getElementById('jenis_kendaraan').disabled = true;
        document.getElementById('nomor_polisi').disabled = true;
        document.getElementById('keluhan').disabled = true;

        document.getElementById('jenis_kendaraan').value = '';
        document.getElementById('nomor_polisi').value = '';
        document.getElementById('keluhan').value = '';
    } else {
        document.getElementById('jenis_kendaraan').disabled = false;
        document.getElementById('nomor_polisi').disabled = false;
        document.getElementById('keluhan').disabled = false;
    }
}
