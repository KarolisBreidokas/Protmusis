$(function() {
    $('#my').on("mousewheel", function(event) {
        event.preventDefault();
        $this = $(this);
        $inc = parseFloat($this.attr('step'));
        $max = parseFloat($this.attr('max'));
        $min = parseFloat($this.attr('min'));
        $currVal = parseFloat($this.val());

        // If blank, assume value of 0
        if (isNaN($currVal)) {
            $currVal = 0.0;
        }

        // Increment or decrement numeric based on scroll distance
        if (event.deltaFactor * event.deltaY > 0) {
            if ($currVal + $inc <= $max) {
                $this.val($currVal + $inc);
            }
        } else {
            if ($currVal - $inc >= $min) {
                $this.val($currVal - $inc);
            }
        }
    });
});
