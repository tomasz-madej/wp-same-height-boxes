document.addEventListener("DOMContentLoaded", function(e) {
    const container = sbh_var.parentClass;
    const box = sbh_var.childClass;
    var resizeTimer;

    if(container && box) same_height_boxes(container, box);

    /**Call same_height_boxes function after window resize event*/
    window.addEventListener('resize', function(){
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            if(container && box) same_height_boxes(container, box);
        }, 250);
    }, true);
});

function same_height_boxes(parentClass, childClass) {

    /**Find all parent containers*/
    var container = document.querySelectorAll("." + parentClass);

    container.forEach(function(singleContainer, i) {

        /**Find all boxes inside single container*/
        var boxes = singleContainer.querySelectorAll("." + childClass),
            hgt = 0;

        boxes.forEach(function(box, i) {

            /**Set height of single box to auto value*/
            box.style["height"] = "auto";

            /**Get box offsetHeight (with padding and border)*/
            var boxHeight = box.offsetHeight;

            /**
             * If it is first box - set hgt value
             * If it isn't, compare values
             * Get highest value and set up the new hgt
             */
            if(hgt > 0) {
                if(boxHeight > hgt) hgt = boxHeight;
            } else {
                hgt = boxHeight;
            }
        });

        if(hgt > 0) {
            /**Set hgt value for each box*/
            boxes.forEach(function(box, i) {
                box.style["height"] = hgt + "px";
            });
        }
    });
}