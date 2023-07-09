
const autoNumericOptions = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 0,
    minimumValue: 0
};

const autoNumericRound = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 0,
    mRound: 'D'
};

const autoNumericOptionsZ = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 0,
};
const autoNumericLoad = {
    digitGroupSeparator: '.',
    decimalCharacter: ',',
    decimalPlaces: 0,
    formatOnPageLoad: true,
};

function formatNumber(angka, prefix) {
    var number_string = angka.toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        price = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? "." : "";
        price += separator + ribuan.join(".");
    }
    price = split[1] != undefined ? price + "," + split[1] : price;
    return prefix == undefined ? price : price ? "" + price : "";
}


function formatNominal(angka, prefix) {
    var number_string = angka.toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        price = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? "." : "";
        price += separator + ribuan.join(".");
    }
    price = split[1] != undefined ? price + "," + split[1] : price;
    return prefix == undefined ? price : price ? "" + price : "";
}

function formatHarta(angka, prefix) {
    var number_string = angka.toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        price = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
        separator = sisa ? "." : "";
        price += separator + ribuan.join(".");
    }
    price = split[1] != undefined ? price + "," + split[1] : price;
    return prefix == undefined ? price : price ? "" + price : "";
}










