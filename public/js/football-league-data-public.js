<script type="text/javascript">
    
        function toggletable(num) {
            console.log("FG")
            let x = document.getElementById(num + "table");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function rotate_trng(num) {
            let element = document.getElementById(num + "triangle");
            element.classList.toggle("flip");
        }

        function zoomimg(num) {

        }

        function underrow(num) {
            console.log(num + "  entered")
            let element = document.getElementById(num + "logo");
            element.classList.toggle("bigger");
        }

        function underrowleave(num) {
            console.log(num + "  leave")
            let element = document.getElementById(num + "logo");
            element.classList.toggle("bigger");
        }
   </script>