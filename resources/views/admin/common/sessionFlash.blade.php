@if(session('flash_message'))
    <div id="myModal" class="modal-xyz">
        <div class="modal-content-xyz {{ session('flash_class') }}">
                    {{ session('flash_message') }}
            <span class="close-xyz">×</span>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close-xyz")[0];

        // When the user clicks the button, open the modal
        modal.style.display = "flex";

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
        setTimeout(function() {
            modal.style.display = "none";
        }, 3000)
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endif