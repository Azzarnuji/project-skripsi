// JavaScript Document
function checkIframe(iframe) {
    var elem = document.activeElement;
    if ((elem && elem.tagName == 'IFRAME') && iframe.src == "http://localhost:8000/login") {
        iframe.height = '1000px'
        // iframe.src = "http://localhost:8000/registrasi"

    }
}
ddsmoothmenu.init({
    mainmenuid: "smoothmenu1", //menu DIV id
    orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
    classname: 'ddsmoothmenu', //class added to menu's outer DIV
    //customtheme: ["#1c5a80", "#18374a"],
    contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
