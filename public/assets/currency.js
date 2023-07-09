// Jquery Dependency
$("input[data-type='currency']").on({
    keyup: function () {
        formatCurrency($(this));
    },
    blur: function () {
        formatCurrency($(this), "blur");
    },
});

function price_to_number(v) {
    if (!v) {
        return 0;
    }
    v = v.split(".").join("");
    v = v.split(",").join(".");
    return Number(v.replace(/[^0-9.]/g, ""));
}

function number_to_price(v) {
    if (v == 0) {
        return "0";
    }
    v = parseFloat(v);
    v = v.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v = v.split(".").join("*").split(",").join(".").split("*").join(",");
    return v;
}

function number_to_price2(v) {
    if (v == 0) {
        return "0";
    }
    v = parseFloat(v);
    v = v.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    v = v.split(".").join("*").split(",").join(".").split("*").join(",");
    return v;
}

function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".", ",");
}

function formatCurrency(input, blur) {
    // appends $ to value, validates decimal side
    // and puts cursor back in right position.

    // get input value
    var input_val = input.val();

    // don't validate empty input
    if (input_val === "") {
        return;
    }
    // original length
    var original_len = input_val.length;
    // initial caret position
    var caret_pos = input.prop("selectionStart");
    // no decimal entered
    // add commas to number
    // remove all non-digits
    input_val = formatNumber(input_val);
    input_val = input_val;

    // final formatting
    if (blur === "blur") {
        input_val += "";
    }

    // send updated string to input
    input.val(input_val);

    // put caret back in the right position
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}