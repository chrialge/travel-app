import flatpickr from "flatpickr";


const dateNow = function (addDay) {
    var data = new Date();
    var gg, mm, aaaa;
    gg = data.getDate() + addDay + "/";
    mm = data.getMonth() + 1 + "/";
    aaaa = data.getFullYear();
    return gg + mm + aaaa;
}

let date = dateNow(0);
console.log(date)

if (document.getElementById("date_range").hasAttribute('data-range')) {
    console.log(document.getElementById("date_range"))
    const dateRange = document.getElementById("date_range").dataset.range;
    const dates = dateRange.split(",")
    let begin = dates[0].split('-');
    begin = begin[2] + '/' + begin[1] + '/' + begin[0]
    let end = dates[1].split('-');
    end = end[2] + '/' + end[1] + '/' + end[0]
    console.log(dates);
    let calendar = flatpickr("input[type='date']", {
        mode: "range",
        defaultDate: [begin, end],
        dateFormat: "d/m/Y",


    })
} else {
    let calendar = flatpickr("input[type='date']", {
        mode: "range",
        defaultDate: [dateNow(0), dateNow(7)],
        dateFormat: "d/m/Y",


    })
}


