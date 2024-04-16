// JavaScript Document
featuredcontentslider.init({
    id: "slider2",  //id of main slider DIV
    contentsource: ["inline", ""],  //Valid values: ["inline", ""] or ["ajax", "path_to_file"]
    toc: "#increment",  //Valid values: "#increment", "markup", ["label1", "label2", etc]
    nextprev: ["Previous", "Next"],  //labels for "prev" and "next" links. Set to "" to hide.
    revealtype: "click", //Behavior of pagination links to reveal the slides: "click" or "mouseover"
    enablefade: [true, 0.2],  //[true/false, fadedegree]
    autorotate: [false, 3000],  //[true/false, pausetime]

})
