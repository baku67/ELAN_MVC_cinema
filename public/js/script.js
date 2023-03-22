window.onload = function() {

    
    // $(document).ready( function () {
    //     $('#movieListTable').DataTable();
    // } );

    // Draw du logo Title
    var logoPathes = document.querySelectorAll('.titleSvgContainer path');
    logoPathes.forEach(element => {
        var lengthRec = element.getTotalLength();
        element.style.transition = element.style.WebkitTransition = 'none';
        element.style.strokeDasharray = lengthRec + ' ' + lengthRec;
        element.style.strokeDashoffset = lengthRec;
        element.getBoundingClientRect();
        element.style.transition = element.style.WebkitTransition =
        'stroke-dashoffset 2.5s 0.5s ease-in-out';
        element.style.strokeDashoffset = '0';    
    });

    // setTimeout(function() {
    //         document.getElementById("logoSvg1").style.fill = "rgba(254, 204, 2, 1)";
    // }, 2500)

    
}


